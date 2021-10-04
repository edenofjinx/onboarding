<?php

namespace Emotion\Onboarding\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }
    /**
     * @param string $path
     * @param string $scope
     * @return string
     */
    public function getValue(
        string $path,
        string $scope = ScopeInterface::SCOPE_STORE
    ): string {
        return (string)($this->scopeConfig->getValue($path, $scope));
    }

    public function getConfigText()
    {
        return $this->getValue('onboarding_settings/general/text') ?? null;
    }

    public function getActive()
    {
        return $this->getValue('onboarding_settings/general/active') ?? null;
    }
}
