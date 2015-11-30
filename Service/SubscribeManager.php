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
        $entity->setId($record['id'])
               ->setName($record['name'])
               ->setEmail($record['email'])
               ->setActive($record['active']);

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
     * Adds a subscriber
     * 
     * @param array $input
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
