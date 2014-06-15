<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta content="text/html; charset=windows-1251" http-equiv="Content-Type">
<title>Password generators</title>
<style type="text/css">@import "../blocks/style.css";</style>
<link rel="alternate" type="application/rss+xml" title="Griever's RSS" href="../rss">
</head>
<body>
<pre>             </pre><img src="../Head.png" alt="Logo">
<table cellpadding="3" cellspacing="3"><tr> 
<td class="c"><a href="/" target="_parent">NEWS</a></td>
<td class="c"><a href="/doc" target="_parent">TUTORiALS</a></td>
<td class="c"><a href="/passgen" target="_parent"><b>PASSGENS</b></a></td>
<td class="c"><a href="/old" target="_parent">OLD PAGES</a></td>
<td class="c"><a href="/captcha/feedback.php" target="_parent">FEEDBACK</a></td>
<td class="c"><a href="http://MagicTeam.net" target="_blank">MAGiC TEAM</a></td>
</tr></table>
<table cellpadding="3" cellspacing="3" align="right">
<tr> 
<td class="d"><a href="/passgen?platform=NES" target="_parent">NES</a></td>
<td class="d"><a href="/passgen?platform=SEGA" target="_parent">SEGA</a></td>
</tr>
</table>
<hr noshade>
<?php 

if (empty($_SERVER['QUERY_STRING'])) 
{
	$platform="ALL";//Если не передано, это индекс 
} 
else 
{ 
	$platform = $_GET['platform'];
}

$filelist = scandir(getcwd(), 1);

foreach ($filelist as $i) 
{
	if (end(explode(".", $i)) == "txt")
	{
		list($date, $fileplatform, $name) = explode(";", $i);
		if ($platform == $fileplatform || $platform == "ALL")
		{
			$filename=getcwd()."/".$i; 
			$stringfile=""; 
			$file = fopen($filename, "r"); 
			while(!feof($file)) 
			{//читаем файл в строку 
				$stringfile = $stringfile . fgets($file, 4096);  
			} 
			fclose ($file); 
			echo "<br>".preg_replace("/\r\n|\n|\r/", "<br>", $stringfile)."<hr>";
			$filecount++;   
		}
	}
}
if ($filecount == 0)
{
	Echo "Item does not exist.";
}

?>
*Все генераторы можно сохранить как отдельный htm файл.
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS" border="0" align="right"></a>
<a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML" border="0" align="right"></a>
</body>
</html>

