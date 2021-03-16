<?php namespace CORE;

include __DIR__.'/../env.php';
include $_ENV['BASE_DIR'].'/libs/var.php';
include $_ENV['BASE_DIR'].'/vendor/autoload.php';

/**
 * Top level core engine mini mvc framework
 * 
 * @author Ade muhamad ramdani
 * 
 */

if($_ENV['ENV'] != 'production') {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
} else {
    error_reporting(0);
}

/**
 * Ini adalah top level instance yang akan di load pertama kali
 * 
 * @package Init
 */

class Init {

    /**
     * @method autoload
     * me load semua module yang di butuhkan untuk memulai aplikasi
     */
    static function autoload() {

        global $modules;

        foreach ($modules as $module) {
            include $module.'.php';
        }
    }
}


/**
 * 
 * Routing untuk mempermudah memilih controller dan view.
 * Penggunaan ||
 * use CORE\Route as Route;
 * Route::get('/', 'Home/index'); untuk method get,
 * Route::post('/', 'Home/post'): untuk handling post,
 * @package Route
 *  
 */

class Route {
    static $controller = 'Home';
    static $method = 'index';
    static $req = [];

    /**
    * @param string $path variable path adalah url path yang di inginkan seperti /home , /about, dll 
    * @param string $controller adalah controller instance yang terdapat di dalam folder controller, untuk instance
    *               Home dan method index gunakan "Home/index"
    * @package Route::get
    * @method get($path, $controller)
    */

    static function get($path, $controller) {


        if(METHOD != 'GET') {


            return;


        }

        if($path == PATH) {



            $ct = explode('/', $controller);



            if(file_exists($_ENV['BASE_DIR'].'/controller/'.$ct[0].'.ct.php')) {



                require_once $_ENV['BASE_DIR'].'/controller/'.$ct[0].'.ct.php';

                
            }

            if(class_exists($ct[0])) {



                self::$controller = $ct[0];



            }



            self::$controller = new self::$controller();



            if(method_exists(self::$controller, $ct[1])) {



                self::$method = $ct[1];

                

            }

            call_user_func([self::$controller, self::$method]);


        }
    }



    /**
    * @param string $path variable path adalah url path yang di inginkan seperti /home , /about, dll 
    * @param string $controller adalah controller instance yang terdapat di dalam folder controller, untuk instance
    *               Home dan method index gunakan "Home/index"
    * @package Route::post
    * @method post($path, $controller)
    */


    static function post($path, $controller) {
        if(METHOD != 'POST') {


            return;


        }

        if($path == PATH) {



            $ct = explode('/', $controller);



            if(file_exists($_ENV['BASE_DIR'].'/controller/'.$ct[0].'.ct.php')) {



                require_once $_ENV['BASE_DIR'].'/controller/'.$ct[0].'.ct.php';

                
            }

            if(class_exists($ct[0])) {



                self::$controller = $ct[0];



            }



            self::$controller = new self::$controller();



            if(method_exists(self::$controller, $ct[1])) {



                self::$method = $ct[1];

                

            }

            call_user_func([self::$controller, self::$method]);


        }
    }
}

/**
 * Ini adalah Views instance yang akan merender views yang ada di folder views
 * 
 * @package Views
 */

class Views {

    /**
     * @param string $view contoh "home" yang akan mengakses home.vw.php
     * @param array $context ini adalah opsi untuk mengirimkan argumen kepada views
     */

    static function render($view, $context = []) {

        global $vwext;

        if(file_exists($_ENV['BASE_DIR'].'/views/'.$view.$vwext)) {

            require_once $_ENV['BASE_DIR'].'/views/'.$view.'.vw.php';

        } else {

            return trigger_error('View not found', E_USER_ERROR);
            
        }
    }
}