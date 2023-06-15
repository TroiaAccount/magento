define(['jquery', 'Magento_Ui/js/modal/modal', 'mage/validation'], function ($, modal) {
    'use strict';
    $.widget('sathya.customWidgetPopupForm', {
        options: {
            PopupForms: '.popup-form-data-submit',
            popupLink: '.action-print'
        },
        _create: function () {
            this._super();
            let self = this;
            let popupOptions = {
                type: 'popup',
                responsive: true,
                innerScroll: true,
                modalClass: 'custom_popup_box'
            };
            modal(popupOptions, this.options.PopupForms);
            $(self.options.popupLink).on('click', function () {
                $(self.options.PopupForms).modal('openModal');
            });

            $(self.options.PopupForms).mage('validation', {
                rules: {
                    telephone: {
                        required: true,
                        pattern: '^\\+380\\s\\d{2}\\s\\d{3}-\\d{2}-\\d{2}$'
                    },
                    name: {
                        required: true,
                        maxlength: 15
                    },
                    email: {
                        email: true,
                        pattern: /^[^\s@]*@[^\s@]*$/
                    }
                },
                messages: {
                    telephone: {
                        required: 'Номер телефону є обов\'язковим полем.',
                        pattern: 'Будь ласка, введіть номер телефону у форматі "+380 dd ddd-dd-dd".'
                    },
                    name: {
                        required: 'Ім\'я \ є обов\'язковим полем.',
                        maxlength: 'Максимальна кількість символів 15'
                    },
                    email: {
                        email: 'Будь ласка, введіть дійсну поштову адресу.',
                        pattern: 'Будь ласка, введіть дійсну поштову адресу.'
                    }
                },

                submitHandler: function (form) {
                    var formData = $(form).serialize();
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: formData,
                        dataType: 'json',

                        success: function (response) {
                            if(response.status === false){
                                alert(response.error)
                            }
                        },
                        error: function (xhr, status, error) {
                            alert({
                                title: 'Error',
                                content: 'An error occurred while submitting the form.'
                            });
                        },
                        complete: function () {
                            $(self.options.PopupForms).modal('closeModal');
                        }
                    });
                }
            });
        }
    });
    return $.sathya.customWidgetPopupForm;

});

