<?php

namespace Modules\Maknon\Services;

use Illuminate\Support\Facades\DB;
use Modules\Maknon\Entities\Car;
use Modules\Member\Entities\Attachment;
use Str;
use Modules\Maknon\Entities\Evaluation;
use Modules\Maknon\Entities\Favourite;


class CarService extends BaseService
{

    public $validationsRules = [
        'postCreate' => [
            'marka_id'         => 'nullable',
            'offer_id'         => 'nullable',
            'condition_id'     => 'nullable',
            'fuel_id'          => 'nullable',
            'transmission'     => 'nullable',
            'years'            => 'nullable',
            'color_id'         => 'nullable',
            'price'            => 'nullable',
            'price_after'      => 'nullable',
            'currency_id'      => 'nullable',
            'show_in_site'     => 'nullable',
            'order'            => 'nullable',
            'slug'             => 'nullable',
            'meta_title'       => 'nullable',
            'meta_keyword'     => 'nullable',
            'meta_description' => 'nullable',
            'car_profile_img'  => 'nullable',
            'car_details_img'  => 'nullable',
            'status'           => 'nullable|required|in:ACTIVE,DISABLED',
        ],
        'postUpdate' => [
            'marka_id'         => 'nullable',
            'offer_id'         => 'nullable',
            'condition_id'     => 'nullable',
            'fuel_id'          => 'nullable',
            'transmission'     => 'nullable',
            'years'            => 'nullable',
            'color_id'         => 'nullable',
            'price'            => 'nullable',
            'price_after'      => 'nullable',
            'currency_id'      => 'nullable',
            'show_in_site'     => 'nullable',
            'order'            => 'nullable',
            'slug'             => 'nullable',
            'meta_title'       => 'nullable',
            'meta_keyword'     => 'nullable',
            'meta_description' => 'nullable',
            'car_profile_img'  => 'nullable',
            'car_details_img'  => 'nullable',
        ],
    ];

    public function __construct($_isApi = false)
    {
        $this->data['locale'] = request()->locale ? request()->locale : app()->getLocale();
        $this->data['model']  = new Car();
        $this->isApi          = $_isApi;
    }

    public function getModel($id, ...$relations)
    {
        $this->data['model'] = Car::query();

        if (auth()->user()->isAn('ROOT') or auth()->user()->can('RESTORE_CAR')) {
            $this->data['model']->withTrashed();
        }

        if (auth()->user()->isAn('ROOT') or auth()->user()->can('STATUS_UPDATE_CAR')) {
            $this->data['model']->withDisabled();
        }

        if ($relations) {
            $this->data['model']->with($relations);
        }

        return $this->data['model']->find($id);
    }

        public function getFavouriteModel($id, ...$relations)
    {
        $this->data['model'] = Favourite::query();

        if (auth()->user()->isAn('ROOT') or auth()->user()->can('RESTORE_CAR')) {
            $this->data['model']->withTrashed();
        }

        if (auth()->user()->isAn('ROOT') or auth()->user()->can('STATUS_UPDATE_CAR')) {
            $this->data['model']->withDisabled();
        }

        if ($relations) {
            $this->data['model']->with($relations);
        }

        return $this->data['model']->find($id);
    }


