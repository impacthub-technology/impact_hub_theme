jQuery(window).load(function(){

    var $ = jQuery, ah = 0, st = 0, pmst1, pmst2;
    function ahf() { ah = ( $(window).width() > 781 && $('#wpadminbar').length > 0 ) ? $('#wpadminbar').outerHeight() : 0; }

    function pmNav() {
        clearTimeout(pmst1);
        clearTimeout(pmst2);
        pmst1 = setTimeout(function() {
            $('#pageMenu .nav:not(.mCustomScrollbar)').mCustomScrollbar({
                axis: 'x',
                scrollButtons: {enable: true},
                mouseWheel: {enable: false}
            });
            pmst2 = setTimeout(function () {
                if ($('#pageMenu .current').length < 1) return;
                for (var i = 0, b = 0; i < $('#pageMenu a.na').length; i++) {
                    var a = $('#pageMenu a.na:eq(' + i + ')');
                    if (a.hasClass('current')) break;
                    b += a.outerWidth() + 10;
                }
                b += parseInt($('#pageMenu a.na:eq(0)').css('margin-left')) - $('#pageMenu .nav').width() / 2 + $('#pageMenu .current').outerWidth() / 2;
                if ( b < 0 ) b = 0;
                $('#pageMenu .nav.mCustomScrollbar').mCustomScrollbar('scrollTo', b);
            },50);
        },50);
    }

    function membership() {
        if ( !$('.area-member').length || $('.area-member .owl-loaded').length && $(window).width < 768 ) return;
        $('.area-member .owl-carousel').owlCarousel('destroy');
        $('.area-member .tBody.mCustomScrollbar').mCustomScrollbar('destroy');
        if ( $(window).width() > 767 ) {
            $('.area-member .tBody:not(.mCustomScrollbar)').mCustomScrollbar({axis:"x"});
        } else {
            $('.area-member .owl-carousel').owlCarousel({ nav: true, navText: [ "", "" ], dots: false, mouseDrag: false, pullDrag: false, items: 1, loop: true });
        }
    }

    function pageMenu() {
        var _st = st;
        st = parseInt($(document).scrollTop());
        if ( st > 200 ) $('#search').hide();
        $('#header').toggleClass('scroll',st > 200).css('top', ah );
        if ( $('#pageMenu').length < 1 ) return;
        $('#pageMenu .icon, #pageMenu .title').toggleClass( 'ib', st > 110 );
        $('#pageMenu .icon').toggleClass( 'hidden', st > 200 );
        pmNav();
    }

    if ( $('#pageMenu').length > 0 ) {
        setTimeout(function(){
            $('html,body').scrollTop(0);
            setTimeout(function(){
                $('#headBlank').css('height', $('#header').outerHeight());
            },100);
        },200);
    }

    setInterval(function(){
        if ( st < 111 ) $('#headBlank').css('height', $('#header').outerHeight());
    },1000);

    pmNav();

    $(window).resize(function(){ahf();pageMenu();membership()}).resize();

    $(document).scroll(function(){pageMenu()});

	
	$('#toggle').click(function(){
	    $('body').addClass('of');
        $('#search').fadeOut(200);
        $('#mainNav').toggleClass('on');
	});
    
	$('body,#mainNav + .navbg').click(function(event) {
        if ( $(event.target).closest('#mainNav').length < 1 && $(event.target).closest('#toggle').length < 1 ) {
            $('body').removeClass('of');
            $('#mainNav').removeClass('on');
        }
    });

    $('#lang_area a').click(function(e){
        console.log(123);
        var a = $(this).closest('#lang_area');
        if ( !a.hasClass('active') ) {
            e.preventDefault();
            a.toggleClass('active');
        }
    });

    $('#mainNav li.has-child > a .ar').click(function(){
        $(this).closest('li.has-child').toggleClass('on');
        return false;
    });

    $('#mainNav li.has-child').click(function(){
        if ( $(this).hasClass('on') || $(window).width() > 1200 ) return true;
        $(this).addClass('on');
        return false;
    });


	$('#header .searchBtn').click(function(){
	    $('html,body').animate({scrollTop:0},200);
		$('#mainNav').removeClass('on');
        $('.popup').trigger('click');
        setTimeout(function(){$('#search').fadeIn(200).find('#sr').focus()},400);
    });

    $('#search .sclose svg').click(function(){
        $('#search').fadeOut(200);
    });

    $(document).on('click','.popup',function(e){
        if ( $(e.target).closest('.times').length || !$(e.target).closest('.m-body').length ) {
            $('body').removeClass('of ofp ofg');
            $(this).closest('.popup').fadeOut(200);
        }
    });

    $(document).on('click','[data-popup]',function(){
        var a = $(this).closest('.row').find('.popup');
        $('body').addClass('ofg');
        a.fadeIn(200);
        $('html,body').animate({scrollTop:(a.find('.m-body').offset().top-50)},200);
    });

    $(document).on('click','a[href^="#popup-"]',function(){
        $('body').addClass('ofp');
        $('.mdls.popup-'+$(this).attr('href').substr(7)).fadeIn(200);
        return false;
    });


    $('#content select').selectpicker();

    $('body.page-template-tpl-stories #sortable').change(function(){
        document.cookie = "blogSort="+this.value+"; path=/;";
        location.reload();
    });

    $('body.page-template-tpl-stories #pageMenu .nav a.blog_cat').click(function(){
        document.cookie = "blogCat="+ $(this).data('href') +"; path=/;";
        location.reload();
        return false;
    });

    $('.area-events').on('click','.showEvent',function(){
        $(this).addClass('hidden').closest('.item').find('.col-md-6').addClass('true');
    });

    $(document).bind('gform_post_render',function(e){
        $('.gform_wrapper select:nth-child(1)').selectpicker();
    });

    $('.showForm').click(function(){
        $(this).siblings('.gform_wrapper').fadeToggle(200);
    });

    setTimeout(function(){$('#preloader').fadeToggle(400)},500);

});