$(document).ready(function(){

    $('#selectAllBoxes').click(function(event) {
        if(this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }
    });

// Create loader

    var div_box = "<div id='load-screen'><div id='loading'></div></div>";

    $("body").prepend(div_box);

    $('#load-screen').delay(700).fadeOut(700, function () {
        $(this).remove();

    })



});




function loadOnlineUsers() {
    $.get("includes/functions_temp.php?onlineusers=result", function(data) {
        $(".onlineusers").text(data);
    })
}

setInterval(function(){

    loadOnlineUsers();
}, 500);
