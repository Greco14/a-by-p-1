Navigation = function(){
    this.settings={
        btn_nav: $('.menu-item'),
        btn_nav_in: $('.in-btn-nav'),
        
        previus_events_section: $('#previous_events').offset().top,
        future_events_section : $('#future_events').offset().top,
        artists_section: $('#artists').offset().top,
        store_section: $('#store').offset().top,
        about_section: $('#about').offset().top,
        contact_section: $('#contact').offset().top,
        futurismo_section: $('#futurismo').offset().top,

        gray_area1: $('.gray').offset().top,
        red_area: $('.red').offset().top,
        // red_area: $('#previus_events-section .listVid').offset().top,
        anam : $('#logoAn'),

        artist_btn: $('.go_artist'),
        calendar_btn: $('.go_calendar'),
        store_btn: $('.go_store')        
    };
};
Navigation.prototype.init= function(){
    var self = this;
    self.bind();
    self.scrollControl();
};
Navigation.prototype.bind= function(){
    var self = this,
        s = self.settings;

    s.btn_nav.on('click', function(){
        var selection = $(this).find('a').attr('href');
        console.log(selection);

        $(this).removeClass('current-menu-item');
        // s.btn_nav_in.removeClass('no-nav');
        setTimeout(function(){
            $('.'+ selection.substr(1) +'-btn').addClass('current-menu-item');
        },50)
        
        self.animation(selection.substr(1));
    });
    // s.artist_btn.on('click', function(){
    //  s.btn_nav_in.removeClass('active-nav');
    //  s.btn_nav_in.removeClass('no-nav');
    //  $('#artists-btn').addClass('active-nav');
    //  self.animation('artist');
    // });

    // s.calendar_btn.on('click', function(){
    //  s.btn_nav_in.removeClass('active-nav');
    //  s.btn_nav_in.removeClass('no-nav');
    //  $('#future_events-btn').addClass('active-nav');
    //  self.animation('calendar');
    // });

    // s.calendar_btn.on('click', function(){
    //  s.btn_nav_in.removeClass('active-nav');
    //  s.btn_nav_in.removeClass('no-nav');
    //  $('#previus_events-btn').addClass('active-nav');
    //  self.animation('calendar');
    // });

    // s.store_btn.on('click', function(){
    //  s.btn_nav_in.removeClass('active-nav');
    //  s.btn_nav_in.removeClass('no-nav');
    //  $('#store-btn').addClass('active-nav');
    //  self.animation('store');
    // });
    
};
Navigation.prototype.animation= function(actions){
    var self = this,
        s = self.settings;
    var elEasing = 'easeOutExpo';
    switch(actions){
        case 'artists':
            var goTop = s.artists_section;
            $('body').animate({
                scrollTop: goTop
            }, 1500, elEasing);
            break;
        case 'store':
            var goTop = s.store_section;
            $('body').animate({
                scrollTop: goTop
            }, 1500, elEasing);
        
            break;
        case 'previous_events':
            var goTop = s.previus_events_section;
            $('body').animate({
                scrollTop: goTop
            }, 1500, elEasing);
        
            break;
        case 'future_events':
            var goTop = s.future_events_section;
            $('body').animate({
                scrollTop: goTop
            }, 1500, elEasing);
        
            break;
        case 'about':
            var goTop = s.about_section;
            $('body').animate({
                scrollTop: goTop
            }, 1500, elEasing);
        
            break;
        case 'contact':
            var goTop = s.contact_section;
            $('body').animate({
                scrollTop: goTop
            }, 1500, elEasing);
        
            break;
    };
};
Navigation.prototype.scrollControl = function(){
    var self = this,
        s = self.settings;
    var alto = $(window).height();
    $(window).scroll( function() {
        var scrolled_val = $(document).scrollTop().valueOf();
        // console.log(scrolled_val);
        if(scrolled_val > s.future_events_section){
            s.btn_nav.removeClass('current-menu-item');
            // s.btn_nav_in.removeClass('no-nav');
            $('.future_events-btn').addClass('current-menu-item');
            $('#head').removeClass('whiteMe');
            $('.footer').removeClass('whiteMe');
            s.anam.removeClass('whiteMe');
        }

        if(scrolled_val > s.gray_area1 && s.gray_area1 +alto ){
            $('#head').addClass('whiteMe');
        }

        if(scrolled_val > s.gray_area1-500 && s.gray_area1 +alto){
            $('.footer').addClass('whiteMe');
            s.anam.addClass('whiteMe');
        }

        if(scrolled_val > s.previous_events_section){
            s.btn_nav.removeClass('current-menu-item');
            // s.btn_nav_in.removeClass('no-nav');
            $('.previous_events-btn').addClass('current-menu-item');
            $('#head').removeClass('whiteMe');
            $('.footer').removeClass('whiteMe');
            s.anam.removeClass('whiteMe');
        }
        if(scrolled_val > s.red_area && s.red_area +alto){
            $('#head').addClass('whiteMe');
        }
        if(scrolled_val > s.red_area-500 && s.red_area +alto){
            $('.footer').addClass('whiteMe');
            s.anam.addClass('whiteMe');
        }

        if(scrolled_val > s.artists_section){
            s.btn_nav.removeClass('current-menu-item');
            // s.btn_nav_in.removeClass('no-nav');
            $('.artists-btn').addClass('current-menu-item');

            $('#head').removeClass('whiteMe');
            $('.footer').removeClass('whiteMe');
            s.anam.removeClass('whiteMe');
        }
        if(scrolled_val > s.store_section-500){
            $('.footer').addClass('whiteMe');
            s.anam.addClass('whiteMe');
        }
        if(scrolled_val > s.store_section){
            s.btn_nav.removeClass('current-menu-item');
            // s.btn_nav_in.removeClass('no-nav');
            $('.store-btn').addClass('current-menu-item');
            $('#head').addClass('whiteMe');

        }

        if(scrolled_val > s.futurismo_section){
            s.btn_nav.removeClass('current-menu-item');
            // s.btn_nav_in.removeClass('no-nav');
            // $('#store-btn').addClass('active-nav');
            $('#head').removeClass('whiteMe');
            $('.footer').removeClass('whiteMe');
            s.anam.removeClass('whiteMe');
        }

        if(scrolled_val > s.about_section-500){
            $('.footer').addClass('whiteMe');
            s.anam.addClass('whiteMe');
        }

        if(scrolled_val > s.about_section){
            s.btn_nav.removeClass('current-menu-item');
            // s.btn_nav_in.removeClass('no-nav');
            $('.about-btn').addClass('current-menu-item');
            $('#head').addClass('whiteMe');
        }

        if(scrolled_val > s.contact_section-500){
            $('.footer').removeClass('whiteMe');
            s.anam.removeClass('whiteMe');
        }

        if(scrolled_val > s.contact_section){
            s.btn_nav.removeClass('current-menu-item');
            // s.btn_nav_in.removeClass('no-nav');
            $('.contact-btn').addClass('current-menu-item');
            $('#head').removeClass('whiteMe');
        } 
    });
};