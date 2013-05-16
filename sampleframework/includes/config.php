<?php
$domain = $_SERVER["HTTP_HOST"];
$domain = str_replace("http://","",$domain); //get domain name without http://
$domain = str_replace("www.","",$domain); //get domain name without www.

$api_url = "http://developers.contrib.com/api/";
$api_key = 'CHANGE_API_KEY'; //replace with your Developer Key found in Account Settings


require('curl_client.php');
$max_redirect = 3;  // Skipable: default => 3
$client = new Curl_Client(array(
	CURLOPT_FRESH_CONNECT => 1,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_USERAGENT => ''
), $max_redirect);

/* API CALL - TO GET DOMAIN DETAILS*/
$url = $api_url."getdomaindetails?api_key=$api_key&domain=$domain"; 
$client->get($url);
$result = $client->currentResponse('body');
$data_domain = json_decode($result,true); //FETCHED JSON RESULT
$error = 0;

if (!$data_domain['error'])
{
	$FrameworkTypeId = $data_domain[0]['FrameworkTypeId']; //---------> get framework_id of domain to be used for api call
	$DomainId = $data_domain[0]['DomainId'];				//--------> get domain_id to be used for api call
	
	/* API CALL - TO GET FRAMEWORK ATTRIBUTES*/
	$url = $api_url."getattributes?api_key=$api_key&framework_id=$FrameworkTypeId"; 
	$client->get($url);
	$result = $client->currentResponse('body');
	$data_attributes = json_decode($result,true); //FETCHED JSON RESULT

	if (!$data_attributes['error'])
	{	
		$logo = ''; 				//initialize variable 
		$description = ''; 			//initialize variable
		$title = '';				//initialize variable
			
		foreach($data_attributes as $data){
			$attribute_id = $data['attribute_id'];	//--------> get attribute_id to be used for api call
			
			/* API CALL - TO GET ATTRIBUTE VALUES*/
			$url = $api_url."getattributevalue?api_key=$api_key&attribute_id=$attribute_id&domain_id=$DomainId"; 
			$client->get($url);
			$result = $client->currentResponse('body');
			$data_attributevalue = json_decode($result,true); //FETCHED JSON RESULT
						
			if (!$data_attributevalue['error'])
			{
				if($attribute_id=='45') 
					$logo = $data_attributevalue[0]['value'];	//--------> get logo value
					
				if($attribute_id=='46') 
					$description = $data_attributevalue[0]['value'];	//--------> get description value
					
				if($attribute_id=='44') 
					$title = $data_attributevalue[0]['value'];	//--------> get title value

			}
			else{
				$error++;
			}
		}
		
		if($logo!='')
			$logo = '<img src="'.$logo.'" alt="LOGO" style="height: 70px;" />';
		else
			$logo = '<span class="title">'.$title.'</span>';
	}
	else{
		$error++;
	}
}
else{
	$error++;
}

if($error>0){ echo 'errors : '.$error; EXIT; } //PRINTS ERROR THEN EXITS

/*

CONNECT TO YOUR DATABASE

$host = "CHANGE_HOSTNAME";
$user = "CHANGE_USERNAME";
$pwd = "CHANGE_PASSWORD";
$db = "CHANGE_DATABASE";

$link = mysql_connect($host, $user,$pwd);

if (!$link) {
	echo "Error establishing connection.";
}
$db_selected = mysql_select_db($db, $link);

*/


?>