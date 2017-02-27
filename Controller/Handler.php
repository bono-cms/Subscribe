<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Subscribe\Controller;

use Site\Controller\AbstractController;
use Krystal\Validate\Pattern;

final class Handler extends AbstractController
{
    /**
     * Renders the message
     * 
     * @param string $template
     * @param array $vars
     * @return string
     */
    private function createMessage($template, array $vars)
    {
        // Configure view. Override inherited configuration
        $this->view->setModule('Subscribe')
                   ->setTheme('site')
                   ->disableLayout();

        return $this->view->render($template, $vars);
    }

    /**
     * Confirms an email
     * 
     * @param string $key
     * @return string
     */
    public function confirmAction($key)
    {
        $service = $this->getModuleService('subscribeManager');

        return $this->createMessage('confirmation', array(
            'success' => $service->confirmUser($key),
            'message' => 'Thank you! You have successfully confirmed your email'
        ));
    }

    /**
     * Subscribes a user by their email address
     * 
     * @return string
     */
    public function subcribeAction()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getPost();

            // Create form validator
            $formValudator = $this->createValidator(array(
                'input' => array(
                    'source' => $data,
                    'definition' => array(
                        'email' => new Pattern\Email(),
                        'name' => new Pattern\Name()
                    )
                )
            ));

            if ($formValudator->isValid()) {
                $service = $this->getModuleService('subscribeManager');

                // Prepare common variables
                $key = $service->subscribe($data['name'], $data['email']);
                $url = $this->request->getBaseUrl();
                $subject = $this->translator->translate('Confirm your email');

                $message = $this->createMessage('subscribe', array(
                    'name' => $data['name'],
                    'site' => $url,
                    'link' => $url.$this->createUrl('Subscribe:Handler@confirmAction', array($key))
                ));

                // Send e-mail notification now
                $mailer = $this->getService('Cms', 'mailer');
                $mailer->sendTo($data['email'], $subject, $message);

                // Successfully sent a request to news letters
                return '1';

            } else {
                return $formValudator->getErrors();
            }
        }
    }

    /**
     * Unsubsribes a user by their email addresss
     * 
     * @param string $key
     * @return string
     */
    public function unsubscribeAction($key)
    {
        $service = $this->getModuleService('subscribeManager');

        return $this->createMessage('confirmation', array(
            'success' => $service->unsubscribe($key),
            'message' => 'You have successfully unsubscribed from our mailing list'
        ));
    }
}
