Main={init:function(i){navigation=new Navigation,navigation.init()}},$(function(){Main.init()});

$(function(){
    fullscreenFix();
});

function fullscreenFix(){
    var h = $('body').height();
    
    $(".imgcoverIN").each(function(i){
        $(this).css('height', h +'px');
    });
    
    $('#contact').find('.SfH').attr('style', 'min-height: 200px !important; height:'+ (h - 180) +'px');
}

$(window).resize(fullscreenFix);
