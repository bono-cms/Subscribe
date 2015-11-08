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

use Admin\Controller\Admin\AbstractController;

final class Browser extends AbstractController
{
    /**
     * Shows a table
     * 
     * @param integer $page
     * @return string
     */
    public function indexAction($page = 1)
    {
        $subscribeManager = $this->getModuleService('subscribeManager');

        $paginator = $subscribeManager->getPaginator();
        $paginator->setUrl('/admin/module/subscribe/page/%s');

        return $this->view->render('browser', array(
            'breadcrumbs' => array(
                '#' => 'Subscribe',
            ),
            
            'subscribers' => $subscribeManager->fetchAllByPage($page, 10),
            'paginator' => $paginator,
        ));
    }

    /**
     * Deletes a record by its associated id
     * 
     * @return string
     */
    public function deleteAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
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
