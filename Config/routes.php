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
        'controller' => 'Admin:Subscriber@gridAction'
    ),
    
    '/admin/module/subscribe/page/(:var)' => array(
        'controller' => 'Admin:Subscriber@gridAction'
    ),
    
    '/admin/module/subscribe/tweak' => array(
        'controller' => 'Admin:Subscriber@tweakAction'
    ),
    
    '/admin/module/subscribe/add' => array(
        'controller' => 'Admin:Subscriber@addAction'
    ),

    '/admin/module/subscribe/edit/(:var)' => array(
        'controller' => 'Admin:Subscriber@editAction'
    ),
    
    '/admin/module/subscribe/save' => array(
        'controller' => 'Admin:Subscriber@saveAction'
    ),
    
    '/admin/module/subscribe/send' => array(
        'controller' => 'Admin:Send@indexAction'
    ),

    '/admin/module/subscribe/send.ajax' => array(
        'controller' => 'Admin:Send@sendAction'
    ),
    
    '/admin/module/subscribe/delete' => array(
        'controller' => 'Admin:Subscriber@deleteAction'
    )
);
