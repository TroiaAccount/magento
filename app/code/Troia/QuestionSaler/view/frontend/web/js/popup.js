define(['jquery', 'Magento_Ui/js/modal/modal'], function ($, modal) {
    'use strict';
    $.widget('sathya.customWidgetPopupForm',{
        options:{
            PopupForms: '.popup-form-data-submit',
            popupLink : '.action-print'
        },
        _create: function () {
            console.log('popup-form-connected');
            this._super();
            let self = this;
            let popupOptions = {
                type: 'popup',
                responsive: true,
                innerScroll: true,
                modalClass: 'custom_popup_box'
            };
            modal(popupOptions, this.options.PopupForms);
            $(self.options.popupLink).on('click',function () {
                $(self.options.PopupForms).modal('openModal');
            });
            $(self.options.PopupForms).on('submit',function (event) {
                event.preventDefault();
                alert('submited');
                // use ajax function to save the data
                // console.log($('.subscribe-form-data').serializeArray());
            })
        }
    });
    return $.sathya.customWidgetPopupForm;

});
