<?php

namespace Emotion\Onboarding\Plugin\Controller;

use Emotion\Onboarding\Controller\Index\Task;

class AfterTask
{
    // #Task 31
    public function afterExecute(Task $subject, $resultPage)
    {
        $title = __('New title created');
        $resultPage->getConfig()->getTitle()->set($title);
        return $resultPage;
    }
}
