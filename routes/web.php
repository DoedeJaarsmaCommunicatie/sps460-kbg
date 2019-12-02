<?php
/**
 * @var \Laravel\Lumen\Routing\Router $router
 */

$router->get('/encrypt/{email}', 'Api\\HashGenerator@hashEmail');
$router->get('/decrypt/{email}', 'Api\\HashGenerator@deHashEmail');

$router->post('/register/advisory-group', 'Api\\RegisterAdvisoryController');
