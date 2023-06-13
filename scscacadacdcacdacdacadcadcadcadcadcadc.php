<?
$data = $_GET['str'].'jhhgdgyydygkoohuihujhhgdgyydygkoohuihu';  
$encrypt = openssl_encrypt($data, 'AES-128-ECB', 'ngfnnfxhrthhjchmfngbsdbgnghn', 0);  
echo ($encrypt);
?>