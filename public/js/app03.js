$(function () {
    $(document).on('click','.app-03-menu li',function () {
        $(this).addClass('current').siblings().removeClass('current')
        var index = $('.app-03-menu li').index($(this));
        $('.app-03-content li').eq(index).addClass('current').siblings().removeClass('current');
        d.reset();

        clearInterval(intervalApp03);
        G_appAjax&&G_appAjax.abort();
        G_photoUpload2&&G_photoUpload2.abort();
        enableInput($('.app-03-content li').eq(index).find('form'));
        $('.app-03-content li').eq(index).find('form button').text('提交验证')

        $('.app-03-content').show();
        $('.app-03-notice').hide();
    })

    $(document).on('click','.app-03-content button[type="submit"]',function (e) {
        e.preventDefault();

        var form = $(this).closest('form')
        var url = $(this).closest('form').attr('action');
        if(!validForm(form)) return;

        form.find('button').text('提交中...');
        form.data('store',form.serialize());
        disableInput(form);

        G_appAjax&&G_appAjax.abort();
        G_appAjax = $.ajax({
            url: url,
            dataType: 'json',
            type: 'post',
            data: form.data('store'),
            success: function (data) {
                var tick = 0;
                /*console.log('第一次请求');
                 console.log(data);
                 console.log('===========================');*/
                if(data.respCode=='000'){
                    var dataTemp = {};
                    dataTemp.seq_id = data.seq_id;
                    function app03Ajax2() {
                        G_photoUpload2&&G_photoUpload2.abort();
                        G_photoUpload2 = $.ajax({
                            url: form.attr('action2'),
                            dataType: 'json',
                            data:$.param(dataTemp)+'&'+form.data('store'),
                            type: 'post',
                            success: function (e) {
                                /*console.log('第2次请求');
                                 console.log(e);
                                 console.log('===========================');*/


                                if(e.respCode=='000'&&e.resp_code=='00'){
                                    $('.app-03-content,.app-03-error').hide();
                                    $('.app-03-notice,.app-03-ok').show();
                                    $('.app-03-error p').text(e.respDesc);
                                    clearInterval(intervalApp03);
                                    enableInput(form);
                                    form.find('button').text('提交验证');
                                }else if(e.respCode=='000'&&e.resp_code!='00'){
                                    clearInterval(intervalApp03);
                                    enableInput(form);
                                    $('.app-03-content,.app-03-ok').hide();
                                    $('.app-03-error,.app-03-notice').show();
                                    $('.app-03-error p').text(e.resp_info);
                                    form.find('button').text('提交验证');
                                }else if(e.respCode=='90112'){
                                    clearInterval(intervalApp03);
                                    enableInput(form);
                                    $('.app-03-content,.app-03-ok').hide();
                                    $('.app-03-error,.app-03-notice').show();
                                    $('.app-03-error p').text(e.respDesc);
                                    form.find('button').text('提交验证');
                                }else{
                                    tick++;
                                    if(tick>6){
                                        clearInterval(intervalApp03);
                                        enableInput(form);
                                        $('.app-03-content,.app-03-ok').hide();
                                        $('.app-03-error,.app-03-notice').show();
                                        $('.app-03-error p').text('验证超时,请重试!');
                                        form.find('button').text('提交验证');
                                    }
                                }

                                /*else{
                                 $('.app-03-content,.app-03-ok').hide();
                                 $('.app-03-error,.app-03-notice').show();
                                 $('.app-03-error p').text(e.respDesc);
                                 }*/
                                d.reset();
                            },
                            error: function () {
                                form.find('button').text('提交验证');
                                $('.app-03-content,.app-03-ok').hide();
                                $('.app-03-error p').text('网络出错,请稍候再试!');
                                $('.app-03-error,.app-03-notice').show();
                                d.reset();
                            }
                        })
                    }
                    app03Ajax2();
                    intervalApp03= setInterval(app03Ajax2,10000)
                }else{
                    $('.app-03-error>p').html(data.respDesc);
                    $('.app-03-notice,.app-03-error').show();
                    $('.app-03-ok,.app-03-content').hide();
                }
            },
            error: function () {
                /*$('.app-03-notice,.app-03-error').show();
                 $('.app-03-content,.app-03-ok').hide();
                 $('.app-03-error p').text('网络出错,请稍候再试!');*/
                enableInput(form);
                d.reset();
            }
        })
        //disableInput(form);
    })

    $(document).on('click','.app-03-notice button',function () {
        $('.app-03-content li').find('form').each(function () {
            enableInput($(this));
        })
        $('.app-03-content li').find('form button').text('提交验证');

        $('.app-03-notice').hide();
        $('.app-03-content').show();
    })
})