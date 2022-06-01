@include('member::common-components.inputs.dropzone', [
    'options' => [
        'id' => 'car_profile_img',
        'name' => 'car_profile_img',
        'label' => __('maknon::main.car_profile_img'),
         'attachments'       => $data->attachments->where('input_name', 'car_profile_img')->map(function($item) {
                                $item->thumbnail = $item->getThumbnail('120x120');
                                return $item;
                            }),
        'required' => false,
        'inline' => false,
        'validation_rules' => 'mimes:jpeg,jpg,png',
        'container_class' => 'col-md-12',
        'sub_folder' => 'car_profile_img',
        'max_files' =>  1,
    ],
])

@include('member::common-components.inputs.dropzone', [
    'options' => [
        'id' => 'car_details_img',
        'name' => 'car_details_img',
        'label' => __('maknon::main.car_details_img'),
          'attachments'       => $data->attachments->where('input_name', 'car_details_img')->map(function($item) {
                                $item->thumbnail = $item->getThumbnail('120x120');
                                return $item;
                            }),
        'required' => false,
        'inline' => false,
        'validation_rules' => 'mimes:jpeg,jpg,png',
        'container_class' => 'col-md-12',
        'sub_folder' => 'car_details_img',
    ],
])

