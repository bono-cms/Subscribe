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

final class Browser extends AbstractController
{
    /**
     * Displays a grid
     * 
     * @param integer $page Current page number
     * @return string
     */
    public function indexAction($page = 1)
    {
        // Append a breadcrumb
        $this->view->getBreadcrumbBag()
                   ->addOne('Subscribe');

        // Append JS script to the stack
        $this->view->getPluginBag()
                   ->appendScript('@Subscribe/admin/browser.js');

        $subscribeManager = $this->getModuleService('subscribeManager');

        $paginator = $subscribeManager->getPaginator();
        $paginator->setUrl('/admin/module/subscribe/page/(:var)');

        return $this->view->render('browser', array(
            'title' => 'Subscribes',
            'subscribers' => $subscribeManager->fetchAllByPage($page, $this->getSharedPerPageCount()),
            'paginator' => $paginator
        ));
    }

    /**
     * Deletes a subscriber by their associated id
     * 
     * @return string
     */
    public function deleteAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
            $id = $this->request->getPost('id');

            $subscribeManager = $this->getModuleService('subscribeManager');
            $subscribeManager->deleteById($id);

            $this->flashBag->set('success', 'A subscriber has been removed successfully');
            return '1';
        }
    }

    /**
     * Delete selected records
     * 
     * @return string
     */
    public function deleteSelectedAction()
    {
        if ($this->request->hasPost('toDelete') && $this->request->isAjax()) {
        }
    }

    /**
     * Saves data from a table
     * 
     * @return string
     */
    public function saveAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
        }
    }
}
