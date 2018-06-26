function uploadFileToServer(fileElmId,type,id){
    $.ajaxFileUpload({
        url:'/upload/'+type,
        fileElementId:fileElmId,
        dataType:'text',
        success:function(data){
            var result=JSON.parse(data);
            $('#'+id).val(result.uri);
        }
        error:function(XMLHttpRequest,textStatus,errorThrown){
            alert(errorThrown);
        }
    });
    return false;
}


function uploadImageToServer(fileElmId,type,id){
    $('#'+id).attr("src"+"/admin/static/h-ui.admin/images/acrossTab/loading.gif");
    $.ajaxFileUpload({
        url:'/upload/'+type,
        fileElementId:fileElmId,
        dataType:'text',
        success:function(data){
            var result=JSON.parse(data);
            $('#'+id).attr("src",result.uri);
        }
        error:function(XMLHttpRequest,textStatus,errorThrown){
            alert(errorThrown);
        }
    });
    return false;
}