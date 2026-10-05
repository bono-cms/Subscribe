<?php

/**
 * Module configuration container
 */

return [
    'name' => 'Subscribe',
    'description' => 'Subscribe module allows you to collect subscribers and send them news-lettters',
    'menu' => [
        'name' => 'Subscribe',
        'icon' => 'fas fa-envelope',
        'items' => [
            [
                'route' => 'Subscribe:Admin:Subscriber@gridAction',
                'name' => 'View all subscribers'
            ],
            [
                'route' => 'Subscribe:Admin:Send@indexAction',
                'name' => 'New bulk-sending'
            ]
        ]
    ]
];