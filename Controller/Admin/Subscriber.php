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
            // Save the old email
            $this->formAttribute->setOldAttribute('email', $subscriber->getEmail());

            // Append breadcrumbs
            $this->view->getBreadcrumbBag()->addOne('Subscribe', 'Subscribe:Admin:Subscriber@gridAction')
                                           ->addOne($this->translator->translate('Edit the subscriber "%s"', $subscriber->getName()));

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
        $service = $this->getModuleService('subscribeManager');

        // Batch removal
        if ($this->request->hasPost('batch')) {
            $ids = array_keys($this->request->getPost('batch'));

            $service->deleteByIds($ids);
            $this->flashBag->set('success', 'Selected elements have been removed successfully');
        } else {
            $this->flashBag->set('warning', 'You should select at least one element to remove');
        }

        // Single removal
        if (!empty($id)) {
            $service->deleteById($id);
            $this->flashBag->set('success', 'Selected element has been removed successfully');
        }

        return '1';
    }

    /**
     * Persists a subscriber
     * 
     * @return string
     */
    public function saveAction()
    {
        $subscribeManager = $this->getModuleService('subscribeManager');
        $input = $this->request->getPost('subscriber');

        $this->formAttribute->setNewAttributes($input);

        // Whether email checking needs to be done
        $hasChanged = $this->formAttribute->hasChanged('email') ? $subscribeManager->emailExists($input['email']) : false;

        $formValidator = $this->createValidator(array(
            'input' => array(
                'source' => $input,
                'definition' => array(
                    'name' => new Pattern\Name(),
                    'email' => new Pattern\Email($hasChanged)
                )
            )
        ));

        if ($formValidator->isValid()) {
            if ($subscribeManager->update($input)) {
                $this->flashBag->set('success', 'The element has been updated successfully');
                return '1';
            }

        } else {
            return $formValidator->getErrors();
        }
    }
}
