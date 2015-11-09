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
     * Adds a record
     * 
     * @param array $input
     * @return boolean
     */
    public function add(array $input)
    {
        return $this->subscribeMapper->insert($input);
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
     * Updates a record
     * 
     * @param array $input
     * @return boolean
     */
    public function update(array $input)
    {
        return $this->subscribeMapper->update($array);
    }
}
