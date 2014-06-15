<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta content="text/html; charset=windows-1251" http-equiv="Content-Type">
<title>News</title>
<style type="text/css">@import "blocks/style.css";</style>
<link rel="alternate" type="application/rss+xml" title="Griever's RSS" href="../rss">
</head>
<body>
<pre>             </pre><img src="../Head.png" alt="Logo">
<table cellpadding="3" cellspacing="3"><tr> 
<td class="c"><a href="/" target="_parent"><b>NEWS</b></a></td>
<td class="c"><a href="/doc" target="_parent">TUTORiALS</a></td>
<td class="c"><a href="/passgen" target="_parent">PASSGENS</a></td>
<td class="c"><a href="/old" target="_parent">OLD PAGES</a></td>
<td class="c"><a href="/captcha/feedback.php" target="_parent">FEEDBACK</a></td>
<td class="c"><a href="http://MagicTeam.net" target="_blank">MAGiC TEAM</a></td>
</tr></table>
<hr noshade>
<?php

if (!empty($_SERVER['QUERY_STRING'])) 
{
	echo "Item does not exist.";
	exit;
}

$filelist = scandir(getcwd(), 1);//выводим все текстовые файлы после враппинга
foreach ($filelist as $i) 
{
	if (end(explode(".", $i)) == "txt")
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
if ($filecount == 0)
{
	echo "Item does not exist.";
}
include("blocks/counter.php");
?>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="/files/valid_css.png" alt="Valid CSS" border="0" align="right"></a><a href="http://validator.w3.org/check?uri=referer"><img src="/files/valid_html.png" alt="Valid HTML" border="0" align="right"></a><a href="http://www.petergreen.ru/stop-using-ie/" target="_blank" title="Looks fine in all but IE"><img src="http://petergreen.ru/images/stop-ie-icon.png" alt="Stop IE" align="right"></a><a href="https://github.com/Grivr" title="Me at GitHub"><img src="/files/github.png" alt="github" border="0" align="right"></a>
</body>
</html>

