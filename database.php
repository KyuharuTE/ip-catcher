<?
$servername = "127.0.0.1";
$username = "name";
$password = "pass";
$dbname = "name";
function checkuser(){
    $servername = "127.0.0.1";
    $username = "name";
    $password = "pass";
    $dbname = "name";
    $islogin = $_COOKIE['islogin'];
    if ($islogin != 1) {
        $url = $_SERVER['REMOTE_HOST'] . "/index.html";
        echo "<script type='text/javascript'>";
        echo "window.location.href='$url'";
        echo "</script>";
        exit;
    }
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (mysqli_connect_error()) {
        echo '<h1>数据库连接失败!</h1>';
        exit;
    }
    $bdusername = substr($_COOKIE['username'], strpos($_COOKIE['username'], '|') + 1);
    $bdpass = substr($_COOKIE['password'], strpos($_COOKIE['password'], '|') + 1);
    $bdusernamesign = substr($_COOKIE['username'], 0, strpos($_COOKIE['username'], '|'));
    $bdpasssign = substr($_COOKIE['password'], 0, strpos($_COOKIE['password'], '|'));
    //exit;
    $sql = "SELECT id, name, username, password FROM user WHERE username='" . $bdusernamesign . "'";
    if ($conn->query($sql)->num_rows > 0) {
        $cloud = $conn->query($sql)->fetch_array();
        $unj = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/scscacadacdcacdacdacadcadcadcadcadcadc.php?str=' . $cloud['username']);
        $psj = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/scscacadacdcacdacdacadcadcadcadcadcadc.php?str=' . $cloud['password']);
        if ($bdpass === $psj and $bdusername === $unj and $bdpasssign === $cloud['password'] and $bdusernamesign === $cloud['username']) {
            $yid = $cloud['id'];
            $name = $cloud['name'];
        } else {
            setcookie("islogin", "", time() - 3600, '/');
            setcookie("username", "", time() - 3600, '/');
            setcookie("password", "", time() - 3600, '/');
            $url = $_SERVER['REMOTE_HOST'] . "/user/login.php";
            echo "<script type='text/javascript'>";
            echo "window.location.href='$url'";
            echo "</script>";
            exit;
        }
    } else {
        echo 1;
        setcookie("islogin", "", time() - 3600, '/');
        setcookie("username", "", time() - 3600, '/');
        setcookie("password", "", time() - 3600, '/');
        $url = $_SERVER['REMOTE_HOST'] . "/user/login.php";
        echo "<script type='text/javascript'>";
        echo "window.location.href='$url'";
        echo "</script>";
        exit;
    }
    return $cloud;
}
?>