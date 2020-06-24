
// Add / Remove Product Start

$(".plus_btn").click(function () {
    var $n = $(this).parent(".vaulebox").find(".qty");
    $n.val(Number($n.val()) + 1);
});

$(".minus_btn").click(function () {
    var $n = $(this).parent(".vaulebox").find(".qty");
    var amount = Number($n.val());
    if (amount > 0) {
        $n.val(amount - 1);
    }
});

$(document).on('click','.navbar-expand-md .navbar-nav .nav-link' ,function(){
    $('.navbar-expand-md .navbar-nav .nav-link').removeClass('active');
    $(this).addClass('Active');
});

$(document).on('click', '.radio label', function () {
    $('.creditInput').hide();
    $(this).siblings('.creditInput').slideToggle();
});
document.addEventListener("mousedown", function (event) {
    if (event.target.closest(".creditInput"))
        return;
    $('.creditInput').slideUp();
});
$(document).on('click', '.referBtn button', function () {
    $('.AddPromo').hide();
    $('.promoShow').show();
});
$(document).on('click', '.removePromo', function () {
    $('.promoShow').hide();
    $('.AddPromo').show();
});


$(document).on('click', '.plus', function () {
    $('.AddPromo a').removeClass('plus').addClass('minus');
    $('.AddPromo a span i').removeClass('fa fa-plus').addClass('fa fa-minus');
    $('.referPromo').slideDown();
});
$(document).on('click', '.minus', function () {
    $('.AddPromo a').removeClass('minus').addClass('plus');
    $('.AddPromo a span i').removeClass('fa fa-minus').addClass('fa fa-plus');
    $('.referPromo').slideUp();
});
$(document).on('click', '.radio label', function () {
    $('.enterCvv').hide();
    $(this).siblings('.enterCvv').slideToggle();
});
$(document).on('click', '.radioadd label', function () {
    $('.creditInput.creditInput2').slideDown(1000);
});
$(document).on('click', '.addressBtn button', function () {
    $('.creditInput.creditInput2').slideUp(1000);
});
$(document).on('click', '.saveAs button', function () {
    $('.saveAs button').removeClass('savAct');
    $(this).addClass('savAct');
});

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}


//image upload code start
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = $(input).parent("div").siblings('.avatar-preview').children('div');
            //            alert((img).attr("id"))
            $(img).css('background-image', 'url(' + e.target.result + ')');
            $(img).hide();
            $(img).fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).on('change', "#imageUpload", function () {
    readURL(this);
});


//image upload code end


$(document).on('click', '.timeAll button', function () {
    $('.timeAll button').removeClass('btnBack');
    $(this).addClass('btnBack');
});

// Fixed Header Start

$(window).scroll(function () {

    if ($(window).scrollTop() >= 1) {
        $('.header').addClass('fixedHeader');
    } else {
        $('.header').removeClass('fixedHeader');
    }
});

// Fixed Header Start

// Dropdown Start

$(document).ready(function () {
    $('a.subMenu').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).parent('.afterLogin').find('.dropBox').slideUp();
        } else {
            $('a.subMenu').removeClass('active');
            $('.afterLogin').find('.dropBox').slideUp()
            $(this).addClass('active');
            $(this).parent('.afterLogin').find('.dropBox').slideDown();
        }
    });
});

$(document).ready(function () {
    $(document).on("click", function (event) {
        var $trigger = $(".afterLogin");
        if ($trigger !== event.target && !$trigger.has(event.target).length) {
            $(".afterLogin .dropBox").slideUp("fast");
            $('a.subMenu').removeClass('active');
        }
    });
});

// Dropdown End

// Notification List Box Start

$('.notificationsList').click(function () {
    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $(this).parents('.navbar-default').find('.notificationBox').slideUp();
    } else {
        $(this).addClass('active');
        $(this).parents('.navbar-default').find('.notificationBox').slideDown();
    }
});

$(document).ready(function () {
    $(document).on("click", function (event) {
        var $trigger = $(".navbar-default");
        if ($trigger !== event.target && !$trigger.has(event.target).length) {
            $(".navbar-default .notificationBox").slideUp("fast");
            $('a.notificationsList').removeClass('active');
        }
    });
});

// Notification List Box End


// Add Address Field Start

$(document).ready(function () {
    $('.addrSection').click(function () {
        if ($(this).hasClass('show')) {
            $(this).parents('.selectAddress').find('.addrInner').slideUp();
            $(this).removeClass('show');
        } else {
            $('.addrSection').removeClass('show');
            $(this).addClass('show');
            $('.addrInner').slideUp();
            $(this).parents('.selectAddress').find('.addrInner').slideDown();
        }
    });
});
$(document).ready(function () {
    $('.addrInner li').click(function () {
        var elm = $(this).text();
        var elm2 = $(this).parents('.selectAddress').find('li.addrSection').text(elm);
        $(this).parents('.selectAddress').find('li.addrSection').removeClass('show');
        $(this).parents('.addrInner').slideUp();
    });
});

$(document).ready(function () {
    $(document).on("click", function (event) {
        var $trigger = $(".chooseAddress");
        if ($trigger !== event.target && !$trigger.has(event.target).length) {
            $(".addrInner").slideUp("fast");
            $('.selectAddress ul li.addrSection').removeClass('show');
        }
    });
});

