var galG = [], galG_t = [], galG_n = [], galArray = [];

galG[1] = '<div class="col-sm-6">' +
    '<div class="col-60">' +
        '<div>' +
            '<div data-num="-1" class="gal img-3"></div>' +
        '</div>' +
    '</div>' +
    '<div class="col-40">' +
        '<div>' +
            '<div data-num="-1" class="gal img-2"></div>' +
        '</div>' +
        '<div class="clear"></div>' +
        '<div class="col-sm-6 col-xs-6">' +
            '<div data-num="-1" class="gal img-1"></div>' +
        '</div>' +
        '<div class="col-sm-6 col-xs-6">' +
            '<div data-num="-1" class="gal img-1"></div>' +
        '</div>' +
    '</div>' +
'</div>';

galG[2] = '<div class="col-sm-6">' +
    '<div class="col-60">' +
        '<div>' +
            '<div data-num="-1" class="gal img-3"></div>' +
        '</div>' +
    '</div>' +
    '<div class="col-40">' +
        '<div class="col-sm-6 col-xs-6">' +
            '<div data-num="-1" class="gal img-1"></div>' +
        '</div>' +
        '<div class="col-sm-6 col-xs-6">' +
            '<div data-num="-1" class="gal img-1"></div>' +
        '</div>' +
        '<div class="clear"></div>' +
        '<div>' +
            '<div data-num="-1" class="gal img-2"></div>' +
        '</div>' +
    '</div>' +
'</div>';


galG[3] = '<div class="col-sm-6">' +
    '<div class="col-40">' +
        '<div>' +
            '<div data-num="-1" class="gal img-2"></div>' +
        '</div>' +
        '<div class="clear"></div>' +
        '<div class="col-sm-6 col-xs-6">' +
            '<div data-num="-1" class="gal img-1"></div>' +
        '</div>' +
        '<div class="col-sm-6 col-xs-6">' +
            '<div data-num="-1" class="gal img-1"></div>' +
        '</div>' +
    '</div>' +
    '<div class="col-60">' +
        '<div>' +
            '<div data-num="-1" class="gal img-3"></div>' +
        '</div>' +
    '</div>' +
'</div>';

galG[4] = '<div class="col-sm-6">' +
    '<div class="col-40">' +
        '<div class="col-sm-6 col-xs-6">' +
            '<div data-num="-1" class="gal img-1"></div>' +
        '</div>' +
        '<div class="col-sm-6 col-xs-6">' +
            '<div data-num="-1" class="gal img-1"></div>' +
        '</div>' +
        '<div class="clear"></div>' +
        '<div>' +
            '<div data-num="-1" class="gal img-2"></div>' +
        '</div>' +
    '</div>' +
    '<div class="col-60">' +
        '<div>' +
            '<div data-num="-1" class="gal img-3"></div>' +
        '</div>' +
    '</div>' +
'</div>';



function galleryRow ( gal ) {
    if ( galG_t[gal] > 4 ) galG_t[gal] = 1;
    jQuery(".gallery-"+gal).append(galG[galG_t[gal]++]).append(galG[galG_t[gal]++]);
}


function galleryImg ( gal ) {
    var num = galG_n[gal] ;
    for ( var g = num; g < num + 8; g++ ) {
        if ( galArray[gal].length <= g ) {
            jQuery('button.addGallery[data-gal="'+gal+'"]').hide();
            break;
        }
        jQuery(".gallery-"+gal+" .gal:eq("+g+")").css("background-image","url("+ galArray[gal][g] +")").attr("data-gallery",gal).attr("data-num",g).attr("data-popup",gal);
        galG_n[gal]++;
    }
}

jQuery('button.addGallery').click(function(){
    var g = jQuery(this).attr('data-gal');
    galleryRow(g);
    galleryImg(g);
});

jQuery('.area-gallery').on('click','.gal',function(){
    var a = jQuery(this).attr('data-gallery');
    var b = parseInt(jQuery(this).attr('data-num'));
    jQuery('.area-gallery .popup-'+a+' .owl-carousel').trigger('to.owl.carousel',b);
});