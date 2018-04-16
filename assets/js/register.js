// SSO JavaScript Logic

var RegisterServlet = '/User/toRegister';

function doRegisterRequest() {
    if (document.getElementById('username').value == '' || document.getElementById('password').value == '' || document.getElementById('password2').value == '') {
        alert('用户注册表单不能有任意一项为空，请核实后重试。');
        return false;
    }
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var password2 = document.getElementById('password2').value;
    if (password != password2) {
        alert('二次密码确认不一致，请检查表单并修正这些问题再次尝试。');
        return false;
    }
    $.ajax({
        url: RegisterServlet,
        method: 'POST',
        data: {
            'phone': username,
            'password': password2,
            'teamName': 'group',
            'realName': 'none',
            'phoneCaptcha': '0000'
        },
        dataType: 'json',
        async: true,
        success: function (res) {
            refreshCode();
            refreshForm();
            if (res.code == 200) {
                alert('注册成功！请在登录页面完成登录。');
                location.href = './login';
            }
            else if (res.code == 500) {
                alert('注册失败，您键入的用户名可能已经存在或被禁止注册。');
            }
            else {
                alert('系统异常，请刷新页面后再次尝试。如多次出现，请联系管理员！');
            }
        },
        error: function (e) {
            alert('系统异常，请刷新页面后再次尝试。如多次出现，请联系管理员！');
        }
    });
}

function refreshForm() {
    document.getElementById('password').value = '';
    document.getElementById('password2').value = '';
}
