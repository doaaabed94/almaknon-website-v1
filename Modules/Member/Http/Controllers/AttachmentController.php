<?php

namespace Modules\Member\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Member\Classes\ImageManipulator;
use Modules\Member\Classes\ResponseHandler;
use Modules\Member\Entities\Attachment;
use Storage;
use Validator;

class AttachmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

      //    dd($request->all());
        // $this->attributeNames = [
        //     'attachment' => __('member::global.attachment'),
        // ];

        // $rules = [
        //     'attachment'      => $request->validation_rules ?? 'required',
        //     'attachable_id'   => 'nullable',
        //     'attachable_type' => 'nullable|string|max:191',
        // ];

        // $validator = Validator::make($request->all(), $rules, [], $this->attributeNames);

        // if ($validator->fails()) {
        //     return new ResponseHandler([
        //         'success'     => false,
        //         'type'        => 'danger',
        //         'title'       => __('member::strings.upload_error.title'),
        //         // 'description' => __('member::strings.upload_error.description', ['filename' => $request->attachment->getClientOriginalName()]),
        //         'errors'      => $validator->getMessageBag()->toArray(),
        //     ], 422);
        // }

        try {
            DB::transaction(function () use ($request) {
                $subFolder = $request->sub_folder ?? 'general';
                if (!empty($subFolder)) {
                    $subFolder = !Str::startsWith($subFolder, '/') ? "/{$subFolder}" : $subFolder;
                }

                if (isset($request->attachment) && is_array($request->attachment)) {

                    foreach ($request->attachment as $_attachment) {
                        if ($attachmentUid = $_attachment->storeAs('attachments' . $subFolder, preg_replace('/\s+/', '', $_attachment->getClientOriginalName()))) {
                            $toAttach = [
                                'type'        => 'TEMP',
                                'uploaded_by' => auth()->user()->id,
                                'filename'    => preg_replace('/\s+/', '', $_attachment->getClientOriginalName()),
                                'uid'         => $attachmentUid,
                                'size'        => $_attachment->getSize(),
                                'mime'        => $_attachment->getMimeType(),
                                'input_name'  => $request->input_name ?? null,
                            ];

                            if ($request->attachable_id && $request->attachable_id != 'null') {
                                $toAttach['attachable_id'] = $request->attachable_id;
                            }

                            if ($request->attachable_type) {
                                $toAttach['attachable_type'] = $request->attachable_type;
                            }

                            $this->data['attachment'][] = Attachment::create($toAttach);
                        }
                    }
}
                    if (!is_array($request->attachment)) {
                        if ($attachmentUid = $request->attachment->storeAs('attachments' . $subFolder, preg_replace('/\s+/', '', $request->attachment->getClientOriginalName()))) {
                            $toAttach = [
                                'type'        => 'TEMP',
                                'uploaded_by' => auth()->user()->id,
                                'filename'    => preg_replace('/\s+/', '', $request->attachment->getClientOriginalName()),
                                'uid'         => $attachmentUid,
                                'size'        => $request->attachment->getSize(),
                                'mime'        => $request->attachment->getMimeType(),
                                'input_name'  => $request->input_name ?? null,
                            ];

                            if ($request->attachable_id && $request->attachable_id != 'null') {
                                $toAttach['attachable_id'] = $request->attachable_id;
                            }

                            if ($request->attachable_type) {
                                $toAttach['attachable_type'] = $request->attachable_type;
                            }

                            $this->data['attachment'] = Attachment::create($toAttach);
                        }

                    }
                });
            } catch (\Exception $e) {
                return new ResponseHandler([
                    'success'     => false,
                    'type'        => 'danger',
                    'title'       => __('member::strings.save_error.title'),
                    'description' => env('APP_DEBUG') ? $e->getMessage() . ' [' . $e->getLine() . ']' : __('member::strings.save_error.description'),
                ], 409);
            }

            return new ResponseHandler([
                'success'     => true,
                'type'        => 'success',
                'title'       => __('member::strings.save_success.title'),
                'description' => __('member::strings.upload_success.description'),
                'attachment'  => $this->data['attachment'],
            ]);
        }

        /**
         * Delete attachment from storage.
         * @param Request $request
         * @return Response
         */
        public function destroy(Request $request)
        {

            // dd($request->all());
            $rules = [
                'file_id' => 'nullable|exists:attachments,id',
            ];

            $validator = Validator::make($request->all(), $rules, []);

            if ($validator->fails()) {
                return new ResponseHandler([
                    'success'     => false,
                    'type'        => 'danger',
                    'title'       => __('member::strings.validation_error.title'),
                    'description' => __('member::strings.validation_error.description'),
                    'errors'      => $validator->getMessageBag()->toArray(),
                ], 422);
            }

            try {
                DB::transaction(function () use ($request) {
                    $this->data['attachment'] = Attachment::find($request->file_id);
                    //   dd($this->data['attachment']);
                    if ($this->data['attachment']) {
                        $this->data['attachment']->delete();
                    }

                });

                if ($this->data['attachment']) {
                    app()->ImageManipulator->deleteImage($this->data['attachment']->uid);
                }

            } catch (\Exception $e) {
                return new ResponseHandler([
                    'success'     => false,
                    'type'        => 'danger',
                    'title'       => __('member::strings.update_error.title'),
                    'description' => env('APP_DEBUG') ? $e->getMessage() . ' [' . $e->getLine() . ']' : __('member::strings.update_error.description'),
                ], 409);
            }

            return new ResponseHandler([
                'success'     => true,
                'type'        => 'success',
                'title'       => __('member::strings.update_success.title'),
                'description' => __('member::strings.update_success.description'),
            ]);
        }

    }
