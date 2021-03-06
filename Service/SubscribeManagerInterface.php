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

interface SubscribeManagerInterface
{
    /**
     * Performs a bulk sending to subscribers
     * 
     * @param string $offset Row offset
     * @param string $limit Records limit
     * @return boolean
     */
    public function findActiveEmails($offset, $limit);

    /**
     * Updates active states
     * 
     * @param array $pair
     * @return boolean
     */
    public function updateActiveStates(array $pair);

    /**
     * Checks whether email is already taken
     * 
     * @param string $email
     * @return boolean
     */
    public function emailExists($email);

    /**
     * Returns last subscriber's id
     * 
     * @return integer
     */
    public function getLastId();

    /**
     * Returns prepared pagination instance
     * 
     * @return \Krystal\Paginate\Paginator
     */
    public function getPaginator();

    /**
     * Fetch all by page
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage);

    /**
     * Confirm that user clicked on confirmation link
     * 
     * @param string $key Activation key
     * @return boolean
     */
    public function confirmUser($key);

    /**
     * Unsubscribes a user by their associated key
     * 
     * @param string $key
     * @return boolean
     */
    public function unsubscribe($key);

    /**
     * Subscribes a user returning unique key
     * 
     * @param string $name
     * @param string $email
     * @return string|boolean False if email already taken
     */
    public function subscribe($name, $email);

    /**
     * Adds a subscriber
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function add(array $input);

    /**
     * Updates a subscriber
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function update(array $input);

    /**
     * Fetches a record by its id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id);

    /**
     * Deletes a record by its associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id);

    /**
     * Removes subscribers by their associated ids
     * 
     * @param array $ids
     * @return boolean
     */
    public function deleteByIds(array $ids);
}
