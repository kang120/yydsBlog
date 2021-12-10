<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Pages');
$routes->setDefaultMethod('route');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function(){
							return view('CustomError/404');
						});
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'BlogController::home');
$routes->get('/about', 'BlogController::about');
$routes->get('/register', 'UserController::register');
$routes->post('/register', 'UserController::register');   // register form submission
$routes->get('/login', 'UserController::login');
$routes->post('/login', 'UserController::login');   // login form submission
$routes->get('/logout', 'UserController::logout');
$routes->get('/reset/request', 'UserController::forgotPassword');
$routes->post('/reset/request', 'UserController::forgotPassword');   // request password reset form submission
$routes->get('/reset/password/(:segment)', 'UserController::resetPassword/$1');
$routes->post('/reset/password/(:segment)', 'UserController::resetPassword/$1');   // reset password form submission
$routes->get('/post/new', 'BlogController::newPost');
$routes->post('/post/new', 'BlogController::newPost');   // new post form submission
$routes->get('/post/edit/(:segment)', 'BlogController::edit/$1');
$routes->post('/post/edit/(:segment)', 'BlogController::edit/$1');   // post edit form submission
$routes->post('/post/delete/(:segment)', 'BlogController::delete/$1');   // post delete form submission
$routes->get('/profile/(:segment)', 'UserController::profile/$1');
$routes->post('/profile/(:segment)', 'UserController::profile/$1');   // profile edit form submission
$routes->get('/post/(:segment)', 'BlogController::postpage/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
