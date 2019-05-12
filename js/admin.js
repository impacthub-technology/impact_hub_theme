(function($){

    var homeUrl = location.href.split('/wp-admin')[0];

    $('.acf-field-repeater[data-name="values_table"] div[data-name="values"] table tr').hover(function(){
        var a = $('.acf-field-repeater[data-name="headers_table"] tbody tr:eq('+ $(this).index() +') td.acf-field input').val();
        $(this).attr('title',a);
    });

    $('#customize-controls').on('change','#customize-control-select_palette select',function(){
        if ( this.value === 'none' ) return;
        var a = this.value.split(',');
        for ( var i = 1; i < 4; i++ ) {
            $('input[name="_customize-radio-color_bg_'+i+'"][value="'+a[i-1]+'"]').prop('checked',true).change();
            $('input[name="_customize-radio-color_font_'+i+'"][value="'+a[i+2]+'"]').prop('checked',true).change();
        }
    });

    $(document).on('change','.vc_ui-panel[data-vc-shortcode^="vc_module_"] select',function(){
        $('.vc_ui-panel .edit_form_line a.mod').remove();
        if ( this.value > 0 ) {
            var l = homeUrl + '/wp-admin/post.php?action=edit&post=' + this.value;
            var link = '<a href="' + l + '" class="mod button button-primary" target="_blank">Edit the content of this Module</a>';
            $('.vc_ui-panel .edit_form_line').append(link);
        }
    });

    $(document).on('click','li[id*="customize-control-color_bg_"] label',function(){
        $('select#_customize-input-select_palette').val('none');
    });

    setInterval(function(){

        if ( $('.vc_ui-panel.vc_active[data-vc-shortcode^="vc_module_"]').length ) {
            if ($('.vc_ui-panel.vc_active[data-vc-shortcode^="vc_module_"] .edit_form_line p.pmod').length) return;
            var a = $('.vc_ui-panel.vc_active[data-vc-shortcode^="vc_module_"] select option').length < 2
                ? 'You have not created any modules. <a href="' + homeUrl + '/wp-admin/post-new.php?post_type=modules" target="_blank">Click here to create</a>'
                : 'Choose from existing modules or <a href="' + homeUrl + '/wp-admin/post-new.php?post_type=modules" target="_blank">create a new one clicking here</a>';
            $('.vc_ui-panel .edit_form_line').append('<p class="pmod">' + a + '</p>');

            var val = $('.vc_ui-panel.vc_active[data-vc-shortcode^="vc_module_"] select').val();
            $('.vc_ui-panel.vc_active .edit_form_line a.mod').remove();
            if (val > 0) {
                var l = homeUrl + '/wp-admin/post.php?action=edit&post=' + val;
                var link = '<a href="' + l + '" class="mod button button-primary" target="_blank">Edit the content of this Module</a>';
                $('.vc_ui-panel.vc_active .edit_form_line').append(link);
            }
        }

    },2000);

    function changeMod() {
        var a = $('#page_template').val();
        var b = ( a === 'default' ) ? 'modules/example.png' : a.replace('.php','.png');
        $('.mod-example img').attr('src',homeUrl+'/wp-content/themes/webdesignsun/img/'+b);
    }

    if ( $('body').hasClass('post-type-modules') && $('#page_template').length ) changeMod();

    $('body.post-type-modules').on('change','#page_template',function(){changeMod()});


    var tabLi = $('.vc_ui-panel-header-content ul.vc_ui-tabs-line li');
    for ( var i = 0; i < tabLi.length; i++ ) {
        var a = tabLi.eq(i).find('button').text().trim();
        if ( a === 'Impact Hub Modules' ) tabLi.eq(i).addClass('ih-logo');
    }

    $(document).on('change','.vc_ui-panel.vc_active[data-vc-shortcode="vc_section"] [name="row-colors"]',function(){
        $('.vc_ui-panel.vc_active[data-vc-shortcode="vc_section"] input[name="el_class"]').val(this.value);
    });


})(jQuery);