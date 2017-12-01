var stories = [];

jQuery('button.addStory').click(function(){
    var b = jQuery(this);
    var s = parseInt(b.attr('data-story'));
    var a = b.siblings('i.gi-animate');
    b.hide();
    a.addClass('on');
    jQuery.post( ajax_url, { action: 'stories', story: s, cat: stories[s][2], num : stories[s][0], order: stories[s][1] }, function(data) {
        jQuery('.area-stories .story-'+s).append(data);
        stories[s][0] += 2;
        a.removeClass('on');
        if ( stories[s][0] === jQuery('.area-stories .story-'+s+' .col-md-6').length ) b.fadeIn(200);
    });
});

jQuery('button.addEvent').click(function(){
    var b = jQuery(this);
    var a = b.siblings('i.gi-animate');
    b.hide();
    a.addClass('on');
    jQuery.post( ajax_url, { action: 'events', from: events[0], num : events[1] }, function(data) {
        jQuery('.area-events .events').append(data);
        events[1] += 2;
        a.removeClass('on');
        if ( events[1] === jQuery('.area-events .events .col-md-6').length ) b.fadeIn(200);
        if ( jQuery('.area-events .events .col-md-6').length < 1 ) jQuery('.area-events .events').html('No future events');
    });
});