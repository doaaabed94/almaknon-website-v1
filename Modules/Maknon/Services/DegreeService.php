<?php

namespace Modules\Academic\Services;

use Modules\Academic\Entities\Car;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Contracts\Validation\Rule;
use App\Rules\UniqueInTranslations;

class CarService extends BaseService
{

    public  $validationsRules = [
        'postCreate' => [
        'status'                          => 'nullable|required|in:ACTIVE,DISABLED',
        ],
        'postUpdate' => [
            //'status'                          => 'nullable|in:ACTIVE,DISABLED',
        ],
    ];

    public function __construct($_isApi = false)
    {
        $this->data['locale']       = request()->locale ? request()->locale : app()->getLocale();
        $this->data['model']        = new Car();
        $this->isApi                = $_isApi;
    }

    public function getModel($id, ...$relations)
    {
        $this->data['model'] = Car::query();

        if (auth()->user()->isAn('ROOT') or auth()->user()->can('RESTORE_CARS'))
            $this->data['model']->withTrashed();

        if (auth()->user()->isAn('ROOT') or auth()->user()->can('STATUS_UPDATE_CARS'))
            $this->data['model']->withDisabled();
        if ($relations)
            $this->data['model']->with($relations);
        return $this->data['model']->find($id);
    }

    public function index()
    {      
        $this->data['ALL_MODEL_DATA_'] = $this->data['model']::select([
            '*',
            DB::raw('
                DATE_FORMAT(created_at, "%Y-%m-%d") AS new_created_at,
                DATE_FORMAT(updated_at, "%Y-%m-%d") AS new_updated_at
            '),
            DB::raw('(CASE 
                WHEN status = "ACTIVE"   THEN "'. __('member::strings.active') .'"
                WHEN status = "DISABLED" THEN "'. __('member::strings.disabled') .'"
                ELSE "-----"
            END) AS new_status')
        ]);
        
        if (auth()->user()->isAn('ROOT') or auth()->user()->can('RESTORE_CARS')) {
            $this->data['ALL_MODEL_DATA_']->withTrashed();
        }
        if (auth()->user()->isAn('ROOT') or auth()->user()->can('STATUS_UPDATE_CARS')) {
            $this->data['ALL_MODEL_DATA_']->withDisabled();
        }
 
        $this->data['ALL_MODEL_DATA_'] = $this->data['ALL_MODEL_DATA_']->with(['translations'])->get();

        return $this->data['ALL_MODEL_DATA_'];
    }


    public function store($data)
    {
        $this->data['currentUser']  = request()->user();
        $this->data['store_data']   = $data;

        if (is_array($this->data['store_data']['name'])) {
            foreach ($this->data['store_data']['name'] as $locale => $name) {
                if (!empty($this->data['store_data']['name'][$locale])) {
                    $this->data['model']->{'name:' . $locale}  = $this->data['store_data']['name'][$locale];
                }
            }
        } else {
            $this->data['model']->{'name:' . $this->data['locale']}    = $this->data['store_data']['name'];
        }

        if (is_array($this->data['store_data']['description'])) {
            foreach ($this->data['store_data']['description'] as $locale => $name) {
                if (!empty($this->data['store_data']['description'][$locale])) {
                    $this->data['model']->{'description:' . $locale}  = $this->data['store_data']['description'][$locale];
                }
            }
        } else {
            $this->data['model']->{'description:' . $this->data['locale']}    = $this->data['store_data']['description'];
        }

        $this->data['model']->created_by                    = $this->data['currentUser']->id;  
        $this->data['model']->status                        = empty($this->data['store_data']['status']) ? 'ACTIVE' : $this->data['store_data']['status'];   
        $this->data['model']->save();
        
        return $this->response(200, [], null, route('cars.index'));
    }

    public function update($id, $data)
    {
        $this->data['currentUser']  = request()->user();
        $this->data['update_data']  = $data;
        if (!$this->data['model'] = $this->getModel($id))
            return $this->response(404);

            if (is_array($this->data['update_data']['name'])) {
                foreach ($this->data['update_data']['name'] as $locale => $name) {
                        $this->data['model']->{'name:' . $locale}  = $this->data['update_data']['name'][$locale];
                }
            } else {
                $this->data['model']->{'name:' . $this->data['locale']}    = $this->data['update_data']['name'];
            }
    
            if (is_array($this->data['update_data']['description'])) {
                foreach ($this->data['update_data']['description'] as $locale => $name) {
                        $this->data['model']->{'description:' . $locale}  = $this->data['update_data']['description'][$locale];
                }
            } else {
                $this->data['model']->{'description:' . $this->data['locale']}    = $this->data['update_data']['description'];
            }

            $this->data['model']->created_by                    = $this->data['currentUser']->id;  
            $this->data['model']->save();

  
        return $this->response(200, [], null,route('cars.update', ['model' => $id]));  
    }

    public function delete($id)
    {
        $this->data['currentUser']          = request()->user();
        if (!$this->data['model']           = $this->getModel($id))
            return $this->response(404);

        $this->data['model']->deleted_by    = $this->data['currentUser']->id;
        $this->data['model']->save();
        $this->data['model']->delete();

        return $this->response(200, [
            'message_title' => __('member::strings.delete_success.title'),
            'message_description' => __('member::strings.delete_success.title'),
        ]);
    }

    public function restore($id)
    {
        $this->data['currentUser']  = request()->user();
        if (!$this->data['model'] = $this->getModel($id))
            return $this->response(404);

        $this->data['model']->updated_by = $this->data['currentUser']->id;
        $this->data['model']->restore();

        return $this->response(200, [
            'message_title' => __('member::strings.restore_success.title'),
            'message_description' => __('member::strings.restore_success.title'),
        ]);
    }

    public function status($id)
    {
              $this->data['currentUser']  = request()->user();
        if (!$this->data['model'] = $this->getModel($id))
            return $this->response(404);

        if ($this->data['model']->isDisabled()) {
            $this->data['model']->updated_by = $this->data['currentUser']->id;
            $this->data['model']->status  =  "ACTIVE";
            $this->data['model']->save();
            $this->data['model']->enable();
        } else if ($this->data['model']->isEnabled()) {
            $this->data['model']->updated_by = $this->data['currentUser']->id;
            $this->data['model']->status  =  "DISABLED";
            $this->data['model']->save();
            $this->data['model']->disable();
        }
        return $this->response(200);
    }

    public function forceDelete($id)
    {
        if (!$this->data['model'] = $this->getModel($id))
            return $this->response(404);

        $this->data['model']->forceDelete();
        return $this->response(200, [
            'message_name'       => __('member::strings.perma_delete_success.name'),
            'message_description' => __('member::strings.perma_delete_success.description'),
        ]);
    }
}
