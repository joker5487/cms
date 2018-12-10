/**
 * Created by monstar on 2018/12/5.
 */

function admin_top_nav(event){
    var tagName = "admin_nav";
    var tags = document.getElementsByName(tagName);
    var current = event["target"].getAttribute('id');
    var tagsLen = tags.length;
    for(var i = 0; i < tagsLen; i++){
        var tagIs = tags[i].getAttribute('id');
        document.getElementById(tagIs).removeAttribute("class");
    }
    document.getElementById(current).setAttribute("class", "selected");
}