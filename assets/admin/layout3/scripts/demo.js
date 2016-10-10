/**
Demo script to handle the theme demo
**/
var Demo = function () {

    // Handle Theme Settings
    var handleTheme = function () {

        var panel = $('.theme-panel');

        if ($('.page-head > .container-fluid').size() === 1) {
            $('.theme-setting-layout', panel).val("fluid");
        } else {
            $('.theme-setting-layout', panel).val("boxed");
        }

        if ($('.top-menu li.dropdown.dropdown-dark').size() > 0) {
            $('.theme-setting-top-menu-style', panel).val("dark");
        } else {
            $('.theme-setting-top-menu-style', panel).val("light");
        }

        if ($('body').hasClass("page-header-top-fixed")) {
            $('.theme-setting-top-menu-mode', panel).val("fixed");
        } else {
            $('.theme-setting-top-menu-mode', panel).val("not-fixed");
        }

        if ($('.hor-menu.hor-menu-light').size() > 0) {
            $('.theme-setting-mega-menu-style', panel).val("light");
        } else {
            $('.theme-setting-mega-menu-style', panel).val("dark");
        }

        if ($('body').hasClass("page-header-menu-fixed")) {
            $('.theme-setting-mega-menu-mode', panel).val("fixed");
        } else {
            $('.theme-setting-mega-menu-mode', panel).val("not-fixed");
        }

        //handle theme layout
        var resetLayout = function () {
            $("body").
            removeClass("page-header-top-fixed").
            removeClass("page-header-menu-fixed");

            $('.page-header-top > .container-fluid').removeClass("container-fluid").addClass('container');
            $('.page-header-menu > .container-fluid').removeClass("container-fluid").addClass('container');
            $('.page-head > .container-fluid').removeClass("container-fluid").addClass('container');
            $('.page-content > .container-fluid').removeClass("container-fluid").addClass('container');
            $('.page-prefooter > .container-fluid').removeClass("container-fluid").addClass('container');
            $('.page-footer > .container-fluid').removeClass("container-fluid").addClass('container');              
        };

        var setLayout = function () {

            var layoutMode = $('.theme-setting-layout', panel).val();
            var headerTopMenuStyle = $('.theme-setting-top-menu-style', panel).val();
            var headerTopMenuMode = $('.theme-setting-top-menu-mode', panel).val();
            var headerMegaMenuStyle = $('.theme-setting-mega-menu-style', panel).val();
            var headerMegaMenuMode = $('.theme-setting-mega-menu-mode', panel).val();
            
            resetLayout(); // reset layout to default state

            if (layoutMode === "fluid") {
                $('.page-header-top > .container').removeClass("container").addClass('container-fluid');
                $('.page-header-menu > .container').removeClass("container").addClass('container-fluid');
                $('.page-head > .container').removeClass("container").addClass('container-fluid');
                $('.page-content > .container').removeClass("container").addClass('container-fluid');
                $('.page-prefooter > .container').removeClass("container").addClass('container-fluid');
                $('.page-footer > .container').removeClass("container").addClass('container-fluid');

                //Metronic.runResizeHandlers();
            }

            if (headerTopMenuStyle === 'dark') {
                $(".top-menu > .navbar-nav > li.dropdown").addClass("dropdown-dark");
            } else {
                $(".top-menu > .navbar-nav > li.dropdown").removeClass("dropdown-dark");
            }

            if (headerTopMenuMode === 'fixed') {
                $("body").addClass("page-header-top-fixed");
            } else {
                $("body").removeClass("page-header-top-fixed");
            }

            if (headerMegaMenuStyle === 'light') {
                $(".hor-menu").addClass("hor-menu-light");
            } else {
                $(".hor-menu").removeClass("hor-menu-light");
            }

            if (headerMegaMenuMode === 'fixed') {
                $("body").addClass("page-header-menu-fixed");
            } else {
                $("body").removeClass("page-header-menu-fixed");
            }          
        };

        // handle theme colors
        var setColor = function (color) {
            var color_ = (Metronic.isRTL() ? color + '-rtl' : color);
            $('#style_color').attr("href", Layout.getLayoutCssPath() + 'themes/' + color_ + ".css");
            $('.page-logo img').attr("src", Layout.getLayoutImgPath() + 'logo-' + color + '.png');
        };

        $('.theme-colors > li', panel).click(function () {
            var color = $(this).attr("data-theme");
            setColor(color);
            $('.theme-colors > li', panel).removeClass("active");
            $(this).addClass("active");
        });

        $('.theme-setting-top-menu-mode', panel).change(function(){
            var headerTopMenuMode = $('.theme-setting-top-menu-mode', panel).val();
            var headerMegaMenuMode = $('.theme-setting-mega-menu-mode', panel).val();            

            if (headerMegaMenuMode === "fixed") {
                alert("The top menu and mega menu can not be fixed at the same time.");
                $('.theme-setting-mega-menu-mode', panel).val("not-fixed");   
                headerTopMenuMode = 'not-fixed';
            }                
        });

        $('.theme-setting-mega-menu-mode', panel).change(function(){
            var headerTopMenuMode = $('.theme-setting-top-menu-mode', panel).val();
            var headerMegaMenuMode = $('.theme-setting-mega-menu-mode', panel).val();            

            if (headerTopMenuMode === "fixed") {
                alert("The top menu and mega menu can not be fixed at the same time.");
                $('.theme-setting-top-menu-mode', panel).val("not-fixed");   
                headerTopMenuMode = 'not-fixed';
            }                
        });

        $('.theme-setting', panel).change(setLayout);

        $('.theme-setting-layout', panel).change(function(){
            Index.redrawCharts();  // reload the chart on layout width change
        });
    };

    // handle theme style
    var setThemeStyle = function(style) {
        var file = (style === 'rounded' ? 'components-rounded' : 'components');
        file = (Metronic.isRTL() ? file + '-rtl' : file);

        $('#style_components').attr("href", Metronic.getGlobalCssPath() + file + ".css");

        if ($.cookie) {
            $.cookie('layout-style-option', style);
        }


    };

    // Handle 
    var handlePromo = function() {

        var init = function() {
            var html = '';

            html  = '<div class="promo-layer" style="z-index: 100000; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0, 0.8)">';
            html += '   <div style="z-index: 100001; top: 50%; left: 50%; margin: -300px 0 0 -400px; width: 800px; height: 600px; position: fixed;">';
            html += '       <div class="row">';
            html += '           <div class="col-md-12" style="text-align: center">';
            html += '               <h3 style="color: white; margin-bottom: 30px; font-size: 28px; line-height: 36px; font-weight: 400;">You are one step behind in choosing a perfect <br>admin theme for your project.</h3>';
            html += '               <p style="color: white; font-size: 18px;">Just to recap some important facts about Metronic:</p>';
            html += '               <ul style="list-style:none; margin: 30px auto 20px auto; padding: 10px; display: block; width: 550px;  text-align: left; background: #fddf00;  color: #000000;transform:rotate(-2deg);">';
            html += '                   <li style="list-style:none; padding: 4px 8px; font-size: 15px;">';
            html += '                      <span style="display: inline-block; width: 10px; height: 10px; border-radius: 20px !important; background: rgba(0, 0, 0, 0.2); margin-right: 5px;  margin-top: 7px;"></span>';
            html += '                      The Most Popular #1 Selling Admin Theme of All Time.';
            html += '                   </li>';
            html += '                   <li style="list-style:none; padding: 4px 8px; font-size: 15px;">';
            html += '                      <span style="display: inline-block; width: 10px; height: 10px; border-radius: 20px !important; background: rgba(0, 0, 0, 0.2); margin-right: 5px;  margin-top: 7px;"></span>';
            html += '                      Trusted By Over 26000 Users Around The Globe.';
            html += '                   </li>';  
            html += '                   <li style="list-style:none; padding: 4px 8px; font-size: 15px;">';
            html += '                      <span style="display: inline-block; width: 10px; height: 10px; border-radius: 20px !important; background: rgba(0, 0, 0, 0.2); margin-right: 5px;  margin-top: 7px;"></span>';
            html += '                      Used By Listed Companies In Small To Enterprise Solutions.';
            html += '                   </li>';  
            html += '                   <li style="list-style:none; padding: 4px 8px; font-size: 15px;">';
            html += '                      <span style="display: inline-block; width: 10px; height: 10px; border-radius: 20px !important; background: rgba(0, 0, 0, 0.2); margin-right: 5px;  margin-top: 7px;"></span>';
            html += '                      Includes 500+ Templates, 80+ Plugins, 1000+ UI Components.';
            html += '                   </li>';  
            html += '                   <li style="list-style:none; padding: 4px 8px; font-size: 15px;">';
            html += '                      <span style="display: inline-block; width: 10px; height: 10px; border-radius: 20px !important; background: rgba(0, 0, 0, 0.2); margin-right: 5px;  margin-top: 7px;"></span>';
            html += '                      Backed By A Team With Combined 32 Years of Experience In The Field.';
            html += '                   </li>';  
            html += '                   <li style="list-style:none; padding: 4px 8px; font-size: 15px;">';
            html += '                      <span style="display: inline-block; width: 10px; height: 10px; border-radius: 20px !important; background: rgba(0, 0, 0, 0.2); margin-right: 5px;  margin-top: 7px;"></span>';
            html += '                      A Product Of Over 2 Years Of Continuous Improvements';
            html += '                   </li>'; 
            html += '                   <li style="list-style:none; padding: 4px 8px; font-size: 15px;">';
            html += '                      <span style="display: inline-block; width: 10px; height: 10px; border-radius: 20px !important; background: rgba(0, 0, 0, 0.2); margin-right: 5px;  margin-top: 7px;"></span>';
            html += '                      Get All The Above & Even More Just For 27$';
            html += '                   </li>'; 
            html += '               </ul>';
            html += '           </div>';
            html += '       </div>';
            html += '       <div class="row">';
            html += '           <div class="col-md-12" style="margin-top: 20px;">';
            html += '               <center><a class="btn btn-circle btn-danger btn-lg" style="padding: 12px 28px; font-size: 14px; text-transform: uppercase1;" href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes&utm_source=preview&utm_medium=banner&utm_campaign=Preview%20Engage" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Now!</a>';
            html += '               &nbsp;&nbsp;<a class="btn btn-circle btn-default btn-lg promo-remind" style="padding: 11px 28px; font-size: 14px; text-transform: uppercase1;background: none; color: #fff;" href="javascript:;">Remind Me Later</a>';
            html += '               <a class="btn btn-circle btn-default btn-lg promo-dismiss" style="padding: 12px 12px; font-size: 14px; text-transform: uppercase1; background: none; color: #aaa; border: 0" href="javascript:;">Dismiss</a></center>';
            html += '           </div>';
            html += '       </div>';
            html += '   </div>';
            html += '</div>';

            $('body').append(html);

            $('.promo-dismiss').click(function(){
                $('.promo-layer').remove();

                $.cookie('user-dismiss', 1, { expires: 7, path: '/' });
            });

            $('.promo-remind').click(function(){
                $('.promo-layer').remove();

                $.cookie('user-page-views', 1, { expires: 1, path: '/' });
            });
        }

        if ($.cookie) {
            var pageViews = $.cookie('user-page-views') ? parseInt($.cookie('user-page-views')) : 0;
            var userDismiss = $.cookie('user-dismiss') ? parseInt($.cookie('user-dismiss')) : 0;
            
            pageViews = pageViews + 1;
            $.cookie('user-page-views', pageViews, { expires: 1, path: '/' });

            //alert(pageViews);

            if (userDismiss === 0 && (pageViews === 10 || pageViews === 30 || pageViews === 50)) {
                setTimeout(init, 1000);
            }
        } else {
            return;
        }
    };

    return {

        //main function to initiate the theme
        init: function() {
            // handles style customer tool
            handleTheme(); 

            /*disable -- handlePromo();*/

            // handle layout style change
            $('.theme-panel .theme-setting-style').change(function() {
                 setThemeStyle($(this).val());
            });

            // set layout style from cookie
            if ($.cookie && $.cookie('layout-style-option') === 'rounded') {
                setThemeStyle($.cookie('layout-style-option'));  
                $('.theme-panel .theme-setting-style').val($.cookie('layout-style-option'));
            }            
        }
    };

}();