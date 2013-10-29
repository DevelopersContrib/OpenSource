<?
$api_url = "http://www.contrib.com/api/";
$monetize_url = "http://manage.vnoc.com/monetize/getcode";


require('curl_client.php');
$max_redirect = 3;  // Skipable: default => 3
$client = new Curl_Client(array(

	CURLOPT_FRESH_CONNECT => 1,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_USERAGENT => ''

), $max_redirect);




$sitename =  $_SERVER["HTTP_HOST"]."".$_SERVER['REQUEST_URI'];

if(stristr($sitename, '~') ===FALSE) {
	$sitename = $_SERVER["HTTP_HOST"];								
	$sitename = str_replace("http://","",$sitename);
	$sitename = str_replace("www.","",$sitename);	
	$siteurl = 'http://'.$sitename;
}else {
   $key = md5('vnoc.com');
   $d = explode('~',$sitename);
   $user = str_replace('/','',$d[1]);
   $url = $api_url.'getdomainbyusername?username='.$user.'&key='.$key;
   $client->get($url);
   $result = $client->currentResponse('body');
   $data_domain = json_decode($result,true);
   $error = 0;
   $sitename =   $data_domain[0]['domain'];
   $siteurl = 'http://'.$_SERVER["HTTP_HOST"]."".$_SERVER['REQUEST_URI'];
	
}



$domain = $sitename;

$domainUrl = "http://".$sitename;
$key = md5($domain);




$url = $api_url.'getdomaininfo?domain='.$domain.'&key='.$key;
$client->get($url);
$result = $client->currentResponse('body');
$domain_info = json_decode($result,true);
$error = 0;
if (!$domain_info['error']){

	$logo = $domain_info[0]['Logo'];
	$domain_title = $domain_info[0]['Title'];
	$description = stripslashes($domain_info[0]['Description']);
	$keywords = $domain_info[0]['Keywords'];
	$domainid = $domain_info[0]['DomainId'];
	$account_ga = $domain_info[0]['AccountGA'];
	//$domainname = $domain_title; 
	
	$client2 = new Curl_Client(array(

				CURLOPT_FRESH_CONNECT => 1,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_USERAGENT => ''

			), $max_redirect);
			
			$url2 = $api_url.'getchallengeinfo?domainid='.$domainid.'&key='.$key;
			$client2->get($url2);
			$result2 = $client2->currentResponse('body');
			$challenge_info = json_decode($result2,true);
			
			if(!$challenge_info['error']){
				$domain_id = $challenge_info[0]['ChallengeKey'];
				$earthchaId = $domain_id;

				$intro_title =  stripslashes($challenge_info[0]['IntroTitle']);
				$small_description =  stripslashes($challenge_info[0]['Introduction']);
				$desc_graphic =  $challenge_info[0]['Desc_Graphics'];
				$categoryid = $challenge_info[0]['CategoryId'];
				$color = $challenge_info[0]['TemplateColor'];
				$header_script = html_entity_decode(base64_decode($challenge_info[0]['HeaderScript']));
				$custom_html = html_entity_decode(base64_decode($challenge_info[0]['CustomHtml']));
				$social_login = $challenge_info[0]['UseSocialLogin'];
				
				if($color=='') $color='lightblue';
				
				/*get related challenges*/
				$client3 = new Curl_Client(array(

					CURLOPT_FRESH_CONNECT => 1,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_USERAGENT => ''

				), $max_redirect);
				
				$limit = 4;
				$url3 = $api_url.'getRelatedChallenges?domainid='.$domainid.'&key='.$key.'&count='.$limit.'&categoryid='.$categoryid;
				$client3->get($url3);
				$result3 = $client3->currentResponse('body');
				$related_sites = json_decode($result3,true);
									
					if(!$related_sites['error']){
						$counter = 0;
						while($counter < $limit){
							$related_sites_list[$counter]['name'] = $related_sites[$counter]['DomainName'];
							$related_sites_list[$counter]['id'] = $related_sites[$counter]['DomainId'];
							$related_sites_list[$counter]['logo'] = $related_sites[$counter]['Logo'];
							$counter++;
						}
					}
				
			
			}
	
	
}else{
	echo "error";
}

if ($account_ga==""){
	$account_ga = "UA-00000000-00";
}
//get monetize banner
$url = $monetize_url.'?d='.$domain.'&p=footer';
$client->get($url);
$result = $client->currentResponse('body');
$data_ads = json_decode($result,true);
$footer_banner = html_entity_decode(base64_decode($data_ads[0]['code']));

$host = "mychallenge.com";
$user = "mychalle_maida";
$pwd = "bing2k";
$db = "mychalle_challenge";

$link = mysql_connect($host, $user,$pwd);
if (!$link) {
	echo "Error establishing connection.";
}
$db_selected = mysql_select_db($db, $link);


/**
	generate robots.txt if not exist
**/
$filename = '/robots.txt';
if(!(file_exists($filename))) {
    $my_file = 'robots.txt';
	$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
	$data = '---BEGIN ROBOTS.TXT ---
User-Agent: *
Disallow:

Sitemap: http://'.$domain.'/sitemap.html
--- END ROBOTS.TXT ----';
	fwrite($handle, $data);
}

?>