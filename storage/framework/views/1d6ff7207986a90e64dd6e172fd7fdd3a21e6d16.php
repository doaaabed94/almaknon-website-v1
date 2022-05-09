<script type="text/javascript">
    const BS_H = {};
    $(document).on('submit', '.action-ajax-form', function(e) {
        e.preventDefault();
        var _NODE_ = $(this),
            _SUBMIT_ = _NODE_.find('[type=submit]'),
            _URL_ = _NODE_.attr('action'),
            _METHOD_ = _NODE_.attr('method'),
            _DATA_ = new FormData(this); //_NODE_.serialize(); 
       // console.log(_NODE_);
        BS_H.RESET_FORM_VALIDATION_ERRORS(_NODE_);

        $.ajax({
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                url: _URL_,
                method: _METHOD_,
                data: _DATA_,
                complete: function(data, xhr, settings) {
                    if (data.status === 200) {
                        var data = JSON.parse(data.responseText);
                        if (data.redirect_url) {
                            window.location = data.redirect_url;
                        }
                        if(data.redirect_to) {
                            window.location = data.redirect_to;
                        }
                        BS_H.SHOW_SWAL_FIRE(data.message_title, data.message_description ,data.message_type);
                        
                    } else if (data.status === 403) {
                        var data = JSON.parse(data.responseText);
                        var _INPUT_ = $("#show_inline_general_error");
                        if (data.message_description) {
                            _MESSAGE = data.message_description;
                        } else {
                            _MESSAGE = "<?php echo __('member::main.general_error_403'); ?>";
                        }
                        _INPUT_.append(`<div class="invalid-feedback" style="display: block">` +
                            _MESSAGE + `</div>`);

                    } else if (data.status === 422) {
                        var _DATAERROR_ = JSON.parse(data.responseText);
                        BS_H.SHOW_FORM_VALIDATION_ERRORS(_NODE_, _DATAERROR_.errors);
                    } else if (data.status === 500) {
                        var data = JSON.parse(data.responseText);
                        BS_H.SHOW_SWAL_FIRE(data.message_title, data.message_description ,data.message_type);
                    } else {
                        var data = JSON.parse(data.responseText);
                        BS_H.SHOW_SWAL_FIRE(data.message_title, data.message_description ,data.message_type);
                    }
                }
            })
            .done(function(data) {})
            .fail(function(XHR) {})
            .always(function() {
                _SUBMIT_.prop('disabled', false);
            });
    });

    BS_H.RESET_FORM_VALIDATION_ERRORS = function($Form) {
        $Form.find('.is-invalid').removeClass('is-invalid');
        $Form.find('.invalid-feedback').remove();
    };

    BS_H.SHOW_FORM_VALIDATION_ERRORS = function($Form, errors) {
        // alert("SHOW_FORM_VALIDATION_ERRORS");
        var _FOCUS_ = true;
        var hidden_inputs_errors = '';
        $.each(errors, function(input_name, messgaes) {
            input_name = input_name.replace(/\.(.+?)(?=\.|$)/g, (m, s) => `[${s}]`);
            var _INPUT_ = $Form.find("[name^='" + input_name + "']");
            if (_INPUT_.data('on-validation-error-click')) {
                $(_INPUT_.data('on-validation-error-click')).click();
            }
            _INPUT_.addClass('is-invalid');
            _INPUT_.parent().append(`<div class="invalid-feedback" style="display: block">` + messgaes[0] +
                `</div>`);
            if (_FOCUS_) {
                _INPUT_.focus();
            }
            _FOCUS_ = false;
        });
        if (hidden_inputs_errors.length > 0) {
            BS_H.toastr(
                'error',
                '',
                hidden_inputs_errors
            );
        }
    };

    BS_H.SHOW_SWAL_FIRE = function($message_title, $message_description ,$message_type) {
        Swal.fire({
                            title: $message_title,
                            text: $message_description,
                            type: $message_type
                        });
    };
</script>
<?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/inc/action_crud.blade.php ENDPATH**/ ?>