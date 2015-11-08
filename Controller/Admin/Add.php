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

final class Add extends AbstractSubscriber
{
    /**
     * Default action
     * 
     * @return string
     */
    public function indexAction()
    {
        return $this->view->render($this->getTemplatePath(), $this->getSharedVars(array(
        )));
    }

    /**
     * Adds a subscriber
     * 
     * @return string
     */
    public function addAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
        }
    }
}
