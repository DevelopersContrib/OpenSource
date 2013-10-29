<?php
	class EmailTemplate{
		function get($logo,$domain,$message,$fb_page='http://www.facebook.com/pages/DomainDirectory/192664094090593',$twitter_page='http://twitter.com/#!/domaindirectory')
		{
			/*header caption*/
			 $header_caption = 'is a member of <a href="http://domaindirectory.com" style="color: #00ffff; text-decoration: none;">DomainDirectory.com</a> and a venture of <a href="http://globalventures.com" style="color: #00ffff; text-decoration: none;">GlobalVentures.com</a>';
			 if($domain == 'entrepreneurs.org'){ $header_caption = 'is a proud member of <a href="http://globalventures.com" style="color: #00ffff; text-decoration: none;"> Global Ventures </a> charity program.';}
			$logo = '<img src="'.$logo.'" alt="'.$domain.'" style="width:350px;height:70px"/>';
			
			  
			 // $tpl = file_get_contents('/home/domaindi/public_html/includes/email_html.html');
			  $tpl = file_get_contents('email_template2.html');
			  $tpl = str_replace('{{message}}', $message, $tpl);
			  $tpl = str_replace('{{domain}}', $domain, $tpl);
			  $tpl = str_replace('{{logo}}', $logo, $tpl);
			  $tpl = str_replace('{{fb_page}}', $fb_page, $tpl);
			  $tpl = str_replace('{{twitter_page}}', $twitter_page, $tpl);
			  $tpl = str_replace('{{date_today}}', date("F d, Y"), $tpl);
			  $tpl = str_replace('{{header_caption}}', $header_caption, $tpl);
			  return $tpl;
		}
		
	}//emailtemplate

?>