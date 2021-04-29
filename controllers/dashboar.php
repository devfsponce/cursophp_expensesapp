<?php
class Dashboard extends SessionController
{
    function __construct()
    {
        parent::__construct();
        error_log('Dashboar::construct -> Inicio de Dashboard');
    }

    function render()
    {
        error_log('Dashboard::render-> Carga el index de Dashboard');
        $this->view->render('dashboard/index');
    }
}
