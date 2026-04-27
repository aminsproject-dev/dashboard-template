<?php

namespace Config;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// Routes
$routes->get('/', 'Dashboard\Dashboard::index');
$routes->get('/dashboard', 'Dashboard\Dashboard::index');
$routes->get('/index', 'Dashboard\Dashboard::index');
$routes->get('/affiliate', 'Dashboard\Affiliate::affiliate');
$routes->get('/finance', 'Dashboard\Finance::finance');
$routes->get('/helpdesk', 'Dashboard\Helpdesk::helpdesk');
$routes->get('/invoice', 'Dashboard\Invoice::invoice');

// routes Widget
$routes->get('/statistics', 'Widget\Statistics::statistics');
$routes->get('/user-widget', 'Widget\User::user');
$routes->get('/data-widget', 'Widget\Data::data');
$routes->get('/chart-widget', 'Widget\Chart::chart');

// routes Application
$routes->get('/chat', 'Application\Chat::chat');

// routes Application/Ecommerce
$routes->get('/ecommerce/product', 'Application\Ecommerce\Product::product');
$routes->get('/ecommerce/product-detail/(:num)', 'Application\Ecommerce\ProductDetail::index/$1');
$routes->get('/ecommerce/product-list', 'Application\Ecommerce\Product::list');
$routes->get('/ecommerce/product-add', 'Application\Ecommerce\Product::addproduct');

// routes Application/Ecommerce/ProductAdd
$routes->get('/ecommerce/product-add', 'Application\Ecommerce\ProductAdd::index');
$routes->post('/ecommerce/product-add', 'Application\Ecommerce\ProductAdd::store');
$routes->get('/ecommerce/product-edit/(:num)', 'Application\Ecommerce\ProductAdd::edit/$1');
$routes->post('/ecommerce/product-update/(:num)', 'Application\Ecommerce\ProductAdd::update/$1');
$routes->delete('/ecommerce/product-delete/(:num)', 'Application\Ecommerce\ProductAdd::delete/$1');


// routes Application/Ecommerce/Checkout    
$routes->get('/ecommerce/checkout', 'Application\Ecommerce\Checkout::checkout');

// routes Pages/Authentication
$routes->get('/contact', 'Pages\Contact::contactUs');
$routes->post('/contact/send', 'Pages\Contact::sendContact');
// Authentication Routes
$routes->get('/auth/login', 'Pages\Authentication\AuthController::login');
$routes->post('/auth/login', 'Pages\Authentication\AuthController::attemptLogin');
$routes->get('/auth/register', 'Pages\Authentication\AuthController::register');
$routes->post('/auth/register', 'Pages\Authentication\AuthController::attemptRegister');
$routes->get('/auth/forgot-password', 'Pages\Authentication\AuthController::forgotPassword');
$routes->post('/auth/forgot-password', 'Pages\Authentication\AuthController::sendResetLink');
$routes->get('/auth/reset-password', 'Pages\Authentication\AuthController::resetPassword');
$routes->post('/auth/reset-password', 'Pages\Authentication\AuthController::updatePassword');
$routes->get('/auth/verify', 'Pages\Authentication\AuthController::verifyCode');




if (file_exists(APPPATH . 'Config/Routes.php')) {
    include_once APPPATH . 'Config/Routes.php';
}