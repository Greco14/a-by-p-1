Main={init:function(i){navigation=new Navigation,navigation.init()}},$(function(){Main.init()});

$(function(){
    fullscreenFix();
});

function fullscreenFix(){
    var h = $('body').height();
    
    $(".imgcoverIN").each(function(i){
        $(this).css('height', h +'px');        
    });
}

$(window).resize(fullscreenFix);
