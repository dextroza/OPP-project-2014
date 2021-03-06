<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Home extends CI_Controller {
    private $dataHome = array();  
    private $information = array();
    //novo
    function __construct()
    {
        parent::__construct();
        $this->load->model('data','',TRUE);
        $this->load->database(); 
        $this->data->newDay();
       
        $this->session->sess_destroy();
        //setcookie( config_item('sess_cookie_name'), '', time() - 3600 );
        
      
        
    }
    //kraj novog

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/home
	 *	- or -  
	 * 		http://example.com/index.php/home/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/home/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
         
//            provjera djelatnika
//           for($index = 75; $index <= 75 ; $index++ ){
//               $this->db->query("INSERT INTO tiket(poslodavac, oznaka, rednibroj, vrijemecekanja,"
//                       . " vrijemestvaranja, vrijemeposluz, ocekvrdolaska) SELECT poslodavac, oznaka,"
//                       . " rednibroj, vrijemecekanja, DATE_ADD(vrijemestvaranja, INTERVAL $index DAY),"
//                       . " DATE_ADD(vrijemeposluz, INTERVAL $index DAY), "
//                       . "DATE_ADD(ocekvrdolaska, INTERVAL $index DAY) FROM tiket LIMIT 51
//                                ");
//           }
//           die();
            $repeatSignal = false;
            if ($this->input->post("repeat")){
                $repeatSignal = true;
            }
            
            $this->load->helper(array('form'));
            $loginView = $this->load->view("components/login_view", array(),true);
           
            $this->dataHome["loginView"] = $loginView;
            
            //dohvaćamo opcije iz baze
            $dataOption = $this->data->getAllOptions();
            
            
            $optionsView = $this->load->view('components/choose_option', $dataOption, true);
            
            
//            $optionsView = $this->data->getOptions();
            $this->dataHome["options"] = $optionsView;
            
           
//
            $this->information = $this->data->getConfig();
            
            $this->dataHome = $this->data->whatToShow($this->dataHome, array("information" =>$this->information,
                                                                                 "repeat" => $repeatSignal)); 
            
           
            $home = $this->load->view('home', $this->dataHome, true);
            $data = array();
            $data["body"] = $home;
            $this->load->view('templates/main', $data);
        }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */