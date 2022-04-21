<?php
use libs\system\Controller;
use src\model\UserDB;

require_once "libs/system/Controller.php";

class AuthentificationController extends Controller
{
    private $login;
    public function __construct() {
        parent::__construct();
        $this -> login = new UserDB();
    }

    //page login
    public function login () {
        $_SESSION['errorSignprofil'] = "";
        $_SESSION['errorSignphone'] = "";
        $_SESSION['errorSignpassword'] = "";
        $_SESSION['errorSignactu'] = "";
        $_SESSION['errorSignpicture'] = "";
        $_SESSION['errorSign'] = "";
        if(isset($_SESSION['userConnect'])){
            $this -> login -> updateActif2($_SESSION['userConnect']['id']);
        }
        return $this->view->load("Authentification/login");
    }

    //index s'inscrire
    public function Sign_In() {
        $_SESSION['errorLoginNum'] ="";
        $_SESSION['errorLoginPas'] ="";
        $_SESSION['errorLogin'] ="";
        return $this -> view -> load("Authentification/Sign_In");
    }

    //index s'inscrire
    public function sign_up() {
        extract($_POST);
        if($this -> login -> userExist1($phone) || (substr($phone,0,2) != "78" && substr($phone,0,2) != "77" && substr($phone,0,2) != "76" && substr($phone,0,2) != "33")){
            $_SESSION['errorSignprofil'] = $profil;
            $_SESSION['errorSignphone'] = $phone;
            $_SESSION['errorSignpassword'] = $password;
            $_SESSION['errorSignactu'] = $actu;
            $_SESSION['errorSignpicture'] = $picture;
            $_SESSION['errorSign'] = '<label for="" style="color:red;">! Phone number already taken </label>';
            return $this -> Sign_In();
        }else{
            $_SESSION['errorSignprofil'] = "";
            $_SESSION['errorSignphone'] = "";
            $_SESSION['errorSignpassword'] = "";
            $_SESSION['errorSignactu'] = "";
            $_SESSION['errorSignpicture'] = "";
            $_SESSION['errorSign'] = "";
            $this -> login -> addUser($profil,$phone,$password,$actu,$picture);
            return $this -> login();
        }
    }

    //test login
    public function logon() {
        extract($_POST);
        if($this -> login -> userExist($phone,$password))
        {
            $_SESSION['errorLoginNum'] ="";
            $_SESSION['errorLoginPas'] ="";
            $_SESSION['errorLogin'] ="";
            $_SESSION['nbConnect'] = -2;
            $_SESSION['idDiscussionInProccess'] = "";
            $_SESSION['messageDiscussion'] = array();
            $_SESSION['userConnect'] = $this -> login -> userExist($phone,$password);
            $this -> login -> updateActif1($_SESSION['userConnect']['id']);
            header("Location: http://localhost/mes_projets/web.whatsapp/SpaceUser/SpaceUser");
        }else
        {
            $_SESSION['errorLoginNum'] = $phone;
            $_SESSION['errorLoginPas'] = $password;
            $_SESSION['errorLogin'] = '<label for="" style="color:red;">! Incorrect phone number or password </label>';
            return $this -> login();
        }
    }

    
}