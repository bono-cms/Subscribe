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
    
    '/module/subscribe/subscribe' => array(
        'controller' => 'Handler@subcribeAction'
    ),

    '/module/subscribe/confirm/(:var)' => array(
        'controller' => 'Handler@confirmAction'
    ),
    
    '/module/subscribe/unsubscribe' => array(
        'controller' => 'Handler@unsubscribeAction'
    ),
    
    '/%s/module/subscribe' => array(
        'controller' => 'Admin:Subscriber@gridAction'
    ),
    
    '/%s/module/subscribe/page/(:var)' => array(
        'controller' => 'Admin:Subscriber@gridAction'
    ),
    
    '/%s/module/subscribe/tweak' => array(
        'controller' => 'Admin:Subscriber@tweakAction'
    ),
    
    '/%s/module/subscribe/add' => array(
        'controller' => 'Admin:Subscriber@addAction'
    ),

    '/%s/module/subscribe/edit/(:var)' => array(
        'controller' => 'Admin:Subscriber@editAction'
    ),
    
    '/%s/module/subscribe/save' => array(
        'controller' => 'Admin:Subscriber@saveAction'
    ),
    
    '/%s/module/subscribe/send' => array(
        'controller' => 'Admin:Send@indexAction'
    ),

    '/%s/module/subscribe/send.ajax' => array(
        'controller' => 'Admin:Send@sendAction'
    ),
    
    '/%s/module/subscribe/delete/(:var)' => array(
        'controller' => 'Admin:Subscriber@deleteAction'
    )
);
