var step=1;
var cart_error_step_1="Please add at least a product";
var windowsize=1;
var mobilesize=1280;
(function($){
    windowsize=$( window ).width();
    $(document).ready(function(){

        //add button next step mobile
        $('#webform-client-form-30 .step1').append('<div class="form-actions-mobile"><button class="mobile-next-step" data-mobile-step="1" type="button">'+Drupal.t('Etape suivante')+'</button></div>');
        $('#webform-client-form-30 .step2').append('<div class="form-actions-mobile">' +
        '<button type="button" class="mobile-back-step"  data-mobile-back-step="1">'+Drupal.t('Retour')+'</button>' +
        '<button  class="mobile-next-step" data-mobile-step="2" type="button">'+Drupal.t('Etape suivante')+'</button>' +
        '</div>');
        $('#webform-client-form-30 [name=op]').before('<button type="button" class="mobile-back-step "  data-mobile-back-step="2">'+Drupal.t('Retour')+'</button>');
        $('.step2,.step3,.form-actions').addClass('mobile-closed mobile-disable');

        $('#webform-client-form-30').on('click','.mobile-back-step',function(){
            var mobile_back_step=parseInt($(this).attr('data-mobile-back-step'));
            if(mobile_back_step>=2){
                $('#webform-client-form-30 .captcha').addClass('mobile-closed');
                $('#webform-client-form-30 .captcha').hide();
                $('.form-actions').addClass('mobile-closed');
            }
            $('.step'+mobile_back_step).removeClass('mobile-closed');
            $('.step'+(mobile_back_step+1)).addClass('mobile-closed');
            //$(window).scrollTop($('.step'+mobile_back_step).offset().top);
        })
        $('#webform-client-form-30').on('click','.mobile-next-step',function(){
            $('#webform-client-form-30').find('#next-step').trigger('click');
            var mobile_step=$(this).attr('data-mobile-step');
            switch (mobile_step){
                case "1":
                    if($('#webform-client-form-30').find('.cart-error').length==0){
                        $('.step1').addClass('mobile-closed');
                        $('.step2').removeClass('mobile-closed');
                        $('.step2').removeClass('mobile-disable');
                        $('html, body').animate({
                            scrollTop: $(".step2").offset().top
                        }, 100);
                    }
                    break;
                case "2":
                    if($('#webform-client-form-30').find('.field-required').length==0){
                        $('.step2').addClass('mobile-closed');
                        $('.step3').removeClass('mobile-closed');
                        $('#webform-client-form-30 .captcha').removeClass('mobile-closed');
                        $('.form-actions').removeClass('mobile-closed');
                        $('.step3').removeClass('mobile-disable');
                        $('html, body').animate({
                            scrollTop: $(".step3_header.step_header_mobile").offset().top
                        }, 100);
                    }
                    break;
                case "3":
                    break;
                default :
                    break;

            }
        })

        $('#webform-client-form-30').on('click','.step1_header,.step2_header,.step3_header',function(){
            var parent=$(this).parent();
            if(!parent.hasClass('mobile-disable')){
                if(parent.hasClass('mobile-closed')){
                    parent.removeClass('mobile-closed');
                    if(parent.hasClass('step3')){
                        $('.form-actions').removeClass('mobile-closed')
                        $('#webform-client-form-30 .captcha').show();
                    }
                }else{
                    parent.addClass('mobile-closed');
                    if(parent.hasClass('step3')){
                        $('.form-actions').addClass('mobile-closed');
                        $('#webform-client-form-30 .captcha').hide();
                    }
                }
            }
        })

        //update window width
        $(window).resize(function() {
            var windowsize = $(window).width();
        });

        $('#webform-client-form-30 .captcha').hide();
        $('.webform-client-form-30').addClass('container');
        //add to cart
        $(document).on('click','.btn-product-cart',function(){
            var pdid=$(this).attr("data-pid");
            var type=$(this).attr("type");
            $.ajax({
                url:'/ajax/product/cart/add',
                type:'post',
                dataType:'json',
                data:{nid:pdid,type:type},
                success:function(response){
                    $('#block-product-cart-product-cart-block').replaceWith(response.block_cart);

                    $.fancybox(
                        response.popup_cart,
                        {   'autoDimensions'    : false,
                            tpl : {
                                closeBtn : '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;">Fermer</a>'
                            }
                        }
                        
                    );
                }
            })
        })

        //cart process
        $('.cart-header-step').find("[step=1]").addClass("active");
        $('.webform-component--step-content--step-1').addClass("active");
        $(".all-dates").appendTo(".form-radios .form-item:first-child"); // move item date flow option 
        if ($(".form-radios .form-item:first-child .form-radio").is(":checked")) {
            $('.all-dates').show();
        }
        $(".form-radios .form-item .form-radio").change(function () {
            if ($(".form-radios .form-item:first-child .form-radio").is(":checked")) {
                $('.all-dates').show();
            }
            else {
                $('.all-dates').hide();
            }
               
        });
        var error_message="";
        var btn_submit=$('#webform-client-form-30').find('input[name=op]');
        if(btn_submit.length==1){
            btn_submit.after('<button type="button" id="next-step">'+next_step_text+'</button>');
            btn_submit.hide();

            var btn_next_step=$('#webform-client-form-30').find('#next-step');

            $('.cart-header-step li').click(function(){
                $('#webform-client-form-30').find('.cart-error').remove();
                $('#webform-client-form-30').find('.field-required').remove();
                var i=parseInt($(this).attr('step'));
                step=i;
                error_message="";
                if(step==1){

                }else if(step==2){
                    if($('#webform-client-form-30').find('.tbl-cart-products tbody tr').length==0){
                        error_message='<div class="cart-error"><span>'+cart_error_step_1+'<span></div>';

                        $('.webform-component--step-header').after(error_message)
                        return false;
                    }
                }else if(step==3){



                   $('.webform-component--step-content--step-2--step2-content--step-2-top').find('[required=required]').each(function(){
                       if($(this).val()===undefined || $(this).val()===null ||  $(this).val()===""){
                            $(this).addClass('input-error');
                            $(this).after('<span class="field-required"> '+ Drupal.t('ceci est un champ obligatoire *')+'</span>');
                            $(this).focus();
                            error_message+='<span>'+$(this).parent().find('label').text()+'</span>'
                       }
                   })
                    if ($('.webform-component--step-content--step-2--step2-content--step-2-bottom--reservation-calendar-type').find('input[name=gender]:checked').length == 0) {
                        // do something here
                    }

                    //check case is select all date
                    var all_date=$('.webform-component--step-content--step-2--step2-content--step-2-bottom--reservation-calendar input[type=radio]:checked').val();

                    if(all_date=='I want to apply those dates to all machines in my cart'){
                        if($('#edit-submitted-step-content-step-2--step2-content-step-2-bottom-step-2-bottom-content-all-dates-number-of-date').val()=="0"){
                            $('#edit-submitted-step-content-step-2--step2-content-step-2-bottom-step-2-bottom-content-all-dates-number-of-date').addClass('required');
                            $('#edit-submitted-step-content-step-2--step2-content-step-2-bottom-step-2-bottom-content-all-dates-number-of-date').after('<span class="field-required"> '+ Drupal.t('ceci est un champ obligatoire *')+'</span>');
                            error_message+='<span>Please add the date number</span>'
                        }else{
                            $('#edit-submitted-step-content-step-2--step2-content-step-2-bottom-step-2-bottom-content-all-dates-number-of-date').removeClass('required');
                        }

                        var id="edit-submitted-step-content-step-2-step2-content-step-2-bottom-step-2-bottom-content-all-dates-date-of-construction-";

                        if($("#"+id+'year').val()=="" || $("#"+id+'month').val()=="" || $("#"+id+'day').val()==""){
                            $('.webform-component--step-content--step-2--step2-content--step-2-bottom--step-2-bottom-content--all-dates--date-of-construction').after('<span class="field-required"> '+ Drupal.t('ceci est un champ obligatoire *')+'</span>');
                            error_message+='<span>Please select date</span>'
                        }
                    }else{
                        $('.product-row').each(function(){
                            if($(this).find('.year').val()=="" || $(this).find('.month').val()=="" || $(this).find('.day').val()==""){
                               $(this).find('.webform-datepicker').after('<span class="field-required"> '+ Drupal.t('ceci est un champ obligatoire *')+'</span>');
                                error_message+='<span>Please select date</span>'
                            }

                            $(this).find('[id$=product-days]').each(function(){
                                if($(this).val()=='0'){
                                    $(this).after('<span class="field-required"> '+ Drupal.t('ceci est un champ obligatoire *')+'</span>');
                                    error_message+='<span>Please add the date number</span>';
                                }
                            })

                        })
                    }

                    if(error_message!=""){
                        //$('.webform-component--step-header').after('<div class="cart-error">'+error_message+'</div>')
                        return false;
                    }
                }
                if(i==3){
                    btn_submit.show();
                    btn_next_step.hide();
                    $('#webform-client-form-30 .captcha').show();
                }else{
                    $('#webform-client-form-30 .captcha').hide();
                    btn_submit.hide();
                    btn_next_step.show();
                }

                $('.cart-header-step li').removeClass('active active'+i);
                $(this).addClass('active active'+i);
                $('.webform-component--step-content >div').removeClass('active active'+i);
                $('.webform-component--step-content').find('.webform-component--step-content--step-'+i).addClass('active active'+i);
            })


            btn_next_step.click(function(){
                var i=parseInt($('.cart-header-step li.active').attr('step'));
                step=i;
                switch (i){
                    case 1:
                        $('.cart-header-step').find("[step="+(i+1)+"]").trigger('click');
                        $('html, body').animate({
                            scrollTop: $(".cart-header-step").offset().top
                        }, 500);
                        break;
                    case 2:
                        $('.cart-header-step').find("[step="+(i+1)+"]").trigger('click');
                        if(error_message==""){
                            btn_submit.show();
                            btn_next_step.hide();
                            $('#webform-client-form-30 .captcha').show();
                            $('html, body').animate({
                                scrollTop: $(".cart-header-step").offset().top
                            }, 500);
                        }
                        break
                    case 3:
                        break
                    default:
                        break;
                }
            })
        }


        //Reservation calenda
        $('.webform-component--step-content--step-2--step2-content--step-2-bottom--reservation-calendar input[type=radio]').each(function(){
            if($(this).prop("checked")){
                if($(this).val()=='I want to apply those dates to all machines in my cart'){
                    $('.webform-component--step-content--step-2--step2-content--step-2-bottom--step-2-bottom-content .all-dates').show();
                    $('.webform-component--step-content--step-2--step2-content--step-2-bottom--step-2-bottom-content .choose-dates').hide();

                }else{
                    $('.webform-component--step-content--step-2--step2-content--step-2-bottom--step-2-bottom-content .choose-dates').show();
                    $('.webform-component--step-content--step-2--step2-content--step-2-bottom--step-2-bottom-content .all-dates').hide();
                }
            }else{

            }
        })
        $('.webform-component--step-content--step-2--step2-content--step-2-bottom--reservation-calendar input[type=radio]').click(function(){
            if($(this).val()=='I want to apply those dates to all machines in my cart'){
                $('.webform-component--step-content--step-2--step2-content--step-2-bottom--step-2-bottom-content .all-dates').show();
                $('.webform-component--step-content--step-2--step2-content--step-2-bottom--step-2-bottom-content .choose-dates').hide();
            }else{
                $('.webform-component--step-content--step-2--step2-content--step-2-bottom--step-2-bottom-content .all-dates').hide();
                $('.webform-component--step-content--step-2--step2-content--step-2-bottom--step-2-bottom-content .choose-dates').show();
            }
        })

        // possition of message error
        $('#webform-client-form-30').on('click','input[name=op]',function(e){
                if($('.form-checkboxes input[type=checkbox]:checked').length==0){
                    var message = Drupal.t('Please check contact type. At least a type is checked!');
                    if(!$('.step3_bottom p').hasClass("meassge")) {
                        $('<p class="meassge">'+message+'<p>').appendTo($('.form-checkboxes'));
                    }
                    e.preventDefault();
                } 
        })
       
        if($('.page-node-30').find('.messages.error').length==1){
            $('.page-node-30 .messages.error').prependTo('#webform-client-form-30 .captcha');
            $('.form-actions').removeClass('mobile-closed');
            $('.cart-header-step li[step=3]').trigger('click');
            if ($('.step3').hasClass('active3')){
                $('.step1').addClass('mobile-closed');
                $('.step2').removeClass('mobile-disable');
                $('.step3').removeClass('mobile-disable');
                $('.step3').removeClass('mobile-closed');
                $('.form-actions').removeClass('mobile-closed');
                $('html, body').animate({
                    scrollTop: $("#webform-client-form-30 .captcha").offset().top
                }, 100);
            }
        }

        $('[key=duration]').change(function(){
            var pdid=$(this).attr("data-pid");
            var type=$(this).attr("data-type");
            var value=$(this).val();
            $.ajax({
                url:'/ajax/product/cart/change_duration',
                type:'post',
                data:{nid:pdid,type:type,value:value},
                success:function(response){
                }
            })
        })



            $('.webform-datepicker').find('select.year, input.year').change(function(){
                update_date($(this).attr("name"));
            });
            $('.webform-datepicker').find('select.month').change(function(){
                update_date($(this).attr("name"));
            });
            $('.webform-datepicker').find('select.day').change(function(){
                update_date($(this).attr("name"));
            });

    })

    function getProductDate(pid){

        var year=$('[name="submitted[step_content][step_2][step2_content][step_2_bottom][step_2_bottom_content][dates][each_item][product_'+pid+'][product-date][year]"]').val();
        var month=$('[name="submitted[step_content][step_2][step2_content][step_2_bottom][step_2_bottom_content][dates][each_item][product_'+pid+'][product-date][month]"]').val();
        var day=$('[name="submitted[step_content][step_2][step2_content][step_2_bottom][step_2_bottom_content][dates][each_item][product_'+pid+'][product-date][day]"]').val();
        var date=year+'-'+month+'-'+day;
        return (date);

    }
    function getProductId(name){
        var r = /\[product_(.*)\]\[product-date\]/g;
        m = r.exec(name);
        if(m){
            return m[1];
        }
        return null;
    }

    function update_date(name){
        var pid= getProductId(name);
        var start_date=getProductDate(pid);
        $.ajax({
            url:'/ajax/product/cart/change_date',
            type:'post',
            dataType:'json',
            data:{nid:pid,date:start_date},
            success:function(response){

            }
        })

    }


})(jQuery)