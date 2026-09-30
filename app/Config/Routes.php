<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('customers', 'Customers::index');
$routes->get('customers/new', 'Customers::new');
$routes->post('customers/create', 'Customers::create');
$routes->get('customers/(:num)/edit', 'Customers::edit/$1');
$routes->post('customers/(:num)/update', 'Customers::update/$1');
$routes->get('customers/(:num)/delete', 'Customers::delete/$1');