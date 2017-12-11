$(function () {
    $('#company-certify-submit').click(function (e) {
        if(!validForm($('#fm'))) return;
        e.preventDefault();
        //var blobData = new FormData($(this).closest('form')[0]);
        sendAjax(false)   
    })

    $('.demo-photo').click(function () {
        $('.ui-popup').next().remove();
        $('.ui-popup').remove();
        var $el = $(this).clone(true);
        $el.attr({width:'800',height:'auto'})
        d = dialog({
            title:'预览',
            content: $el,
            fixed:true,
            skin: ''
        });
        d.show();
        if($('.ui-popup-backdrop').length<=0){
            d.showModal();
        }
    })

    //图片初始化居中
    var G_imgLoad = [];
    $('.image-bg').each(function (index) {
        var $that = $(this);
        var rate = $that.closest('.upload-wrap').width()/$that.closest('.upload-wrap').height();
        var rateImg = [];
        //if(rateImg==0||rateImg==undefined||rateImg==NaN){
        G_imgLoad[index] = setInterval(function () {
            var rateImg = $that.width()/$that.height();
            imgCenter(rateImg)
            if(rateImg!=0&&rateImg!=undefined&&!isNaN(rateImg)){
                clearInterval(G_imgLoad[index])
            }
        },700)
        //}else{
            //imgCenter()
        //}

        function imgCenter(rateImg) {
            if(rate>rateImg){
                if($that.closest('.upload-wrap').height()<$that.height()){
                    $that.attr({
                        'height':'100%',
                        'width':'auto'
                    })
                }else{
                    $that.attr({
                        'height':'auto',
                        'width':'auto'
                    })
                    $that.css('top',($that.closest('.upload-wrap').height()-$that.height())/2)
                }
            }else{
                if($that.closest('.upload-wrap').width()<$that.width()){
                    $that.attr({
                        'width':'100%',
                        'height':'auto'
                    })
                    $that.css('top',($that.closest('.upload-wrap').height()-$that.closest('.upload-wrap').width()/rateImg)/2)
                }else{
                    $that.attr({
                        'height':'auto',
                        'width':'auto'
                    })
                    $that.css('top',($that.closest('.upload-wrap').height()-$that.height())/2)
                }
            }
        }
    })


    var step = $('#step').val()||'';
    if(step == '1'){
        setInterval(function () {
            sendAjax(true)
		},100000)
    }

    function sendAjax(isAuto) {
            var url;
            if(isAuto){
                url = $('#fm').attr('autourl');
            }else{
                url = $('#fm').attr('action');
            }
            var para = $('#fm').serialize()  ; 
            var pos = $('#fm').attr('method');
            if(isAuto) para = para +'&isAuto='+isAuto;// console.log(para)
           $.ajax({
            url:url,
            type:pos,
            data:para,
            dataType:'json',
            success:function (re) {
                console.log(re);
                if(!isAuto) window.location.href = list_url;//window.location.reload();
                if(isAuto){
                    d = dialog({
                        title:'标题',
                        content: '内容已自动保存',
                        fixed:true,
                        skin: 'dialog-error'
                    });
                    d.show();
                    setTimeout(function () {
                        $('.ui-popup').next().remove();
                        $('.ui-popup').remove();
                        $('.ui-popup-backdrop').remove();
                    },2000)
                }
            },
            error:function () {
                console.log('提交失败');
            }
        })
    }
    
    window.showBlock = function (ele) {
        $('.'+ele).show();
        $('.'+ele).siblings('.comp_type_wrap').hide();
    }
})