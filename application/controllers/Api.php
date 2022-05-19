<?

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function member($dir)
    {
        if($dir == "add"){
            // USER ADD
            $now_date = date("Y-m-d H:i:s");
            $a = $_POST["userLevel"];
            $b = $_POST["userNickname"];
            $c = $_POST["userAccountName"];
            $d = $_POST["userJob"];
            $e = $_POST["userItemLevel"];
            $f = $_POST["userEtc"];
            $g = "";
            $h = "";
            $q = "INSERT INTO club_users(registerDate, lastEditDate, userLevel, userNickname,
             userAccountName, job, itemLevel, etc1, etc2, etc3) VALUE( '$now_date', '$now_date',
             $a, '$b', '$c', $d, '$e', '$f', '$g', '$h' )";
            $this->db->query($q);
            echo "success";
            header('Location: /main');
        }else if($dir == "edit"){
            // USER EDIT
            $now_date = date("Y-m-d H:i:s");
            $target = $_POST["targetId2"];
            $a = $_POST["userLevel"];
            $b = $_POST["userNickname"];
            $c = $_POST["userAccountName"];
            $d = $_POST["userJob"];
            $e = $_POST["userItemLevel"];
            $f = $_POST["userEtc"];
            $g = "";
            $h = "";
            $q = "UPDATE club_users SET lastEditDate='$now_date', userLevel=$a, userNickname='$b', userAccountName='$c',
                job=$d, itemLevel='$e', etc1='$f' WHERE num = $target";
            $this->db->query($q);
            echo "success";
            header('Location: /main');
        }else if($dir == "delete"){
            // USER DELETE
            if(isset($_POST["id"])){
                $id = $_POST["id"];
                $q = "DELETE FROM club_users WHERE num = $id";
                $this->db->query($q);
                echo "success";
            }else{
                echo "fail";
            }
        }
    }

    public function board($dir)
    {
        $this->load->model('Board_model');
        if($dir == "write"){
            // 게시글 등록
            try{
                $boardNum = $_POST["targetBoard"];
                $passwd = $_POST["writerPasswd"];
                $title = $_POST["writeTitle"];
                $content = $_POST["editordata"];
                $writerName = $_POST["writerName"];
                $num = $this->Board_model->addNewItem($boardNum, $passwd, $title, $content, $writerName);
                header('Location: /board/view/'.$num);
            }
            catch(Exception $e){
                echo "<script>alert('오류가 발생했습니다. 관리자에게 문의해주세요. (오류코드: ".$e->getCode().")');</script>";
                echo "<script>history.back();</script>";
            }
        }else if($dir == "comWrite"){
            // 댓글 등록
            try{
                $itemNum = $_POST["targetItem"];
                $name = $_POST["newCommentName"];
                $content = $_POST["newComment"];
                $this->Board_model->addComment($itemNum, $name, $content);
                header('Location: /board/view/'.$itemNum);
            }
            catch(Exception $e){
                echo "<script>alert('오류가 발생했습니다. 관리자에게 문의해주세요. (오류코드: ".$e->getCode().")');</script>";
                echo "<script>history.back();</script>";
            }
        }else if($dir == "delItem"){
            // 게시글 삭제
        }else if($dir == "delCom"){
            // 댓글 삭제
        }
    }

}

/* End of file Api.php */


?>