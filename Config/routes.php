<?php

/**
 * This file is part of the Bono CMS
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

return [
    
    '/module/subscribe/subscribe' => [
        'controller' => 'Handler@subcribeAction'
    ],

    '/module/subscribe/confirm/(:var)' => [
        'controller' => 'Handler@confirmAction'
    ],
    
    '/module/subscribe/unsubscribe/(:var)' => [
        'controller' => 'Handler@unsubscribeAction'
    ],
    
    '/%s/module/subscribe' => [
        'controller' => 'Admin:Subscriber@gridAction'
    ],
    
    '/%s/module/subscribe/page/(:var)' => [
        'controller' => 'Admin:Subscriber@gridAction'
    ],
    
    '/%s/module/subscribe/tweak' => [
        'controller' => 'Admin:Subscriber@tweakAction'
    ],
    
    '/%s/module/subscribe/edit/(:var)' => [
        'controller' => 'Admin:Subscriber@editAction'
    ],
    
    '/%s/module/subscribe/save' => [
        'controller' => 'Admin:Subscriber@saveAction'
    ],
    
    '/%s/module/subscribe/send' => [
        'controller' => 'Admin:Send@indexAction'
    ],

    '/%s/module/subscribe/send.ajax' => [
        'controller' => 'Admin:Send@sendAction'
    ],
    
    '/%s/module/subscribe/delete/(:var)' => [
        'controller' => 'Admin:Subscriber@deleteAction'
    ]
];