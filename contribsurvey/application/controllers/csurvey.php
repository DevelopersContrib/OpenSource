<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CSurvey extends CI_Controller {
	private $param = array("key"=>"xxxx");	//Get api_key from http://www.developers.contrib.com

   function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	    $this->load->library('session');
	    $this->load->database();
	    $this->load->library('contribsurvey',$this->param);
	}
	
	public function index(){
		$ress = $this->contribsurvey->getsurveys();		// Fetch all surveys available
		$data['surveylist']= $ress;				// Sample response: [{"sid" : "08F54B", "title" : "Weight Management Survey", "template" : "AskPeopleDefault.php"}]
		$this->load->view('backend/index',$data);
	}
	
    public function getsurveys(){	
		$ress = $this->contribsurvey->getsurveys();	// Fetch all surveys available
		$data['surveylist']= $ress;			// Sample response: [{"sid" : "08F54B", "title" : "Weight Management Survey", "template" : "AskPeopleDefault.php"}]
		$this->load->view('backend/index',$data);
	}

	public function showAddSurvey(){
		$data['templates'] = $this->contribsurvey->gettemplates(); 	// Fetch all survey templates available
		$this->load->view('backend/surveycreate',$data);		// Sample response: [{"tempalte1", tempalte2", "tempalte3, "tempalte4", "tempalte5"}]
	}
	
	public function createsurvey(){
		$title = $this->db->escape_str($this->input->post('title'));		// Required parameter
		$template = $this->db->escape_str($this->input->post('template'));	// Required parameter
		
		$res = $this->contribsurvey->createsurvey($template,$title);		// Creates a new survey
		$val = $res[0];													// Sample response: [{"success" : true, "sid" : "08F54B"}]
	
		if($val->success===true){ 
			echo ':true:'.$val->sid;
		}else
			echo 'false';
	}
	
	public function editsurvey(){
		$sid = $this->db->escape_str($this->input->post('sid'));		// Required parameter
		$title = $this->db->escape_str($this->input->post('title'));		// Required parameter
		$template = $this->db->escape_str($this->input->post('template'));	// Required parameter
		if($this->contribsurvey->editsurvey($sid,$title,$template)){		// Updates survey
			echo "OK";
		}
	}
	
	public function deletesurvey(){
		$sid = $this->db->escape_str($this->input->post('sid'));	// Required parameter
		if($this->contribsurvey->deletesurvey($sid)){			// Deletes selected survey
			echo "OK";
		}
	}
	
	public function addquestionform(){
		$sid = $this->db->escape_str($this->input->post('sid'));	
		$data['sid'] = $sid;
		$this->load->view('backend/questioncreate',$data);
	}
	
	public function getquestions(){
		$sid = $this->db->escape_str($this->input->get('sid'));		// Required parameter
		$surveyquestions = $this->contribsurvey->getquestions($sid);	// Fetch all questionnaires available
		
		$data['surveyquestions'] = $surveyquestions;			// Sample response: [{"questionid" : "1", "type" : "single", "validation" : "optional", "questiontext" : "What is your favorite color?", "options" : NULL, "scale" : NULL }]
		$data['templates'] = $this->contribsurvey->gettemplates();
		$data['sid'] = $sid;
			$surveys = $this->contribsurvey->getsurveys();
			foreach($surveys AS $survey){
				if($survey->sid == $sid){
					$data['surveytitle'] = $survey->title;
					$data['template'] = $survey->template;
				}
			}
		$this->load->view('backend/surveyquestions',$data);
	}
	
	public function addquestion(){	
		$sid = $this->db->escape_str($this->input->post('sid'));		// Required parameter
		$qtype = $this->db->escape_str($this->input->post('qtype'));		// Required parameter
		$qvalid = $this->db->escape_str($this->input->post('qvalid'));		// Required parameter
		$question = $this->db->escape_str($this->input->post('question'));	// Required parameter
		$response = explode("\n",$this->input->post('options'));		// Optional parameter
		$options = "";
		foreach($response AS $r){
			$options = $options."|".$r;
		}
		if($this->contribsurvey->addquestion($sid,$qtype,$qvalid,$question,urlencode(substr($options, 1)))){ // Adds a question under a specific survey
			echo "OK";
		}
	}
	
	public function getquestiondetails(){
		$sid = $this->db->escape_str($this->input->post('sid'));		// Required parameter
		$qid = $this->db->escape_str($this->input->post('qid'));		// Required parameter
		$data['surveyquestions'] = $this->contribsurvey->getquestions($sid);	// Fetch questionnaire details
		$data['qid'] = $qid;
		$data['sid'] = $sid;
		$this->load->view('backend/questionedit',$data);
	}
	
	public function editquestion(){
		$sid = $this->db->escape_str($this->input->post('sid'));			// Required parameter
		$qid = $this->db->escape_str($this->input->post('qid'));			// Required parameter
		$question = $this->db->escape_str($this->input->post('title'));			// Required parameter
		$qvalid = $this->db->escape_str($this->input->post('validation'));		// Required parameter
		$qtype = $this->db->escape_str($this->input->post('qtype'));			// Required parameter
		
		$response = explode("\n",trim($this->input->post('responses')));		// Optional parameter
		$options = "";
		foreach($response AS $r){
			$options = $options."|".$r;
		}
		
		if($this->contribsurvey->editquestion($sid,$qid,$qtype,$qvalid,$question,urlencode(substr($options, 1)))){	// Updates questionnaire details
			echo "OK";
		}
	}
	
	public function deletequestion(){
		$sid = $this->db->escape_str($this->input->post('sid'));	// Required parameter
		$qid = $this->db->escape_str($this->input->post('qid'));	// Required parameter
	
		if($this->contribsurvey->deletequestion($sid,$qid)){		// Deletes selected questionnaire from survey
			echo "OK";
		}
	}
	
	public function getreport(){
		$sid = $this->db->escape_str($this->input->post('sid'));	// Required parameter
		$qid = "all";												// Required parameter
		$stats = $this->contribsurvey->getreport($sid,$qid);		// Fetches statistical results of a survey
		if($stats){
			$data['statistics'] = $stats;				// Sample response: [{ "questionid":"1", "questiontext":"Your favorite character", "answered":5, "total":"5", "stats":array()}]
			$this->load->view('backend/surveystatistics',$data);
		}else{
			echo "error: ".$stats;
		}
	}
	
	public function LoadSurveyList(){
		$ress = $this->contribsurvey->getsurveys();
		$data['surveylist']= $ress;
		$this->load->view('backend/surveymenu',$data);
	}
	
	public function Loadquestionlist(){
		$sid = $this->db->escape_str($this->input->post('sid'));
		$qid = $this->db->escape_str($this->input->post('qid'));
		$surveyquestions = $this->contribsurvey->getquestions($sid);
		$data['surveyquestions'] = $surveyquestions;
		$data['sid'] = $sid;
		$data['qid'] = $qid;
		$this->load->view('backend/questionmenu',$data);
	}
	
	
	
	
} //end of class
