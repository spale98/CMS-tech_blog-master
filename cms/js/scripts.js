$(document).ready(function(){

// Create loader

    var div_box = "<div id='load-screen'><div id='loading'></div></div>";

    $("body").prepend(div_box);

    $('#load-screen').delay(700).fadeOut(700, function () {
        $(this).remove();

    })
    
});