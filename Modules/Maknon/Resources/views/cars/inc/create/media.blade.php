@include('member::common-components.inputs.dropzone', [
    'options' => [
        'id' => 'car_profile_img',
        'name' => 'car_profile_img',
        'label' => __('maknon::main.car_profile_img'),
        'attachments' => [],
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
        'attachments' => [],
        'required' => false,
        'inline' => false,
        'validation_rules' => 'mimes:jpeg,jpg,png',
        'container_class' => 'col-md-12',
        'sub_folder' => 'car_details_img',
    ],
])

