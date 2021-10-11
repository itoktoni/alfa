function getcheckboxes() {
    var node_list = document.getElementsByTagName('input');
    var checkboxes = [];
    for (var i = 0; i < node_list.length; i++) {
        var node = node_list[i];
        if (node.getAttribute('type') == 'checkbox') {
            checkboxes.push(node);
        }
    }
    return checkboxes;
}

function toggle(source) {
    checkboxes = getcheckboxes();
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}

function number_format(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function convertNumber(strg) {
    var strg = strg || "";
    var decimal = '.';
    strg = strg.replace(/[^0-9$.,]/g, '');
    if (strg.indexOf(',') > strg.indexOf('.')) decimal = ',';
    if ((strg.match(new RegExp("\\" + decimal, "g")) || []).length > 1) decimal = "";
    if (decimal != "" && (strg.length - strg.indexOf(decimal) - 1 == 3) && strg.indexOf("0" + decimal) !== 0) decimal = "";
    strg = strg.replace(new RegExp("[^0-9$" + decimal + "]", "g"), "");
    strg = strg.replace(',', '.');
    return parseFloat(strg);
}

$(document).ready(function() {
    $("select.form-control:not(.select)").chosen();
});

function rmSidebar(){
    setTimeout(function(){
        $('html').removeClass('sidebar-left-opened');
    }, 200);
}

function showProfile(){
    $('.userbox').toggleClass('open');
}

function showNotif(){
    $('.notif').toggleClass('open');
}

function showEmail(){
    $('.mail').toggleClass('open');
}