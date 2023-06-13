function httpPost(URL, PARAMS) {
    var temp = document.createElement("form");
    temp.action = URL;
    temp.method = "post";
    temp.style.display = "none";

    for (var x in PARAMS) {
        var opt = document.createElement("textarea");
        opt.name = x;
        opt.value = PARAMS[x];
        temp.appendChild(opt);
    }

    document.body.appendChild(temp);
    temp.submit();

    return temp;
}

document.getElementById('namexiu').onclick = function () {
    mdui.alert('暂未开发');
};
document.getElementById('exitlogin').onclick = function () {
    var params = {
        "met": 'exitlogin',
    };
    httpPost(window.location.protocol+'//'+window.location.hostname+'/user/dash.php',params);
};