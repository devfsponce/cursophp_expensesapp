<?php
class View
{
    function __construct()
    {
    }

    function render($nombre, $data = [])
    {
        $this->d = $data;

        $this->handleMessages();

        require 'views/' . $nombre . '.php';
    }

    private function handleMessages()
    {
        if (isset($_GET['success']) && isset($_GET['error'])) {
        } elseif (isset($_GET['success'])) {
            $this->handleSuccess();
        } elseif (isset($_GET['error'])) {
            $this->handleError();
        }
    }

    private function handleError()
    {
        $hash = $_GET['error'];
        $error = new ErrorMessages();

        if ($error->existsKey($hash)) {
            $this->d['error'] =  $error->get($hash);
        }
    }

    private function handleSuccess()
    {
        $hash = $_GET['success'];
        $success = new SuccessMessages();

        if ($success->existsKey($hash)) {
            $this->d['success'] =  $success->get($hash);
        }
    }
}
