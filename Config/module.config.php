<?php

/**
 * Module configuration container
 */

return array(
    'name'  => 'Subscribe',
    'description' => 'Subscribe module allows you to collect subscribers and send them news-lettters',
    'menu' => array(
        'name' => 'Subscribe',
        'icon' => 'fas fa-envelope',
        'items' => array(
            array(
                'route' => 'Subscribe:Admin:Subscriber@gridAction',
                'name' => 'View all subscribers'
            ),
            array(
                'route' => 'Subscribe:Admin:Send@indexAction',
                'name' => 'New bulk-sending'
            )
        )
    )
);