<?
require '../database.php';
if(getenv('HTTP_CLIENT_IP')) {
    $onlineip = getenv('HTTP_CLIENT_IP');
} elseif(getenv('HTTP_X_FORWARDED_FOR')) {
    $onlineip = getenv('HTTP_X_FORWARDED_FOR');
} elseif(getenv('REMOTE_ADDR')) {
    $onlineip = getenv('REMOTE_ADDR');
} else {
    $onlineip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
}
$conn=mysqli_connect($servername,$username,$password,$dbname);
if ($conn->query("SELECT * FROM ip WHERE user='".$_GET['user']."' AND id=".$_GET['id'])->num_rows==1) {
    $conn->query("UPDATE ip SET value='".$onlineip."' WHERE user='".$_GET['user']."' AND id=".$_GET['id']);
    $url = "http://baidu.com";  
    echo "<script type='text/javascript'>";  
    echo "window.location.href='$url'";  
    echo "</script>";
    exit;
}else {
    echo 'error';
    exit;
}
?>