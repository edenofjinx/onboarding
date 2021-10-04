<?php

namespace Emotion\Onboarding\Plugin\Block\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor as CheckoutLayoutProcessor;

class LayoutProcessor
{

    public function afterProcess(CheckoutLayoutProcessor $subject, $jsLayout) {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
        ['children']['shippingAddress']['children']['shipping-address-fieldset']
        ['children']['telephone']['sortOrder'] = 60;
        return $jsLayout;
    }

}
