<?
require '../database.php';
$cloud = checkuser();
if (!empty($_POST['old']) and !empty($_POST['new']) and !empty($_POST['newt'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (mysqli_connect_error()) {
        $status = 'connect';
    }
    if ($cloud['password'] === $_POST['old']) {
        if ($_POST['new'] == $_POST['newt']) {
            if (preg_match_all('/^[a-zA-Z]\w{5,17}$/', $_POST['new']) === 1) {
                $sql = "UPDATE `user` SET `password` = '".$_POST['new']."' WHERE `id` = ".$cloud['id'];
                $conn->query($sql);
                setcookie("islogin", "", time() - 3600, '/');
                setcookie("username", "", time() - 3600, '/');
                setcookie("password", "", time() - 3600, '/');
                $url = $_SERVER['REMOTE_HOST'] . "/user/login.php";
                echo "<script type='text/javascript'>";
                echo "window.location.href='$url'";
                echo "</script>";
                exit;
            } else {
                $status = 'passz';
            }
        } else {
            $status = 'no';
        }
    } else {
        $status = 'pass';
    }
}
?>
<html>

<head>
    <!-- MDUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css" />
    <link rel="stylesheet" href="/css/index.css" />
    <title>iP探针-Pass</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>

<body>
    <div class="mdui-color-blue-200 big" style="text-align: center;padding: 15px;margin: 15px; ">
        <h1>iP探针-Pass</h1>
        <p class="mdui-text-color-black-secondary">YAOU Studio</p>
    </div>
    <div class="mdui-color-blue-200 big">
        <h2 style="text-align: center;">修改密码</h2>
        <form action="/user/passxiu.php" method="post">
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">原密码</label>
                <input class="mdui-textfield-input" type="password" name="old" required />
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">新密码</label>
                <input class="mdui-textfield-input" type="password" name="new" required />
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">确认密码</label>
                <input class="mdui-textfield-input" type="password" name="newt" required />
            </div>
            <div style="text-align: center;">
                <input class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-200 .mdui-ripple" type="submit" value="修改" />
            </div>
            <p class="mdui-text-color-red" style="text-align: center;"><?
                                            if (!empty($status)) {


                                                switch ($status) {
                                                    case 'connect':
                                                        echo '数据库连接失败!';
                                                        break;

                                                    case 'pass':
                                                        echo '原密码错误';
                                                        break;

                                                    case 'no':
                                                        echo '两次输入的密码不一致';
                                                        break;

                                                    case 'passz':
                                                        echo '密码必须以字母开头，长度在6~18之间，只能包含字母、数字和下划线';
                                                        break;

                                                    default:
                                                        echo '未知错误';
                                                        break;
                                                }
                                            }
                                            ?></p>
        </form>
    </div>
    <!-- MDUI JavaScript -->
    <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
</body>

</html>