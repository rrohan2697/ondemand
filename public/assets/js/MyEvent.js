var MyEvent = function () {
    this.__construct = function () {
    
        this.adminForm(); 
        this.logout();
        this.AdminProfilePic();   
        this.submitCommonForm(); 
        this.userStatusChange();
        this.doDelete();
        this.commonWrapper();
        this.activeInactive();
        this.changeOrderStatus();
        this.sendNotificationSubmit();
        this.changeServiceStatus();
        this.changeServiceProvider();
        this.categorychange();
    };
    
    this.adminForm = function () {
        $(document).on('submit', '#loginform,#verifyEmailForm,#resetPassword', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            var form = $(this)[0];
            $.post(url, postdata, function (out) {
                $('.error').remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parents("p").append('<span class="error text-danger "><p style="text-align : left;">' + out.errors[i] + '</p></span>');
                        $("#" + i).focus();
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
    
    this.logout = function(){
        $(document).on('click', '#logout', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            swal({
              title: "Logout.?",
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
                            if(i =='recommended'){
                         $('.recommended_chk').append('<span class="error text-danger">' + out.errors[i] + '</span>');


                            }else{
                            $("." + i).parents(".form-group").append('<span class="error text-danger">' + out.errors[i] + '</span>');
                            $("." + i).focus();
                        }
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
     this.changeOrderStatus = function () { 
        $(document).on('change', '#order_status', function (e) {
            e.preventDefault(e);
            $(".loader").show();
            var url = $(this).attr('data-url');
            var postdata = $(this).val();
            $.post(url, {status: postdata}, function (out) {
                 $(".loader").hide();
                  if (out.result === 1) {
                    swal( out.msg);
                     window.setTimeout(function () {
                        if (out.url) {
                            window.location.href = out.url;
                        }
                    }, 2000);
                }
                if (out.result === -1) {
                    swal( out.msg);
                }
            });
        });
    };
    
    this.changeServiceProvider = function () { 
        $(document).on('change', '#service_provider', function (e) {
            e.preventDefault(e);
            $(".loader").show();
            var url = $(this).attr('data-url');
            var postdata = $(this).val();
            $.post(url, {provider_id: postdata}, function (out) {
                $(".loader").hide();
                  if (out.result === 1) {
                    swal( out.msg);
                }
                if (out.result === -1) {
                    swal( out.msg);
                }
            });
        });
    };
    
    this.changeServiceStatus = function () { 
        $(document).on('change', '#service_status', function (e) {
            e.preventDefault(e);
            $(".loader").show();
            var url = $(this).attr('data-url');
            var postdata = $(this).val(); 
        $.post(url, {status: postdata}, function (out) {
                $(".loader").hide();
                if (out.result === 1) {
                    swal( out.msg);
                }
                if (out.result === -1) {
                    swal( out.msg);
                }
            });
        });
    };
    
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
    this.categorychange = function (){
        $(document).on('change', '#category_name',function(){
           var category_id = $(this).val();
            if($(this).val() != ""){
                var url = $(this).data('url');
                $(".loader").fadeIn();
                $.post(url, {category_id : category_id}, function(out){
                    $(".loader").fadeOut();
                    $("#sub_cat").html(out.contentWrapper);
                })
            }
        })
    }
    };

    this.__construct();
};
var obj = new MyEvent();