<?php

namespace Emotion\Onboarding\Controller\Adminhtml\Onboarding;

use Emotion\Onboarding\Api\ContactRepositoryInterface;
use Emotion\Onboarding\Api\Data\ContactDataInterfaceFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\RedirectFactory;

class Save extends Action implements HttpPostActionInterface
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
     * @var ContactDataInterfaceFactory
     */
    protected $contactDataFactory;

    /**
     *
     * @param Context $context
     * @param RequestInterface $request
     * @param ContactRepositoryInterface $contactRepository
     * @param ContactDataInterfaceFactory $contactDataFactory
     * @param RedirectFactory $result
     */
    public function __construct(
        Context $context,
        RequestInterface $request,
        ContactRepositoryInterface $contactRepository,
        ContactDataInterfaceFactory $contactDataFactory,
        RedirectFactory $result
    ) {
        parent::__construct($context);

        $this->request = $request;
        $this->result = $result;
        $this->contactRepository = $contactRepository;
        $this->contactDataFactory = $contactDataFactory;
    }

    /**
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $post = $this->request->getParam('contact');
        if (!empty($post) && is_array($post)) {
            if (!isset($post['entity_id']) || $post['entity_id'] === null || $post['entity_id'] === '') {
                $contact = $this->contactDataFactory->create();
            } else {
                $contact = $this->contactRepository->get($post['entity_id']);
            }
            $contact->setContactName($post['name'] ?: '');
            $contact->setContactEmail($post['email'] ?: '');
            $contact->setContactPosition($post['position'] ?: '');
            $this->contactRepository->save($contact);
        }
        $result = $this->result->create();
        $result->setPath('*/*/listing');
        return $result;
    }
}
