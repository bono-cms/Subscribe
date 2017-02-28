<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Subscribe\Controller\Admin;

use Cms\Controller\Admin\AbstractController;

final class Send extends AbstractController
{
    /**
     * Renders the form
     * 
     * @return string
     */
    public function indexAction()
    {
        // Load view plugins
        $this->view->getPluginBag()
                   ->load(array($this->getWysiwygPluginName()));

        // Append breadcrumbs
        $this->view->getBreadcrumbBag()->addOne('Subscribe', 'Subscribe:Admin:Subscriber@gridAction')
                                       ->addOne('New bulk-sending');

        return $this->view->render('send', array(
        ));
    }

    /**
     * Sends a message to all subscribers
     * 
     * @return string
     */
    public function sendAction()
    {
        if ($this->request->hasPost('subject', 'content')) {
            // Configure view
            $this->view->setModule('Subscribe')
                       ->setTheme('site')
                       ->disableLayout();

            // Prepare the body
            $body = $this->view->render('newsletter', array(
                'content' => $this->request->getPost('content'))
            );

            // Subscribe manager
            $subscribeManager = $this->getModuleService('subscribeManager');
            $subscribeManager->mailAll(
                $this->request->getPost('subject'),
                $body
            );

            $this->flashBag->set('success', 'The mailing queue has been successfully processed');
        }

        return '1';
    }
}
