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
        return 'bono_module_subscribers';
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
