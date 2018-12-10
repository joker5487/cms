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
        console.log(a[i])
        if (title.innerHTML == a[i].innerHTML) {
            console.log(1)
            a[i].setAttribute("class", "selected");
        }
    }
};