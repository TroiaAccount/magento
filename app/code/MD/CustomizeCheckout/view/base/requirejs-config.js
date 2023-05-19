var config = {
    'config': {
        'mixins': {
            'Magento_Checkout/js/view/shipping': {
                'MD_CustomizeCheckout/js/view/shipping-payment-mixin': true
            },
            'Magento_Checkout/js/view/payment': {
                'MD_CustomizeCheckout/js/view/shipping-payment-mixin': true
            }
        }
    }
}
