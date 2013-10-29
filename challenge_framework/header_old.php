<? 
session_start();
include ('includes/functions.php'); 
$dir = new DIR_LIB();

include ('includes/meta_title.php'); 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
<meta name="generator" content="HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
<title><?=$meta_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="content-language" content="en-US">
<meta name="title" content="<?=$meta_title?>">
<meta name="description" content="<?=$meta_desc?>">
<meta name="keywords" content="<?=$meta_keywords?>">
<meta name="author" content="<?=$meta_author?>">
<meta name="robots" content="INDEX,FOLLOW">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<? if($logo!=''){ ?>
<meta property="og:image" content="<?=$logo?>" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:height" content="80" />
<? } ?>
<link rel="shortcut icon" href="http://d2qcctj8epnr7y.cloudfront.net/images/lucille/favicon-contrib.png">
<link rel="stylesheet" href="<?=$siteurl?>/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=$siteurl?>/css/bootstrap.css"/>
<link rel="stylesheet" href="<?=$siteurl?>/css/custom.css"/>
<link rel="stylesheet" href="<?=$siteurl?>/css/theme-<?=$color?>.css"/>
<link rel="stylesheet" href="<?=$siteurl?>/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=$siteurl?>/css/mobile.css" type="text/css" media="handheld" />
<link rel="stylesheet" href="<?=$siteurl?>/css/bootstrap-responsive.css"/>
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">-->
<link rel="stylesheet" href="<?=$siteurl?>/css/jquery.fileupload-ui.css">
<noscript><link rel="stylesheet" href="<?=$siteurl?>/jquery.fileupload-ui-noscript.css"></noscript>
<!--[if ie 6]>
<link rel="stylesheet" href="css/ie6.css" type="text/css" media="screen" />
<script type="text/javascript" src="css/ie6/iepngfix_tilebg.js"></script>  
<![endif]-->

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?=$account_ga?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

<?=$header_script?>

</head>
<body>

<div id="wrap" class="colortheme">
<div id="header-wrap">
    <div id="header-wrapper">
    
    <div id="header-inner">
		
						
			
			<? if(!isset($_SESSION['Username'])){ ?>
		<a href="<?=$siteurl?>" class="logo" title="<?=$domain?>"><?=($logo!='')?'<img src="'.$logo.'" style="height:50px;"  alt="'.$domain.'"  />':'<h1 style="font-size: 20px;">'.ucwords($domain).'</h1>'?></a>
		<div class="head-right">
    <div class="span8">
        <div class="btn-group pull-left">
      
					<a class="btn" href="http://photochallenge.com/browse.html"><i class="icon-home"></i>Browse Challenges</a>
							<a class="btn" href="http://photochallenge.com/howtosponsor.html"><i class="icon-heart"></i>Sponsor Challenges</a>
         </div>
         <div class="btn-group pull-right">     
							<a class="btn" href="http://photochallenge.com/login.html"><i class="icon-cog"></i>Login</a>
							<a class="btn btn-success" href="http://photochallenge.com/register.html" style="color:white"><i class="icon-play"></i>Sign Up</a>
				</div>		
      </div>
			
			<? } else { ?>
		<!-- IF LOGGED IN -->
		<a href="<?=$siteurl?>/home.html" class="logo" title="<?=$domain?>"><?=($logo!='')?'<img src="'.$logo.'" style="height: 50px;"  alt="'.$domain.'" />':'<h1 style="font-size: 20px;">'.ucwords($domain).'</h1>'?></a>
			<div class="head-right">			
				
			<ul class="top-menu" style="margin-left:50px">
      
				<li>
					<div id="menu-username">
						<?
						$header_avatar = $dir->GetUserInfo('Photo',$_SESSION['ChallengeMemberId']);
						if($header_avatar == ""){
							$header_avatar = 'http://webpoints.com/images/avatar-linked.png';
						}?>
						<span><img src="<?=$header_avatar?>" alt="<?=$_SESSION['Username']?>" ></span>
						<span style="color:#0f5c92;"><?=$_SESSION['Username']?></span>
						<i class="icon-chevron-down" style="margin-left: 5px;"></i>
					</div>
					<ul id="menu-username-hover" >
						<li><a href="<?=$siteurl?>/user/<?=$_SESSION['Username']?>"><span class="icon-briefcase"></span>&nbsp; Profile</a></li>
						<li><a href="<?=$siteurl?>/settings.html"><span class="icon-wrench"></span>&nbsp; Settings</a></li>
						<li><a href="<?=$siteurl?>/logout.html"><span class="icon-off"></span>&nbsp; Logout</a></li>
					</ul>
				</li>
			</ul>
		
			<script>
				$(function(){
					$("#menu-username").click(function(){
						$('#menu-username-hover').toggle();
					});
				});
			</script>

			<? } ?>
			
		</div><!--head-right -->
    </div><!--header-inner -->
    
    </div><!--header -->
</div><!--header-wrap -->  



