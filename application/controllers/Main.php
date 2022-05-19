<?

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //header("Pragma: no-cache");   
        //header("Cache-Control: no-cache,must-revalidate");   
        session_start();
    }
    
    public function index()
    {
        if(!isset($_SESSION["is_login"])){
            $_SESSION["is_login"] = false;
        }
        $data1["login_fail"] = 0;
        if(isset($_GET["login_fail"])){
            if($_GET["login_fail"] == 'true'){
                $data1["login_fail"] = 1;
            }
        }
        $this->load->model('Members');
        $data1["now_dir"] = 1;
        $data1["page_title"] = '메인';
        $data2["memberJson"] = $this->Members->getMembersJson();
        $data2["memberNumAll"] = $this->Members->getMemberNumAll();
        $jobs = $data2["memberNumJob"] = $this->Members->getMemberNumByJob();
        $jobs_max = max($jobs);
        $jobs_biggest = [];
        $jobs_name = ['엘리멘탈리스트', '미스틱', '워로드', '어쌔신', '거너'];
        for($i=0;$i<5;$i++){
            if($jobs[$i] == $jobs_max){
                array_push($jobs_biggest, $jobs_name[$i]);
            }
        }
        $jobs_biggest_cnt = count($jobs_biggest);
        if($jobs_biggest_cnt == 1){
            $jobs_string = $jobs_biggest[0];
        }else if($jobs_biggest_cnt == 2){
            $jobs_string = $jobs_biggest[0] . ", " . $jobs_biggest[1];
        }else{
            $jobs_string = $jobs_biggest[0] . ", " . $jobs_biggest[1] . ", ...";
        }
        $data2["jobsBig"] = $jobs_string;
        $this->load->view('template/header.php', $data1);
        $this->load->view('main.php', $data2);
    }

}

/* End of file Main.php */
