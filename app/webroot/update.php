<?
require_once('path.php');

$_path = 'D:\Projects\marryme.dev\wwwroot\app\webroot\files\article\ ';

$count = 0;
$size = 0;
processPath(getPathContent(trim($_path)), 'process', true);
$size = number_format($size / 1024);
echo "Total: $size Kb in $count files";

function process($fname, $path) {
global $count, $size;
	
	list($name, $ext) = explode('.', $fname);
	if ($name != 'image') {
		echo $fname.'<br>';
	        $size+= filesize($path.$fname);
		unlink($path.$fname);
		$count++;
	}
}
