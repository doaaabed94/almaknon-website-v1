<?php

return [
    'deleteable' => [
        'label'       => 'Can Be Deleted',
        'placeholder' => null,
        'options'     => [
            'Y' => 'Yes',
            'N' => 'No',
        ],
    ],
    'send_confirmation_by_email' => [
        'input_label' => 'By Email',
        'label'       => 'Send Confirmation Code',
        'help'        => 'Send Email To This User With Confirmation Code',
    ],
    'send_confirmation_by_sms' => [
        'input_label' => 'By SMS',
        'label'       => 'Send Confirmation Code',
        'help'        => 'Send SMS To This User With Confirmation Code',
    ],
    'dial_code' => [
        'label'       => 'Dial Code',
        'placeholder' => 'Enter a Dial Code',
    ],
    'country_iso_2' => [
        'label'       => 'Country ISO 2',
        'placeholder' => 'Enter The Two Digits Code For This Country',
    ],
    'country_iso_3' => [
        'label'       => 'Country ISO 3',
        'placeholder' => 'Enter The Three Digits Code For This Country',
    ],
    'lat' => [
        'label'       => 'Latitude',
        'placeholder' => 'Enter The Latitude For This Record',
    ],
    'lng' => [
        'label'       => 'longtitude',
        'placeholder' => 'Enter The longtitude For This Record',
    ],
    'status' => [
        'label'       => 'Status',
        'placeholder' => '-- Select Status --',
    ],
    'created_at' => [
        'label'       => 'Created At',
        'placeholder' => 'Enter Created At Date',
    ],
    'updated_at' => [
        'label'       => 'Last Update',
        'placeholder' => 'Enter Updated At Date',
    ],
    'deleted_at' => [
        'label'       => 'Deleted At',
        'placeholder' => 'Enter Deleted At Date',
    ],
    'locale' => [
        'label'       => 'Language',
        'placeholder' => 'Language',
        'help'        => 'Select Language',
    ],
    'avatar' => [
        'label'       => 'Avatar',
        'placeholder' => 'Add Avatar',
    ],
    'roles' => [
        'label'       => 'Role',
        'placeholder' => '-- Select Role --',
    ],
    'username' => [
        'label'       => 'Username',
        'placeholder' => 'Enter Username',
    ],
    'email_username_phone' => [
        'label'       => 'Username or Phone or E-mail',
        'placeholder' => 'Enter Username or Phone or E-mail',
    ],
    'country' => [
        'label'       => 'Country',
        'placeholder' => '-- Select Country --',
    ],
    'city' => [
        'label'       => 'City',
        'placeholder' => '-- Select City --',
    ],
    'email' => [
        'label'       => 'E-mail Address',
        'placeholder' => 'Enter E-mail Address',
    ],
    'name' => [
        'label'       => 'Name',
        'placeholder' => 'Enter a Name',
    ],
    'latin_name' => [
        'label'       => 'latin Name',
        'placeholder' => 'Enter a Native/latin Name',
    ],
    'first_name' => [
        'label'       => 'First Name',
        'placeholder' => 'Enter First Name',
    ],
    'last_name' => [
        'label'       => 'Last Name',
        'placeholder' => 'Enter Last Name',
    ],
    'current_password' => [
        'label'       => 'Current Password',
        'placeholder' => 'Enter Account Current Password',
    ],
    'password' => [
        'label'       => 'Password',
        'placeholder' => 'Enter Password',
    ],
    'password_confirmation' => [
        'label'       => 'Password Confirmation',
        'placeholder' => 'Enter Password Confirmation',
    ],
    'phone_number' => [
        'label'       => 'Phone Number',
        'placeholder' => 'Enter Phone Number',
    ],
    'address' => [
        'label'       => 'Address',
        'placeholder' => '',
    ],
    'id' => [
        'label'       => 'ID',
        'placeholder' => 'Enter Unique ID',
        'help'        => 'Enter Unique ID (Required)',
    ],
    'code' => [
        'label'       => 'Code',
        'placeholder' => 'Enter Code',
        'help'        => 'Enter Code (Required)',
    ],
    'icon' => [
        'label'       => 'Image',
        'placeholder' => 'Enter Image',
        'help'        => 'Enter Image (Required)',
    ],
    'title' => [
        'label'       => 'Title',
        'placeholder' => 'Enter Title',
        'help'        => 'Enter Title (Required)',
    ],
    'description' => [
        'label'       => 'Description',
        'placeholder' => 'Enter Description',
        'help'        => 'Enter Description (Optional)',
    ],
    'details' => [
        'label'       => 'Details',
        'placeholder' => 'Enter Details',
        'help'        => 'Enter Details (Optional)',
    ],
    'birthday' => [
        'label'       => 'Birthday',
        'placeholder' => 'Select Birthday',
        'help'        => 'Select Birthday (Optional)',
    ],
    'gender' => [
        'label'       => 'Gender',
        'placeholder' => '-- Select Gender --',
        'help'        => 'Select Gender (Optional)',
    ],
    'date' => [
        'label'       => 'Entry Date',
        'placeholder' => 'Select Entry Date',
        'help'        => '',
    ],
    'notification_permissions' => [
        'APPROVED' => [
            'title'       => 'Notifications Activated',
            'description' => 'You Allowed The System To Send You a Notifications',
        ],
        'REJECTED' => [
            'title'       => 'Notifications Permissions Declined',
            'description' => 'You Have Declined The Permissions Required To Recive Notifications From The System',
        ],
        'ASK' => [
            'title'       => 'Notifications Permissions Required',
            'description' => 'You Wont be Recive Notifications Unless You Approved The Notifications Permissions',
        ],
    ],
    'published_at' => [
        'label'       => 'Published At',
        'placeholder' => 'These Data Published At',
        'help'        => '',
    ],
];