// Add Address Field End


// Home Banner Slider Start

$('.bannerSlider').slick({
    dots: true,
    arrows: false,
    autoplay: false,
    autoplaySpeed: 3000,
    infinite: false,
    speed: 1000,
    slidesToShow: 1,
    adaptiveHeight: false,
});

// Home Banner Slider End

// Services Provided Slider Start

$('.servicesSlider').slick({
    dots: false,
    arrows: true,
    autoplay: false,
    autoplaySpeed: 3000,
    infinite: false,
    speed: 1000,
    slidesToShow: 6,
    adaptiveHeight: false,

    responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 5,
            }
        },

        {
            breakpoint: 992,
            settings: {
                slidesToShow: 4,
            }
        },

        {
            breakpoint: 768,
            settings: {
                slidesToShow: 3,
            }
        },

        {
            breakpoint: 561,
            settings: {
                slidesToShow: 2,
            }
        },

    ]

});

// Services Provided Slider End

// Recommended Slider Start

$('.recommendedSlider').slick({
    dots: false,
    arrows: true,
    autoplay: false,
    autoplaySpeed: 3000,
    infinite: false,
    speed: 1000,
    slidesToShow: 4,
    adaptiveHeight: false,

    responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
            }
        },

        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            }
        },

        {
            breakpoint: 561,
            settings: {
                slidesToShow: 1.3,
            }
        },

    ]

});

// Recommended Slider End

// Product List Slider Start

$('.productlistSlider').slick({
    dots: false,
    arrows: true,
    autoplay: false,
    autoplaySpeed: 3000,
    infinite: false,
    speed: 1000,
    slidesToShow: 6,
    adaptiveHeight: false,
    responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 5
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 4
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 3
            }
        },
                         {
            breakpoint: 505,
            settings: {
                slidesToShow: 2,
                   slidesToScroll:2
            }
        },
                                          {
            breakpoint: 330,
            settings: {
                slidesToShow: 1
             
            }
        }
    ]

});



// Product List Slider End

// Product List in Tabs Start

$(document).ready(function () {
    $('.all').hide();
    $('.allswitch').show();
    $('.clickhere').click(function () {
        var type = $(this).data('type');
        $('.all').hide();
        $('.all' + type).fadeIn();
        $('.clickhere').removeClass('active');
        $(this).addClass('active');
    });
});

// Product List in Tabs End

//   Sidebar Start

$('.navbar-toggler').click(function () {
    if ($(this).parents('.navbar').find('.navbar-collapse').hasClass('show')) {
        $('.navbar-expand-md .navbar-collapse').css('left', '-250px');
    } else {
        $('.navbar-expand-md .navbar-collapse').css('left', '0px');
    }
});

//   Sidebar End

//   Navbar Button Style Start

$(document).ready(function () {
    $('.navbar-toggler').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active')
        } else {
            $(this).addClass('active')
        }
    });
});


//   Navbar Button Style End



// $(".minus_btn").click(function () {
//      var prodCount = $('.vaulebox').find('.qty').val();
//      if($(prodCount < 1)){
//         $('.categoriesInner').find('.bookNowbox').css('display','none');
//      }
// });

// Add / Remove Product End

// Add product button show Start

$(document).ready(function () {
    $('.productAdd').click(function () {
        $(this).parents('.vaulebox').find('.minus_btn').css('display', 'block');
        $(this).parents('.vaulebox').find('.qty').css('display', 'block');
        $(this).parents('.vaulebox').find('.productAdd').css('display', 'none');
        $(this).parents('.categoriesInner').find('.bookNowbox').css('display', 'block');
    });
});

// Add product button show End



// select 2 Start

$(document).ready(function () {
    $('.citySelect').select2();
});

// select 2 End




// My Cart Date Ang TIme Picker Start

// $(document).ready(function(){
//     var dateInput = $('#dateOptn').val();

//     if($(dateInput == '')){

//         // $('#dateOptn').prop("readonly", true);
//         $('#dateOptn').parent('input').css('background-color','red');
//         alert(dateInput);
//     }
//     else
//     {
//         $('#dateOptn').parent('input').css('background-color','green');
//     }
// });

// $(document).ready(function(){
//     var timeInput = $('#timeOptn').val();

//     if($(timeInput == '')){
//         $('#timeOptn').prop("readonly", true);
//     }
//     else
//     {
//         $('#timeOptn').prop("readonly", false);
//     }
// });

// My Cart Date Ang TIme Picker End


// Contact Number With Flag and Country Code Start

var input = document.querySelector("#phone2");
window.intlTelInput(input, {
    nationalMode: false,
    utilsScript: "https://appxhub.com/js/utils.js",
});

$('#phone2').click(function () {
    var elmcode = $(this).prev('.iti__flag-container').find('ul.iti__country-list').find('.iti__active').find(".iti__dial-code").text();
    $(this).val(elmcode + ' - ');
});

// Contact Number With Flag and Country Code End




$(document).ready(function () {
    $(document).on('click', '.myTab li a', function () {
        $('.myTab li a').removeClass('bookactive');
        $(this).addClass('bookactive');
    });
});


