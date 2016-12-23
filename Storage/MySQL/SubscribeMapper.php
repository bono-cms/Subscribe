<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Subscribe\Storage\MySQL;

use Cms\Storage\MySQL\AbstractMapper;
use Subscribe\Storage\SubscribeMapperInterface;

final class SubscribeMapper extends AbstractMapper implements SubscribeMapperInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getTableName()
    {
        return self::getWithPrefix('bono_module_subscribers');
    }

    /**
     * Finds an email by associated key
     * 
     * @param string $key
     * @return string
     */
    public function findEmailByKey($key)
    {
        $column = 'email';

        return $this->db->select($column)
                        ->from(self::getTableName())
                        ->whereEquals('key', $key)
                        ->query($column);
    }

    /**
     * Updates a record by its associated email
     * 
     * @param string $email
     * @param string $column
     * @param string $value
     * @return boolean
     */
    private function updateByEmail($email, $column, $value)
    {
        return $this->db->update(self::getTableName(), array($column => $value))
                        ->whereEquals('email', $email)
                        ->execute();
    }

    /**
     * Updates a key by associated email
     * 
     * @param string $email
     * @param string $key
     * @return boolean
     */
    public function updateKeyByEmail($email, $key)
    {
        return $this->updateByEmail($email, 'key', $email);
    }

    /**
     * Marks a user as active by associated email
     * 
     * @param string $email
     * @return boolean
     */
    public function makeActiveByEmail($email)
    {
        return $this->updateByEmail($email, 'active', '1');
    }

    /**
     * Updates subscriber's state
     * 
     * @param string $id Subscriber id
     * @param string $state
     * @return boolean
     */
    public function updateActive($id, $state)
    {
        return $this->updateColumnByPk($id, 'active', $state);
    }

    /**
     * Checks whether email is already taken
     * 
     * @param string $email
     * @return boolean
     */
    public function emailExists($email)
    {
        return (bool) $this->countByColumn('email', $email);
    }

    /**
     * Updates a subscriber
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function update(array $input)
    {
        return $this->persist($input);
    }

    /**
     * Adds a subscriber
     * 
     * @param array $input Raw data to be inserted
     * @return boolean
     */
    public function insert(array $input)
    {
        return $this->persist($this->getWithLang($input));
    }

    /**
     * Fetches a subscriber by associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id)
    {
        return $this->findByPk($id);
    }

    /**
     * Deletes a subscriber by associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id)
    {
        return $this->deleteByPk($id);
    }

    /**
     * Fetches all subscribers filtered by pagination
     * 
     * @param integer $page Current page number
     * @param integer $itemsPerPage Per page count
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage)
    {
        return $this->db->select('*')
                        ->from(self::getTableName())
                        ->whereEquals('lang_id', $this->getLangId())
                        ->orderBy('id')
                        ->desc()
                        ->paginate($page, $itemsPerPage)
                        ->queryAll();
    }
}
