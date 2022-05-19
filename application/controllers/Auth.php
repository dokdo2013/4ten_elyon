<?

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function login(){
        session_start();
        $success = false;
        if(isset($_POST["passwd"])){
            $passwd = $_POST["passwd"];
            $realPasswd = 'prettywiz';
            if($passwd == $realPasswd){
                $_SESSION["is_login"] = true;
                $success = true;
            }
        }
        if($success){
            header('Location: /main');
        }else{
            header('Location: /main?login_fail=true');
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: /main');
    }

}

/* End of file Auth.php */
