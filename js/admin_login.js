/**
 * Created by monstar on 2018/12/12.
 */

function checkLogin() {
    var fm = document.adminLogin;
    if (fm.admin_user.value == "" || fm.admin_user.value.length < 2 || fm.admin_user.value.length > 20) {
        alert("警告：用户名输入有误！");
        fm.admin_user.focus();
        return false;
    }
    if (fm.admin_pass.value == "" || fm.admin_pass.value.length < 6) {
        alert("警告：密码输入有误！");
        fm.admin_pass.focus();
        return false;
    }
    if (fm.code.value.length != 4) {
        alert("警告：验证码必须是4位！");
        fm.code.focus();
        return false;
    }

    return true;
}