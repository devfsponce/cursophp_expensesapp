<?php
require_once 'models/usermodel.php';
class User extends SessionController
{
    private $user;

    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function render()
    {
        $this->view->render('user/index', [
            'user' => $this->user
        ]);
    }

    function updateBudget()
    {
        if (!$this->existPOST('budget')) {
            $this->redirect('user', ['error' => ErrorsMessages::ERROR_USER_UPDATEBUDGET]); //TODO:
            return;
        }

        $budget = $this->getPost('budget');

        if (empty($budget) || $budget == 0 || $budget < 0) {
            $this->redirect('user', ['error' => ErrorsMessages::ERROR_USER_UPDATEBUDGET]); //TODO:
            return;
        }

        $this->user->setBudget($budget);
        if ($this->user->update()) {
            $this->redirect('user', ['success' => SuccessMessages::SUCCESS_USER_UPDATEBUDGET]); //TODO:
        }
    }

    function updateName()
    {
        if (!$this->existPOST('name')) {
            $this->redirect('user', ['error' => ErrorsMessages::ERROR_USER_UPDATENAME]); //TODO:
            return;
        }

        $name = $this->getPost('name');

        if (empty($name) || $name == NULL) {
            $this->redirect('user', ['error' => ErrorsMessages::ERROR_USER_UPDATENAME_EMPTY]); //TODO:
            return;
        }

        $this->user->setName($name);
        if ($this->user->update()) {
            $this->redirect('user', ['success' => SuccessMessages::SUCCESS_USER_UPDATENAME]); //TODO:
        }
    }

    function updatePassword()
    {
        if (!$this->existPOST(['current_password', 'new_password'])) {
            $this->redirect('user', ['error' => ErrorsMessages::ERROR_USER_UPDATEPASSWORD]); //TODO:
            return;
        }

        $current = $this->getPost('current_password');
        $new = $this->getPost('new_password');

        if (empty($current) || empty($new)) {
            $this->redirect('user', ['error' => ErrorsMessages::ERROR_USER_UPDATEPASSWORD_EMPTY]); //TODO:
            return;
        }

        if ($current === $new) {
            $this->redirect('user', ['error' => ErrorsMessages::ERROR_USER_UPDATEPASSWORD_ISNOTTHESAME]); //TODO:
            return;
        }

        $newHash = $this->model->comparePasswords($current, $this->user->getId());
        if ($newHash) {
            $this->user->setPassword($new);
            if ($this->user->update()) {
                $this->redirect('user', ['success' => SuccessMessages::SUCCESS_USER_UPDATEPASSWORD]); //TODO:
                return;
            } else {
                $this->redirect('user', ['error' => ErrorsMessages::ERROR_USER_UPDATEPASSWORD]); //TODO:
                return;
            }
        } else {
            $this->redirect('user', ['error' => ErrorsMessages::ERROR_USER_UPDATEPASSWORD]); //TODO:
            return;
        }
    }
    function updatePhoto()
    {
        if (!isset($_FILES['photo'])) {
            $this->redirect('user', ['error' => ErrorsMessages::ERROR_USER_UPDATEPHOTO]); //TODO:
            return;
        }

        $photo = $_FILES['photo'];

        $targetDir = 'public/img/photos/';
        $extension = explode('.', $photo['name']);
        $filename = $extension[sizeof($extension) - 2];
        $ext = $extension[sizeof($extension) - 1];
        $hash = md5(Date('Ymdgi') . $filename) . '.' . $ext;
        $targetFile = $targetDir . $hash;
        $uploadOk = false;
        $imageFileType = strtoLower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($photo['tmp_name']);
        if ($check != false) {
            $uploadOk = true;
        } else {
            $uploadOk = false;
        }

        if (!$uploadOk) {
            $this->redirect('user', ['error' => ErrorsMessages::ERROR_USER_UPDATEPHOTO_FORMAT]); //TODO:
            return;
        } else {
            if (move_uploaded_file($photo['tmp_name'], $targetFile)) {
                $this->user->setPhoto($hash);
                $this->user->update();
                $this->redirect('user', ['success' => SuccessMessages::SUCCESS_USER_UPDATEPHOTO]); //TODO:
                return;
            } else {
                $this->redirect('user', ['error' => ErrorsMessages::ERROR_USER_UPDATEPHOTO]); //TODO:
                return;
            }
        }
    }
}
