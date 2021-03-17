<?php namespace CORE\Models;

use PDO;
use PDOException;

/**
 * 
 * Model instance to requiring all of the needed models
 * 
 */

 class Models {
    static private $dbh;
    static private $stmt;

    /**
     * @param string $dbname adalah database yang mau di gunakan
     */

    public function __construct($dbname)
    {
        /**
         * PDO option 
         */
        $opt = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];


        $dsn = $_ENV['DB']['DB'].":host=".$_ENV['DB']['HOST'].";dbname=$dbname";

        try {
            self::$dbh = new PDO($dsn, $_ENV['DB']['USER'], $_ENV['DB']['PASS'], $opt);
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
        }
    }

    /**
     * @method query adalah untuk mengeksekusi custom query
     * @param string $args INSERT * INTO or SELECT * FROM
     * @param string $mode mode nya itu bisa read, insert, update dan delete
     */

    static function query($args) {
        
        self::$stmt = self::$dbh->prepare($args);
    }

    /**
     * 
     * Bind di gunakan saat ingin menggunakan query dengan menggunakan insert mode
     * @param mixed $param di isi dengan place holder dari  PDO bind
     * @param mixed $value di isi dengan value yang mau di isikan kedalam bind‹
     * 
     */

    static function bind($param, $value, $type = null) {

        if(is_null($type)) {
            
            switch(true){

                case is_int($value):

                    $type = PDO::PARAM_INT;
                    break;
                
                case is_bool($value):

                    $type = PDO::PARAM_BOOL;
                    break;
                
                case is_null($value):

                    $type = PDO::PARAM_NULL;
                    break;

                default :
                    
                    $type = PDO::PARAM_STR;
            }

        }

        self::$stmt->bindValue($param, $value, $type);

    }

    /**
     * 
     * Execute the query
     * 
     */

     static function execute() {

        self::$stmt->execute();

     }

     /**
      * Returning data
      */

      static function fetchAll() {

        self::execute();

        return self::$stmt->fetchAll(PDO::FETCH_ASSOC);

      }

      static function fetch() {

        self::execute();
          
        return self::$stmt->fetch(PDO::FETCH_ASSOC);

      }
 }