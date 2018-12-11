/**
 * Created by monstar on 2018/12/7.
 */

window.onload = function () {
    var level = document.getElementById('level');
    var options = document.getElementsByTagName('option');
    var optionLen = options.length;

    if (level) {
        for (var i = 0; i < optionLen; i++) {
            if (level.value == options[i].value) {
                options[i].setAttribute("selected", "selected");
            }
        }
    }

    var title = document.getElementById('title');
    var ol = document.getElementsByTagName('ol');
    var a = ol[0].getElementsByTagName('a');
    var aLen = a.length;

    for (var i = 0; i < aLen; i++) {
        a[i].setAttribute("class", "");
        if (title.innerHTML == a[i].innerHTML) {
            a[i].setAttribute("class", "selected");
        }
    }
};


// 检查新增表单的内容
function checkAddForm() {
    var fm = document.add;
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
    if (fm.admin_pass.value != fm.admin_notpass.value) {
        alert("警告：密码和密码确认不一致！");
        fm.admin_notpass.focus();
        return false;
    }
    return true;
}

// 检查修改表单的内容
function checkUpdateForm() {
    var fm = document.update;
    if (fm.admin_pass.value != "" && fm.admin_pass.value.length < 6) {
        alert("警告：密码输入有误！");
        fm.admin_pass.focus();
        return false;
    }
    return true;
}