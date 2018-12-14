/**
 * Created by monstar on 2018/12/7.
 */

window.onload = function () {
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

// 检查导航表单的内容
function checkForm() {
    var fm = document.add;
    if (fm.nav_name.value == "" || fm.nav_name.value.length < 2 || fm.nav_name.value.length > 20) {
        alert("警告：导航名称输入有误！");
        fm.nav_name.focus();
        return false;
    }
    if (fm.nav_info.value.length > 200) {
        alert("警告：导航描述不能大于200位！");
        fm.nav_info.focus();
        return false;
    }
    return true;
}