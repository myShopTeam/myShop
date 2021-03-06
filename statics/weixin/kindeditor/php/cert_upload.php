<?php
date_default_timezone_set("Asia/Shanghai");
session_start();
require_once 'JSON.php';
$php_path = dirname(__FILE__) . '/';
$php_url = dirname($_SERVER['PHP_SELF']) . '/';

//$save_path = $php_path . '../../../../data/ArticleImg/';//上传的磁盘地址
$save_path=$_SERVER['DOCUMENT_ROOT'].'/data/pem/';
$save_url = '/data/pem/';//访问时的网络地址

$ext_arr = array(
	'cacert' => array('zip')
);
$max_size = 100000000;
$save_path = realpath($save_path).'/';
if (!empty($_FILES['imgFile']['error'])) {
	switch($_FILES['imgFile']['error']){
		case '1':
			$error = '超过php.ini允许的大小。';
			break;
		case '2':
			$error = '超过表单允许的大小。';
			break;
		case '3':
			$error = '图片只有部分被上传。';
			break;
		case '4':
			$error = '请选择图片。';
			break;
		case '6':
			$error = '找不到临时目录。';
			break;
		case '7':
			$error = '写文件到硬盘出错。';
			break;
		case '8':
			$error = 'File upload stopped by extension。';
			break;
		case '999':
		default:
			$error = '未知错误。';
	}
	alert($error);
}



if (empty($_FILES) === false) {
	$file_name = $_FILES['imgFile']['name'];
	$tmp_name = $_FILES['imgFile']['tmp_name'];
	$file_size = $_FILES['imgFile']['size'];
	if (!$file_name) alert("请选择文件。");
	
	if (@is_dir($save_path) === false) alert("上传目录不存在。");
	if (@is_writable($save_path) === false) alert("上传目录没有写权限。");
	if (@is_uploaded_file($tmp_name) === false) alert("上传失败。");
	if ($file_size > $max_size) alert("上传文件大小超过限制。");
	$dir_name = empty($_GET['dir']) ? 'cacert' : trim($_GET['dir']);
	//print_r($_GET['dir']);exit;
	if (empty($ext_arr[$dir_name])) alert("目录名不正确。");
	$temp_arr = explode(".", $file_name);
	$file_ext = array_pop($temp_arr);
	$file_ext = trim($file_ext);
	$file_ext = strtolower($file_ext);
	if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
		alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
	}
	if ($dir_name !== '') {
		$save_path .= $dir_name . "/";
		$save_url .= $dir_name . "/";
		if (!file_exists($save_path)) mkdir($save_path);
	}
	$token=$_SESSION['token'];//厂商唯一token
	
	$save_path .= $token . "/";
	$save_url .= $token . "/";
	if (!file_exists($save_path)) {
		mkdir($save_path);
	}
	//$new_file_name = uniqid().'.'.$file_ext;
	$new_file_name = $file_name;
	$file_path = $save_path . $new_file_name;
	if (move_uploaded_file($tmp_name, $file_path) === false) {
		alert("上传文件失败。");
	}
	@chmod($file_path, 0644);
	//$file_url = $_SERVER['HTTP_ORIGIN'].$save_url.$new_file_name;
	$file_url = $save_url.$new_file_name;
	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 0,'url' => $file_url));
	exit;
}
function alert($msg) {
	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 1,'message' => $msg));
	exit;
}
