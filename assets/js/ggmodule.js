/**
 * Created by zfd on 2018/1/17.
 */
/*var string  = '';*/
var boxOfTop = {//页面顶部广告配置
    url: '',
    img: '',
    id: ''
};
var boxOfMid_1 = {//页面中部01广告配置
    url: '',
    img: '',
    id: ''
};

var boxOfMid_2 = {//页面中部02广告配置
    url: '',
    img: '',
    id: ''
};

var boxOfBottom = {//页面底部广告配置
    url: '',
    img: '',
    id: ''
};
//var ua = navigator.userAgent.toLowerCase();
//var isWeixin = ua.indexOf('micromessenger') != -1;
 
    if (checkCooieTimeout(boxOfTop.id) && boxOfTop.id != '') {
        setOutlink(boxOfTop, 'top')
    }

    if (checkCooieTimeout(boxOfMid_1.id) && boxOfMid_1.id != '') {
        setOutlink(boxOfMid_1, 'mid_01')
    }

    if (checkCooieTimeout(boxOfMid_2.id) && boxOfMid_2.id != '') {
        setOutlink(boxOfMid_2, 'mid_02')
    }

    if (checkCooieTimeout(boxOfBottom.id) && boxOfBottom.id != '') {
        setOutlink(boxOfBottom, 'bottom')
    }

    //点击监听
    $('body').on('click', '.theBox a', function () {

    });
 