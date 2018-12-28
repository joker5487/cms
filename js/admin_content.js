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
function centerWindow(url, name, width, height) {
    var left = ( screen.width - width ) / 2;
    var top = ( screen.height - height ) / 2 + 50;
    window.open(url, name, "width="+width+",height="+height+",left="+left+",top="+top);
}