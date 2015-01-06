$(function(){
    fullscreenFix();

    Main = { init: function(i){ navigation = new Navigation,navigation.init()}}, $(function(){ Main.init() });
});

function fullscreenFix(){
    var h = $('body').height();
    
    $(".imgcoverIN").each(function(i){
        $(this).css('height', h +'px');
    });

    $(".snap").each(function(i){
        var a = $(this).height();
        if(a < h){
            console.log('ajustamos la altura');
            $(this).css('height', h +'px');
        }
    });

    $('#contact').find('.SfH').attr('style', 'min-height: 200px !important; height:'+ (h - 150) +'px');
}

// $(window).resize(fullscreenFix);
