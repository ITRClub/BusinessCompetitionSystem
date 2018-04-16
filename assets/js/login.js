// SSO JavaScript Logic

var LoginServlet = '/User/toLogin';

function doLoginRequest() {
    if (document.getElementById('username').value == '' || document.getElementById('password').value == '') {
        alert('用户名或密码不能为空，请重试。');
        return false;
    }
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    $.ajax({
        url: LoginServlet,
        method: 'POST',
        data: {
            'phone': username,
            'password': password,
            'captcha': '0000'
        },
        dataType: 'json',
        async: true,
        success: function (res) {
            refreshForm();
            if (res.code == 200) {
                if (getUrlParam('returnUrl') == null) {
                    alert('登录成功！');
                    location.reload();
                }
                else {
                    location.href = getUrlParam('returnUrl');
                }
            }
            else if (res.code == 403) {
                alert('登录失败，用户名或密码不正确。');
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
}