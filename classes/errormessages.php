<?php
class ErrorMessages
{
    //ERROR_CONTROLLER_METHOD_ACTION
    const ERROR_ADMIN_NEWCATEGORY_EXISTS = "d588900d2032283b316604dd6aedf4ab";
    const ERROR_SIGNUP_NEWUSER = "d588900ddw342283b3165f44dd6aedf4fb";
    const ERROR_SIGNUP_NEWUSER_EMPTY = "dfa478900ddw34225dhhb31345f44dd6aedf4fb";
    const ERROR_SIGNUP_NEWUSER_EXISTS = "dhj29d478900ddw34225dhhb31gu389sod6aedf4fb";
    const ERROR_LOGIN_AUTHENTICATE_EMPTY = "dhj2s8478908ldw341p5dhhsi1gu3alsod6aedf4fb";
    const ERROR_LOGIN_AUTHENTICATE_DATA = "ahjfs8r7w840yldb3f1p53hhsiggu3alsodm6aeuf4db";
    const ERROR_LOGIN_AUTHENTICATE = "28gfs8rkqo90yldb7cjsoe4hsikop4alsodm6aeuf4db";



    private $errorList = [];

    public function __construct()
    {
        $this->errorList = [
            ErrorMessages::ERROR_ADMIN_NEWCATEGORY_EXISTS => 'El nombre de la categoria ya existe, intenta otra',
            ErrorMessages::ERROR_SIGNUP_NEWUSER => 'Hubo un error al intentar procesar la solicitud',
            ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY => 'Llena los campos de usuario y password',
            ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS => 'Ya existe ese nombre de usuario, prueba otro',
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY => 'LLena los campos de usuario y password',
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA => 'Nombre de usuario y/o contraseña incorrectos',
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE => 'No se puede procesar la solicitud. Ingresa usuario y password'
        ];
    }

    public function get($hash)
    {
        return $this->errorList[$hash];
    }

    public function existsKey($key)
    {
        if (array_key_exists($key, $this->errorList)) {
            return true;
        } else {
            return false;
        }
    }
}
