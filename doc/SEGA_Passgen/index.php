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
</tr>
</table>
<hr noshade>
<p style="color: #000000; font-family: Garamond,Apple Garamond,Baskerville,Georgia,serif; font-size: medium; width: 70%; text-align: justify;">
<?php 
include ('../blocks/wrap.php');

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
  //$output = better_wordwrap($stringfile,$LineLength,"\n");//word wrap в строке
  //$output = str_replace(array("\r\n", "\r", "\n"), "<br />", $stringfile)
  echo nl2br($stringfile);//выводим готовый файл

  //постоянные склонения числительного
  $titles = array('раз', 'раза', 'раз');
  $cases = array (2, 0, 1, 1, 1, 2);

  If ($doc == '')
  {
    $cnt = explode('.',$name);
    $arr = file('counter.dat');
    foreach ($arr as $item)
    {
     $parts = explode('::', $item);
     if (eregi($cnt[0], $parts[0])) 
     {
      print "\n---------------------------------------------\n";
      print 'Прочитано '.(int)($parts[1])." ".$titles[ ($parts[1]%100>4 && $parts[1]%100<20)? 2 : $cases[min($parts[1]%10, 5)] ].'. Прокомментировано '.(int)($parts[2])." ".$titles[ ($parts[2]%100>4 && $parts[2]%100<20)? 2 : $cases[min($parts[2]%10, 5)] ].'.<hr>';
     }
    }	  
   }	  
  $filecount++;   
  }
 }
}
if ($doc != '')//Если это документ, выводим счетчик разбив имя файла самой статьи
{
 $arr = file('counter.dat');
 foreach ($arr as $item)
 {
  $parts = explode('::', $item);
  if (eregi($doc, $parts[0])) 
  {
   $parts[1] = $parts[1] + 1;
   print '<hr>Прочитано '.$parts[1]." ".$titles[ ($parts[1]%100>4 && $parts[1]%100<20)? 2 : $cases[min($parts[1]%10, 5)] ].".\n";
   Echo "\n========== Комментарии(".$parts[2].")==========\n";
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
  //$output = better_wordwrap($stringfile,$LineLength,"\n");//word wrap в строке
  echo "<br/><br/><br/>".nl2br($stringfile);
  //echo "\n\n\n".$output;//выводим   
?>

</p>
<pre>

<?php
//Капча тело
echo <<<END
<form action="" method="post">
Имя:<input type="text" name="name">
Комментарий:
<textarea name="message" cols="45" rows="4"></textarea>
<table width="42" style='border: 1px solid;'>
<tr>
<td width="32"><img src="../captcha/?<?php echo session_name()?>=<?php echo session_id()?>">
</tr>
</table>
Текст на картинке:<input type="text" name="keystring">  <input type="submit" value="Отправить">

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

    $msg = comment_wordwrap($_POST['message'],34,"\n");
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
   echo"Неверно введён текст картинки! <A href=\"javascript:history.go(-1)\" mce_href=\"javascript:history.go(-1)\">Назад</A>";
  }
 }
 else
 {
  echo "Введите сообщение!";
 }
}
unset($_SESSION['captcha_keystring']);


}

if ($filecount == 0)
{
 Echo "Такого раздела не существует.
";
}
?>
</pre>
</body>
</html>

