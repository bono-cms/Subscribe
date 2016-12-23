<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Subscribe\Service;

use Cms\Service\AbstractManager;
use Subscribe\Storage\SubscribeMapperInterface;
use Krystal\Stdlib\VirtualEntity;
use Krystal\Text\TextUtils;

final class SubscribeManager extends AbstractManager
{
    /**
     * Any-compliant subscribe mapper
     * 
     * @var \Subscribe\Storage\SubcribeMapperInterface
     */
    private $subscribeMapper;

    /**
     * State initialization
     * 
     * @param \Subscribe\Storage\SubscribeMapperInterface $subscribeMapper
     * @return void
     */
    public function __construct(SubscribeMapperInterface $subscribeMapper)
    {
        $this->subscribeMapper = $subscribeMapper;
    }

    /**
     * {@inheritDoc}
     */
    protected function toEntity(array $record)
    {
        $entity = new VirtualEntity();
        $entity->setId($record['id'], VirtualEntity::FILTER_INT)
               ->setName($record['name'], VirtualEntity::FILTER_HTML)
               ->setEmail($record['email'], VirtualEntity::FILTER_HTML)
               ->setActive($record['active'], VirtualEntity::FILTER_BOOL);

        return $entity;
    }

    /**
     * Updates active states
     * 
     * @param array $pair
     * @return boolean
     */
    public function updateActiveStates(array $pair)
    {
        foreach ($pair as $id => $state) {
            if (!$this->subscribeMapper->updateActive($id, $state)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Checks whether email is already taken
     * 
     * @param string $email
     * @return boolean
     */
    public function emailExists($email)
    {
        return $this->subscribeMapper->emailExists($email);
    }

    /**
     * Returns last subscriber's id
     * 
     * @return integer
     */
    public function getLastId()
    {
        return $this->subscribeMapper->getLastId();
    }

    /**
     * Returns prepared pagination instance
     * 
     * @return \Krystal\Paginate\Paginator
     */
    public function getPaginator()
    {
        return $this->subscribeMapper->getPaginator();
    }

    /**
     * Fetch all by page
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage)
    {
        return $this->prepareResults($this->subscribeMapper->fetchAllByPage($page, $itemsPerPage));
    }

    /**
     * Confirm that user clicked on confirmation link
     * 
     * @param string $key Activation key
     * @return boolean
     */
    public function confirmUser($key)
    {
        $email = $this->subscribeMapper->findEmailByKey($key);

        // If could find
        if (!empty($email)) {
            // Mark the email as active
            $this->subscribeMapper->makeActiveByEmail($email);

            // For security reasons, update the key, so that the current key will no longer be valid
            $this->subscribeMapper->updateKeyByEmail($email, TextUtils::uniqueString());

            return true;
        } else {
            // Can't find email by provided key
            return false;
        }
    }

    /**
     * Subscribes a user returning unique key
     * 
     * @param string $name
     * @param string $email
     * @return string
     */
    public function subscribe($name, $email)
    {
        $key = TextUtils::uniqueString();

        $this->add(array(
            'email' => $email,
            'name' => $name,
            'key' => $key
        ));

        return $key;
    }

    /**
     * Adds a subscriber
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function add(array $input)
    {
        // Defaults
        $input['active'] = '0';
        $input['timestamp'] = time();

        return $this->subscribeMapper->insert($input);
    }

    /**
     * Updates a subscriber
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function update(array $input)
    {
        return $this->subscribeMapper->update($input);
    }

    /**
     * Fetches a record by its id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id)
    {
        return $this->prepareResult($this->subscribeMapper->fetchById($id));
    }

    /**
     * Deletes a record by its associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id)
    {
        return $this->subscribeMapper->deleteById($id);
    }

    /**
     * Removes subscribers by their associated ids
     * 
     * @param array $ids
     * @return boolean
     */
    public function deleteByIds(array $ids)
    {
        foreach ($ids as $id) {
            if (!$this->subscribeMapper->deleteById($id)) {
                return false;
            }
        }

        return true;
    }
}
