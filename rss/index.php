<?php
Echo '<?xml version="1.0" encoding="windows-1251" ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<atom:link href="http://griever.magicteam.net/rss" rel="self" type="application/rss+xml" />
<title>Griever\'s page news</title>
<link>http://griever.magicteam.net/</link>
<description>Griever\'s news</description>
<language>ru</language>
';


if (!empty($_SERVER['QUERY_STRING'])) {
Echo "Item does not exist";
exit;
}

//Word_wrap - исходные текстовые файлы без переносов строки
$LineLength = 80;//Длина строки на странице
function better_wordwrap($str,$cols,$cut){
   $tag_open = '<';
   $tag_close = '>';
   $count = 0;
   $in_tag = 0;
   $str_len = strlen($str);
   $segment_width = 0;  
   for ($i=1 ; $i<=$str_len ; $i++){
       if ($str[$i] == $tag_open) {
           $in_tag++;
       } elseif ($str[$i] == $tag_close) {
           if ($in_tag > 0) { 
               $in_tag--; 
           } 
       } else {
           if ($in_tag == 0) { 
               $segment_width++;
	       if ($str[$i] == "\n"){//конец строки сбрасывает счетчик
                $segment_width = 0;
               }
               if (($segment_width > $cols) && ($str[$i] == " ")) {
                 $str = substr($str,0,$i).$cut.substr($str,$i+1,$str_len-1);
                 $i += strlen($cut);
                 $str_len = strlen($str);
                 $segment_width = 0;
               }
           }
       }
   }
   return $str;
}



chdir('../');
$filelist = scandir(getcwd(), 1);

foreach ($filelist as $i) 
{
 list($year,$month,$day,$descript,$ext) = explode(".", $i);
 if (end(explode(".", $i)) == "txt")
 {
   Echo '<item>
   <title>';
   Echo $descript;
   Echo '</title>
   <description><![CDATA[<pre>';
  $filename=getcwd()."/".$i; 
  $stringfile=""; 
  $file = fopen($filename, "r"); 
  while(!feof($file)) 
  {//читаем файл в строку 
   $stringfile = $stringfile . fgets($file, 4096);  
  } 
  fclose ($file); 
  $output = better_wordwrap($stringfile,$LineLength,"\n");//word wrap в строке
  echo $output;//выводим готовый файл
   Echo '</pre>]]></description>
   <dc:creator>Griever</dc:creator>
   </item>
';
   $filecount++;  
 }
}
Echo '</channel>
</rss>';
if ($filecount == 0)
{
 Echo "Такого раздела не существует.";
}
?>

