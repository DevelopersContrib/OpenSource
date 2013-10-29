<? 
session_start();
include ('includes/functions.php'); 
$dir = new DIR_LIB();
include ('includes/meta_title.php'); 
?>
<?if(isset($_SESSION['userid'])){ ?>
	<script>window.location="home.html";</script>	<?
}?>
<!DOCTYPE html>
<html>
<head>
	<meta name="generator" content="HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
	<title><?=$meta_title?></title>
	<meta http-equiv="content-type" content="text/html; charset=windows-1250">
  	<meta name="generator" content="PSPad editor, www.pspad.com">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="content-language" content="en-US">
	<meta name="title" content="<?=$meta_title?>">
	<meta name="description" content="<?=$meta_desc?>">
	<meta name="keywords" content="<?=$meta_keywords?>">
	<meta name="author" content="<?=$meta_author?>">
	<link rel="canonical" href="http://<?=$domain?>" />
	<meta name="robots" content="INDEX,FOLLOW">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<? if($logo!=''){ ?>
	<meta property="og:image" content="<?=$logo?>" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:height" content="80" />
	<? } ?>
	<link rel="shortcut icon" href="http://d2qcctj8epnr7y.cloudfront.net/images/lucille/favicon-contrib.png">
	<link rel="stylesheet" href="<?=$siteurl?>/css/bootstrap.css"/>
	<link rel="stylesheet" href="<?=$siteurl?>/css/bootstrap-responsive.css"/>
	<link rel="stylesheet" href="<?=$siteurl?>/css/photochallenge-index.css"/>
	<link rel="stylesheet" href="<?=$siteurl?>/css/photochallenge-footer-links.css"/>
	<link rel="stylesheet" href="<?=$siteurl?>/css/theme-<?=$color?>.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">
	(function() {
	    if (typeof window.janrain !== 'object') window.janrain = {};
	    if (typeof window.janrain.settings !== 'object') window.janrain.settings = {};
	    
	    janrain.settings.tokenUrl = '<?=$siteurl?>/social_dashboard.php';
	
	    function isReady() { janrain.ready = true; };
	    if (document.addEventListener) {
	      document.addEventListener("DOMContentLoaded", isReady, false);
	    } else {
	      window.attachEvent('onload', isReady);
	    }
	
	    var e = document.createElement('script');
	    e.type = 'text/javascript';
	    e.id = 'janrainAuthWidget';
	
	    if (document.location.protocol === 'https:') {
	      e.src = 'https://rpxnow.com/js/lib/challenge-login/engage.js';
	    } else {
	      e.src = 'http://widget-cdn.rpxnow.com/js/lib/challenge-login/engage.js';
	    }
	
	    var s = document.getElementsByTagName('script')[0];
	    s.parentNode.insertBefore(e, s);
	})();
	</script>
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
<div class="container-fluid header-bckgrnd">
	<div class="row-fluid">
		<div class="container">
			<div class="row-fluid">
				<div class="span12">
					<div class="span4">
						<a href="<?=$siteurl?>/home.html">
							<?=($logo!='')?'<img src="'.$logo.'" style="height:62px;"  alt="'.$domain.'" class="logo-photochallenge"  />':'<h1 style="font-size: 20px;">'.ucwords($domain).'</h1>'?>
						</a>
					</div>
					<div class="span7 offset1" style="padding-top:2px;text-align:right;">
           <div class="span7 pull-right" style="padding-left:45px;">
     <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_pinterest_pinit"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-517895f814f07260"></script>
<!-- AddThis Button END -->
     </div>
          <div class="btn-group">
							<a class="btn" href="<?=$siteurl?>"><i class="icon-home"></i> Home</a>
							<a class="btn" href="<?=$siteurl?>/about.html"><i class="icon-info-sign"></i> About</a>
							<a class="btn" href="<?=$siteurl?>/contact.html"><i class="icon-envelope"></i> Contact</a>
							<a class="btn" href="<?=$siteurl?>/howtosponsor.html"><i class="icon-heart"></i> Sponsors</a>
							<a class="btn" href="<?=$siteurl?>/staffing.html"><i class="icon-user"></i> Staffing</a>
							<a class="btn" href="<?=$siteurl?>/login.html"><i class="icon-cog"></i> Login</a>
							<a class="btn btn-success" href="<?=$siteurl?>/register.html" style="color:white"><i class="icon-play icon-white"></i> Register</a>		
          </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!--header-->