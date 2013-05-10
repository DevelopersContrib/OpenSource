<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CSurvey extends CI_Controller {
	private $param = array("key"=>"a088239f8263dc8f");

   function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	    $this->load->library('session');
	    $this->load->database();
	    $this->load->library('contribsurvey',$this->param);
	}
	
	public function index()
	{
		//$ress = $this->contribsurvey->getsurveys();
		//var_dump($ress);
		$ress = $this->contribsurvey->getsurveys();
		$data['surveylist']= $ress;
		$this->load->view('surveylist',$data);
	
	}
	
	public function gettemplates(){
		$ress = $this->contribsurvey->gettemplates();
		var_dump($ress);
	}
	
    public function getsurveys(){
		$ress = $this->contribsurvey->getsurveys();
		$data['surveylist']= $ress;
		$this->load->view('surveylist',$data);
	}
	
	public function addquestion(){
		
		$sid = $this->db->escape_str($this->input->post('sid'));
		$qtype = $this->db->escape_str($this->input->post('qtype'));
		$qvalid = $this->db->escape_str($this->input->post('qvalid'));
		$question = $this->db->escape_str($this->input->post('question'));
		$response = explode("\n",$this->input->post('options'));
		$options = "";
		foreach($response AS $r){
			$options = $options."|".$r;
		}
		
		
		if($this->contribsurvey->addquestion($sid,$qtype,$qvalid,$question,urlencode(substr($options, 1)))){
			echo "OK";
		}
		
	}
	
	public function createsurvey(){ //ADD TO ORIGINAL CONTROLLER
		
		$title = $this->db->escape_str($this->input->post('title'));
		$template = $this->db->escape_str($this->input->post('template'));
		$res = $this->contribsurvey->createsurvey($template,$title);
		$val = $res[0];
	
		if($val->success===true){ 
			echo ':true:'.$val->sid;
		}else
			echo 'false';

	}
	
	public function getquestions(){
		$sid = $this->db->escape_str($this->input->get('sid'));
		$surveyquestions = $this->contribsurvey->getquestions($sid);
		
		$data['surveyquestions'] = $surveyquestions;
		$data['templates'] = $this->contribsurvey->gettemplates();
		$data['sid'] = $sid;
			$surveys = $this->contribsurvey->getsurveys();
			foreach($surveys AS $survey){
				if($survey->sid == $sid){
					$data['surveytitle'] = $survey->title;
					$data['template'] = $survey->template;
				}
			}
		$this->load->view('surveyquestions',$data);
	}
	
	public function editsurvey(){
		//$sid = "886598";
		//$title = "People Color Favorites Updated";
		$sid = $this->db->escape_str($this->input->post('sid'));
		$title = $this->db->escape_str($this->input->post('title'));
		$template = $this->db->escape_str($this->input->post('template'));
		if($this->contribsurvey->editsurvey($sid,$title,$template)){
			echo "OK";
		}
	}
	
    public function editquestion(){
		$sid = $this->db->escape_str($this->input->post('sid'));
		$qid = $this->db->escape_str($this->input->post('qid'));
		$question = $this->db->escape_str($this->input->post('title'));
		$qvalid = $this->db->escape_str($this->input->post('validation'));
		$qtype = $this->db->escape_str($this->input->post('qtype'));
		
		$response = explode("\n",trim($this->input->post('responses')));
		$options = "";
		foreach($response AS $r){
			$options = $options."|".$r;
		}
		
		if($this->contribsurvey->editquestion($sid,$qid,$qtype,$qvalid,$question,urlencode(substr($options, 1)))){
			echo "OK";
		}
		
		//echo $responses;
	}
	
	public function deletequestion(){
		$sid = $this->db->escape_str($this->input->post('sid'));
		$qid = $this->db->escape_str($this->input->post('qid'));
	
		if($this->contribsurvey->deletequestion($sid,$qid)){
			echo "OK";
		}
	}
	
	public function deletesurvey(){
		$sid = $this->db->escape_str($this->input->post('sid'));
		if($this->contribsurvey->deletesurvey($sid)){
			echo "OK";
		}
	}
	
	public function getreport(){
		//$sid = "886598";
		$sid = $this->db->escape_str($this->input->post('sid'));
		$qid = "all";
		$stats = $this->contribsurvey->getreport($sid,$qid);
		if($stats){
			$data['statistics'] = $stats;
			$this->load->view('loadStatistics',$data);
		}else{
			echo "error: ".$stats;
		}
	}
	
	public function getquestiondetails(){
		$sid = $this->db->escape_str($this->input->post('sid'));
		$qid = $this->db->escape_str($this->input->post('qid'));
		$data['surveyquestions'] = $this->contribsurvey->getquestions($sid);
		$data['qid'] = $qid;
		$data['sid'] = $sid;
		$this->load->view('editquestion',$data);
	}
	
	public function showAddSurvey(){
		$data['templates'] = $this->contribsurvey->gettemplates();
		$this->load->view('createsurvey',$data);
	}
	
	public function addquestionform(){
		$sid = $this->db->escape_str($this->input->post('sid'));
		$data['sid'] = $sid;
		$this->load->view('createquestion',$data);
	
	}
	
	public function Loadquestionlist(){
		$sid = $this->db->escape_str($this->input->post('sid'));
		$surveyquestions = $this->contribsurvey->getquestions($sid);
		$data['surveyquestions'] = $surveyquestions;
		$data['sid'] = $sid;
		$this->load->view('questionlist',$data);
	}
	
	public function LoadSurveyList(){
		$ress = $this->contribsurvey->getsurveys();
		$data['surveylist']= $ress;
		$this->load->view('loadsurveylist',$data);
	}
	
} //end of class