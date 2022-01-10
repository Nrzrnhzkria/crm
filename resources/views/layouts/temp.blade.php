<!doctype html>
<html lang="en">
    <!--
    |--------------------------------------------------------------------------
    | This layout is for Customer Registration page
    |--------------------------------------------------------------------------
    -->
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | Momentum Internet</title>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
        <script src="https://kit.fontawesome.com/e4e5c205fb.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> --}}
        <script src="https://js.stripe.com/v3/"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
        @yield('css')

        {{-- CDN Starts Font Awesome --}}
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/duotone.css" integrity="sha384-R3QzTxyukP03CMqKFe0ssp5wUvBPEyy9ZspCB+Y01fEjhMwcXixTyeot+S40+AjZ" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css" integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>
        {{-- CDN Ends Font Awesome --}}

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-JQHNHZ00GS"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-JQHNHZ00GS');
        </script>

        <style>

            html {
                height: 100%;
                background: rgb(233, 233, 233); /* fallback for old browsers */
                background: -webkit-linear-gradient(to left, #6441A5, #2a0845); /* Chrome 10-25, Safari 5.1-6 */
            }

            body {
                background: transparent;
            }

            /*form styles*/
            #msform {
                text-align: center;
                position: relative;
                margin-top: 30px;
            }

            #msform fieldset {
                background: white;
                border: 0 none;
                border-radius: 0px;
                box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
                padding: 30px 5px;
                box-sizing: border-box;
                width: 94%;
                margin: 0 3%;

                /*stacking fieldsets above each other*/
                position: relative;
            }

            /*Hide all except first fieldset*/
            #msform fieldset:not(:first-of-type) {
                display: none;
            }

            /*buttons*/
            #msform .action-button {
                width: 100px;
                height: 33px;
                background: #202020;
                font-weight: bold;
                color: white;
                border: 0 none;
                border-radius: 5px;
                cursor: pointer;
            }

            #msform .action-button:hover, #msform .action-button:focus {
                box-shadow: 0 0 0 2px white, 0 0 0 3px #202020;
                outline-width: 0;
            }
            #msform .action-button-previous {

                width: 100px;
                height: 33px;
                background: #cccccc;
                font-weight: bold;
                color: #202020;
                border: 0 none;
                border-radius: 5px;
                cursor: pointer;
                outline-width: 0;
            }

            #msform .action-button-previous:hover, #msform .action-button-previous:focus {
                box-shadow: 0 0 0 2px white, 0 0 0 3px #C5C5F1;
            }

            /*headings*/
            .fs-title {
                font-size: 18px;
                text-transform: uppercase;
                color: #2C3E50;
                margin-bottom: 10px;
                letter-spacing: 2px;
                font-weight: bold;
            }

            .fs-subtitle {
                font-weight: normal;
                font-size: 13px;
                color: #666;
                margin-bottom: 20px;
            }

            .select {
                background-color: #202020;
            }

            .center {
                margin: auto;
                width: 70%;
                padding: 10px;
                text-align: center;
            }

            .btn-circle {
                width: 30px;
                height: 30px;
                text-align: center;
                padding: 6px 0;
                font-size: 12px;
                line-height: 1.428571429;
                border-radius: 15px;
            }
            .btn-circle.btn-lg {
                width: 50px;
                height: 50px;
                padding: 10px 16px;
                font-size: 18px;
                line-height: 1.33;
                border-radius: 25px;
                box-shadow: 1px 1px 3px #2520206d;
            }
        </style> 
        
    </head>
    <body>  
        <div class="container-fluid mb-3">
            @yield('content')
        </div>
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!--
    |--------------------------------------------------------------------------
    | This function is to calculate Total Price
    |--------------------------------------------------------------------------
    -->
    <script>
    function calculateAmount(val) {
        
        var prices = document.getElementById("price").value;
        var total_price = val * prices;

        /*display the result*/
        var divobj = document.getElementById('totalprice');
        divobj.value = total_price;

        var totallagi = document.getElementById('total_lagi');
        totallagi.value = total_price;

        document.getElementById('total_lah').innerHTML = total_price;

    }
    </script>

    <!--
    |--------------------------------------------------------------------------
    | This function is for button in the form
    |--------------------------------------------------------------------------
    -->
    <script>
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function(){
        if(animating) return false;
        animating = true;
        
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        
        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50)+"%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
            'transform': 'scale('+scale+')',
            'position': 'absolute'
        });
                next_fs.css({'left': left, 'opacity': opacity});
            }, 
            duration: 800, 
            complete: function(){
                current_fs.hide();
                animating = false;
            }, 
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".previous").click(function(){
        if(animating) return false;
        animating = true;
        
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        
        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        
        //show the previous fieldset
        previous_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1-now) * 50)+"%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
            }, 
            duration: 800, 
            complete: function(){
                current_fs.hide();
                animating = false;
            }, 
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".submit").click(function(){
        return true;
    })
    </script>

    <!--
    |--------------------------------------------------------------------------
    | This function is to fetch back data from
    | previous fieldset
    |--------------------------------------------------------------------------
    -->
    {{-- <script>

        var first_name = document.getElementById("first_name").value;
        document.getElementById('first_nameVal').innerHTML = first_name;

        var last_name = document.getElementById("last_name").value;
        document.getElementById('last_nameVal').innerHTML = last_name;

        var ic = document.getElementById("ic").value;
        document.getElementById('icVal').innerHTML = ic;

        var email = document.getElementById("email").value;
        document.getElementById('emailVal').innerHTML = email;

        var phone = document.getElementById("input-phone").value;
        document.getElementById('input-phoneVal').innerHTML = phone;

        var quantity = document.getElementById('quantity').value;
        document.getElementById('quantityVal').innerHTML = quantity;

        var item_total = document.getElementById('item_total').value;
        document.getElementById('total_lah').innerHTML = item_total;
        

        $("#quantity").on('change', function(){
        if($(this).val() != ""){
            $("#quantityVal").text($("#quantity option:selected").text());
            $(".quantity").show();
        }else{
            $(".quantity").hide();
        }
        });

        $("#item_total").on('change', function(){
        if($(this).val() != ""){
            $("#total_lah").text($(this).val());
            $(".item_total").show();
        }else{
            $(".item_total").hide();
        }
        });

        $("#first_name").on('keyup change', function(){
        if($(this).val() != ""){
            $("#first_nameVal").text($(this).val());
            $(".first_name").show();
        }else{
            $(".first_name").hide();
        }
        });

        $("#last_name").on('keyup change', function(){
        if($(this).val() != ""){
            $("#last_nameVal").text($(this).val());
            $(".last_name").show();
        }else{
            $(".last_name").hide();
        }
        });

        $("#ic").on('blur', function(){
        if($(this).val() != ""){
            $("#icVal").text($(this).val());
            $(".ic").show();
        }else{
            $(".ic").hide();
        }
        });

        $("#email").on('keyup change', function(){
        if($(this).val() != ""){
            $("#emailVal").text($(this).val());
            $(".email").show();
        }else{
            $(".email").hide();
        }
        });
        $("#input-phone").on('blur', function(){
        if($(this).val() != ""){
            $("#input-phoneVal").text($(this).val());
            $(".input-phone").show();
        }else{
            $(".input-phone").hide();
        }
        });
    </script> --}}

    <!--
    |--------------------------------------------------------------------------
    | This function is for Stripe application
    |--------------------------------------------------------------------------
    -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
    <script type="text/javascript">
        $(function() {
            var $form         = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form         = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                                'input[type=text]', 'input[type=file]',
                                'textarea'].join(', '),
                $inputs       = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid         = true;
                $errorMessage.addClass('hide');
        
                $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
            });
        
            if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
            }
        
        });
        
        function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        
        });
    </script>

    <!--
    |--------------------------------------------------------------------------
    | This function is for form validation
    |--------------------------------------------------------------------------
    -->
    <script>
        function IsEmpty() {
        if (document.forms['frm'].ic.value === "" || document.forms['frm'].first_name.value === "" || document.forms['frm'].last_name.value === "" || document.forms['frm'].email.value === "" || document.forms['frm'].input-phone.value === "" || document.forms['frm'].quantity.value === "" ) {
            alert("Sila pastikan borang telah diisi dengan lengkap.");
            return false;
        }
        return true;
        }
    </script>
</html>
