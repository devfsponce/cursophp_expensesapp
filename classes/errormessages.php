<?php
class ErrorMessages
{
    //ERROR_CONTROLLER_METHOD_ACTION
    const ERROR_ADMIN_NEWCATEGORY_EXISTS = "d588900d2032283b316604dd6aedf4ab";

    private $errorList = [];

    public function __construct()
    {
        $this->errorList = [
            ErrorMessages::ERROR_ADMIN_NEWCATEGORY_EXISTS => 'El nombre de la categoria ya existe, intenta otra'
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
