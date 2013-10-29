<?
$file = explode("/",$_SERVER['REQUEST_URI']);
$file_page = $file[1];

$_domain = ucwords($sitename);

if (preg_match("/.html/",$_SERVER['REQUEST_URI'])) {
	
	$_page = str_replace('.html','',$file_page);
	if($_page=='howtosponsor')
		$_page = 'How to Sponsor';
	else if($_page=='services')
		$_page = 'Our Services';
	else if($_page=='terms')
		$_page = 'Terms and Conditions';
	else if($_page=='policy')
		$_page = 'Privacy Policy';
	else if($_page=='faq')
		$_page = 'Frequently Asked Questions';
	else if($_page=='browse')
		$_page = 'Browse Challenges';
	else if($_page=='sponsor')
		$_page = 'My Sponsorships';
	else if($_page=='latestapplications')
		$_page = 'Latest Challenge Applications';
	else if($_page=='badges')
		$_page = 'Challenge Badges';
		
	$meta_title = ucwords($_page).' - '.$_domain;
	$meta_desc = $meta_title.' - '.$_page.' - '.$description;
	
		
} else {
    
	$meta_keywords = $file_page;
	
	switch($file_page){

		case 'challenge':{
			
			$__slug = $file[3];

			$__page = $dir->GetInfo('Challenges','ChallengeTitle','Slug',$__slug);
		
			if($file[3] && $file[2]=='applications'){ 	//applications gallery	
				$__desc = $dir->GetInfo('Challenges','ChallengeDesc','Slug',$__slug);
				$meta_title = 'Applications Gallery : '.$__page.' - '.$_domain;
				$meta_desc = "View challenge application gallery - ".$__desc;
			}
			else if($file[3] && $file[2]=='apply'){	//application form page	
				$__desc = $dir->GetInfo('Challenges','ChallengeDesc','Slug',$__slug);
				$meta_title = 'Apply to Challenge : '.$__page.' - '.$_domain;
				$meta_desc = "Apply to this Challenge - ".$__desc;
			}
			else if($file[3] && $file[2]=='sponsor'){		
				$__desc = $dir->GetInfo('Challenges','ChallengeDesc','Slug',$__slug);
				$meta_title = 'Sponsor a Challenge : '.$__page.' - '.$_domain;
				$meta_desc = "Sponsor this Challenge - ".$__desc;
			}
			else if($file[3] && $file[2]=='edit'){		
				$__desc = $dir->GetInfo('Challenges','ChallengeDesc','Slug',$__slug);
				$meta_title = 'Edit Challenge Post : '.$__page.' - '.$_domain;
				$meta_desc = "Modifying challenge details - ".$__desc;
			}
			else{										//challenge page
				$__slug = $file[2];
				$__desc = $dir->GetInfo('Challenges','ChallengeDesc','Slug',$__slug);
				$__page = $dir->GetInfo('Challenges','ChallengeTitle','Slug',$__slug);
				$meta_title = 'Challenge : '.$__page.' - '.$_domain;
				$meta_desc = $__desc;
			}
			
			
			$__companyID = $dir->GetInfo('Challenges','CompanyId','Slug',$__slug);
			$meta_author = $dir->GetInfo('ChallengeMembers','FirstName','ChallengeMemberId',$__companyID)." ".$dir->GetInfo('ChallengeMembers','LastName','ChallengeMemberId',$__companyID);
			if($meta_author==' ')
				$meta_author = $dir->GetInfo('ChallengeMembers','Username','ChallengeMemberId',$__companyID);
				
			break;
		}
		
		case 'application':{
			$slug = $file[2];
			$_page = $dir->GetInfo('Applications','AppName','Slug',$slug);
			$meta_title = 'Application : '.$_page.' - '.$_domain;
			
			$meta_desc = $dir->GetInfo('Applications','AppDesc','Slug',$slug);
			
			$__challengeID = $dir->GetInfo('Applications','ChallengeId','Slug',$slug);
			$__companyID = $dir->GetInfo('Challenges','CompanyId','ChallengeId',$__challengeID);
			
			$meta_author = $__companyID;
			if($meta_author=='')
				$meta_author = $dir->GetInfo('ChallengeMembers','Username','ChallengeMemberId',$__companyID);
			
			break;
		}
		
		case 'user':{
			$_uname = $file[2];
			$meta_title = 'Profile : '.$_uname.' - '.$_domain;
			
			$meta_desc = $description;
			break;
		}
		
		case 'badges':
			$meta_title = $_domain.' - Challenge Badges';
			$meta_desc = $description;
		break;	
	
		default:{
			$meta_title = $_domain.' - '.$domain_title;
			$meta_desc = $description;
			break;
		}
		
	}

	
}



?>