<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Subscrive\Controller\Admin;

final class Edit extends AbstractSubcriber
{
    /**
     * Shows edit form
     * 
     * @return string
     */
    public function indexAction()
    {
        return $this->view->render($this->getTemplatePath(), $this->getSharedVars(array(
        )));
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
