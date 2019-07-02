<?php
ob_start();
session_start();
$sql ="SELECT * FROM uyeler WHERE id='1' "; 
$exec=query($sql);
function alt_replace($string){
	$search = array(
		chr(0xC2) . chr(0xA0), // c2a0; Alt+255; Alt+0160; Alt+511; Alt+99999999;
		chr(0xC2) . chr(0x90), // c290; Alt+0144
		chr(0xC2) . chr(0x9D), // cd9d; Alt+0157
		chr(0xC2) . chr(0x81), // c281; Alt+0129
		chr(0xC2) . chr(0x8D), // c28d; Alt+0141
		chr(0xC2) . chr(0x8F), // c28f; Alt+0143
		chr(0xC2) . chr(0xAD), // cdad; Alt+0173
		chr(0xAD)
	);
	$string = str_replace($search, $string);
	return trim($string);
}
function p($par){
    return alt_replace (smysql_real_escape_string(strip_tags(trim($_POST[$par]))));
    }
function get($par){
    return alt_replace (smysql_real_escape_string(strip_tags(trim($_GET[$par]))));
    }
function query($par){
    return mysql_query($par);
    }
function row($par){
    return mysql_fetch_array($par);
    }
function rows($par){
    return mysql_num_rows($par);
    }
function go($url,$time){
    //Sayfa Yönlendirme
    if(isset($time)){ 
    //Time tanımlı ise
        header("refresh:$time;url=$url");
        }
    else{
        header("location:$url");
        }
    }
function seflink($string){
    $find = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/");
    $replace = array("G","U","S","I","O","C","g","u","s","i","o","c");
    $string = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/"," ",$string);
    $string = preg_replace($find,$replace,$string);
    $string = preg_replace("/ +/"," ",$string);
    $string = preg_replace("/ /","-",$string);
    $string = preg_replace("/\s/","",$string);
    $string = strtolower($string);
    $string = preg_replace("/^-/","",$string);
    $string = preg_replace("/-$/","",$string);
    return $string;
    }
function key_logger($par){
    return crypt(md5(sha1($par)));
    }
function set_session($name,$value){
    $_SESSION[$name]=$value;      
    }
function get_session($par){
    if(isset($_SESSION[$par])){
        return $_SESSION[$par];
        }
    else{   
        return false;
        }
    }
$url=$_SERVER['SCRIPT_NAME'];
?>
