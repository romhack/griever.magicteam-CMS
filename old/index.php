<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta content="text/html; charset=windows-1251" http-equiv="Content-Type">
<title>Old news</title>
<style type="text/css">@import "../blocks/style.css";</style>
<link rel="alternate" type="application/rss+xml" title="Griever's RSS" href="../rss">
</head>
<body>
<pre>             </pre><img src="../Head.png" alt="Logo">
<table cellpadding="3" cellspacing="3"><tr> 
<td class="c"><a href="/" target="_parent">NEWS</a></td>
<td class="c"><a href="/doc" target="_parent">TUTORiALS</a></td>
<td class="c"><a href="/passgen" target="_parent">PASSGENS</a></td>
<td class="c"><a href="/old" target="_parent"><b>OLD PAGES</b></a></td>
<td class="c"><a href="/captcha/feedback.php" target="_parent">FEEDBACK</a></td>
<td class="c"><a href="http://MagicTeam.net" target="_blank">MAGiC TEAM</a></td>
</tr></table>
<table cellpadding="3" cellspacing="3" align="right">
<tr> 
<td class="d"><a href="/old?year=2006" target="_parent">2oo6</a></td>
<td class="d"><a href="/old?year=2007" target="_parent">2oo7</a></td>
<td class="d"><a href="/old?year=2008" target="_parent">2oo8</a></td>
<td class="d"><a href="/old?year=2009" target="_parent">2oo9</a></td>
<td class="d"><a href="/old?year=2010" target="_parent">2o1o</a></td>
</tr>
</table>
<hr noshade>
<?php 

if (empty($_SERVER['QUERY_STRING'])) 
{
	$year="ALL";//Если не передано, это индекс 
} 
else 
{ 
	$year = $_GET['year'];
}

$filelist = scandir(getcwd(), 1);

foreach ($filelist as $i) 
{
	if (end(explode(".", $i)) == "txt")
	{
		list($fileyear, $ext) = explode(".", $i);
		if ($year == $fileyear || $year == "ALL")
		{
			$filename=getcwd()."/".$i; 
			$stringfile=""; 
			$file = fopen($filename, "r"); 
			while(!feof($file)) 
			{//читаем файл в строку 
				$stringfile = $stringfile . fgets($file, 4096);  
			} 
			fclose ($file); 
			echo preg_replace("/\r\n|\n|\r/", "<br>", $stringfile)."<hr>";
			$filecount++;   
		}
	}
}
if ($filecount == 0)
{
	echo "Item does not exist.";
}
?>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="/files/valid_css.png" alt="Valid CSS" border="0" align="right"></a><a href="http://validator.w3.org/check?uri=referer"><img src="/files/valid_html.png" alt="Valid HTML" border="0" align="right"></a>
</body>
</html>