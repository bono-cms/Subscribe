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
        return $this->view->render('form', array(
        ));
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
