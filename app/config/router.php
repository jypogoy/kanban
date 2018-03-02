<?php

$router = $di->getRouter();

// $router->add(
//     '/home',
//     [
//         'controller' => 'index',
//         'action' => 'index'
//     ]
// );

$router->handle();
