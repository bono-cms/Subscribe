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

final class Add extends AbstractController
{
    /**
     * Displays the adding form
     * 
     * @return string
     */
    public function indexAction()
    {
        return $this->view->render('form', array(
            'title' => 'Add a new subscriber'
        ));
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
