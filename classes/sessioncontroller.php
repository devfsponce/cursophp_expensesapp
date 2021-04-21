<?php

require_once 'classes/session.php';

class SessionController extends Controller
{

    private $userSession;
    private $userName;
    private $userId;

    private $session;
    private $sites;

    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function init()
    {
        $this->session = new Session();

        $json = $this->getJSONFileConfig();

        $this->sites = $json['sites'];
        $this->defaultSites = $json['default-sites'];

        $this->validateSession();
    }

    private function getJSONFileConfig()
    {
        $string = file_get_contents('config/access.json');
        $json = json_decode($string, true);

        return $json;
    }

    public function validateSession()
    {
        error_log('SESSIONCONTROLLER::validateSession');

        //Si existe la sesion
        if ($this->existsSession()) {
            $role = $this->getUserSessionData()->getRole();

            //validar el acceso publico 
            if ($this->isPublic()) {
                $this->redirectDefaultSiteByRole($role);
            } else {
                if ($this->isAuthorizes($role)) {
                    // autorizado lo dejo pasar
                } else {
                    $this->redirectDefaultSiteByRole($role);
                }
            }
        } else {
            //no existe la sesion
            if ($this->isPublic()) {
                //puede entrar
            } else {
                header('location:' . constant('URL') . '');
            }
        }
    }

    public function existsSession()
    {
        if (!$this->session->exists()) return false;
        if ($this->session->getCurrentUser() == NULL) return false;

        $userId = $this->session->getCurrentUser();

        if ($userId) return true;

        return false;
    }

    function getUserSessionData()
    {
        $id = $this->userId;
        $this->user = new UserModel();
        $this->user->get($id);
        error_log('SESSIONCONTROLLER::getUserSessiondata -> ' . $this->user->getUsername());
        return $this->user;
    }

    function isPublic()
    {
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/", "", $currentURL);

        for ($i = 0; $i < sizeof($this->sites); $i++) {
            if ($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['access'] == 'public') {
                return true;
            }
        }
        return false;
    }

    function getCurrentPage()
    {
        $actualLink = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actualLink);
        error_log('SESSIONCONTROLLER::getCurrentPage -> ' . $url[2]);
        return $url[2];
    }

    private function redirectDefaultSiteByRole($role)
    {
        $url = '';
        for ($i = 0; $i < sizeof($this->sites); $i++) {
            if ($this->site[$i]['role'] == $role) {
                $url = '/expenses/' . $this->sites[$i]['site'];
                break;
            }
        }
        header('location:' . $url);
    }

    private function isAuthorizes($role)
    {
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/", "", $currentURL);

        for ($i = 0; $i < sizeof($this->sites); $i++) {
            if ($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['role'] == $role) {
                return true;
            }
        }
        return false;
    }

    function initialize($user)
    {
        $this->session->setCurrentUser($user->getId());
        $this->authorizeAccess($user->getRole());
    }

    private function authorizeAccess($role)
    {
        switch ($role) {
            case 'user':
                $this->redirect($this->defaultSites['user'], []);
                break;
            case 'admin':
                $this->redirect($this->defaultSites['admin'], []);
                break;
        }
    }

    function logOut()
    {
        $this->session->closeSession();
    }
}
