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

            // $(self.options.PopupForms).on('submit',function (event) {
            //     event.preventDefault();

            //     alert('submited');
            //     // use ajax function to save the data
            //     // console.log($('.subscribe-form-data').serializeArray());
            // })

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
                        url: 'your_ajax_endpoint_url',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        beforeSend: function () {
                            // Виконується перед відправкою AJAX-запиту
                            // Можна відобразити завантажувач або індікатор процесу
                        },
                        success: function (response) {
                            // Обробка успішної відповіді від сервера
                            // Можна відобразити повідомлення про успішну відправку або виконати додаткові дії
                            alert({
                                title: 'Success',
                                content: 'Form submitted successfully.'
                            });
                        },
                        error: function (xhr, status, error) {
                            // Обробка помилки під час відправки AJAX-запиту
                            // Можна відобразити повідомлення про помилку або виконати додаткові дії
                            alert({
                                title: 'Error',
                                content: 'An error occurred while submitting the form.'
                            });
                        },
                        complete: function () {
                            // Виконується після успішного або неуспішного виконання AJAX-запиту
                            // Можна виконати додаткові дії, такі як очищення форми або оновлення сторінки
                        }
                    });
                }
            });
        }
    });
    return $.sathya.customWidgetPopupForm;

});
