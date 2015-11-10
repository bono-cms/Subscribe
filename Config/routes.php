<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

return array(
    '/admin/module/subscribe' => array(
        'controller' => 'Admin:Browser@indexAction'
    ),
    
    '/admin/module/subscribe/add' => array(
        'controller' => 'Admin:Add@indexAction'
    ),
    
    '/admin/module/subscribe/send' => array(
        'controller' => 'Admin:Send@indexAction'
    ),

    '/admin/module/subscribe/send.ajax' => array(
        'controller' => 'Admin:Send@sendAction'
    )
);
