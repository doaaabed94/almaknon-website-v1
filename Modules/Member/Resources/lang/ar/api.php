<?php

return [
    'response_messages' => [
        'validation_error' => [
            'message' => 'يرجى التأكد من أنك قد قمت بإدخال المعلومات بشكل صحيح',
            'hint'    => 'User Should See Validation Errors From errors.invalid_fields',
        ],
        'something_went_wrong' => [
            'message' => 'عذرا لقد حصلت بعض الأخطاء',
            'hint'    => 'User Should See Error From message',
        ],
        'user_not_found' => [
            'message' => 'عذرا ولكن هذا المستخدم غير موجود بقواعد البيانات',
            'hint'    => 'The User Is Not Found You Should Redirect The User To Signin Again',
        ],
        'code_is_not_correct' => [
            'message' => 'عذرا ولكن الكود الذي تم ادخاله غير صالح',
            'hint'    => 'You Should Ask The User If He Want To Resend The Code Or Check Again',
        ],
        'code_sent_successfully' => [
            'message' => 'تم إرسال الكود بنجاح',
            'hint'    => 'Code Has Been Sent',
        ],
        'code_failed_to_send' => [
            'message' => 'لقد فشل إرسال الكود يرجى المحاولة لاحقا',
            'hint'    => 'The Otb Code Faild To Send You Should Try Again',
        ],
        'exceeded_maximnumber_of_attempts' => [
            'message' => 'لقد تجاوت الحد المسموح به يرجى اعادة المحاولة بعد',
            'hint'    => 'User Should Wait In Seconds For errors.waiting_time',
        ],
        'logged_in_successfully' => [
            'message' => 'تم تسجيل الدخول بنجاح',
            'hint'    => 'Redirect The User To Main View',
        ],
        'logged_in_successfully_but_your_account_details_are_incomplete' => [
            'message' => 'يرجى استكمال معلوماتك للمتابعة',
            'hint'    => 'Redirect The User To Complete Account View',
        ],
        'logged_in_successfully_but_you_are_not_yet_approved_by_admins' => [
            'message' => 'إن حسابك قيد المراجعة من الإدارة سيتم تنبيهك بعد انتهاء هذه المرحلة',
            'hint'    => 'Forbid The User From Continue',
        ],
        'registered_successfully' => [
            'message' => 'لقد تم إنشاء الحساب بنجاح',
            'hint'    => 'Forbid The User From Continue',
        ],
        'processed_successfully' => [
            'message' => 'لقد تم معالجة طلبك بنجاح',
            'hint'    => 'Request Processed Successfully',
        ],
        'languages_loaded_successfully' => [
            'message' => 'لقد تم جلب اللغات بنجاح',
            'hint'    => 'Request Processed Successfully',
        ],
        'language_updated' => [
            'message' => 'لقد تم تعديل لغة المستخدم بنجاح',
            'hint'    => 'Change The User Language From Mobile Side To Match The Backend',
        ],
        'all_banks_list_loaded' => [
            'message' => 'لقد تم جلب جميع البنوك المتوفرة',
            'hint'    => 'List Of All Available Banks To Choose From',
        ],
        'all_user_banks_list_loaded' => [
            'message' => 'لقد تم جلب البنوك المرتبطة بحسابك',
            'hint'    => 'List Of All Available Banks Related To Current Account',
        ],
        'new_bank_added' => [
            'message' => 'لقد تم إضافة معلومات البنك بنجاح',
            'hint'    => 'Request Processed Successfully',
        ],
        'bank_not_found' => [
            'message' => 'عذرا ولكن هذا البنك غير متوفر في الوقت الحالي',
            'hint'    => 'Bank Details Not Found In The Database',
        ],
        'bank_details_updated' => [
            'message' => 'لقد تم تعديل معلومات البنك بنجاح',
            'hint'    => 'Request Processed Successfully',
        ],
        'bank_deleted' => [
            'message' => 'لقد تم ازالة هذا البنك بنجاح',
            'hint'    => 'Request Processed Successfully',
        ],

        'token_refreshed' => [
            'message' => 'لقد تم تحديث معلومات الوصول',
            'hint'    => 'token_refreshed',
        ],
        'token_expired' => [
            'message' => 'لقد انتهت صلاحية الجلسة يرجى اعادة تسجيل الدخول مرة اخرى',
            'hint'    => 'token_expired',
        ],
        'token_blacklisted' => [
            'message' => 'لقد انتهت صلاحية الجلسة يرجى اعادة تسجيل الدخول مرة اخرى',
            'hint'    => 'token_blacklisted',
        ],
        'account_does_not_exist' => [
            'message' => 'حسابك غير متوفر بالوقت الحالي',
            'hint'    => 'account_does_not_exist',
        ],
        'user_account_not_found' => [
            'message' => 'حسابك غير متوفر بالوقت الحالي',
            'hint'    => 'user_account_not_found',
        ],
    ],
];