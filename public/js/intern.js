$(document).ready(function(){
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;
    setProgressBar(current);
    $(".next").click(function(){
        var email = $('.fieldset.active #email').val();
        var uname = $('.fieldset.active #uname').val();
        var password = $('.fieldset.active #password').val();
        var fname = $('.fieldset.active #fname').val();
        var lname =  $('.fieldset.active #lname').val();
        var address =  $('.fieldset.active #address').val();
        var colleges = $('.fieldset.active #colleges').val();
        var img = $('.fieldset.active #img').val();
        if (email == '') {
            $('.email_error').html('ban chua nhap email');
        }
        if (uname =='') {
            $('.uname_error').html('ban chua nhap user name');
        }
        if (password == '') {
            $('.password_error').html('ban chua nhap password');
        }
        if (fname == '') {
            $('.fname_error').html('ban chua nhap first name');
        }
        if (lname == '') {
            $('.lname_error').html('ban chua nhap last name');
        }
        if (address == '') {
            $('.address_error').html('ban chua nhap address');
        }
        if (colleges == '') {
            $('.colleges_error').html('ban chua nhap colleges');
        }
        // if (img == '') {
        //     $('.img_error').html('ban chua nhap images');
        // }
                if (email !='' && password !='' && uname!=''&&fname != ''&&lname != ''&&address != ''&&colleges != '') {
                    current_fs = $(this).parent();
                    next_fs = $(this).parent().next();
//Add Class Active
                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    $("#msform fieldset").eq($("fieldset").index(next_fs)).addClass("active");
//show the next fieldset
                    next_fs.show();
//hide the current fieldset with style
                    current_fs.animate({opacity: 0}, {
                        step: function(now) {
// for making fielset appear animation
                            opacity = 1 - now;
                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            next_fs.css({'opacity': opacity});
                        },
                        duration: 500
                    });
                    setProgressBar(++current);
                    $('.password_error').html('');
                    $('.uname_error').html('');
                    $('.email_error').html('');
                }

    });
    // (function($) {
    //     $.fn.checkFileType = function(options) {
    //         var defaults = {
    //             allowedExtensions: [],
    //             success: function() {},
    //             error: function() {}
    //         };
    //         options = $.extend(defaults, options);
    //
    //         return this.each(function() {
    //             $(this).on('change', function() {
    //                 var value = $(this).val(),
    //                     file = value.toLowerCase(),
    //                     extension = file.substring(file.lastIndexOf('.') + 1);
    //                 if ($.inArray(extension, options.allowedExtensions) == -1) {
    //                     options.error();
    //                     $(this).focus();
    //                 } else {
    //                     options.success();
    //                 }
    //             });
    //
    //         });
    //     };
    // })(jQuery);
    //
    // $(function() {
    //     $('#img').checkFileType({
    //         allowedExtensions: ['jpg', 'jpeg'],
    //         success: function() {
    //             alert('Success');
    //         },
    //         error: function() {
    //             $('.img_error').html('vui long chon dung file anh jpg jpeg');
    //         }
    //     });
    //
    // });

    $(document).on('change', ':file',function () {
        var file = this.files[0];
        var fileType = file['type'];
        var validImageTypes = ['image/jpeg', 'image/png'];
        if (!validImageTypes.includes(fileType)) {
            alert('Only JPEG and PNG file types are allowed');
            this.value = '';
        }
    });

    $(".previous").click(function(){
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
//Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        $("#msform fieldset").eq($("fieldset").index(current_fs)).removeClass("active");
//show the previous fieldset
        previous_fs.show();
//hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
// for making fielset appear animation
                opacity = 1 - now;
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            },
            duration: 500
        });
        setProgressBar(--current);
    });

    function setProgressBar(curStep){
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar").css("width",percent+"%")
    }
    $(".submit").click(function(){
        return false;
    })
});