<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//user
Route::get('/','userController@home');
Route::get('https://studio-20.herokuapp.com/about','userController@about');
Route::get('/services','userController@services');
Route::get('/gallery','userController@gallery');
Route::get('gallery/category','userController@category');
Route::get('/contact','userController@contact');
Route::get('/language','userController@language');
Route::post('/contact/data','userController@contactData');
Route::post('/contact/subscribe','userController@subscribe');
Route::get('/profileDownload','userController@profileDownload');

Route::get('/local/{lang?}',function($lang=null)
{
    App::setlocale($lang);
});


//admin
Route::get('admin/login','adminController@adminLogin');
Route::get('/admin/check','adminController@adminCheck');
Route::get('/logout','adminController@adminLogout');
Route::get('/admin/profile','adminController@adminProfile');

Route::get('admin/','adminController@home');

Route::get('admin/editPages','adminController@editPages');
Route::get('/admin/editPages/content/','adminController@pageContent');
Route::get('/admin/editPages/content/edit/ar','adminController@arContent');
Route::post('/admin/editPages/content/edit/update','adminController@updateArContent');
Route::get('/admin/editPages/content/edit/en','adminController@enContent');
Route::post('/admin/editPages/content/edit/updateEnContent','adminController@updateEnContent');



Route::get('/admin/editPages/translation/','adminController@translation');
Route::get('/admin/editPages/translation/edit','adminController@editTranslation');
Route::post('/admin/editPages/translation/update','adminController@updateTranslation');

Route::get('/admin/editPages/others/','adminController@editGeneral');
Route::get('/admin/editPages/others/links/','adminController@editlinks');
Route::get('/admin/editPages/others/links/edit','adminController@oldLink');
Route::post('admin/editPages/others/links/new','adminController@newLink');
Route::get('/admin/editPages/others/cover/','adminController@covers');
Route::get('admin/editPages/others/cover/new','adminController@addCover');
Route::post('admin/editPages/others/cover/new/add','adminController@newCover');
Route::get('/admin/editPages/others/cover/delete','adminController@deleteCover');
Route::get('/admin/editPages/others/cover/edit','adminController@editCover');
Route::post('/admin/editPages/others/cover/update','adminController@updateCover');
Route::get('/admin/editPages/others/cover/profile','adminController@profileCompany');
Route::post('/admin/editPages/others/cover/profile/update','adminController@updateProfileCompany');


Route::get('admin/other','adminController@other');
Route::get('admin/other/clients','adminController@clients');
Route::get('admin/other/clients/new','adminController@newClient');
Route::post('admin/other/clients/new/add','adminController@addClient');
Route::get('admin/other/clients/delete','adminController@deleteClient');
Route::get('/admin/other/clients/edit','adminController@editClient');
Route::post('/admin/other/clients/update','adminController@updateClient');
Route::get('/admin/other/subscribers/','adminController@subscribers');
Route::get('/admin/other/subscribers/new','adminController@newSubscriber');
Route::post('/admin/other/subscribers/add','adminController@addSubscriber');
Route::get('/admin/other/subscribers/delete','adminController@deleteSubscriber');
Route::get('/admin/other/subscribers/sendMessage','adminController@sub_sendMessage');
Route::post('/admin/other/subscribers/send','adminController@sub_message_send');
Route::get('/admin/other/admins/','adminController@admins');
Route::get('/admin/other/admins/profile','adminController@adminProfiles');
Route::get('/admin/other/admins/new','adminController@newAdmin');
Route::post('/admin/other/admins/add','adminController@addAdmin');
Route::get('/admin/other/admins/delete','adminController@deleteAdmin');
Route::get('/admin/other/admins/edit','adminController@editAdmin');
Route::post('/admin/other/admins/update','adminController@updateAdmin');

Route::get('admin/gallery/','adminController@gallery');
Route::get('admin/gallery/category/new/','adminController@newCategoy');
Route::get('/admin/gallery/category/images','adminController@CategoyImages');
Route::post('admin/gallery/category/new/add','adminController@addCategoy');
Route::get('admin/gallery/category/delete','adminController@deleteCategoy');
Route::get('/admin/gallery/category/edit','adminController@editCategoy');
Route::post('/admin/gallery/category/new','adminController@updateCategoy');

Route::get('admin/gallery/images/','adminController@images');
Route::get('/admin/gallery/images/new/','adminController@newImage');
Route::post('/admin/gallery/images/new/add','adminController@addImage');
Route::get('/admin/gallery/images/delete','adminController@deleteImage');

Route::get('/admin/orders/','adminController@orders');
Route::get('/admin/orders/packages/oprions','adminController@options');
Route::get('/admin/orders/packages/option/new','adminController@newOption');
Route::post('/admin/orders/packages/option/new/add','adminController@addOption');
Route::get('/admin/orders/packages/option/delete','adminController@deleteOption');
Route::get('/admin/orders/packages/','adminController@packages');
Route::get('/admin/orders/packages/new/','adminController@newPackage');
Route::post('/admin/orders/packages/add','adminController@addPackage');
Route::get('/admin/orders/packages/delete','adminController@deletePackage');
Route::get('/admin/orders/packages/edit','adminController@editPackage');
Route::post('/admin/orders/packages/update','adminController@updatePackage');

Route::get('/admin/messages/','adminController@messages');
Route::get('/admin/messages/order','adminController@showMessage');
Route::post('/admin/messages/arder/sendMessage','adminController@sendMessage');
Route::get('/admin/messages/download','adminController@downloadFile');
Route::get('/admin/messages/arder/reply','adminController@replyMessage');
Route::get('/admin/messages/order/delete','adminController@deleteMessage');
Route::get('/admin/messages/deleteMessages','adminController@deleteMessages');
Route::get('/admin/messages/exports','adminController@exports');
Route::get('/admin/messages/export','adminController@eachExport');
Route::get('/admin/messages/export/download','adminController@downloadFileExport');
Route::get('/admin/messages/export/delete','adminController@deleteExportMessage');
Route::get('/admin/messages/deleteExportMessages','adminController@deleteExportMessages');

Route::get('pdfview',array('as'=>'pdfview','uses'=>'adminController@pdfview'));

