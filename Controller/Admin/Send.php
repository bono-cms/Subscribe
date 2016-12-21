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
     * Renders the form
     * 
     * @return string
     */
    public function indexAction()
    {
        // Append breadcrumbs
        $this->view->getBreadcrumbBag()->addOne('Subscribe', 'Subscribe:Admin:Subscriber@gridAction')
                                       ->addOne('Send');

        return $this->view->render('send', array(
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
