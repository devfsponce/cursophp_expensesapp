<?php
class SuccessMessages
{

    //SUCCESS_CONTROLLER_METHOD_ACTION
    const SUCCESS_ADMIN_NEWCATEGORY_EXISTS = "857e30c6d3768781649715c67c0ea419";
    const SUCCESS_SIGNUP_NEWUSER = "85G834c6d3768781649715G5Kc0ea419";

    private $successList = [];

    public function __construct()
    {
        $this->successList = [
            SuccessMessages::SUCCESS_ADMIN_NEWCATEGORY_EXISTS => 'Categoria creada correctamente',
            SuccessMessages::SUCCESS_SIGNUP_NEWUSER => 'Nuevo usuario registrado correctamente'
        ];
    }

    public function get($hash)
    {
        return $this->successList[$hash];
    }

    public function existsKey($key)
    {
        if (array_key_exists($key, $this->successList)) {
            return true;
        } else {
            return false;
        }
    }
}
