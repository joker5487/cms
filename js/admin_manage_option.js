/**
 * Created by monstar on 2018/12/7.
 */

window.onload = function () {
    var level = document.getElementById('level');
    var options = document.getElementsByTagName('option');
    var len = options.length;
    for (var i = 0; i < len; i++) {
        if (level.value == options[i].value) {
            options[i].setAttribute("selected", "selected");
        }
    }
};