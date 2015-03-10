<?php
/*
	test download json-p script
*/
header('Access-Control-Allow-Origin: *');

$callback = isset($_GET['callback']) ? preg_replace('/[^a-z0-9$_]/si', '', $_GET['callback']) : false;
header('Content-Type: ' . ($callback ? 'application/javascript' : 'application/json') . ';charset=UTF-8');

$url = $_GET['file'];

$p = parse_url($url);
$fn = basename($p['path']);
downloadFile($url,"postyimages/".$fn);

$data = array('returnValue' => $fn);

echo ($callback ? $callback . '(' : '') . json_encode($data) . ($callback ? ')' : '');



function downloadFile ($url, $path) {

  $newfname = $path;
  $file = fopen ($url, "rb");
  if ($file) {
    $newf = fopen ($newfname, "wb");

    if ($newf)
    while(!feof($file)) {
      fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
    }
  }

  if ($file) {
    fclose($file);
  }

  if ($newf) {
    fclose($newf);
  }
 }



?>

