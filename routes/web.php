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