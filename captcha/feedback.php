<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta content="text/html; charset=windows-1251" http-equiv="Content-Type">
<title>Feedback</title>
<style type="text/css">@import "../blocks/style.css";</style>
<link rel="alternate" type="application/rss+xml" title="Griever's RSS" href="../rss">
</head>
<body>
<pre>             </pre><img src="../Head.png" alt="Logo">
<table cellpadding="3" cellspacing="3"><tr> 
<td class="c"><a href="/" target="_parent">NEWS</a></td>
<td class="c"><a href="/doc" target="_parent">TUTORiALS</a></td>
<td class="c"><a href="/passgen" target="_parent">PASSGENS</a></td>
<td class="c"><a href="/old" target="_parent">OLD PAGES</a></td>
<td class="c"><a href="/captcha/feedback.php" target="_parent"><b>FEEDBACK</b></a></td>
<td class="c"><a href="http://MagicTeam.net" target="_blank">MAGiC TEAM</a></td>
</tr></table>
<hr noshade>
<?php
echo <<<END
<form action="" method="post">
Name:<input type="text" name="name"><br><br>
Message:<br>
<textarea name="message" cols="45" rows="4"></textarea>
<table width="42" style='border: 1px solid;'>
<tr>
<td width="32"><img src="../captcha/?<?php echo session_name()?>=<?php echo session_id()?>" alt="CAPTCHA image">
</tr>
</table>
CAPTCHA text:<input type="text" name="keystring">  <input type="submit" value="Send"><br>
</form>
END;

if(count($_POST)>0)
{
	$name = $_POST['name'];
	if($name == '')
	{
		$name = "Anonymous";
	} 
	if($_POST['message'] != '')
	{
		if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['keystring'])
		{		
			mail("Romhack@gmail.com", "Feedback from Griever's site", $name.":\n".$_POST['message']); 
			echo"Message is sent. Appreciate your feedback.";
		}
		else
		{
			echo"Wrong CAPTCHA! <A href=\"javascript:history.go(-1)\" mce_href=\"javascript:history.go(-1)\">Назад</A>";
		}
	}
	else
	{
		echo "Message is empty!";
	}
}
unset($_SESSION['captcha_keystring']);
?>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS" border="0" align="right"></a><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML" border="0" align="right"></a>
</body>
</html>
