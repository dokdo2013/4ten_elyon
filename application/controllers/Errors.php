<?

defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

    public function index()
    {
        $this->load->view('error');
    }

}

/* End of file Error.php */
