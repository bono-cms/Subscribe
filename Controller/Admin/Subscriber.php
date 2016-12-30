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
use Krystal\Validate\Pattern;

final class Subscriber extends AbstractController
{
    /**
     * Renders edit form
     * 
     * @param string $id
     * @return string
     */
    public function editAction($id)
    {
        $subscriber = $this->getModuleService('subscribeManager')->fetchById($id);

        if ($subscriber !== false) {

            // Append breadcrumbs
            $this->view->getBreadcrumbBag()->addOne('Subscribe', 'Subscribe:Admin:Subscriber@gridAction')
                                           ->addOne('Edit the subscriber');

            return $this->view->render('form', array(
                'subscriber' => $subscriber
            ));

        } else {
            return false;
        }
    }

    /**
     * Saves data from a table
     * 
     * @return string
     */
    public function tweakAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {

            $states = $this->request->getPost('active');

            $subscribeManager = $this->getModuleService('subscribeManager');
            $subscribeManager->updateActiveStates($states);

            $this->flashBag->set('success', 'Settings have been updated successfully');
            return '1';
        }
    }

    /**
     * Renders a grid
     * 
     * @param integer $page Current page number
     * @return string
     */
    public function gridAction($page = 1)
    {
        // Append a breadcrumb
        $this->view->getBreadcrumbBag()
                   ->addOne('Subscribe');

        $subscribeManager = $this->getModuleService('subscribeManager');

        $paginator = $subscribeManager->getPaginator();
        $paginator->setUrl($this->createUrl('Subscribe:Admin:Subscriber@gridAction', array(), 1));

        return $this->view->render('browser', array(
            'subscribers' => $subscribeManager->fetchAllByPage($page, $this->getSharedPerPageCount()),
            'paginator' => $paginator
        ));
    }

    /**
     * Removes a subscriber by their associated id
     * 
     * @param string $id
     * @return string
     */
    public function deleteAction($id)
    {
        return $this->invokeRemoval('subscribeManager', $id);
    }

    /**
     * Persists a subscriber
     * 
     * @return string
     */
    public function saveAction()
    {
        $input = $this->request->getPost('subscriber');

        return $this->invokeSave('subscribeManager', $input['id'], $input, array(
            'input' => array(
                'source' => $input,
                'definition' => array(
                    'name' => new Pattern\Name(),
                    'email' => new Pattern\Email($this->getModuleService('subscribeManager')->emailExists($input['email']))
                )
            )
        ));
    }
}
