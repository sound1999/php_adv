<?php
$vow;
$conso=0;
$sp=0;
$dig;
$line;
$char;
$cnt=0;
$length;
$word=0;
$file="P1.txt";
$myFile=fopen($file,"r") or die("Unable to open");
$op1 = fread($myFile,filesize("P1.txt"));
$op=strtolower($op1);
$vow=array("","a","e","i","o","u");
$length=strlen($op);
for($i=0;$i<$length;$i++){

	if(array_search($op[$i],$vow)){
		$cnt++;
	}
	else if($op[$i]>='a' && $op[$i]<='z')
	{
		$conso++;
		
	}
	
}
$lines="P1.txt";
$line=count(file($lines));
$sp=preg_match_all("/[`~!@#$%^&*(){-}_+=;':.]/",$op);
$dig=preg_match_all("/[0-9]/",$op);
$word=str_word_count($op1);	
echo "<br><br>No of vowels in the file: ".$cnt;
echo "<br>No of characters in the file: ".$length;
echo "<br>No of consonants in the file: ".$conso;
echo "<br>No of lines in the file: ".$line;
echo "<br>No of Words in the file: ".$word;
echo "<br>No of Digits in the file: ".$dig;
echo "<br>No of Special characters in the file: ".$sp;
echo "<br>File size:";
echo filesize("P1.txt");
fclose($myFile);
?>