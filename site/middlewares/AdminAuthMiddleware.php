<?php
/**
 * Author: https://github.com/davinder17s
 * Email: davinder17s@gmail.com
 * Repository: https://github.com/davinder17s/codeigniter-middleware
 */

class AdminAuthMiddleware {
    protected $controller;
    protected $ci;
    public $roles = array();
    public function __construct($controller, $ci)
    {
        $this->controller = $controller;
        $this->ci = $ci;
    }

    public function run(){
        //echo 'aaaa';
        //$this->roles = array('somehting', 'view', 'edit');
    }
}