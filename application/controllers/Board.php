<?

defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //header("Pragma: no-cache");   
        //header("Cache-Control: no-cache,must-revalidate");   
        session_start();
        $this->load->model('Board_model');
    }

    public function list($dir){
        $data2["boardShow"] = true;
        $boards_list_array = ["자유 커뮤니티", "공지사항", "신규 가입신청", "기능제안 및 오류제보"];
        $boards_list_array_en = ["community", "notice", "apply", "suggest"];
        $iserr = 0;
        $today = time();
        $yesterday = time() - 86400;
        if($dir == 'community'){
            $data1["now_dir"] = 2;
            $data1["page_title"] = $data2["page_title"] = $boards_list_array[0];
            $data1["login_fail"] = false;
            $data2["category"] = $boards_list_array_en[0];
            $data2["now_board"] = 1;
            $data2["itemsAll"] = $itemsAll = $this->Board_model->getAllItems(1);
            $commentsNumArr = array();
            $isNewArr = array();
            $commCnt = 0;
            foreach($itemsAll as $it){
                // comments
                $itemNum = $it->num;
                $commentsNum = $this->Board_model->getCommentsNum($itemNum);
                $commentsNumArr[$commCnt] = $commentsNum;
                // is new
                $writeTime = strtotime($it->writeTime);
                if($writeTime >= $yesterday && $writeTime <= $today){
                    // 최신글 맞음
                    $isNewArr[$commCnt] = 1;
                }else{
                    // 최신글 아님
                    $isNewArr[$commCnt] = 0;
                }
                $commCnt++;
            }
            $data2["commentsNumArr"] = $commentsNumArr;
            $data2["isNewArr"] = $isNewArr;
            $this->load->view('template/header', $data1);
            $this->load->view('list', $data2);
        }else if($dir == 'notice'){
            if(!isset($_SESSION["is_login"])){
                $data2["boardShow"] = false;
            }else if($_SESSION["is_login"] != true){
                $data2["boardShow"] = false;
            }
            $data1["now_dir"] = 3;
            $data1["page_title"] = $data2["page_title"] = $boards_list_array[1];
            $data1["login_fail"] = false;
            $data2["category"] = $boards_list_array_en[1];
            $data2["now_board"] = 2;
            $data2["itemsAll"] = $itemsAll = $this->Board_model->getAllItems(2);
            $commentsNumArr = array();
            $isNewArr = array();
            $commCnt = 0;
            foreach($itemsAll as $it){
                // comments
                $itemNum = $it->num;
                $commentsNum = $this->Board_model->getCommentsNum($itemNum);
                $commentsNumArr[$commCnt] = $commentsNum;
                // is new
                $writeTime = strtotime($it->writeTime);
                if($writeTime >= $yesterday && $writeTime <= $today){
                    // 최신글 맞음
                    $isNewArr[$commCnt] = 1;
                }else{
                    // 최신글 아님
                    $isNewArr[$commCnt] = 0;
                }
                $commCnt++;
            }
            $data2["commentsNumArr"] = $commentsNumArr;
            $data2["isNewArr"] = $isNewArr;
            $this->load->view('template/header', $data1);
            $this->load->view('list', $data2);
        }else if($dir == 'apply'){
            $data1["now_dir"] = 2;
            $data1["page_title"] = $data2["page_title"] = $boards_list_array[2];
            $data1["login_fail"] = false;
            $data2["category"] = $boards_list_array_en[2];
            $data2["now_board"] = 3;
            $data2["itemsAll"] = $itemsAll = $this->Board_model->getAllItems(3);
            $commentsNumArr = array();
            $isNewArr = array();
            $commCnt = 0;
            foreach($itemsAll as $it){
                // comments
                $itemNum = $it->num;
                $commentsNum = $this->Board_model->getCommentsNum($itemNum);
                $commentsNumArr[$commCnt] = $commentsNum;
                // is new
                $writeTime = strtotime($it->writeTime);
                if($writeTime >= $yesterday && $writeTime <= $today){
                    // 최신글 맞음
                    $isNewArr[$commCnt] = 1;
                }else{
                    // 최신글 아님
                    $isNewArr[$commCnt] = 0;
                }
                $commCnt++;
            }
            $data2["commentsNumArr"] = $commentsNumArr;
            $data2["isNewArr"] = $isNewArr;
            $this->load->view('template/header', $data1);
            $this->load->view('list', $data2);
        }else if($dir == 'suggest'){
            $data1["now_dir"] = 2;
            $data1["page_title"] = $data2["page_title"] = $boards_list_array[3];
            $data1["login_fail"] = false;
            $data2["category"] = $boards_list_array_en[3];
            $data2["now_board"] = 4;
            $data2["itemsAll"] = $itemsAll = $this->Board_model->getAllItems(4);
            $commentsNumArr = array();
            $isNewArr = array();
            $commCnt = 0;
            foreach($itemsAll as $it){
                // comments
                $itemNum = $it->num;
                $commentsNum = $this->Board_model->getCommentsNum($itemNum);
                $commentsNumArr[$commCnt] = $commentsNum;
                // is new
                $writeTime = strtotime($it->writeTime);
                if($writeTime >= $yesterday && $writeTime <= $today){
                    // 최신글 맞음
                    $isNewArr[$commCnt] = 1;
                }else{
                    // 최신글 아님
                    $isNewArr[$commCnt] = 0;
                }
                $commCnt++;
            }
            $data2["commentsNumArr"] = $commentsNumArr;
            $data2["isNewArr"] = $isNewArr;
            $this->load->view('template/header', $data1);
            $this->load->view('list', $data2);
        }else{
            $iserr = 1;
            $this->load->view('error');
        }
    }

    public function view($id){
        // 조회수 +1
        $this->Board_model->addViewCount($id);

        $boards_list_array = ["자유 커뮤니티", "공지사항", "신규 가입신청", "기능제안 및 오류제보"];
        $boards_list_array_en = ["community", "notice", "apply", "suggest"];
        $data["itemDetail"] = $itemDetail = $this->Board_model->getItemDetails($id);
        if($itemDetail->boardNum == 2){
            $data["now_dir"] = 3;
        }else{
            $data["now_dir"] = 2;
        }
        $data["page_title"] = $boards_list_array[$itemDetail->boardNum - 1];
        $data["category"] = $boards_list_array_en[$itemDetail->boardNum - 1];
        $data["login_fail"] = false;
        $data["now_id"] = $id;
        // comments
        $data["commentsNum"] = $this->Board_model->getCommentsNum($id);
        $data["comments"] = $this->Board_model->getComments($id);
        $this->load->view('template/header', $data);
        $this->load->view('view', $data);
}

    public function write($dir){
        $boards_list_array = ["자유 커뮤니티", "공지사항", "신규 가입신청", "기능제안 및 오류제보"];
        $boards_list_array_en = ["community", "notice", "apply", "suggest"];
        if($dir == 'community'){
            $data1["now_dir"] = 2;
            $data1["page_title"] = $boards_list_array[0];
            $data1["now_board"] = 1;
            $data1["login_fail"] = false;
            $this->load->view('template/header', $data1);
            $this->load->view('write', $data1);
        }else if($dir == 'notice'){
            if(!isset($_SESSION["is_login"])){
                header('Location: /main?login_fail=true');
            }else if($_SESSION["is_login"] != true){
                header('Location: /main?login_fail=true');
            }
            $data1["now_dir"] = 3;
            $data1["page_title"] = $boards_list_array[1];
            $data1["now_board"] = 2;
            $data1["login_fail"] = false;
            $this->load->view('template/header', $data1);
            $this->load->view('write', $data1);
        }else if($dir == 'apply'){
            $data1["now_dir"] = 2;
            $data1["page_title"] = $boards_list_array[2];
            $data1["now_board"] = 3;
            $data1["login_fail"] = false;
            $this->load->view('template/header', $data1);
            $this->load->view('write', $data1);            
        }else if($dir == 'suggest'){
            $data1["now_dir"] = 2;
            $data1["page_title"] = $boards_list_array[3];
            $data1["now_board"] = 4;
            $data1["login_fail"] = false;
            $this->load->view('template/header', $data1);
            $this->load->view('write', $data1);
        }else{
            $this->load->view('error');
        }
    }
}

/* End of file Board.php */
