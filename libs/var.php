<?php
/**
 * tempat untuk menyimpan global variable yang di butuhkan
 * 
 */
define('PATH', $_SERVER['REQUEST_URI']); //mengambil url path dari server request




define('METHOD', $_SERVER['REQUEST_METHOD']); //mengambil request method





$modules = [$_ENV['BASE_DIR'].'/routes/web']; //modul yang akan di load di dalam init





$vwext = '.vw.php';