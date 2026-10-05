<?php

/**
 * This file is part of the Bono CMS
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Subscribe\Controller\Admin;

use Cms\Controller\Admin\AbstractController;
use Subscribe\Service\SubscribeManager;

final class Send extends AbstractController
{
    /**
     * Performs a bulk sending to subscribers
     * 
     * @param string $subject
     * @param string $body
     * @param string $offset Row offset
     * @param string $limit Records limit
     * @return boolean
     */
    private function mailAll($subject, $body, $offset, $limit)
    {
        // Get mailer instance
        $mailer = $this->getService('Cms', 'mailer');

        // Get array of all activated emails
        $users = $this->getModuleService('subscribeManager')->findActiveEmails($offset, $limit);

        foreach ($users as $user) {
            $mailer->sendTo($user['email'], $subject, 
                str_replace(
                    SubscribeManager::PARAM_UNSUBSCRIBE_PLACEHOLDER, 
                    // Un-subscribe URL
                    $this->request->getBaseUrl() . $this->createUrl('Subscribe:Handler@unsubscribeAction', [$user['key']]), 
                    $body
                )
            );
        }

        return true;
    }

    /**
     * Renders the form
     * 
     * @return string
     */
    public function indexAction()
    {
        // Load view plugins
        $this->view->getPluginBag()
                   ->load([$this->getWysiwygPluginName()]);

        // Append breadcrumbs
        $this->view->getBreadcrumbBag()->addOne('Subscribe', 'Subscribe:Admin:Subscriber@gridAction')
                                       ->addOne('New bulk-sending');

        return $this->view->render('send', [
        ]);
    }

    /**
     * Sends a message to all subscribers
     * 
     * @return string
     */
    public function sendAction()
    {
        if ($this->request->hasPost('subject', 'content')) {
            $input = $this->request->getPost();

            $validator = $this->createValidation();

            $validator->field('subject')
                      ->required();

            $validator->field('content')
                      ->required();

            if ($validator->isPassed()) {
                // Configure view
                $this->view->setModule('Subscribe')
                           ->setTheme('site')
                           ->disableLayout();

                // Prepare the body
                $body = $this->view->render('newsletter', [
                    'content' => $this->request->getPost('content')]
                );

                // Subscribe manager
                $this->mailAll(
                    $this->request->getPost('subject'),
                    $body,
                    $this->request->getPost('offset'),
                    $this->request->getPost('limit')
                );

                $this->flashBag->set('success', 'The mailing queue has been successfully processed');

            } else {
                return $this->json([
                    'errors' => $validator->getErrors()
                ]);
            }
        }

        return $this->json([
            'refresh' => true
        ]);
    }
}
