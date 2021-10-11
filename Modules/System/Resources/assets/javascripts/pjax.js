document.addEventListener("pjax:error", function(e) {
    window.location.replace(e.request.responseURL);
});

document.addEventListener("DOMContentLoaded", function() {
    pjax = new Pjax({
        elements: ["a"],
        selectors: ["body"],
        cacheBust: false
    });

});

$(document).on('click', '#childMenu', function() {
    setTimeout(function() {
        $('html').removeClass('sidebar-left-opened');
    }, 500);
});

$(".date").flatpickr({
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
});

$(".nav-children").on("click","li", function(){
    alert('alert');
    $('html').removeClass('sidebar-left-opened');
    // alert($(this).find("span.t").text());
});