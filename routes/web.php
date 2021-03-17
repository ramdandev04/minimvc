<?php
/**
 * memberitahu bahwa di sini kita akan menggunakan Route
 */
use CORE\Route as Route;

/**
 * route method yang baru tersedia hanyalah GET dan POST
 * untuk penggunaan sangat mudah dan simple hehe
 */

 Route::get('/', 'Home/index');


 Route::get('/crud', 'Crud/index');


 Route::post('/crud', 'Crud/addData');


 Route::post('/crud/update', 'Crud/updateData');


 Route::post('/crud/delete', 'Crud/deleteData');