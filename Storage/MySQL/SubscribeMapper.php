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

/**
 * Abstracts table access
 */
final class SubscribeMapper extends AbstractMapper implements SubscribeMapperInterface
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'bono_module_subscribers';

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
     * Fetch all by page
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage)
    {
        return $this->db->select('*')
                        ->from($this->table)
                        ->where('langId', '=', $this->getLangId())
                        ->paginate($page, $itemsPerPage)
                        ->queryAll();
    }
}
