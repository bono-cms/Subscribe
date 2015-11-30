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
     * Displays a form
     * 
     * @return string
     */
    public function indexAction()
    {
        // Append breadcrumbs
        $this->view->getBreadcrumbBag()
                   ->addOne('Subscribe', 'Subscribe:Admin:Browser@indexAction')
                   ->addOne('Send');

        return $this->view->render('send', array(
            'title' => 'Batch sending to subscribers'
        ));
    }

    /**
     * Sends a message to all subscribers
     * 
     * @return string
     */
    public function sendAction()
    {
    }
}
