if($('#realme').length>=0){
    var G_appAjax,G_photoUpload,G_photoUpload2;
    var intervalApp01,intervalApp03;
    $(function () {

        //通用函数
        // apikey显示隐藏
        $('.show-key').click(function () {
            var key1 = $(this).parent().attr('app_key');
            var key2 = $(this).siblings('a').text();
            $(this).siblings('a').text(key1);
            $(this).parent().attr('app_key',key2);
        })

        //table滚动条
        $('.table-wrap').niceScroll({
            cursorborder: "0",
            cursorcolor: "#c0d6f3",
            background: "#ececec"
        });

        //api功能弹出框
        $('.open-app').click(function () {
            pop('加载中,请稍候...','dialog-error');
            //打开弹出框
            if(G_appAjax) G_appAjax.abort();
            G_appAjax = $.ajax({
                url: $(this).attr('ajaxUrl'),
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    pop(data);
                },
                error: function () {
                    pop('网络出错,请稍候再试!','dialog-error');
                }
            })
        })

        //按钮选择
        $('.component-btn-select button').click(function () {
            $(this).closest('.gradient-border').addClass('current').siblings().removeClass('current');
            $(this).closest('.matrix').find('input[type="hidden"]').val($(this).attr('val'))
        })
        
        $(document).on('click','.ui-dialog-close',function () {
            clearInterval(intervalApp01);
            clearInterval(intervalApp03);
            G_photoUpload&&G_photoUpload.abort();
            G_photoUpload2&&G_photoUpload2.abort();
        })
    })
}