<?php
header("Content-type: text/xml");
echo'<?xml version=\'1.0\' encoding=\'UTF-8\'?>';
echo'   <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
require_once('includes/functions.php');
$dir = new DIR_LIB();
?>
<url>
       <loc><?php echo $siteurl?>/</loc>
       <lastmod>2013-09-16T07:13:36+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>1.0000</priority>
  </url>
   <url>
       <loc><?php echo $siteurl?>/home.html</loc>
       <lastmod>2013-09-16T07:13:36+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.8000</priority>
  </url>
  
  <url>
       <loc><?php echo $siteurl?>/about.html</loc>
       <lastmod>2013-09-16T07:13:36+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.8000</priority>
  </url>
  <url>
       <loc><?php echo $siteurl?>/contact.html</loc>
       <lastmod>2013-09-16T07:13:36+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.8000</priority>
  </url>
  <url>
       <loc><?php echo $siteurl?>/howtosponsor.html</loc>
       <lastmod>2013-09-16T07:13:36+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.8000</priority>
  </url>
  <url>
       <loc><?php echo $siteurl?>/staffing.html</loc>
       <lastmod>2013-09-16T07:13:36+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.8000</priority>
  </url>
  <url>
       <loc><?php echo $siteurl?>/login.html</loc>
       <lastmod>2013-09-16T07:13:36+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.8000</priority>
  </url>
  <url>
       <loc><?php echo $siteurl?>/register.html</loc>
       <lastmod>2013-09-16T07:13:36+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.8000</priority>
  </url>
  <url>
       <loc><?php echo $siteurl?>/browse.html</loc>
       <lastmod>2013-09-16T07:13:36+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.8000</priority>
  </url>
  
<?php 

 $browsearray = $dir->BrowseChallenges($categoryid,null,$sitename);
 for($i=0; $i < sizeof($browsearray) ; $i++){ 
 	 $__slug  = $browsearray[$i]['Slug'];
?>
            <url>
                <loc><?php echo $siteurl?>/challenge/<?echo $__slug?></loc>
                <changefreq>weekly</changefreq>
            </url>
<?}?> 
</urlset>
