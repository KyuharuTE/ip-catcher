<?
require '../database.php';
$islogin = $_COOKIE['islogin'];
if ($_POST['met'] == 'exitlogin') {
    setcookie("islogin", "", time() - 3600, '/');
    setcookie("username", "", time() - 3600, '/');
    setcookie("password", "", time() - 3600, '/');
    $url = $_SERVER['REMOTE_HOST'] . "/user/login.php";
    echo "<script type='text/javascript'>";
    echo "window.location.href='$url'";
    echo "</script>";
    exit;
}
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
?>
<html>

<head>
    <!-- MDUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css" />
    <link rel="stylesheet" href="/css/index.css" />
    <title>iP探针-DashBaord</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>

<body>
    <div class="mdui-appbar">
        <div class="mdui-toolbar mdui-color-blue-300">
            <a href="javascript:;" class="mdui-typo-title">iP探针-DashBaord</a>
            <div class="mdui-toolbar-spacer"></div>
            <a href="javascript:;" class="mdui-typo-headline" mdui-menu="{target: '#example-attr'}" id="cdopen"><? echo $cloud['name'] ?></a>
            <ul class="mdui-menu" id="example-attr">
                <li class="mdui-menu-item">
                    <a href="javascript:;" id="exitlogin" class="mdui-ripple">退出登录</a>
            </ul>
        </div>
    </div>
    <div class="mdui-color-yellow" style="text-align: left;padding: 15px;">请注意：每个账号默认20个接口，如有22个接口则iD为21的接口无法使用</div>
    <div class="mdui-color-blue-200 big" style="text-align: center;padding: 15px;margin: 15px; ">
        <h1>iP探针-DashBaord</h1>
        <p class="mdui-text-color-black-secondary">YAOU Studio</p>
    </div>
    <div class="mdui-color-blue-200 big">
        <h2 style="text-align: center;">个人信息</h2>
        <ul class="mdui-list">
            <li class="mdui-subheader">基础信息</li>
            <li class="mdui-list-item mdui-ripple">您是本站第 <? echo $yid; ?> 个用户</li>
            <li class="mdui-list-item mdui-ripple">昵称：<? echo $name; ?><a id="namexiu" style="margin-left: 5px;">点我修改</a></li>
            <li class="mdui-subheader">隐私信息</li>
            <li class="mdui-list-item mdui-ripple">邮箱：<? echo $cloud['username']; ?></li>
            <li class="mdui-list-item mdui-ripple">密码：<a href="/user/passxiu.php">点我修改</a></li>
        </ul>
    </div>
    <div class="mdui-color-blue-200 big">
        <h2 style="text-align: center;">接口信息</h2>
        <ul class="mdui-list">
            <li class="mdui-subheader">接口数量：<?
                                            $api = $conn->query("SELECT zid, value, id, user FROM ip WHERE user='" . $cloud['username'] . "'");
                                            echo $api->num_rows;
                                            ?></li>
            <li class="mdui-list-item mdui-ripple">
            <div class="mdui-panel" mdui-panel>
                <?
                while ($row = mysqli_fetch_array($api)) {
                    echo '<div class="mdui-panel-item">
                    <div class="mdui-panel-item-header">iD：'.$row['id'].' iP：'.$row['value'].'</div>
                    <div class="mdui-panel-item-body">
                      <p>APi: http://'.$_SERVER['HTTP_HOST'].'/ip/zhua.php?user='.$row['user'].'&id='.$row['id'].'</p>
                    </div>
                  </div>';
                }
                ?>
            </li>
            </div>
        </ul>
    </div>
    <!-- MDUI JavaScript -->
    <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
    <script src="/js/dash.js"></script>
</body>

</html>