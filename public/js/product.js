var G_DATAAJAX;
$(function () {
    if($("#detail").length>0){ //只有明细页加载页面即调用
        sendAjax(); //默认调用
    }

    $('.table-wrap').on('click','.dels',function(){ 
        console.log($("input[name='_token']").val());
        //e.preventDefault();

        $.ajax({
            url:$(this).attr('act'),
            type:'DELETE',
            data:{'_token':$("input[name='_token']").val()},
            dataType:'json',
            success:function (re) {
                console.log(re);
                d = dialog({
                    title:'提示',
                    content: '内容已删除成功',
                    fixed:true,
                    skin: 'dialog-error'
                });
                d.show();
                setTimeout(function () {
                    $('.ui-popup').next().remove();
                    $('.ui-popup').remove();
                    $('.ui-popup-backdrop').remove();
                    window.location.href = base_url;
                },2000)
                
            },
            error:function () {
                console.log('删除失败');
            }
        })
     });
    

    $('#company-certify-submit').click(function (e) {
        if(!validForm($('#fm'))) return;
        e.preventDefault();
        //var blobData = new FormData($(this).closest('form')[0]);
        sendAjax()
    })




    function sendAjax(isAuto) {
            var url = $('#fm').attr('request-url');
            var para = $('#fm').serialize();
            $('.table-wrap').html('<div class="data-loading">数据加载中....</div>')
           $.ajax({
            url:url,
            type:'get',
            data:para,
            dataType:'json',
            success:function (re) {
                //console.log(re)
                html = '';
                if(re.respCode=='000'){ 
                    //if(re.data != '') $('#page_number').val( parseInt(re.param['page_number']) + 1);
                    //$('#total').val(re.total);
                    if(re.total=='0'){
                        html = '<div class="data-loading no-data"></div>';
                    }else{
                        initPager(re.total,re.param['page_size'],$('.table-pager'),$('#fm'),$('.table-wrap'))

                        html = generateTable(re.thead,re.data,re.class) 
                        
                    }
                }else{
                    html = '<div style="text-align:center">'+ re.respDesc+'</div>';
                }
                $('.table-wrap').html(html)
            },
            error:function () {
                alert('查询失败');
            }
        })
    }
    
})