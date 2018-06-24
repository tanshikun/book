function ajax(method, url, data, success) {
    var xhr = null;//申明一个变量
//创建ajax对象，在不同的浏览器下面创建!
    try {
        //试着去执行里面的代码 try
        xhr = new XMLHttpRequest();//火狐，谷歌浏览器创建ajax对象的方法
    } catch (e) {
        xhr = new ActiveXObject('Microsoft.XMLHTTP');
        //ie6,7,8这些浏览器就必须使用下面的代码来创建ajax对象
    }
    //数据提交的形式是get
    if (method == 'get' && data) {
        url += '?' + data;
    }
    //open 表示ajax里面的一个方法,打开连接
    //参数1表示数据提交的方式,
    //参数2表示 提交的数据(包含访问的页面和url传参)
    //参数3只有2个值:true和false,true表示使用异步通讯.false表示同步通讯
    xhr.open(method,url,true);
    if (method == 'get') {
        //send 方法 表示发送，如果数据是get形式提交，直接发送
        xhr.send();
    } else {
        //如果是post 必须创建头信息
        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
    }
    //onreadystatechange 表示ajax中的属性,当数据提交到服务器后，服务器这边是不是有相应,
    xhr.onreadystatechange = function() {
        /*
        0: 请求未初始化
        1: 服务器连接已建立
        2: 请求已接收
        3: 请求处理中
        4: 请求已完成，且响应已就绪
         */
        if ( xhr.readyState == 4 ) {
            //status 表示服务器返回的状态码 状态码只有等于200的时候，才能处理数据
            if ( xhr.status == 200 ) {
                success && success(xhr.responseText);
            } else {
                alert('出错了,Err：' + xhr.status);
            }
        }

    }
}