        public function getEvaluationModel($id, ...$relations)
    {
        $this->data['model'] = Evaluation::query();

        if (auth()->user()->isAn('ROOT') or auth()->user()->can('RESTORE_CAR')) {
            $this->data['model']->withTrashed();
        }

        if (auth()->user()->isAn('ROOT') or auth()->user()->can('STATUS_UPDATE_CAR')) {
            $this->data['model']->withDisabled();
        }

        if ($relations) {
            $this->data['model']->with($relations);
        }

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
                WHEN status = "ACTIVE"   THEN "' . __('member::strings.active') . '"
                WHEN status = "DISABLED" THEN "' . __('member::strings.disabled') . '"
                ELSE "-----"
            END) AS new_status'),
        ]);

        if (auth()->user()->isAn('ROOT') or auth()->user()->can('RESTORE_CAR')) {
            $this->data['ALL_MODEL_DATA_']->withTrashed();
        }
        if (auth()->user()->isAn('ROOT') or auth()->user()->can('STATUS_UPDATE_CAR')) {
            $this->data['ALL_MODEL_DATA_']->withDisabled();
        }

        $this->data['ALL_MODEL_DATA_'] = $this->data['ALL_MODEL_DATA_']->with(['translations'])->get();

        return $this->data['ALL_MODEL_DATA_'];
    }

    public function store($data)
    {
        $this->data['currentUser'] = request()->user();
        $this->data['store_data']  = $data;

        if (is_array($this->data['store_data']['name'])) {
            foreach ($this->data['store_data']['name'] as $locale => $name) {
                if (!empty($this->data['store_data']['name'][$locale])) {
                    $this->data['model']->{'name:' . $locale} = $this->data['store_data']['name'][$locale];
                }
            }
        } else {
            $this->data['model']->{'name:' . $this->data['locale']} = $this->data['store_data']['name'];
        }

        if (is_array($this->data['store_data']['description'])) {
            foreach ($this->data['store_data']['description'] as $locale => $name) {
                if (!empty($this->data['store_data']['description'][$locale])) {
                    $this->data['model']->{'description:' . $locale} = $this->data['store_data']['description'][$locale];
                }
            }
        } else {
            $this->data['model']->{'description:' . $this->data['locale']} = $this->data['store_data']['description'];
        }

        $this->data['model']->marka_id     = $this->data['store_data']['marka_id'];
        $this->data['model']->offer_id     = $this->data['store_data']['offer_id'];
        $this->data['model']->condition_id = $this->data['store_data']['condition_id'];
        $this->data['model']->fuel_id      = $this->data['store_data']['fuel_id'];
        $this->data['model']->transmission = $this->data['store_data']['transmission'];
        $this->data['model']->years        = $this->data['store_data']['years'];
        $this->data['model']->color_id     = $this->data['store_data']['color_id'];
        $this->data['model']->price        = $this->data['store_data']['price'];
        $this->data['model']->price_after  = $this->data['store_data']['price_after'];
        $this->data['model']->kilometer    = $this->data['store_data']['kilometer'];
        $this->data['model']->currency_id  = $this->data['store_data']['currency_id'];
        $this->data['model']->order        = $this->data['store_data']['order'];
        if (!isset($this->data['store_data']['slug'])) {
            if ($this->data['store_data']['name']['en']) {
                $slug = Str::slug($this->data['store_data']['name']['en']);
            } else {
                $slug = Str::slug($this->data['store_data']['name']['ar']);
            }
        } else {
            $slug = Str::slug($this->data['store_data']['slug']);
        }
        $this->data['model']->slug             = $slug;
        $this->data['model']->show_in_site     = $this->data['store_data']['show_in_site'];
        $this->data['model']->meta_title       = $this->data['store_data']['meta_title'];
        $this->data['model']->meta_keyword     = $this->data['store_data']['meta_keyword'];
        $this->data['model']->meta_description = $this->data['store_data']['meta_description'];

        $this->data['model']->created_by = $this->data['currentUser']->id;
        $this->data['model']->status     = empty($this->data['store_data']['status']) ? 'ACTIVE' : $this->data['store_data']['status'];
        $this->data['model']->save();

        if (isset($this->data['store_data']['car_details_img']) && is_array($this->data['store_data']['car_details_img']) && !empty($this->data['store_data']['car_details_img'])) {
            $attachments = Attachment::whereIn('id', $this->data['store_data']['car_details_img'])->get();
            foreach ($attachments as $key => $attachment) {
                $attachment->type            = 'LINKED';
                $attachment->attachable_id   = $this->data['model']->id;
                $attachment->attachable_type = get_class($this->data['model']);
                $attachment->save();
            }
        }

        if (isset($this->data['store_data']['car_profile_img']) && is_array($this->data['store_data']['car_profile_img']) && !empty($this->data['store_data']['car_profile_img'])) {
            $attachments = Attachment::whereIn('id', $this->data['store_data']['car_profile_img'])->get();
            foreach ($attachments as $key => $attachment) {
                $attachment->type            = 'LINKED';
                $attachment->attachable_id   = $this->data['model']->id;
                $attachment->attachable_type = get_class($this->data['model']);
                $attachment->save();
            }
        }

        return $this->response(200, [], null, route('cars.index'));
    }

    public function update($id, $data)
    {
        $this->data['currentUser'] = request()->user();
        $this->data['update_data'] = $data;
        if (!$this->data['model'] = $this->getModel($id)) {
            return $this->response(404);
        }

        if (is_array($this->data['update_data']['name'])) {
            foreach ($this->data['update_data']['name'] as $locale => $name) {
                if (!empty($this->data['update_data']['name'][$locale])) {
                    $this->data['model']->{'name:' . $locale} = $this->data['update_data']['name'][$locale];
                }
            }
        } else {
            $this->data['model']->{'name:' . $this->data['locale']} = $this->data['update_data']['name'];
        }

        if (is_array($this->data['update_data']['description'])) {
            foreach ($this->data['update_data']['description'] as $locale => $name) {
                if (!empty($this->data['update_data']['description'][$locale])) {
                    $this->data['model']->{'description:' . $locale} = $this->data['update_data']['description'][$locale];
                }
            }
        } else {
            $this->data['model']->{'description:' . $this->data['locale']} = $this->data['update_data']['description'];
        }

        $this->data['model']->marka_id     = $this->data['update_data']['marka_id'];
        $this->data['model']->offer_id     = $this->data['update_data']['offer_id'];
        $this->data['model']->condition_id = $this->data['update_data']['condition_id'];
        $this->data['model']->fuel_id      = $this->data['update_data']['fuel_id'];
        $this->data['model']->transmission = $this->data['update_data']['transmission'];
        $this->data['model']->years        = $this->data['update_data']['years'];
        $this->data['model']->color_id     = $this->data['update_data']['color_id'];
        $this->data['model']->price        = $this->data['update_data']['price'];
        $this->data['model']->kilometer    = $this->data['update_data']['kilometer'];
        $this->data['model']->price_after  = $this->data['update_data']['price_after'];
        $this->data['model']->currency_id  = $this->data['update_data']['currency_id'];
        $this->data['model']->order        = $this->data['update_data']['order'];
        if (!isset($this->data['update_data']['slug'])) {
            if ($this->data['update_data']['name']['en']) {
                $slug = Str::slug($this->data['update_data']['name']['en']);
            } else {
                $slug = Str::slug($this->data['update_data']['name']['ar']);
            }
        } else {
            $slug = Str::slug($this->data['update_data']['slug']);
        }
        $this->data['model']->slug             = $slug;
        $this->data['model']->show_in_site     = $this->data['update_data']['show_in_site'];
        $this->data['model']->meta_title       = $this->data['update_data']['meta_title'];
        $this->data['model']->meta_keyword     = $this->data['update_data']['meta_keyword'];
        $this->data['model']->meta_description = $this->data['update_data']['meta_description'];
        $this->data['model']->created_by       = $this->data['currentUser']->id;
        $this->data['model']->save();

        if (isset($this->data['update_data']['car_details_img']) && is_array($this->data['update_data']['car_details_img']) && !empty($this->data['update_data']['car_details_img'])) {
            $attachments = Attachment::whereIn('id', $this->data['update_data']['car_details_img'])->get();
            foreach ($attachments as $key => $attachment) {
                $attachment->type            = 'LINKED';
                $attachment->attachable_id   = $this->data['model']->id;
                $attachment->attachable_type = get_class($this->data['model']);
                $attachment->save();
            }
        }

        if (isset($this->data['update_data']['car_profile_img']) && is_array($this->data['update_data']['car_profile_img']) && !empty($this->data['update_data']['car_profile_img'])) {
            $attachments = Attachment::whereIn('id', $this->data['update_data']['car_profile_img'])->get();
            foreach ($attachments as $key => $attachment) {
                $attachment->type            = 'LINKED';
                $attachment->attachable_id   = $this->data['model']->id;
                $attachment->attachable_type = get_class($this->data['model']);
                $attachment->save();
            }
        }

        return $this->response(200, [], null, route('cars.update', ['model' => $id]));
    }

    public function delete($id)
    {
        $this->data['currentUser'] = request()->user();
        if (!$this->data['model'] = $this->getModel($id)) {
            return $this->response(404);
        }

        $this->data['model']->deleted_by = $this->data['currentUser']->id;
        $this->data['model']->save();
        $this->data['model']->delete();

        return $this->response(200, [
            'message_title'       => __('member::strings.delete_success.title'),
            'message_description' => __('member::strings.delete_success.title'),
        ]);
    }

    public function restore($id)
    {
        $this->data['currentUser'] = request()->user();
        if (!$this->data['model'] = $this->getModel($id)) {
            return $this->response(404);
        }

        $this->data['model']->updated_by = $this->data['currentUser']->id;
        $this->data['model']->restore();

        return $this->response(200, [
            'message_title'       => __('member::strings.restore_success.title'),
            'message_description' => __('member::strings.restore_success.title'),
        ]);
    }

    public function status($id)
    {
        $this->data['currentUser'] = request()->user();
        if (!$this->data['model'] = $this->getModel($id)) {
            return $this->response(404);
        }

        if ($this->data['model']->isDisabled()) {
            $this->data['model']->updated_by = $this->data['currentUser']->id;
            $this->data['model']->status     = "ACTIVE";
            $this->data['model']->save();
            $this->data['model']->enable();
        } else if ($this->data['model']->isEnabled()) {
            $this->data['model']->updated_by = $this->data['currentUser']->id;
            $this->data['model']->status     = "DISABLED";
            $this->data['model']->save();
            $this->data['model']->disable();
        }
        return $this->response(200);
    }

    public function forceDelete($id)
    {
        if (!$this->data['model'] = $this->getModel($id)) {
            return $this->response(404);
        }

        $this->data['model']->forceDelete();
        return $this->response(200, [
            'message_name'        => __('member::strings.perma_delete_success.name'),
            'message_description' => __('member::strings.perma_delete_success.description'),
        ]);
    }


      public function getEvaluationbyCar($id, ...$relations)
    {
        $this->data['Evaluation'] = Evaluation::query();

        if (auth()->user()->isAn('ROOT') or auth()->user()->can('RESTORE_CAR')) {
            $this->data['Evaluation']->withTrashed();
        }

        if (auth()->user()->isAn('ROOT') or auth()->user()->can('STATUS_UPDATE_CAR')) {
            $this->data['Evaluation']->withDisabled();
        }

        if ($relations) {
            $this->data['Evaluation']->with($relations);
        }

        return $this->data['Evaluation']->get();
    }


      public function getFavouritebyCar($id, ...$relations)
    {
        $this->data['Favourite'] = Favourite::query();

        if (auth()->user()->isAn('ROOT') or auth()->user()->can('RESTORE_CAR')) {
            $this->data['Favourite']->withTrashed();
        }

        if (auth()->user()->isAn('ROOT') or auth()->user()->can('STATUS_UPDATE_CAR')) {
            $this->data['Favourite']->withDisabled();
        }

        if ($relations) {
            $this->data['Favourite']->with($relations);
        }

        return $this->data['Favourite']->get();
    }

    public function statusEvaluation($id)
    {
        $this->data['currentUser'] = request()->user();
        if (!$this->data['model'] = $this->getEvaluationModel($id)) {
            return $this->response(404);
        }

        if ($this->data['model']->isDisabled()) {
            $this->data['model']->updated_by = $this->data['currentUser']->id;
            $this->data['model']->status     = "ACTIVE";
            $this->data['model']->save();
            $this->data['model']->enable();
        } else if ($this->data['model']->isEnabled()) {
            $this->data['model']->updated_by = $this->data['currentUser']->id;
            $this->data['model']->status     = "DISABLED";
            $this->data['model']->save();
            $this->data['model']->disable();
        }
        return $this->response(200);
    }

    public function statusFavourite($id)
    {
        $this->data['currentUser'] = request()->user();
        if (!$this->data['model'] = $this->getFavouriteModel($id)) {
            return $this->response(404);
        }

        if ($this->data['model']->isDisabled()) {
            $this->data['model']->updated_by = $this->data['currentUser']->id;
            $this->data['model']->status     = "ACTIVE";
            $this->data['model']->save();
            $this->data['model']->enable();
        } else if ($this->data['model']->isEnabled()) {
            $this->data['model']->updated_by = $this->data['currentUser']->id;
            $this->data['model']->status     = "DISABLED";
            $this->data['model']->save();
            $this->data['model']->disable();
        }
        return $this->response(200);
    }


}
