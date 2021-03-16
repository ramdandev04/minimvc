<?php

/**
 * 
 * Ini adalah persamaan dengan .env yang banyak di gunakan oleh beberapa framework
 * @package Enviroment
 * 
 */

 $_ENV = [
    /**
     * 
     * Kalian bisa mengubah value dari env yang ada di sini
     * 
     */

     "ENV" => "development", //set ke development atau production untuk menampilkan atau menyembunyikan error



     "BASE_DIR" => __DIR__, //saya saran kan gak ngedit bagian ini wkwkwk


     "DB" => [


         "HOST" => "localhost", // silahkan sesuaikan dengan kebutuhan


         "USER" => "root", // Username dari database kalian


         "PASS" => "root" // untuk password database


     ]


 ];