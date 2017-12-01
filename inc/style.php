<script>ajax_url = "<?= admin_url('admin-ajax.php'); ?>"; home_url = "<?= home_url(); ?>";</script>
<style>
    body .vc_general[class*="vc_btn"], .ih-btn {background:<?= bg1; ?>!important;border-color:<?= bg1; ?>!important;color:<?= cr1; ?>!important}
    body .vc_general[class*="vc_btn"]:hover, .ih-btn:hover {background:<?= cr1; ?>!important;color:<?= bg1; ?>!important}
    .ih-btn svg {stroke:<?= cr1; ?>}
    .ih-btn:hover svg {stroke:<?= bg1; ?>}

    body .btn2 .vc_general[class*="vc_btn"], .ih-btn.btn2 {background:<?= bg2; ?>!important;border-color:<?= bg2; ?>!important;color:<?= cr2; ?>!important}
    body .btn2 .vc_general[class*="vc_btn"]:hover, .ih-btn.btn2:hover {background:<?= cr2; ?>!important;color:<?= bg2; ?>!important}
    .ih-btn.btn2 svg {stroke:<?= cr2; ?>}
    .ih-btn.btn2:hover svg {stroke:<?= bg2; ?>}

    body .btn3 .vc_general[class*="vc_btn"], .ih-btn.btn3 {background:<?= bg3; ?>!important;border-color:<?= bg3; ?>!important;color:<?= cr3; ?>!important}
    body .btn3 .vc_general[class*="vc_btn"]:hover, .ih-btn.btn3:hover {background:<?= cr3; ?>!important;color:<?= bg3; ?>!important}
    .ih-btn.btn3 svg {stroke:<?= cr3; ?>}
    .ih-btn.btn3:hover svg {stroke:<?= bg3; ?>}

    body .gray > .vc_general[class*="vc_btn"], .ih-btn.btn4 {background:<?= bg4; ?>!important;border-color:<?= bg4; ?>!important;color:<?= cr4; ?>!important}
    body .gray > .vc_general[class*="vc_btn"]:hover, .ih-btn.btn4:hover {background:<?= cr4; ?>!important;color:<?= bg4; ?>!important}
    .ih-btn.btn4 svg {stroke:<?= cr4; ?>}
    .ih-btn.btn4:hover svg {stroke:<?= bg4; ?>}

    .ih-btn.btn5 {background:<?= bg5; ?>!important;border-color:<?= bg5; ?>!important;color:<?= cr5; ?>!important}
    .ih-btn.btn5:hover {background:<?= cr5; ?>!important;color:<?= bg5; ?>!important}
    .ih-btn.btn5 svg {stroke:<?= cr5; ?>}
    .ih-btn.btn5:hover svg {stroke:<?= bg5; ?>}

    <?php $pal = ( palette ) ? [bg5] : [bg2]; ?>

    #header .search_a {fill:<?= cr1; ?>}
    #header .search_b {fill:<?= bg1; ?>}

    #search .sbg svg {fill:<?= bg2; ?>}
    #search input {border-color:<?= palette ? bg5 : bg2; ?>;color:<?= cr2; ?>}
    #search input::-webkit-input-placeholder {color:<?= cr2; ?>}
    #search input::-moz-placeholder {color:<?= cr2; ?>}
    #search input:-ms-input-placeholder {color:<?= cr2; ?>}
    #search input:-moz-placeholder {color:<?= cr2; ?>}
    #search .sclose svg .close-a {fill:<?= cr2; ?>}
    #search .sclose svg .close-b {stroke:<?= bg2; ?>}
    #search .sclose svg:hover .close-b {stroke:<?= cr3; ?>}
    #search .sclose svg:active .close-a {stroke:<?= cr3; ?>}
    #search .sclose svg:active .close-b {stroke:<?= cr3; ?>}

    <?php $pal = ( palette ) ? [bg1,cr1] : [bg3,cr3]; ?>

    .area-member .popup .ih-btn.btn4 {background:<?= $pal[0]; ?>!important;border-color:<?= $pal[0]; ?>!important;color:<?= $pal[1]; ?>!important}
    .area-member .popup .ih-btn.btn4:hover {background:<?= $pal[1]; ?>!important;color:<?= $pal[0]; ?>!important}
    .area-member .popup .ih-btn.btn4 svg {stroke:<?= $pal[1]; ?>}
    .area-member .popup .ih-btn.btn4:hover svg {stroke:<?= $pal[0]; ?>}
    .area-member .popup svg .close-a {fill:<?= $pal[0]; ?>}
    .area-member .popup svg .close-b {stroke:<?= $pal[1]; ?>}
    .area-member .popup svg:hover .close-a {fill:transparent}

    .social svg:hover path {fill:<?= palette ? bg1 : bg3; ?> !important;}
    .area-slider .item:after {background: linear-gradient( to top, <?= bg2; ?>, transparent)}

    <?php if  ( palette ) { ?>
    .area-slider .ih-btn {background:<?= bg3; ?>!important;border-color:<?= bg3; ?>!important;color:<?= bg1; ?>!important}
    .area-slider .ih-btn:hover {background:<?= bg1; ?>!important;color:<?= bg3; ?>!important}
    .area-slider .ih-btn svg {stroke:<?= bg1; ?>}
    .area-slider .ih-btn.hover svg {stroke:<?= bg3; ?>}
    <?php } else { ?>
    .area-gallery .addGallery {background:<?= cr4; ?>!important;border-color:<?= cr4; ?>!important;color:<?= bg4; ?>!important}
    .area-gallery .addGallery:hover {background:<?= bg4; ?>!important;color:<?= cr4; ?>!important}
    .area-gallery .addGallery svg {stroke:<?= bg4; ?>}
    .area-gallery .addGallery:hover svg {stroke:<?= cr4; ?>}
    <?php } ?>

    .area-forms .vc-mid.bg3 .gform_wrapper .ih-btn {background:<?= bg1; ?>;border-color:<?= bg1; ?>;color:<?= cr1; ?>}
    .area-forms .vc-mid.bg3 .gform_wrapper .ih-btn:hover {background:<?= cr1; ?>;color:<?= bg1; ?>}
    .area-forms .vc-mid.bg3 .gform_wrapper .ih-btn:hover svg {stroke:<?= bg1; ?>}

    .popup .gform_wrapper .ih-btn {background:<?= bg3; ?>;border-color:<?= bg3; ?>;color:<?= cr3; ?>}
    .popup .gform_wrapper .ih-btn:hover {background:<?= cr3; ?>;color:<?= bg3; ?>}

    .bootstrap-select .dropdown-menu {background:<?= bg3; ?>;color:<?= cr3; ?> !important}

    button.dropdown-toggle,
    button.dropdown-toggle:hover,
    .gform_wrapper textarea,
    .gform_wrapper select,
    .gform_wrapper input {border-bottom-color:<?= cr_input; ?> !important;}

    .gform_wrapper textarea:focus,
    .gform_wrapper select:focus,
    .gform_wrapper input:focus {border-color:<?= cr_input; ?> !important;}

    .gform_wrapper input[type="radio"]:checked:before,
    .gform_wrapper input[type="checkbox"]:checked:before {border-color:<?= cr_input; ?>!important;}
    .gform_wrapper input[type="radio"]:checked:after {background:<?= cr_input; ?>!important;}
    .gform_wrapper input[type="checkbox"]:checked:after {color:<?= cr_input; ?>!important;}

    #page .bg1 {background:<?= bg1; ?>!important;color:<?= cr1; ?>}
    #page .bg2 {background:<?= bg2; ?>!important;color:<?= cr2; ?>}
    #page .bg3 {background:<?= bg3; ?>!important;color:<?= cr3; ?>}
    #page .bg4 {background:<?= bg4; ?>!important;color:<?= cr4; ?>}
    #page .bg5 {background:<?= bg5; ?>!important;color:<?= cr5; ?>}
    #page .bg6 {background:<?= bg6; ?>!important;color:<?= cr6; ?>}
    #page .bgc1 {color:<?= bg1; ?>!important;}
    #page .bgc2 {color:<?= bg2; ?>!important;}
    #page .bgc3 {color:<?= bg3; ?>!important;}
    #page .bgc4 {color:<?= bg4; ?>!important;}
    #page .bgc5 {color:<?= bg5; ?>!important;}
    #page .bgc6 {color:<?= bg6; ?>!important;}

    <?php if ( palette ) { ?>
    #page #footer { background: #292929 !important;}
    <?php } ?>
</style>