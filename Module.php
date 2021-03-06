<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Subscribe;

use Cms\AbstractCmsModule;
use Subscribe\Service\SubscribeManager;

final class Module extends AbstractCmsModule
{
    /**
     * {@inheritDoc}
     */
    public function getServiceProviders()
    {
        $subscribeMapper = $this->getMapper('/Subscribe/Storage/MySQL/SubscribeMapper');
        $subscribeManager = new SubscribeManager($subscribeMapper);

        return array(
            'subscribeManager' => $subscribeManager
        );
    }
}
