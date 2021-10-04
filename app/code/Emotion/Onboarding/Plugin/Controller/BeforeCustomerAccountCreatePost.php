<?php

namespace Emotion\Onboarding\Plugin\Controller;

use Magento\Customer\Controller\Account\CreatePost;
use Magento\Framework\App\Request\Http;

class BeforeCustomerAccountCreatePost
{

    // #Task 30
    /**
     * @var Http
     */
    private $request;

    public function __construct(Http $request)
    {
        $this->request = $request;
    }

    public function beforeExecute(CreatePost $subject)
    {
        $name = $this->request->getParam('firstname');
        if ($name) {
            $name = 'B2C - ' . $name;
            $this->request->setParam('firstname', $name);
        }
    }
}
