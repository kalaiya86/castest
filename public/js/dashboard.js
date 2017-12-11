$(function () {
    
    $('.table-wrap').on('click','.dels',function(){ 
        //console.log($("input[name='_token']").val());
        e.preventDefault();

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

    $('.close').click(function(){ $(this).parent().hide(); });

    $('.table-wrap').on('click','.img img',function(){
        //$(this).parent().hide(); 
        var pic = $(this).attr('src');
        d = dialog({
                    title:'谱图',
                    content: '<img src="'+pic+'" />',
                    fixed:false,
                    skin: 'dialog-error'
                });
        d.show();

    });

    sendAjax();
    $('.dashboard-table-title select').change(sendAjax);

    window.onDateRangePickerChange = sendAjax

    function sendAjax() {
        $('.component-table tbody').html('<tr><td colspan="10" style="text-align: center">数据查询中...</td></tr>')
        $.ajax({
            url:$('#dashboard-url').attr('action'),
            type:'get',
            data:$('#dashboard-url').serialize(),
            dataType:'json',
            success:function (re) {
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
                
                // var html = '';
                // console.log(re.data)
                // // if(re.respCode=='000'){
                //     for(var i in re.data){
                //         html += '<tr>';
                //         // html += '<td>'+G_infodata[i].p_id_title+'</td>';
                //         html += '<td>'+re.data[i].test_time+'</td>';
                //         html += '<td>'+re.data[i].bncode+'</td>';
                //         html += '<td>'+re.data[i].appearance+'</td>';
                //         html += '<td>'+re.data[i].purity+'</td>';
                //         html += '<td>'+re.data[i].condition+'</td>';
                //         // html += '<td><img src="'+base_url+'/'+re.data[i].spectrogram+'"/></td>';
                //         html += '<td><a href="'+'/tests/'+re.data[i].id+'/edit">编辑</a> <b class="delete" act="'+'/tests/'+re.data[i].id+'">删除</b></td>';
                //         html += '</tr>';
                //     }
                    
                // // }
                // $('.component-table tbody').html(html)
            },
            error:function () {
                alert('失败')
            }
        })
    }
})
