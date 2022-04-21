<?php
namespace libs\system;
use libs\system\View;
require_once "libs/system/View.php";

class Controller
{
    protected $view;
    public function __construct(){
        $this->view=new View();
    }
}



?>