<?
require '../database.php';
if ($_COOKIE['islogin']==1) {
    $url = $_SERVER['REMOTE_HOST']."/index.html";  
    echo "<script type='text/javascript'>";  
    echo "window.location.href='$url'";  
    echo "</script>";
    exit;
}
if (!empty($_POST['email'])) {
    if (preg_match_all("@^(?:http://)?([^/]+)@i",$_POST['email'])===1) {
        $con=mysqli_connect($servername,$username,$password,$dbname);
        if (mysqli_connect_error()) {
            $status='connect';
        }
        if (preg_match_all("/^[a-zA-Z]\w{5,17}$/",$_POST['password'])===1) {
            if (preg_match_all("/^[a-zA-Z][a-zA-Z0-9_]{4,15}$/",$_POST['name'])===1) {
                $sql="SELECT * FROM user WHERE username='".$_POST['email']."'";
                if ($con->query($sql)->num_rows>0) {
                    $status='emailm';
                }else {
                    if ($con->query("SELETC * FROM user WHERE name='".$_POST['name']."'")->num_rows>0) {
                        $status='namem';
                    }else {
                        $sql = "INSERT INTO user (id, name, username, password)
VALUES (NULL, '".$_POST['name']."', '".$_POST['email']."', '".$_POST['password']."')";
                        $one=$con->query($sql);
                        for ($bl=1; $bl <= 21; $bl++) { 
                            $sql="INSERT INTO ip (zid, id, user)
VALUES (NULL, ".$bl.", '".$_POST['email']."')";
                            $con->query($sql);
                        }
                        if ($con->query($sql)===TRUE) {
                            $url = $_SERVER['REMOTE_HOST']."/user/login.php";  
                            echo "<script type='text/javascript'>";  
                            echo "window.location.href='$url'";  
                            echo "</script>";
                            exit;
                        }
                    }
                }
            }else {
                $status='name';
            }
        }else {
            $status='pass';
        }
    }else {
        $status='email';
    }
}
?>
<html>
    <head>
        <!-- MDUI CSS -->
        <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css"/>
        <link rel="stylesheet" href="/css/index.css"/>
        <title>iP探针-Regin</title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    </head>
    <body>
        <!-- MDUI JavaScript -->
        <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
        <div class="mdui-color-blue-200 big"><h1 style="text-align: center;">iP探针-Regin</h1><p class="mdui-text-color-black-secondary" style="text-align: center;">YAOU Studio</p></div>
        <div class="mdui-color-blue-200 big"><h2 style="text-align: center;">请输入注册信息</h2><form action="/user/regin.php" method="post">
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">Name</label>
                <input class="mdui-textfield-input" type="text" name="name" required/>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">Password</label>
                <input class="mdui-textfield-input" type="password" name="password" required/>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">Email</label>
                <input class="mdui-textfield-input" type="email" name="email" required/>
            </div>
            <div style="text-align: center;">
                <input class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-200 .mdui-ripple" type="submit" value="Regin" />
            </div>
            <div style="text-align: center;">
                <p class="mdui-text-color-red"><?
                if (!empty($status)) {
                    switch ($status) {
                        case 'connect':
                            echo('数据库连接失败!');
                            break;
                        
                        case 'pass':
                            echo '密码必须以字母开头，长度在6~18之间，只能包含字母、数字和下划线';
                            break;

                        case 'email':
                            echo '邮箱格式错误';
                            break;

                        case 'name':
                            echo '名称必须以字母开头，允许5-16字节，允许字母数字下划线';
                            break;

                        case 'emailm':
                            echo '邮箱重复';
                            break;

                        case 'namem':
                            echo '名称重复';
                            break;

                        default:
                            echo('未知错误!');
                            break;
                    }
                }
                ?></p>
            </div>
            <div style="text-align: center;margin: 15px;">
                <a href="/user/login.php">已有账号?</a>
            </div></form></div>
    </body>
</html>