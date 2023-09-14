<?php

$allow = 0;

if ($allow == 1){

  $file = $_GET['file'];
  $tr_contents_get = $_GET['tr_contents'];
  $pass = $_GET['pass']; 

  $table = file_get_contents($file);
  $table_replace = str_replace($tr_contents, "", $table);
  $fp = fopen("$file", "w");
  fwrite($fp, "$table_replace");
  fclose($fp);
}    
?>