
<?
require '../database.php';
$islogin = $_COOKIE['islogin'];
if ($islogin==1) {
    $url = $_SERVER['REMOTE_HOST']."/index.html";  
    echo "<script type='text/javascript'>";  
    echo "window.location.href='$url'";  
    echo "</script>";
    exit;
}
if (!empty($_POST['email'])) {
    $con=mysqli_connect($servername,$username,$password,$dbname);
    if (mysqli_connect_error()) {
         $status='connect';
    }
    $sql="SELECT username, password FROM user WHERE username='".$_POST['email']."'";
    $re=$con->query($sql);
    if ($re->num_rows > 0) {
        if ($re->num_rows < 2) {
            $sz=$re->fetch_assoc();
            if ($sz['password']==$_POST['password']) {
                $url='http://'.$_SERVER['HTTP_HOST'].'/strj.php?str='.$_POST['email'];
                $un = file_get_contents($url);
                $url='http://'.$_SERVER['HTTP_HOST'].'/strj.php?str='.$_POST['password'];
                $pw = file_get_contents($url);
                setcookie("islogin", "1", time()+60*60*24*1, '/');
                setcookie("username", $_POST['email'].'|'.$un, time()+60*60*24*1, '/');
                setcookie("password", $_POST['password'].'|'.$pw, time()+60*60*24*1, '/');
                $url = $_SERVER['REMOTE_HOST']."/index.html";  
                echo "<script type='text/javascript'>";  
                echo "window.location.href='$url'";  
                echo "</script>";
                exit; 
            }else {
                $status='pass';
            }
        }else {
            $status='what';
        }
    }else {
        $status='no';
    }
}
?>
<html>
    <head>
        <!-- MDUI CSS -->
        <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css"/>
        <link rel="stylesheet" href="/css/index.css"/>
        <title>iP探针-Login</title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    </head>
    <body>
        <!-- MDUI JavaScript -->
        <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
        <div class="mdui-color-blue-200 big" style="text-align: center;padding: 15px;margin: 15px; "><h1>iP探针-Login</h1><p class="mdui-text-color-black-secondary">YAOU Studio</p></div>
        <div class="mdui-color-blue-200 big"><h2 style="text-align: center;">请输入账号密码</h2><form action="/user/login.php" method="post">
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">Email</label>
                <input class="mdui-textfield-input" type="email" name="email" required/>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">Password</label>
                <input class="mdui-textfield-input" type="password" name="password" required/>
            </div>
            <div style="text-align: center;">
                <input class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-200 .mdui-ripple" type="submit" value="Login" />
            </div>
            <div style="text-align: center;">
                <p class="mdui-text-color-red"><?
                if (!empty($status)) {
                    switch ($status) {
                        case 'connect':
                            echo('数据库连接失败!');
                            break;
                        
                        case 'pass':
                            echo '密码错误!';
                            break;

                        case 'what':
                            echo '账号异常!';
                            break;

                        case 'no':
                            echo '没有此账号!';
                            break;

                        default:
                            echo('未知错误!');
                            break;
                    }
                }
                ?></p>
            </div>
            <div style="text-align: center;margin: 15px;">
                <a href="/user/regin.php">没有账号?</a>
            </div>
        </form></div>
    </body>
</html>