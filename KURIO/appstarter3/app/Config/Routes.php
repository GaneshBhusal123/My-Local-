<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/kurio', 'Home::index');
$routes->get('kurio/signup', 'SignupController::index');
$routes->match(['get', 'post'], 'SignupController/store', 'SignupController::store');
$routes->match(['get', 'post'], 'SigninController/loginAuth', 'SigninController::loginAuth');
$routes->get('kurio/signin', 'SigninController::index');
$routes->get('kurio/dashboard', 'ProfileController::index',['filter' => 'authGuard']);
$routes->get('kurio/client', 'ClientController::index');
$routes->get('kurio/profile', 'ProfileController::profile');
$routes->get('kurio/delete', 'ProfileController::delete');
$routes->get('kurio/remove_file/(:num)', 'ProfileController::remove_file/$1');
$routes->get('kurio/edit_file/(:num)', 'ProfileController::edit_file/$1');
$routes->post('kurio/update_file','ProfileController::update_file');
$routes->post('kurio/update', 'ProfileController::update');
$routes->get('kurio/logout', 'ProfileController::logout');
$routes->get('kurio/ajax_crud_app', 'ProfileController::ajax_crud_app');
$routes->get('kurio/ajax_modal', 'ProfileController::ajax_modal');


$routes->get('/', 'PostController::index');
$routes->post('post/add', 'PostController::add');
$routes->get('post/fetch', 'PostController::fetch');
$routes->get('post/edit/(:num)', 'PostController::edit/$1');
$routes->get('post/delete/(:num)', 'PostController::delete/$1');
$routes->get('post/detail/(:num)', 'PostController::detail/$1');
$routes->post('post/update', 'PostController::update');


$routes->get('kurio/forget_password', 'ForgetPasswordController::index');
 $routes->match(['get', 'post'], 'ForgetPasswordController/send_mail', 'ForgetPasswordController::send_mail');
$routes->get('/update_page/(:any)', 'UpdatePassword::index/$1');
$routes->match(['get', 'post'], 'UpdatePassword/change_password', 'UpdatePassword::change_password');
$routes->get('/update_credential/(:any)', 'UpdateCredential::index/$1');
$routes->match(['get', 'post'], 'UpdateCredential/save_credential', 'UpdateCredential::save_credential');
$routes->match(['get', 'post'], 'UserController/loginAuth', 'UserController::loginAuth');
$routes->get('kurio/user', 'UserController::index');
$routes->get('kurio/student', 'StudentController::index');
$routes->get('kurio/file', 'ProfileController::file');
$routes->post('kurio/uploadfile', 'ProfileController::uploadfile');
//--->Country, State, And City Populate using Ajax call
$routes->get('kurio/dropdown', 'DropdownAjaxController::index');
$routes->post('kurio/state', 'DropdownAjaxController::state');
$routes->post('kurio/cities', 'DropdownAjaxController::cities');
$routes->post('kurio/upload_dropdown', 'DropdownAjaxController::upload_dropdown');
$routes->get('kurio/userlist', 'DropdownAjaxController::userlist');

$routes->post('kurio/delete_selected', 'DropdownAjaxController::delete_selected');
$routes->post('kurio/delete_checked', 'DropdownAjaxController::delete_checked');

$routes->get('kurio/edit_list/(:num)', 'DropdownAjaxController::edit_list/$1');
$routes->post('kurio/state_data', 'DropdownAjaxController::state_data');
$routes->post('kurio/city_data', 'DropdownAjaxController::city_data');
$routes->post('kurio/update_list', 'DropdownAjaxController::update_list');
$routes->get('kurio/delete_file/(:num)', 'DropdownAjaxController::delete_file/$1');
$routes->post('kurio/delete_all', 'DropdownAjaxController::delete_all');
$routes->get('kurio/load_modal', 'DropdownAjaxController::load_modal');
$routes->post('kurio/update_modal', 'ProfileController::update_modal');

//
$routes->get('book/index', 'Book::index');
$routes->post('book/book_add', 'Book::book_add');
$routes->get('book/ajax_edit/(:num)', 'Book::ajax_edit/$1');
$routes->post('book/book_delete/(:num)', 'Book::book_delete/$1');
$routes->post('book/book_update', 'Book::book_update');
$routes->post('book/uploadFile', 'Book::uploadFile');




$routes->get('crud/index', 'Ajax::index');
$routes->post('crud/fileUpload', 'Ajax::fileUpload');

/*
// Route::get('/', [EmployeeController::class, 'index']);
// Route::post('/store', [EmployeeController::class, 'store'])->name('store');
// Route::get('/fetchall', [EmployeeController::class, 'fetchAll'])->name('fetchAll');
// Route::delete('/delete', [EmployeeController::class, 'delete'])->name('delete');
// Route::get('/edit', [EmployeeController::class, 'edit'])->name('edit');
// Route::post('/update', [EmployeeController::class, 'update'])->name('update');
 */


$routes->get('/employee', 'EmployeeController::index');
$routes->post('/store', 'EmployeeController::store');
$routes->get('/fetchall', 'EmployeeController::fetchAll');
$routes->get('/delete/(:num)', 'EmployeeController::delete/$1');
$routes->get('edit/(:num)', 'EmployeeController::edit/$1');
$routes->post('/update', 'EmployeeController::update');













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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
