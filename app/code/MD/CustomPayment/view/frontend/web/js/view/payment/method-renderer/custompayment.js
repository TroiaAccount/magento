define(
    [
        'Magento_Checkout/js/view/payment/default',
        'Magento_Checkout/js/model/quote',

    ],
    function (Component,
              quote) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'MD_CustomPayment/payment/custompayment',
            },
            initObservable: function () {
                this._super();
                quote.shippingMethod.subscribe(this.shippingMethodChanged.bind(this));
                return this;
            },

            shippingMethodChanged: function (shippingMethod) {
                var isMixShipSelected = shippingMethod && shippingMethod.method_code === 'customshipping';
                if (isMixShipSelected) {
                    quote.paymentMethod(this.getData());
                } else {
                    quote.paymentMethod(null);
                }
            }
        });
    }
);
