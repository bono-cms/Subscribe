<?php

/**
 * This file is part of the Bono CMS
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Subscribe\Controller;

use Site\Controller\AbstractController;

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

        return $this->createMessage('confirmation', [
            'success' => $service->confirmUser($key),
            'message' => 'Thank you! You have successfully confirmed your email'
        ]);
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

            // If name isn't provided, use empty name
            if (!isset($data['name'])) {
                $data['name'] = '';
            }

            $validator = $this->createValidation();

            $validator->field('email')
                      ->required()
                      ->addRule('email');

            $validator->field('name')
                      ->required(null, isset($data['name']))
                      ->addRule('minlength', null, ['min' => 2]);

            if ($validator->isPassed()) {
                $service = $this->getModuleService('subscribeManager');

                // Prepare common variables
                $key = $service->subscribe($data['name'], $data['email']);

                // If key isn't false, that means the email doesn't yet exists in a database
                if ($key !== false) {
                    $url = $this->request->getBaseUrl();
                    $subject = $this->translator->translate('Confirm your email');

                    $message = $this->createMessage('subscribe', [
                        'name' => $data['name'],
                        'site' => $url,
                        'link' => $url.$this->createUrl('Subscribe:Handler@confirmAction', [$key])
                    ]);

                    // Send e-mail notification now
                    $mailer = $this->getService('Cms', 'mailer');
                    $mailer->sendTo($data['email'], $subject, $message);

                    // Successfully sent a request to news letters
                    $output = [
                        'code' => '1',
                        'message' => $this->translator->translate('Thanks for subscription. Please now check your email to confirm your identity')
                    ];

                } else {
                    // Email already exists
                    $output = [
                        'code' => '0',
                        'message' => $this->translator->translate('Email already exists')
                    ];
                }

                return $this->json($output);

            } else {
                return $this->json([
                    'errors' => $validator->getErrors()
                ]);
            }
        }
    }

    /**
     * Unsubscribes a user by their email address
     * 
     * @param string $key
     * @return string
     */
    public function unsubscribeAction($key)
    {
        $service = $this->getModuleService('subscribeManager');

        return $this->createMessage('confirmation', [
            'success' => $service->unsubscribe($key),
            'message' => 'You have successfully unsubscribed from our mailing list'
        ]);
    }
}
