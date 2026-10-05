<?php

/**
 * This file is part of the Bono CMS
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Subscribe\Controller\Admin;

use Cms\Controller\Admin\AbstractController;

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

            return $this->view->render('form', [
                'subscriber' => $subscriber
            ]);

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

            return $this->json([
                'refresh' => true
            ]);
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
        $paginator->setUrl($this->createUrl('Subscribe:Admin:Subscriber@gridAction', [], 1));

        return $this->view->render('browser', [
            'subscribers' => $subscribeManager->fetchAllByPage($page, $this->getSharedPerPageCount()),
            'paginator' => $paginator
        ]);
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

        return $this->json([
            'refresh' => true
        ]);
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
        $emailTaken = $this->formAttribute->hasChanged('email') ? $subscribeManager->emailExists($input['email']) : false;

        $validator = $this->createValidation();

        $validator->setFieldRule('unique_email', function($value) use ($emailTaken) {
            return !$emailTaken;
        }, 'This email is already taken');

        $validator->field('subscriber.name')
                  ->required()
                  ->addRule('minlength', null, ['min' => 2]);

        $validator->field('subscriber.email')
                  ->required()
                  ->addRule('email')
                  ->addRule('unique_email');

        if ($validator->isPassed()) {
            if ($subscribeManager->update($input)) {
                $this->flashBag->set('success', 'The element has been updated successfully');

                return $this->json([
                    'refresh' => true
                ]);
            }

        } else {
            return $this->json([
                'errors' => $validator->getErrors()
            ]);
        }
    }
}
