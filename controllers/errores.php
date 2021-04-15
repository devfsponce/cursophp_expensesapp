<?php
require_once 'libs/controller.php';

class Errores extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $this->view->render('errores/index');
    }
}
