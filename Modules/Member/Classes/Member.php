<?php

namespace Modules\Member\Classes;

use DB;
use Closure;
use Carbon\Carbon;
use Modules\Member\Entities\Config;
use Modules\Member\Entities\FirebaseNotificationReciver;
use Modules\Member\Entities\SmartQueue;

class Member
{
    protected $reportable;

    protected $quickMenu;

    protected $asideMenu;

    protected $notificationsLinks;

    public function __construct()
    {
        $this->asideMenu  = collect([]);

        $this->reportable = collect([]);

        $this->notificationsLinks = [];
    }

    public function registerNotificationLink(string $Type, Closure $closure)
    {
        $this->notificationsLinks[ $Type ] = $closure;
    }

    public function getNotificationLink(string $Type, $params)
    {
        if (!isset($this->notificationsLinks[ $Type ])) {
            return null;
        }
        try {
            $Result = call_user_func_array($this->notificationsLinks[ $Type ], [
                $params
            ]);
            return $Result;
        } 
        catch (\Exception $th) {
            return null;
        }
        return null;
    }

    public function startSendingNotifications()
    {
        return FirebaseNotificationReciver::startSending();
    }

    public function asideMenu($Options)
    {
        $I = $this->asideMenu->count() + 1;
        $O = array_merge([
            'id'        => 'MENU_' . $I,
            'parent_id' => null,
            'type'      => 'ITEM', //ITEM | HEADER
            'link'      => 'javascript:;',
            'icon_type' => null, // null: i | svg
            'icon'      => null,
            'ordering'  => $I,
            'title'     => null,
        ], $Options);

        $O['is_active'] = request()->url() == $O['link'] ? true : false;
        $O['sub_items'] = [];
        $this->asideMenu->push( $O );
    }

    public function asideMenuGet()
    {
        $RES = [];
        foreach ($this->asideMenu->where('parent_id', null)->sortBy('ordering') as $I => $item) {
            $_SUBS_    = $this->asideMenu->where('parent_id', $item['id'])->sortBy('ordering');
            $RES[ $I ] = $item;
            $RES[ $I ]['sub_items'] = $_SUBS_->toArray();
            $RES[ $I ]['is_active'] = (request()->url() == $item['link'] ? true : false) || ! is_null( $_SUBS_->where('is_active', true)->first() );
            foreach ($_SUBS_ as $II => $sub_item) {
                $_SUBS_2    = $this->asideMenu->where('parent_id', $sub_item['id']);
                $RES[ $I ]['sub_items'][ $II ] = $sub_item;
                $RES[ $I ]['sub_items'][ $II ]['sub_items'] = $_SUBS_2->toArray();
                $RES[ $I ]['sub_items'][ $II ]['is_active'] = (request()->url() == $sub_item['link'] ? true : false) || ! is_null( $_SUBS_2->where('is_active', true)->first() );
            }
        }
        return $RES;
    }

    public function addToQueue(array $details = [])
    {
        if (!isset($details['attributes'])) {
            return false;
        }
        if (!is_array($details['attributes'])) {
            return false;
        }
        if (!isset($details['job_namespace'])) {
            return false;
        }
        try {
            DB::transaction(function()use($details){
                $QUEUE = new SmartQueue;
                $QUEUE->job_namespace = $details['job_namespace'];
                $QUEUE->requested_by  = auth()->check() ? auth()->user()->id : null;
                $QUEUE->requested_at  = Carbon::now()->toDateTimeString();
                $QUEUE->save();
                if (!empty($details['attributes'])) {
                    $ATTRIBUTES = [];
                    foreach ($details['attributes'] as $key => $value) {
                        $ATTRIBUTES[] = [
                            'queue_id' => $QUEUE->id,
                            'x_key'    => $key,
                            'x_val'    => $value,
                        ];
                    }
                    $QUEUE->Attributes()->insert($ATTRIBUTES);
                }
            });
        } 
        catch(Exception $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 404);
        }
    }

    public function reportToDashboard(array $details = [])
    {
        $Message = array_merge([
            'type'        => 'warning', //warning | danger | success | info
            'title'       => null,      //(string)
            'description' => null,      //(string)
            'closable'    => true,      //(boolean)
            'priroity'    => 3,         // 1 | 2 | 3
            'icon'        => 'flaticon-questions-circular-button',
        ], $details);

        $this->reportable->push($Message);
    }

    public function getDashboardReports()
    {
        return $this->reportable;
    }

    public function UniqueTimeStamp($date = null, $MicroSecondsInterval = null) 
    {
        if ($MicroSecondsInterval) {
            usleep($MicroSecondsInterval);
        }
        $TimeStamp = Carbon::now()->format('Y-m-d H:i:s.u');
        if (! empty($date) ) {
            $YMD       = Carbon::parse($date)->format('Y-m-d');
            $HI        = Carbon::parse($date)->format('H:i');
            $HI        = $HI == '00:00' ? Carbon::now()->format('H:i') : $HI;
            $SU        = Carbon::now()->format('s.u');
            $TimeStamp = Carbon::parse( 
                $YMD . ' ' . Carbon::parse( $HI . ':' . $SU )->format('H:i:s.u') 
            )->format('Y-m-d H:i:s.u');
        }
        return $TimeStamp;
    }
}
