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

final class Edit extends AbstractSubscriber
{
    /**
     * Shows edit form
     * 
     * @param string $id Subscriber's id
     * @return string
     */
    public function indexAction($id)
    {
        $subscribeManager = $this->getModuleService('subscribeManager');
        $subscriber = $subscribeManager->fetchById($id);

        if ($subscriber !== false) {

            $this->loadBreadcrumbs('Edit the subscriber');
            return $this->view->render('form', array(
                'subscriber' => $subscriber,
                'title' => 'Edit the subscriber'
            ));

        } else {
            return false;
        }
    }

    /**
     * Updates a record
     * 
     * @return string
     */
    public function updateAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
        }
    }
}
