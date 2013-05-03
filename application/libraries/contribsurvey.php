<?php
class ContribSurvey {
	private $api_url = "http://www.surveycontrib.applications.net/survey/api.php";
	private $api_key;
	
	 function __construct($param) {
	 	  $this->api_key = $param['key'];
	 }
	 
     private function getresult($url){
	 	$result = file_get_contents($url);
	 	return $result;
	 }
	 
	 function authenticate(){
	 	 if ($this->checkexist()===false){
	 	 	 if ($this->adduser()===true){
	 	 	 	return true;
	 	 	 }else {
	 	 	 	return false;
	 	 	 }
	 	 }else {
	 	 	return true;
	 	 }
	 }
	 
	  function adduser(){
	 	$url = $this->api_url."?request=adduser&api_key=".$this->api_key;
	 	$result = $this->getresult($url);
	 	$res = json_decode($result);
	 	return $res[0]->success;
	 }
	 
	  function checkexist(){
	 	$url = $this->api_url."?request=checkexist&api_key=".$this->api_key;
	 	$result = $this->getresult($url);
	 	$res = json_decode($result);
	 	return $res[0]->exist;
	 }
	 
	  function gettemplates(){
	 	$url = $this->api_url."?request=gettemplates&api_key=".$this->api_key;
	 	$result = $this->getresult($url);
	 	$res = json_decode($result);
	 	return $res;
	 }
	 
	  function getqtypes(){
	 	$url = $this->api_url."?request=getqtypes&api_key=".$this->api_key;
	 	$result = $this->getresult($url);
	 	$res = json_decode($result);
	 	return $res;
	 }
	 
	  function createsurvey($template,$title){
	 	$url = $this->api_url."?request=createsurvey&api_key=".$this->api_key."&template=".urlencode($template)."&title=".urlencode($title);
	 	$result = $this->getresult($url);
	 	$res = json_decode($result);
	 	return $res[0]->success;
	 }
	 
	  function getsurveys(){
	 	$url = $this->api_url."?request=getsurveys&api_key=".$this->api_key;
	 	$result = $this->getresult($url);
	 	$res = json_decode($result);
	 	return $res;
	 }
	 
	  function addquestion($sid,$qtype,$qvalid,$question,$options){
	 	$url = $this->api_url."?request=addquestion&api_key=".$this->api_key."&sid=".$sid."&qtype=".$qtype."&qvalid=".$qvalid."&question=".urlencode($question)."&options=".$options;
	 	$result = $this->getresult($url);
	 	$res = json_decode($result);
	 	return $res[0]->success;
	 }
	 
	  function getquestions($sid){
	 	$url = $this->api_url."?request=getquestions&api_key=".$this->api_key."&sid=".$sid;
	 	$result = $this->getresult($url);
	 	$res = json_decode($result);
	 	return $res;	 	
	 }
	 
	  function editsurvey($sid,$title){
	 	$url = $this->api_url."?request=editsurvey&api_key=".$this->api_key."&sid=".$sid."&title=".urlencode($title);
	 	$result = $this->getresult($url);
	 	$res = json_decode($result);
	 	return $res[0]->success;
	 }
	 
     function editquestion($sid,$qid,$qtype,$qvalid,$question,$options){
	 	$url = $this->api_url."?request=editquestion&api_key=".$this->api_key."&sid=".$sid."&qid=".$qid."&qtype=".$qtype."&qvalid=".$qvalid."&question=".urlencode($question)."&options=".$options;
	 	$result = $this->getresult($url);
	 	$res = json_decode($result);
	 	return $res[0]->success;
	 }
	 
	 function deletequestion($sid,$qid){
		$url = $this->api_url."?request=deletequestion&api_key=".$this->api_key."&sid=".$sid."&qid=".$qid;
	 	$result = $this->getresult($url);
	 	$res = json_decode($result);
	 	return $res[0]->success;
	} 
	
     function deletesurvey($sid){
		$url = $this->api_url."?request=deletesurvey&api_key=".$this->api_key."&sid=".$sid;
	 	$result = $this->getresult($url);
	 	$res = json_decode($result);
	 	return $res[0]->success;
	}
	
	 function getreport($sid,$qid="all"){
	 	$url = $this->api_url."?request=getreport&api_key=".$this->api_key."&sid=".$sid."&qid=".$qid;
	 	$result = $this->getresult($url);
	 	$res = json_decode($result);
	 	return $res;
	 }
	 
	 
}
?>