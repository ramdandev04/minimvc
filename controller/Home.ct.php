<?php
/**
 * sebelum menggunakan views kita harus mendeklarasikan instance terlebih dahulu dengan use CORE/Views
 * 
 */

use CORE\Views;

class Home {

    public function index() {
        Views::render('home', ['title' => 'Minimvc - Home']);
    }

}