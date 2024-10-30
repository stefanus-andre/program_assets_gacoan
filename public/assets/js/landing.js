(function ($) {
    "use strict";
$('.demo-imgs .hover-link .html').on('click', function () {
    // debugger
    var type = $(this).attr("data-attr");
    var boxed = "";
    console.log(type)
    if ($(".page-wrapper").hasClass("landing-page")) {
        boxed = "landing-page";
    }
    
    switch (type) {
        case 'dark-sidebar':
        {
            $(".page-wrapper").attr("class", "page-wrapper compact-wrapper dark-sidebar"  + boxed);
            localStorage.setItem('page-wrapper', 'compact-wrapper dark-sidebar');
            break;
        }

        case 'box-layout':
        {
            $(".page-wrapper").attr("class", "page-wrapper compact-wrapper box-layout " + boxed);
            localStorage.setItem('page-wrapper', 'compact-wrapper box-layout');
            break;
        }

        case 'default':
        {
            $(".page-wrapper").attr("class", "page-wrapper compact-wrapper " + boxed);
            localStorage.setItem('page-wrapper', 'compact-wrapper');
            break;
        }

        default:
        {
            $(".page-wrapper").attr("class", "page-wrapper compact-wrapper " + boxed);
            localStorage.setItem('page-wrapper', 'compact-wrapper');
            break;
        }
    } 
    window.open('http://admin.pixelstrap.com/enzo/template/index.html', '_blank');
});


$('.layout-slider').owlCarousel({       
    items:4,
    loop:true,
    margin: 30,
    nav: false,
    autoplay: false,
    autoplayTimeout:5000,
    autoplayHoverPause:false,
     responsive: {
         320:{
            items:1
        },
        600:{
            items:2
         },
        1366:{
            items:3
        },

        1660: {
            items:4
         }
        
    }
});
    $('.product-details-box .close').on('click', function (e) {
        var tets = $(this).parent().parent().parent().parent().addClass('d-none');
        console.log(tets);
    })
   })(jQuery);