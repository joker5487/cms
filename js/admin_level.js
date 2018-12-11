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


// 检查等级表单的内容
function checkForm() {
    var fm = document.add;
    if (fm.level_name.value == "" || fm.level_name.value.length < 2 || fm.level_name.value.length > 20) {
        alert("警告：等级名称输入有误！");
        fm.level_name.focus();
        return false;
    }
    if (fm.level_info.value.length > 200) {
        alert("警告：等级描述不能大于200位！");
        fm.level_info.focus();
        return false;
    }
    return true;
}