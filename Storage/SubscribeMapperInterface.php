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
     * Fetches all activated emails
     * 
     * @param integer $offset Starting offset
     * @param integer $limit Limit for records to be returned from offset
     * @return array
     */
    public function findActiveEmails($offset = 0, $limit = 0);

    /**
     * Finds an email by associated key
     * 
     * @param string $key
     * @return string
     */
    public function findEmailByKey($key);

    /**
     * Updates a key by associated email
     * 
     * @param string $email
     * @param string $key
     * @return boolean
     */
    public function updateKeyByEmail($email, $key);

    /**
     * Marks a user as active by associated email
     * 
     * @param string $email
     * @return boolean
     */
    public function makeActiveByEmail($email);

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
     * Deletes a subscriber by their associated key
     * 
     * @param string $key
     * @return integer A number of affected rows
     */
    public function deleteByKey($key);

    /**
     * Fetches all subscribers filtered by pagination
     * 
     * @param integer $page Current page number
     * @param integer $itemsPerPage Per page count
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage);
}
