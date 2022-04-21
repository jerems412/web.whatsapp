<?php
namespace libs\system;
class BootStrap
{
    private $controller_object;
    public function __construct(){
        
        if(isset($_GET["url"])){
            $url=explode("/",$_GET["url"]);
            $controller_file="src/controller/".$url[0]."Controller.php";
            if(file_exists($controller_file)){
                require_once $controller_file;
                $file=$url[0]."Controller";
                $this -> controller_object= new $file();
                if(isset($url[2])){
                    $method=$url[1];
                    if(method_exists($this -> controller_object,$method)){
                        $this -> controller_object->$method( $url[2]);
                    }else {
                        die($method."n'exite pas dans le controlleur".$file);
                    }
                 
                }
                else if(isset($url[1])){
                    $method=$url[1];
                    if(method_exists($this -> controller_object,$method)){
                        $this -> controller_object->$method( );
                    }else {
                        die($method."n'exite pas dans le controlleur".$file);
                    }
                 
                }
            }else {
                die($controller_file."n'existe pas");
            }
        }else {
                $file = 'src/controller/'.welcome_params()['home_controller'].'.php';
				if(file_exists($file))
				{
					require_once $file;
					$this -> controller_object = welcome_params()['home_controller'];
					$this -> controller_object = new $this -> controller_object();
				
					if(method_exists($this -> controller_object, welcome_params()['function'])){
						$this -> controller_object ->{welcome_params()['function']}();
					}else{
						$msg = "La methode <b>index()</b> n'existe pas dans le controller <b>".welcome_params()['home_controller']."</b>!";
						//$error->messageError($msg);
					}
                    
				}else{
					$msg = "Le controller welcome <b>" . welcome_params()['home_controller'] . "</b> n'existe pas !";
					$msg = $msg. "<br/>Merci de bien faire la configuration du fichier <b>config/home_controller.php</b>!";
					//$error->messageError($msg);
				}
            
        }
    }
}



?>