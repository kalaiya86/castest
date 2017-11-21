var G_file;
$(function () {

    $(document).on('change','#upload-01',function(){
       /* var obj=new SetPreviewPic($('#upload-01').get(0),$('#image-bg').get(0),$('.photo-container').get(0),100);
        obj.uploadSinglePic(330,248);
        $('.upload-again').show();*/
    })

    $(document).on('click','.app-01-notice button',function () {
        photoUploadInit()
    })

    $(document).off('click','.realme-pop.app-01 button[type="submit"]')
    $(document).on('click','.realme-pop.app-01 button[type="submit"]',function (e) {
        e.preventDefault();
        var $that = $(this)
        var form = $that.closest('form');

        if(!validForm(form)) return;
        G_photoUpload2&&G_photoUpload2.abort();
        clearInterval(intervalApp01);

        photoUploading(form);//开始加载动画并禁用input等按钮
        $('#image-bg').removeAttr('width').removeAttr('height').css('top',0)
        form.find('button').text('提交中...');
        form.data('store',form.serialize())

        var blobData = new FormData($("#form-app01")[0]);
        blobData.append('video_pic',G_file);

        $.ajax({
            url: form.attr('action'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: blobData,
            type: 'post',
            success: function (e) {
                var tick = 0;
                if(e.respCode=='000'){
                    //轮询开始
                    var dataTemp = {};
                    dataTemp.seq_id = e.seq_id;
                    function app01Ajax2() {
                        //G_photoUpload2&&G_photoUpload2.abort();
                        G_photoUpload2 = $.ajax({
                            url: $that.closest('form').attr('action2'),
                            dataType: 'json',
                            data:$.param(dataTemp)+"&"+form.data('store'),
                            type: 'post',
                            success: function (data) {
                                $('#image-bg').removeAttr('width').removeAttr('height').css('top',0)
                                if(data.respCode=='000'&&data.resp_code=='00'){
                                    clearInterval(intervalApp01);
                                    enableInput(form);
                                    $('.app-01-ok>span>span').text(data.mp_ssim);
                                    $('.app-01-content,.app-01-error').hide();
                                    $('.app-01-ok,.app-01-notice').show();
                                    form.find('button').text('提交验证');
                                }else if(data.respCode=='000'&&data.resp_code!='00'){
                                    clearInterval(intervalApp01);
                                    enableInput(form);
                                    $('.app-01-content,.app-01-ok').hide();
                                    $('.app-01-error p').text(data.resp_info);
                                    $('.app-01-error,.app-01-notice').show();
                                    form.find('button').text('提交验证');
                                }else if(data.respCode=='90112'){
                                    clearInterval(intervalApp01);
                                    enableInput(form);
                                    $('.app-01-content,.app-01-ok').hide();
                                    $('.app-01-error p').text(data.respDesc);
                                    $('.app-01-error,.app-01-notice').show();
                                    form.find('button').text('提交验证');
                                }else{
                                    tick++;
                                    if(tick>6){
                                        clearInterval(intervalApp01);
                                        enableInput(form);
                                        $('.app-01-content,.app-01-ok').hide();
                                        $('.app-01-error p').text('验证超时,请重试!');
                                        $('.app-01-error,.app-01-notice').show();
                                        form.find('button').text('提交验证');
                                    }
                                }

                                d.reset();
                            },
                            error: function () {
                                form.find('button').text('提交验证');
                                $('#image-bg').removeAttr('width').removeAttr('height')
                                $('.app-01-content,.app-01-ok').hide();
                                $('.app-01-error p').text('网络出错,请稍候再试!');
                                $('.app-01-error,.app-01-notice').show();
                                d.reset();
                            }
                        })
                    }
                    app01Ajax2();
                    intervalApp01= setInterval(app01Ajax2,10000)
                    //END - 轮询开始
                }else{
                    $('.app-01-content,.app-01-ok').hide();
                    $('.app-01-error p').text(e.respDesc);
                    $('.app-01-error,.app-01-notice').show();
                    form.find('button').text('提交验证');
                    $('#image-bg').removeAttr('width').removeAttr('height')
                    enableInput(form);
                }
                d.reset();
            },
            error: function () {
                $('.app-01-error p').text('网络出错,请稍候再试!');
                enableInput(form);
                d.reset();
            }
        })
        disableInput(form);
    })

    function photoUploading(obj) {
        var $this = obj
        $('.realme-pop .photo-container>input').hide();
        $('.realme-pop .photo-container>img').attr('src','')
        $('.realme-pop .photo-container>img').attr('src',$('.realme-pop .photo-container>img').attr('load-img2'));
        $('.la-ball-clip-rotate.la-2x').show();
        //disableInput($this.closest('form'))
    }

    function photoUploadInit() {
        $('#upload-01').show();
        $('.realme-pop .photo-container>input').show();
        $('.realme-pop .photo-container>img').attr('src',$('.realme-pop .photo-container>img').attr('load-img'));
        $('.la-ball-clip-rotate.la-2x').hide();
        //enableInput($(this).closest('form'));
        $('#form-app01').clearForm();

        $('.app-01-ok,.app-01-error').hide();
        $('.app-01-content').show();
        d.reset();
    }
})