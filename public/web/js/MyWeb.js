var MyWeb = function () {
    this.__construct = function () {
    
        this.adminForm(); 
        this.logout();
        this.categoryFilter();
        this.doCategoryFilter();
        this.addtocart();
        this.imageCommonForm();
        this.emptyBook();
        this.removeAddress();
        this.cancelBooking();
        this.cartWrapper();
        this.cartQuantity();
        this.addRating();
        this.addressWrapper();
    };
    
    
    
    this.adminForm = function () {
        $(document).on('submit', '#userLogin,#address,#booking,#payment', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var error = $(this);
            if($(this).attr('id') == "payment" || $(this).attr('id') == "address" || $(this).attr('id') == "email" || $(this).attr('id') == "sms" ){
                var payment_id = "payment";
            }
            var postdata = $(this).serialize();
            var form = $(this)[0];
            $.post(url, postdata, function (out) {
                $('.error').remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        if(payment_id){
                            if(i == "rating"){
                                $("#" + i).after('<span class="error text-danger">' + out.errors[i] + '</span>');
                            }else{
                                $("#" + i).parents(".form-group").append('<span class="error text-danger">' + out.errors[i] + '</span>');    
                            }
                            
                        }else{
                            $("#" + i).parents(".form-group").after('<span class="error text-danger">' + out.errors[i] + '</span>');
                        }
                        
//                        $("#" + i).focus();
                    }
                }
                if (out.result === -1) {
                    var message = '<span class="close" data-dismiss="alert" aria-label="Close"></span>';
                    $(error).find("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $(error).find("#error_msg").html(message + out.msg);
                    window.setTimeout(function () {
                        $(error).find('#error_msg').slideUp();
                    }, 2000);
                }
                if (out.result === 1) {
                    form.reset();
                    // swal("Good job!", "You clicked the button!", "success");
                    var message = '<span class="close" data-dismiss="alert" aria-label="Close"></span>';
                    $(error).find("#error_msg").removeClass('alert-warning alert-danger').addClass('alert alert-success alert-dismissable').show();
                    $(error).find("#error_msg").html(message + out.msg);
                    window.setTimeout(function () {
                        $(error).find('#error_msg').slideUp();
                        if (out.url) {
                            
                            window.location.href = out.url;
                        }
                    }, 2000);
                }if(out.result === 2){
                    form.reset();
                    swal(out.msg, "", "success"); 
                    
                }
                
            });
        });
    };
    
        this.imageCommonForm = function () {
        $(document).on('submit', '#profile', function (evt) {
            evt.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (out) {
                    $(".form-group > .error").remove();
                    if (out.result === 0) {
                        for (var i in out.errors) {
                            $("." + i).parents(".form-group").append('<span class="error text-danger">' + out.errors[i] + '</span>');
                            $("." + i).focus();
                        }
                    }
                    if (out.result === -2) {
                        for (var i in out.errors) {
                            $("." + i).parents(".form-group").append('<span class="error" style="margin-left:186px; color:red;">' + out.errors[i] + '</span>');
                            $("." + i).focus();
                        }
                    }
                    if (out.result === -1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                        if (out.url) {
                            window.location.href = out.url;
                        }
                    }
                    if (out.result === 1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $("#error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                        window.setTimeout(function () {
                            window.location.href = out.url;
                        }, 1000);
                    }
                }
            });
        });
    };

    

    
    this.removeAddress = function(){
        $(document).on('click', '.removeAddress', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            swal({
              title: "Are you sure you want to delete this address?",
              text: "",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        // swal(out.msg).delay(2000);
                        window.location.href = out.url;
                    } else if (out.result === -1) {
                        swal(out.msg);
                    }
                });
              } 
              else {
                swal("Process Aborted!");
              }
            });
        });
    }
    
    // this.sendEmail = function(){
    //     $(document).on('submit','#address1',function (evt){
    //      evt.preventDefault();   
    //      var url = $(this).attr("action");
    //       $.post(url, '', function (out) {
    //                 if (out.result === 1) {
    //                     swal("Good job!", "You clicked the button!", "success");
    //                 } 
    //             });
         
    //     });
    // };
    
    this.logout = function(){
        $(document).on('click', '#logout', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            swal({
              title: "Logout?",
              text: "Are you sure you want to Logout?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        // swal(out.msg).delay(2000);
                        window.location.href = out.url;
                    } else if (out.result === -1) {
                        swal(out.msg);
                    }
                });
              } 
              else {
                swal("You are safe in dashboard panel!!");
              }
            });
        });
    }
    
    this.cancelBooking = function(){
        $(document).on('click', '.cancel', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            swal({
              title: "Are you sure you want to Cancel this Booking?",
              text: "",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        // swal(out.msg).delay(2000);
                        window.location.href = out.url;
                    } else if (out.result === -1) {
                        swal(out.msg);
                    }
                });
              } 
              else {
                swal("Process Aborted!");
              }
            });
        });
    }
    
    
    this.AdminProfilePic = function () {
        $(document).on('submit', '#uploadImages, #editProfile', function (evt) {
            evt.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (out) {
                    $(".form-group > .error").remove();
                    if (out.result === 0) {
                        for (var i in out.errors) {
                            $("." + i).parents(".form-group").append('<span class="error text-danger">' + out.errors[i] + '</span>');
                            $("." + i).focus();
                        }
                    }
                    if (out.result === -2) {
                        for (var i in out.errors) {
                            $("." + i).parents(".form-group").append('<span class="error" style="margin-left:186px; color:red;">' + out.errors[i] + '</span>');
                            $("." + i).focus();
                        }
                    }
                    if (out.result === -1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                        if (out.url) {
                            window.location.href = out.url;
                        }
                    }
                    if (out.result === 1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $("#error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                        window.setTimeout(function () {
                            window.location.href = out.url;
                        }, 1000);
                    }
                }
            });
        });
    };
    this.submitCommonForm = function () {
        $(document).on('submit', '#common-form, #changePassword', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            var form = $(this)[0];
            $.post(url, postdata, function (out) {
                $('.error').remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("." + i).parents(".form-group").append('<span class="error text-danger"><p style="text-align : left;">' + out.errors[i] + '</p></span>');
                        $("." + i).focus();
                    }
                }
                if (out.result === -1) {
                    var message = '<span class="close" data-dismiss="alert" aria-label="Close"></span>';
                    $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    window.setTimeout(function () {
                        $('#error_msg').slideUp();
                    }, 2000);
                }
                if (out.result === 1) {
                    form.reset();
                    var message = '<span class="close" data-dismiss="alert" aria-label="Close"></span>';
                    $("#error_msg").removeClass('alert-warning alert-danger').addClass('alert alert-success alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    window.setTimeout(function () {
                        $('#error_msg').slideUp();
                        if (out.url) {
                            window.location.href = out.url;
                        }
                    }, 2000);
                }
            });
        });
    };

    this.userStatusChange = function(){
        $(document).on('change', '.user_status, .change_status', function (evt) {
            evt.preventDefault();
            var url = $(this).data('url');
            var selt = $(this).val();
            $.post(url, {selt:selt}, function (out) {
                if (out.result === 1) {
                    swal( out.msg);
                }
                if (out.result === -1) {
                    swal( out.msg);
                }
            });
        });
    }

    this.doDelete = function () {
        $(document).on('click', '.delete', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');

            swal({
                title: "Are you sure you want to Delete?",
                text: "Once deleted, you will not be able to recover this Record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {

                        $.post(url, '', function (out) {
                            if (out.result === 1) {
                                window.location.href = out.url;

                            } else if (out.result === -1) {
                                var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                                $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                                $("#error_msg").html(message + out.msg);
                                $("#error_msg").fadeOut(2000);
                            }
                        });
                    } else {
                        swal("Your imaginary record is safe!!");
                    }
                });
        });
    };

    this.commonWrapper = function (){
        $('document').ready(function () {
            var url = $('#banner-images').data('url');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#banner-images').html(out.content_wrapper);
                    $("#example-1").dataTable({
                        responsive: true,
                        aLengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ]
                    });
                }
            });
        });
    }

    this.activeInactive = function(){
        $(document).on('click', '.change-status', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === -1) {
                    swal( out.msg);
                }
                if (out.result === 1) {
                    window.setTimeout(function () {
                        $('#error_msg').slideUp();
                        if (out.url) {
                            window.location.href = out.url;
                        }
                    }, 2000);
                }
            });
        });
    }
    
    this.sendNotificationSubmit = function () {
        $(document).on('click', '.notify', function (evt) {
            evt.preventDefault();
            if ($('.user_id:checked').length > 0) {
                var url = $(this).attr('href');
                var user_id = [];
                $.each($(".user_id:checked"), function () {
                    user_id.push($(this).val());
                });
                $.post(url, {user_id: user_id}, function (out) {
                    if (out.result === 1) {
                        $('#send-notification-wrapper').html(out.notification_wrapper);
                        $('#notificationModal').modal('show');
                    }
                });
            } else {
                swal("Please select ...", "A user to send Message!");
            }
        });


        $(document).on('click', '.check', function () {
            if($(this).prop("checked") === true){
                $(".user_id").prop("checked", true);
            }
            else if($(this).prop("checked") === false){
                $(".user_id").prop("checked", false);
            }
        });
        
        $(document).on('submit', '#send-notification', function (evt) {
            evt.preventDefault();
            $("body").append('<div class="loaddata"></div>');
            $(".loaddata").fadeOut("slow");

            var url = $(this).attr("action");
            var postdata = $(this).serialize();

            $.post(url, postdata, function (out) {
                $(".form-group > .text-danger").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parents(".form-group").append('<span class="text-danger">' + out.errors[i] + '</span>');
                    }
                }
                if (out.result === 1) {
                    $('#notificationModal').modal('hide');
                    swal( out.msg);
                    
                    // var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    // $(".error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                    // $(".error_msg").html(message + out.msg);
                    // $(".error_msg").fadeOut(2000);
                    
                }
                if (out.result === -1) {
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $(".error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $(".error_msg").html(message + out.msg);
                    $(".error_msg").fadeOut(2000);
                }
            });
        });
    };
    
    this.categoryFilter = function () {
        var url = $("#category_wrapper").data('url');
        $.post(url, function (res) {
            $("#category_wrapper").html(res.content_wrapper);
        })
    }
     
     this.doCategoryFilter = function () {
        $(document).on('click', '#categoryFilter', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("href");
             $('.clickhere').removeClass('active');
        $(this).parent('.clickhere').addClass('active');
            $.post(url, function (out) {
                if (out.result === 1) {
//                    alert(out.content_wrapper)
                    $('#category_wrapper').html(out.content_wrapper);
                }
            });

        });
    };
    
     this.addressWrapper = function () {
        // $(document).on('click', '.editaddress', function(evt){
        //     evt.preventDefault();
        //     $("#editModal").modal('show');
        //     var url = $(this).data("url");
        //     $.post(url, '', function (out) {
        //         $("#address_wrapper").html(out.content_wrapper);
                
                
        //     });
        // })
    }

    
    this.cartWrapper = function () {
        var url = $("#conent_cart_wrapper").data('url');
        $.post(url, function (res) {
            $("#conent_cart_wrapper").html(res.content_wrapper);
            $( "#datepicker" ).datepicker({
                    minDate: 0,
                    dateFormat: 'd MM, yy'
                });
        })
    }  
    this.cartQuantity = function () {
        
    $(document).on('click', '.plus_btn',function (e) {
        e.preventDefault();
        var $n = $(this).parent(".vaulebox").find(".qty");
        var qty = Number($n.val()) + 1;
        $n.val(qty)
        var url = $(this).parent(".valuebox_add").data('url');
        $.post(url, {qty : qty}, function(){
            var url1 = $("#conent_cart_wrapper").data('url');
            $.post(url1, function (res) {
                $("#conent_cart_wrapper").html(res.content_wrapper);
                $( "#datepicker" ).datepicker({
                    minDate: 0,
                    dateFormat: 'd MM, yy'
                });
                
            })
        })
    });

    $(document).on('click', '.minus_btn',function (e) {
        e.preventDefault();
        var $n = $(this).parent(".vaulebox").find(".qty");
        var amount = Number($n.val());
        if (amount > 0) {
            $n.val(amount - 1);
            var qty = amount - 1;
            var url = $(this).parent(".valuebox_add").data('url');
            $.post(url, {qty : qty}, function(){
                var url1 = $("#conent_cart_wrapper").data('url');
                $.post(url1, function (res) {
                    $("#conent_cart_wrapper").html(res.content_wrapper);
                    $( "#datepicker" ).datepicker({
                    minDate: 0,
                    dateFormat: 'd MM, yy'
                });
                    
                })
            })
        }
    });

    }
    
    this.addtocart = function () {
      $(document).on('click', '.productAddToCart', function (evt) {
        evt.preventDefault();
           var url = $(this).attr('href');
                $.post(url, '', function(out)  {
                    if (out.result === 1) {
          swal("Service Added to Cart", "", "success")
              window.setTimeout(function () {
                            location.reload();
                        }, 2000);          
                    }
           });
                
        });
    };
    
    
    this.addRating = function () {
        $(document).on('click', '.rating_chk li a', function(){
            var rating = $(this).data('rating');
            $(this).parent('li').parent('ul').find('a').removeClass('filled_color');
            $(".rating_chk li a").each(function(){
                if($(this).data('rating') <= rating){
                    $(this).addClass('filled_color');
                    $("#rating").val(rating);
                }
            })
        })
    }
    
this.emptyBook = function () {
      $(document).on('click', '.emptybook', function (evt) {
        evt.preventDefault();
           
          swal("Oops", "Please select any service to continue.");
              
          
                
        });
    };
    this.__construct();
};
var obj = new MyWeb();