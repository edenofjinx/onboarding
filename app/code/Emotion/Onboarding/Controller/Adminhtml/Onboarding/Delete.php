<?php

namespace Emotion\Onboarding\Controller\Adminhtml\Onboarding;

use Emotion\Onboarding\Api\ContactRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\RedirectFactory;

class Delete extends Action
{

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var RedirectFactory
     */
    protected $result;

    /**
     * @var ContactRepositoryInterface
     */
    protected $contactRepository;

    /**
     *
     * @param Context $context
     * @param RequestInterface $request
     * @param ContactRepositoryInterface $contactRepository
     * @param RedirectFactory $result
     */
    public function __construct(
        Context $context,
        RequestInterface $request,
        ContactRepositoryInterface $contactRepository,
        RedirectFactory $result
    ) {
        parent::__construct($context);

        $this->request = $request;
        $this->result = $result;
        $this->contactRepository = $contactRepository;
    }

    /**
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $id = $this->request->getParam('id');
        if ($id !== null && $id !== '') {
            $this->contactRepository->deleteById($id);
        }
        $result = $this->result->create();
        $result->setPath('*/*/listing');
        return $result;
    }
}
