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
     * Inserts a record
     * 
     * @param stdclass $container
     * @return boolean
     */
    public function insert(stdclass $container)
    {
        return $this->db->insert($this->table, array(
            
            'langId'    => $this->getLangId(),
            'email'     => $container->email,
            'timestamp' => $container->timestamp,
            'active'    => $container->active,
            
        ))->execute();
    }

    /**
     * Fetches a record by its associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id)
    {
        return $this->db->select('*')
                        ->from($this->table)
                        ->where('id', '=', $id)
                        ->query();
    }

    /**
     * Deletes a record by its associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id)
    {
        return $this->db->delete()
                        ->from($this->table)
                        ->where('id', '=', $id)
                        ->execute();
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
