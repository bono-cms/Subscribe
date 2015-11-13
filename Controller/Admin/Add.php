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

use Krystal\Stdlib\VirtualEntity;

final class Add extends AbstractSubscriber
{
    /**
     * Displays the adding form
     * 
     * @return string
     */
    public function indexAction()
    {
        $this->loadBreadcrumbs('Add new subscriber');

        return $this->view->render('form', array(
            'title' => 'Add new subscriber',
            'subscriber' => new VirtualEntity()
        ));
    }

    /**
     * Adds a subscriber
     * 
     * @return string
     */
    public function addAction()
    {
        $formValidator = $this->getValidator($this->request->getPost('subscriber'));

        if ($formValidator->isValid()) {
            $subscribeManager = $this->getModuleService('subscribeManager');
            $subscribeManager->add($this->request->getPost('subscriber'));

            $this->flashBag->set('success', 'A subscriber has been added successfully');
            return $subscribeManager->getLastId();

        } else {
            return $formValidator->getErrors();
        }
    }
}
