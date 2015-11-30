<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Subscribe\Storage;

interface SubscribeMapperInterface
{
    /**
     * Updates subscriber's state
     * 
     * @param string $id Subscriber id
     * @param string $state
     * @return boolean
     */
    public function updateActive($id, $state);

    /**
     * Checks whether email is already taken
     * 
     * @param string $email
     * @return boolean
     */
    public function emailExists($email);

    /**
     * Updates a subscriber
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function update(array $input);

    /**
     * Adds a subscriber
     * 
     * @param array $input Raw data to be inserted
     * @return boolean
     */
    public function insert(array $input);

    /**
     * Fetches a subscriber by associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id);

    /**
     * Deletes a subscriber by associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id);

    /**
     * Fetches all subscribers filtered by pagination
     * 
     * @param integer $page Current page number
     * @param integer $itemsPerPage Per page count
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage);
}
