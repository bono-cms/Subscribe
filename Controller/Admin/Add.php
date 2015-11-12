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

use Krystal\Stdlib\VirtualEntity;

final class Add extends AbstractSubscriber
{
    /**
     * Displays the adding form
     * 
     * @return string
     */
    public function indexAction()
    {
        return $this->view->render('form', array(
            'title' => 'Add a new subscriber',
            'subscriber' => new VirtualEntity()
        ));
    }

    /**
     * Adds a subscriber
     * 
     * @return string
     */
    public function addAction()
    {
        $formValidator = $this->getValidator($this->request->getPost('subscriber'));

        if ($formValidator->isValid()) {
            
        } else {
            return $formValidator->getErrors();
        }
    }
}
