<?php

namespace Emotion\Onboarding\Plugin\Controller;

use Magento\Customer\Controller\Account\CreatePost;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;

class AroundCustomerAccountCreatePost
{

    // #Task 32
    /**
     * @var Http
     */
    private $request;

    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    public function __construct(
        Http $request,
        ResultFactory $resultFactory,
        ManagerInterface $messageManager
    ) {
        $this->request = $request;
        $this->resultFactory = $resultFactory;
        $this->messageManager = $messageManager;
    }

    public function aroundExecute(CreatePost $subject, callable $proceed)
    {
        $email = $this->request->getParam('email');
        $emailProvider = explode('@', $email);
        if ($emailProvider[1] !== 'yahoo.com') {
            return $proceed();
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $this->messageManager->addErrorMessage(__('You cannot use yahoo.com emails on this website.'));
        return $resultRedirect->setPath('customer/account/create');
    }
}
