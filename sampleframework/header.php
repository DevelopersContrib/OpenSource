<? include('includes/config.php');?>
<?
$php_self = str_replace('/sampleframework','',$_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?=$title?></title> <!--TITLE VALUE FETCHED AT CONFIG.PHP-->
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />	
	<!--[if lte IE 7]>
		<link rel="stylesheet" href="css/ie.css" type="text/css" charset="utf-8" />	
	<![endif]-->
</head>
<body>
	<div id="header">
		<a href="index.php" id="logo" style="padding: 0 0 10px 20px;"><?=$logo?></a> <!--LOGO VALUE FETCHED AT CONFIG.PHP-->
		<div style="color:white;padding: 0 0 10px 20px;"><?=$description?></div> 	<!--DESCRIPTION VALUE FETCHED AT CONFIG.PHP-->
		<div id="navigation">
			<ul>
				<li class="menu first <?=$php_self=='/index.php'?'selected':''?>"><a href="index.php">Home</a></li>
				<li class="menu <?=$php_self=='/about.php'?'selected':''?>"><a href="about.php">About us</a></li>
				<li class="menu <?=$php_self=='/blog.php'?'selected':''?>"><a href="blog.php">Blog</a></li>
			</ul>
		</div>
		<div id="search">
			<form action="" method="">
				<input type="text" value="Search" class="txtfield" onblur="javascript:if(this.value==''){this.value=this.defaultValue;}" onfocus="javascript:if(this.value==this.defaultValue){this.value='';}" />
				<input type="submit" value="" class="button" />
			</form>
		</div>
	</div> <!-- /#header -->
	