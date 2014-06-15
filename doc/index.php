<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta content="text/html; charset=windows-1251" http-equiv="Content-Type">
<title>Tutorials</title>
<style type="text/css">@import "../blocks/style.css";</style>
<link rel="alternate" type="application/rss+xml" title="Griever's RSS" href="../rss">
</head>
<body>
<pre>             </pre><img src="../Head.png" alt="Logo">
<table cellpadding="3" cellspacing="3"><tr> 
<td class="c"><a href="/" target="_parent">NEWS</a></td>
<td class="c"><a href="/doc" target="_parent"><b>TUTORiALS</b></a></td>
<td class="c"><a href="/passgen" target="_parent">PASSGENS</a></td>
<td class="c"><a href="/old" target="_parent">OLD PAGES</a></td>
<td class="c"><a href="/captcha/feedback.php" target="_parent">FEEDBACK</a></td>
<td class="c"><a href="http://MagicTeam.net" target="_blank">MAGiC TEAM</a></td>
</tr></table>
<table cellpadding="3" cellspacing="3" align="right">
<tr> 
<td class="d"><a href="/doc?platform=NES" target="_parent">NES</a></td>
<td class="d"><a href="/doc?platform=SEGA" target="_parent">SEGA</a></td>
<td class="d"><a href="/doc?platform=PSX" target="_parent">PSX</a></td>
<td class="d"><a href="/doc?platform=MISC" target="_parent">MiSC</a></td>
</tr>
</table>
<hr noshade>

<?php 

if (empty($_GET['platform']) && empty($_GET['doc'])) 
{
	$platform="ALL";//Если не передано, это индекс 
} 
else 
{
	$platform = $_GET['platform'];
	$doc = $_GET['doc'];
}

$filelist = scandir(getcwd()."/".$doc."/", 1); 

foreach ($filelist as $i) 
{
	if (end(explode(".", $i)) == "txt")
	{
		list($date, $fileplatform, $name) = explode(";", $i);
		if ($platform == $fileplatform || $platform == "ALL")
		{	  
			$filename = getcwd()."/".$doc."/".$i; 
			$stringfile=""; 
			$file = fopen($filename, "r"); 
			while(!feof($file)) 
			{//читаем файл в строку 
				$stringfile = $stringfile . fgets($file, 4096);  
			}
			fclose ($file); 
			echo "<br>".preg_replace("/\r\n|\n|\r/", "<br>", $stringfile);
			 
			If ($doc == '')
			{
				$cnt = explode('.',$name);
				$arr = file('counter.dat');
				foreach ($arr as $item)
				{
					$parts = explode('::', $item);
					if (eregi($cnt[0], $parts[0])) 
					{
						print "<br>---------------------------------------------<br>";
						$readTimes = ((int)($parts[1]) == 1) ? ' time.' : ' times.';
						$commentTimes = ((int)($parts[2]) == 1) ? ' time.' : ' times.';
						print 'Read '.(int)($parts[1]).$readTimes.' Commented '.(int)($parts[2]).$commentTimes;
						print "<hr><br>";
					}
				}	  
			}	  
		$filecount++;   
		}
	}
}

if ($doc != '')//Если это документ, выводим счетчик разбив имя файла самой статьи и ниже капчу с комментами
{
	$arr = file('counter.dat');
	foreach ($arr as $item)
	{
		$parts = explode('::', $item);
		if (eregi($doc, $parts[0])) 
		{
			$parts[1] = $parts[1] + 1;
			$readTimes = ((int)($parts[1]) == 1) ? ' time.' : ' times.';
			print '<hr>Read '.$parts[1].$readTimes."<br>";
			echo "<p style=\"width: 50%\">";
			Echo "<br>================ Comments(".$parts[2].")================<br>";
		}
		$str = $str.$parts[0].'::'.(int)($parts[1]).'::'.$parts[2].'::'.$parts[3];
	}
	$file = fopen('counter.dat', "w");
	fputs($file, $str);
	fclose($file);



	//Вывод комментариев
	$filename = getcwd()."/".$doc."/comments.dat"; 
	$stringfile=""; 
	$file = fopen($filename, "r"); 
	while(!feof($file)) 
	{//читаем файл в строку 
		$stringfile = $stringfile . fgets($file, 4096);  
	}
	fclose ($file); 

	echo "<br>".preg_replace("/\r\n|\n|\r/", "<br>", $stringfile);


	//Капча тело
echo <<<END
<form action="" method="post">
Name:<input type="text" name="name"><br>
Comment:<br>
<textarea name="message" cols="45" rows="4"></textarea>
<table width="42" style='border: 1px solid;'>
<tr>
<td width="32"><img src="../captcha/?<?php echo session_name()?>=<?php echo session_id()?>">
</tr>
</table>
CAPTCHA text:<input type="text" name="keystring">  <input type="submit" value="Send"><br>
</form>
END;



	//Капча код
	if(count($_POST)>0)
	{
		 $name = $_POST['name'];
		 if($name == '')
		 {
		  $name = "Anonymous";
		 }  
		if($_POST['message'] != '')
		{
			if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['keystring'])//добавление комментария
			{
				$str = $str.$parts[0].'::'.(int)($parts[1]).'::'.(int)($parts[2]).'::'.$parts[3];
				//Увеличиваем счетчик комментариев
				$arr = file('counter.dat');
				$str = '';
				foreach ($arr as $item)
				{
					$parts = explode('::', $item);
					if (eregi($doc, $parts[0])) 
					{
						$parts[2] = $parts[2] + 1; 
						$msg_count = $parts[2];  
					}
					$str = $str.$parts[0].'::'.$parts[1].'::'.$parts[2].'::'.$parts[3];
				}
				$file = fopen('counter.dat', "w");
				fputs($file, $str);
				fclose($file);

				$msg = $_POST['message'];
				$str = "#".$msg_count." [".date("m.d.y")." - ".date("H:i:s")."]\n".$name.":\n".$msg."\n-----------------------------------\n";
				$filename = getcwd()."/".$doc."/comments.dat";
				$file = fopen($filename, "a");
				fwrite($file, $str);
				fclose($file);
				mail("Romhack@gmail.com", "New Comment at Griever's Stuff", "http://www.griever.magicteam.net".$_SERVER[REQUEST_URI]."\n\n".$name.":\n".$_POST['message']);
				echo "<html><head><meta http-equiv='Refresh' content='0; URL=$_SERVER[REQUEST_URI]'></head></html>";
				exit();
			}
			else
			{
				echo"Wrong CAPTCHA! <A href=\"javascript:history.go(-1)\" mce_href=\"javascript:history.go(-1)\">Back</A>";
			}
		}
		else
		{
			echo "Message is empty!";
		}
	}
	unset($_SESSION['captcha_keystring']);
}
else
{
	echo '<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="/files/valid_css.png" alt="Valid CSS" border="0" align="right"></a><a href="http://validator.w3.org/check?uri=referer"><img src="/files/valid_html.png" alt="Valid HTML" border="0" align="right"></a>';
}

if ($filecount == 0)
{
	Echo "Item does not exist.";
}

?>

</body>
</html>

