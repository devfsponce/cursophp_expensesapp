<?php
class SuccessMessages
{

    //SUCCESS_CONTROLLER_METHOD_ACTION
    const SUCCESS_ADMIN_NEWCATEGORY_EXISTS = "857e30c6d3768781649715c67c0ea419";

    private $successList = [];

    public function __construct()
    {
        $this->successList = [
            SuccessMessages::SUCCESS_ADMIN_NEWCATEGORY_EXISTS => 'Categoria creada correctamente'
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
