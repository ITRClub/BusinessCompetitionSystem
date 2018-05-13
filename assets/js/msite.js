var apiHost = "//mapi.feixiaohao.com/";
function totop() {
    document.write("<div class='totop'><i></i></div>")
    $(window).scroll(function () {
        if ($(window).scrollTop() > 200) {
            $('.totop').fadeIn()
        }
        else {
            $('.totop').fadeOut()
        }
    });
    $(".totop").click(function () {
        $('body,html').animate({ scrollTop: 0 }, 500, function () {
            $('.totop').fadeOut()
        });
    })
}
totop();

$('nav .manue').click(function () {
    $('nav').find('.slidebox').slideToggle("fast");
});
$('nav .slidebox li').click(function () {
    if ($(this).find("ul").length > 0) {
        $(this).find("ul").slideToggle("fast");
    }
});

//过滤
//过滤
$('.flitter button').click(function (e) {
    e.stopPropagation();

    if ($(this).find('i').length == 0) {
        $('.flitter button').removeClass('active');
        $(this).addClass('active')
        return;
    }
    if (!$(this).hasClass('active')) {
        $('.flitter button').removeClass('active');
        $('.flitter').find('ul').css('display', 'none');
        var index = $(this).index();
        $(this).addClass('active');
        if ($('.flitter').find('ul').length == 1) {
            $('.flitter').find('ul').slideToggle('fast')
            return;
        }
        $('.flitter').find('ul').eq(index).slideToggle('fast')
    }
    else {
        $('.flitter button').removeClass('active');
        $('.flitter').find('ul').css('display', 'none');
    }
});
$('body').on('click', function (e) {
    $('.flitter button').removeClass('active');
    $('.flitter').find('ul').css('display', 'none');
}); 
$('.search-btn').click(function () {
    $('.searchform').slideToggle('fast')
})
//switchbar
$('.switch-nav li').click(function () {
    var index = $(this).index();
    var tar = $(this).closest(".switch-box").find('.switch-body').eq(index);
    if (tar.css('display') != 'block') {
        $(this).closest(".switch-box").find('.switch-nav li').removeClass('active');
        $(this).addClass('active');
        $(this).closest(".switch-box").find('.switch-body').css('display', 'none');
        tar.fadeIn('fast');
    }
})

//more info
$('.more-slide').click(function () {
    if (!$(this).hasClass('active')) {
        $('.coin-info2').slideDown('fast');
        $(this).text('收起').addClass('active');
    }
    else {
        $('.coin-info2').slideUp('fast');
        $(this).text('基本信息').removeClass('active');
    }
});

function moreCoin(btn, url, obj) {
    url = apiHost + "v2"+url;
    page = parseInt(btn.attr('page')) + 1;
      var urlparam = "";
    if (url.indexOf("?") > -1) {
        urlparam = "&page=" + page;
    } else {
        urlparam = "?page=" + page;
    }
    info = $.ajax({
        url: url + urlparam,
        async: false,
        dataType: "json",
        success: function (data) {
            if (data == '') {
                btn.css("display", "none");
            }
            else {
                if (data != 'error') {
                   
                    $(".tablefixed").append(data.result1);
                    $(".tableMain").append(data.result2);
                    btn.attr("page", page);
                }
            }
        }
    });

}

function moreMonthRank(btn, url, obj) {
    url = apiHost + url;
    page = parseInt(btn.attr('page')) + 1;
    var urlparam = "";
    if (url.indexOf("?") > -1) {
        urlparam = "&page=" + page;
    } else {
        urlparam = "?page=" + page;
    }
    info = $.ajax({
        url: url + urlparam,
        async: false,
        dataType: "json",
        success: function (data) {
            if (data == '') {
                btn.css("display", "none");
            }
            else {
                if (data != 'error') {
                   
                    $(".tablefixed").append(data.result1);
                    $(".tableMain").append(data.result2);
                    btn.attr("page", page);
                }
            }
        }
    });

}
function morevol(btn, url, obj) {
    url = apiHost + url;
    page = parseInt(btn.attr('page')) + 1;
    var urlparam = "";
    if (url.indexOf("?") > -1) {
        urlparam = "&page=" + page;
    } else {
        urlparam = "?page=" + page;
    }
    info = $.ajax({
        url: url + urlparam,
        async: false, 
        success: function (data) {
            if (data == '') {
                btn.css("display", "none");
            }
            else {
                if (data != 'error') { 
                    $("#result").append(data); 
                    btn.attr("page", page);
                }
            }
        }
    });

}
function moreExchange(btn, url, obj) {
    url = apiHost + url;
    page = parseInt(btn.attr('page')) + 1;
    var urlparam = "";
    if (url.indexOf("?") > -1) {
        urlparam = "&page=" + page;
    } else {
        urlparam = "?page=" + page;
    }
    info = $.ajax({
        url: url + urlparam,
        async: false,
        dataType: "json",
        success: function (data) {
            if (data == '') {
                btn.css("display", "none");
            }
            else {
                if (data != 'error') {
                    $(".tablefixed").append(data.result1);
                    $(".tableMain").append(data.result2);
                    btn.attr("page", page);
                }
            }
        }
    });

}

function moreMarketTicker(btn, url, obj) {
    url = apiHost + url;
    page = parseInt(btn.attr('page')) + 1;
    
    var urlparam = "";
    if (url.indexOf("?") > -1) {
        urlparam = "&page=" + page;
    } else {
        urlparam = "?page=" + page;
    }
    info = $.ajax({
        url: url + urlparam,
        async: false,
        dataType: "json",
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            if (data == '' || '' == data.result1) {
                btn.css("display", "none");
            }
            else {
                if (data != 'error') {

                    $(".tablefixed").append(data.result1);
                    $(".tableMain").append(data.result2);
                    btn.attr("page", page);
                }
            }
        }
    });

}

function moreUserTicker(btn, url, obj) {
    url = apiHost + url;
    page = parseInt(btn.attr('page')) + 1;

    var urlparam = "";
    if (url.indexOf("?") > -1) {
        urlparam = "&page=" + page;
    } else {
        urlparam = "?page=" + page;
    }
    info = $.ajax({
        url: url + urlparam,
        async: false,
        dataType: "json",
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
           if (data == '' || '' == data.result1) {
                btn.css("display", "none");
            }
            else {
                if (data != 'error') {

                    $(".tablefixed").append(data.result1);
                    $(".tableMain").append(data.result2);
                    btn.attr("page", page);
                }
            }
        }
    });

}

function MoreSearchCoin(btn, url, obj) {
    url = apiHost + url;
    page = parseInt(btn.attr('page')) + 1;

    var urlparam = "";
    if (url.indexOf("?") > -1) {
        urlparam = "&page=" + page;
    } else {
        urlparam = "?page=" + page;
    }
    info = $.ajax({
        url: url + urlparam,
        async: false,
        dataType: "json",
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            if (data == '' || '' == data.result1) {
                btn.css("display", "none");
            }
            else {
                if (data != 'error') {
                    $("#TCoin").append(data.result1);
                    $("#TCoin1").append(data.result2);
                    btn.attr("page", page);
                }
            }
        }
    });

}

function MoreSearchExchange(btn, url, obj) {
    url = apiHost + url;
    page = parseInt(btn.attr('page')) + 1;

    var urlparam = "";
    if (url.indexOf("?") > -1) {
        urlparam = "&page=" + page;
    } else {
        urlparam = "?page=" + page;
    }
    info = $.ajax({
        url: url + urlparam,
        async: false,
        dataType: "json",
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
         if (data == '' || '' == data.result1) {
                btn.css("display", "none");
            }
            else {
                if (data != 'error') {
                    $("#Texchange").append(data.result1);
                    $("#Texchange1").append(data.result2);
                    btn.attr("page", page);
                }
            }
        }
    });

}
function logout() {
    if (confirm("确认退出吗？")) {
        var parms = new Object();
        $.ajax({
            url: apiHost + "user/logout",
            data: parms,
            type: "post",
            async: true,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                logoutResponse(data);
            }
        });

    }
}
//处理logout反馈信息
function logoutResponse(data) {

    var result = eval("(" + data + ")");
    if (result.status == "success") {
        window.location.href ='/?v=' + Math.random();
    }
    else {
        alert(result.content);
    }
}




$('.navList>li').click(function (e) {
    e.stopPropagation();
    if ($(this).find('ul').length > 0 && !$(this).hasClass('active')) {
        $('.navList>li').find('ul').hide();
        $('.navList>li').removeClass('active');
        $(this).find('ul').slideDown('fast');
        $(this).addClass('active');
    } else {
        $(this).find('ul').slideUp('fast');
        $(this).removeClass('active');
    }
});
$('.memubtn').click(function () {
    $('.memu').fadeIn('100');
    setTimeout(function () {
        $('.memu .list').css('margin-left', 0)
    }, 100)
    $('body').css('overflow', 'hidden')
});
$('.memu').click(function(e){
    e.stopPropagation();
    $('body').css('overflow', 'auto');
    $('.memu .list').css('margin-left', '-250px');
    $('.listBox2,.listBox1').slideUp(100);
    $('.navList .swift>span').removeClass('active');
    setTimeout(function () {
        $('.memu ').fadeOut('100')
    }, 100);
    return false
});
$('.memuheader .back,.memu a').click(function () {
    $('body').css('overflow', 'auto')
    if ($(this).attr('href') != null) {
        setTimeout("top.location.href = '" + $(this).attr('href') + "'", 400);
    }
    $('.memu .list').css('margin-left', '-250px')
    setTimeout(function () {
        $('.memu ').fadeOut('100')
    }, 100)
    return false
});
$('.tabBox .boxTit *').click(function () {
    if (!$(this).hasClass('active')) {
        var index = $(this).index();

        $('.tabBox .boxTit *').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.tabBox').find('.tabBody').hide();
        $(this).closest('.tabBox').find('.tabBody').eq(index).show()
    }
});
$('.showhelp').click(function (e) {
    e.stopPropagation()
    $(this).find('.textBox').slideToggle(100);
});
$('body').click(function (e) {
    $('body').find('.showhelp .textBox').hide();
});
function showFixedPrice() {
    if ($(window).scrollTop() > 100) {
        $('.fixedPrice').css('top', '45px')
    }
    else {
        $('.fixedPrice').css('top', '-45px')
    }
    $(window).scroll(function () {
        if ($(window).scrollTop() > 100) {
            $('.fixedPrice').css('top', '45px')
        }
        else {
            $('.fixedPrice').css('top', '-45px')
        }
    });
};
function drawPreicChar(data, coinName) {
    var chart = Highcharts.chart('container', {
        title: {
            text: ''
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: {
                millisecond: '%H:%M:%S.%L',
                second: '%H:%M:%S',
                minute: '%H:%M',
                hour: '%H:%M',
                day: '%m-%d',
                week: '%m-%d',
                month: '%Y-%m',
                year: '%Y'
            }
        },
        tooltip: {
            dateTimeLabelFormats: {
                millisecond: '%H:%M:%S.%L',
                second: '%H:%M:%S',
                minute: '%H:%M',
                hour: '%H:%M',
                day: '%Y-%m-%d',
                week: '%m-%d',
                month: '%Y-%m',
                year: '%Y'
            }
        },
        yAxis: [{
            title: {
                text: ''
            },
            labels: {
                align: 'center',
                x: 10,
                y: -2,
                reserveSpace: false
            }
        }],
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                lineWidth: 1,
                threshold: null
            }
        },
        series: [{
            type: 'area',
            name: coinName,
            data: data
        }]
    });
}
function drawMarketcapChar(data, coinName) {
    var chart = Highcharts.chart('char03', {
        title: {
            text: ''
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: {
                millisecond: '%H:%M:%S.%L',
                second: '%H:%M:%S',
                minute: '%H:%M',
                hour: '%H:%M',
                day: '%m-%d',
                week: '%m-%d',
                month: '%Y-%m',
                year: '%Y'
            }
        },
        tooltip: {
            dateTimeLabelFormats: {
                millisecond: '%H:%M:%S.%L',
                second: '%H:%M:%S',
                minute: '%H:%M',
                hour: '%H:%M',
                day: '%Y-%m-%d',
                week: '%m-%d',
                month: '%Y-%m',
                year: '%Y'
            }
        },
        yAxis: [{
            title: {
                text: ''
            },
            labels: {
                align: 'center',
                x: 10,
                y: -2,
                reserveSpace: false
            }
        }],
        legend: {
            enabled: false
        },
        series: [{
            type: 'line',
            name: coinName,
            data: data
        }]
    });
}
function drawPie(contener, val, color) {
    var chart = null;
    $(function () {
        $(contener).highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                floating: true,
                text: val * 100 + '%',
                style: { "color": "#555", "fontSize": "15px", }
            },
            plotOptions: {
                pie: {
                    dataLabels: {
                        enabled: false
                    }
                }
            },
            series: [{
                type: 'pie',
                innerSize: '88%',
                name: ' ',
                colors: [color, "#f1f1f1"],
                data: [
                    ['btc成交额', val],
                    ['成交额', 1 - val]
                ]
            }]
        }, function (c) {
            // 环形图圆心
            var centerY = c.series[0].center[1],
                titleHeight = parseInt(c.title.styles.fontSize);
            c.setTitle({
                y: centerY + titleHeight / 2
            });
            chart = c;
        });
    });
}

$('body').on('click', '.close', function () {
    $(this).closest('.theBox').fadeOut('400');
});
if ($('.showannouncement').length > 0) {
    /*function runAnno() {
        setTimeout(function () {
            $('.showannouncement').find('li:first-child').animate({'margin-top': '-30px'},300,function(){
                $(this).css('margin-top','0')
                $('.showannouncement').find('ul').append($(this));
                runAnno();
            });
        }, 3000);
    }*/
    function runAnno() {
        setTimeout(function () {
            $('.showannouncement').find('li:first-child').css('margin-top', '-30px');
            setTimeout(function () {
                $('.showannouncement').find('ul').append($('.showannouncement').find('li:first-child').css('margin-top', '0'));
            }, 400);
            runAnno();
        }, 3000);
    }
    runAnno();
}
if ($('.preview_fixed').length > 0) {
    (function () {
        var ul1 = $('.preview_fixed').find('ul');
        var i = 0;
        var width = $('.preview_fixed').find('ul').width() * (-1);
        $('.preview_fixed').find('ul').eq(0).after(ul1.clone());
        $('.preview_fixed').find('ul').eq(0).after(ul1.clone());
        function runPreview() {
            setTimeout(function () {
                i = i - 1;
                $('.preview_fixed').find('ul').eq(0).css('margin-left', i + 'px');
                if (i < width) {
                    i = 0;
                    $('.preview_fixed').find('ul:last-child').after($('.preview_fixed').find('ul:first-child').css('margin-left', '0'));
                    runPreview()
                }
                else {
                    runPreview()
                }
            }, 30)
        }

        runPreview()
    })()
}
if ($('.option').length > 0) {
    $('.filter').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active')
        } else {
            $(this).addClass('active')
        }
        $(this).find('.option').slideToggle('fast')
    })
    $('.option>li').click(function (e) {
        e.stopPropagation();
        if (!$(this).hasClass('active')) {
            $('.option>li ul').slideUp('fast');
            $(this).find('ul').slideDown('fast');
            $('.option>li').removeClass('active');
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
            $(this).find('ul').slideUp('fast');
        }
    })
}




if ($('.smalltab').length > 0) {
    $('.smalltab a').click(function () {
        var index = $(this).index();
        if (!$(this).hasClass('active')) {
            $(this).closest('.smalltab').find('a').removeClass('active');
            $(this).addClass('active');
            $(this).closest('.tabBody').find('.smalltabBody').hide('fast');
            $(this).closest('.tabBody').find('.smalltabBody').eq(index).fadeIn('fast')
        }
        else {
            return false
        }
    })
}

function loadglobalinfo() {
    $.ajax({
        url: apiHost + "v2/global/?msite=1",
        async: true,
        success: function (data) {
            $(".preview").html(data);
        }
    });

}

function refreshGlobalTicker() {
    setInterval(function () {
        $.ajax({
            url: apiHost + "/global/tickerlist/" ,
            async: true,
            xhrFields: {
                withCredentials: true
            },
            dataType: "json",
            success: function (data) {



            }
        });
    }, 30000);

}

function updateGlobalTicker(tickerRow, cellIndex, cellValue) {

}


function loadmcoinevent() {
    var coincode = $("#mcoincode").val();
    $.ajax({
        url: apiHost + "v2/coinevent/" + coincode + "/",
        async: true,
        success: function (data) {
            if (data.length > 0) {
                $("#coineventtimeline").append(data);
                $("#timeLineBox").css("display", "block");
            }
        }
    });
}


//回到顶部

    var div = '<div class="totop"></div>'
    $('body').append(div);
    $('body').on('click', '.totop', function () {
        $('body,html').animate({ scrollTop: 0 }, 500, function () {
            $('.totop').fadeOut()
        });
    })
    $(window).scroll(function () {
        if ($(window).scrollTop() > 200) {
            $('.totop').fadeIn()
        }
        else {
            $('.totop').fadeOut()
        }
    });

    function search(word) {
        if (word == undefined || word == null || word.length < 1 || word.trim().length < 1) {
            alert("请输入关键词");
            return false;
            //window.location.href = "/search/";
        }
        else {
            window.location.href = "/search?word=" + encodeURIComponent(word);
            //alert(window.location.href = "/search?word=" + encodeURIComponent(word));
        }
    }


    function toLocaleString(n, m) {
        if (m == null || m == "") {
            m = 0;
        }

        var str = n.toLocaleString();
        if (-1 == str.lastIndexOf(".")) {
            return str;
        }
        if (m > 0) {
            str = str.substring(0, str.lastIndexOf(".") + 1 + m);
        } else {
            str = str.substring(0, str.lastIndexOf(".") + m);
        }
        return str;
    }
    function format_market_cap(val) {
        if (val >= 1000000000) {
            val = Math.round(val / 100000000).toLocaleString() + "亿";
        } else if (val >= 100000000) {
            val = (val / 100000000).toFixed(2).toLocaleString() + "亿";
        } else if (val >= 1000000) {
            val = (val / 100000000).toFixed(4).toLocaleString() + "亿";
        } else if (val >= 1000) {
            val = toLocaleString(val, 0);
        }
        else {
            val = toLocaleString(val, 2);
        }
        return val;
    }
    function formatprice(val) {

        var price = val.toString();
        var indx = price.indexOf('.');
        var priceStr = price;
        var counter = 0;
        if (indx > -1) {
            for (var i = price.length - 1; i >= 1; i--) {
                if (price[i] == "0") {
                    counter++;
                    if (price[i - 1] == ".") {
                        counter++;
                        break;
                    }
                } else {
                    break;
                }
            }
            priceStr = "";
            for (var i = 0; i < price.length - counter; i++) {
                priceStr += price[i];
            }
        }
        return priceStr;

    }
    function format_crypto(val) {
        var result;
        if (val >= 1000) {
            result = toLocaleString(val, 2);
        } else if (val >= 1) {
            result = val.toFixed(2);
        } else {
            if (val < 0.00000001) {
                result = val.toPrecision(4)
            } else {
                result = val.toFixed(8);
            }
        }
        return formatprice(result);
    }
    function format_crypto_volume(val) {
        if (val >= 1000000) {
            val = Math.round(val / 10000).toLocaleString() + "万";
        } else if (val >= 100000) {
            val = (val / 10000).toLocaleString() + "万";
        } else if (val >= 1000) {
            val = (val / 10000).toFixed(2).toLocaleString() + "万";
        } else if (val >= 100) {
            val = val.toFixed(0).toLocaleString();
        } else if (val >= 0.1) {
            val = val.toFixed(2).toLocaleString();
        }
        else {
            val = val.toFixed(4).toLocaleString();
        }

        return formatprice(val);
    }
    var currencyCNName = {
        "usd": "美元",
        "eur": "€",
        "cny": "人民币",
        "gbp": "英镑",
        "cad": "加元",
        "rub": "卢布",
        "hkd": "港币",
        "jpy": "日元",
        "aud": "澳元",
        "brl": "巴西雷亚尔",
        "inr": "印尼盾",
        "krw": "韩币",
        "mxn": "比索",
        "idr": "印尼盾",
        "chf": "法郎",
        "eth": "以太坊",
        "btc": "比特币",
		 "twd": "新台币",
    };
    function toggle_currency(currency) {
        var currency_uppercase = currency.toUpperCase();
        var currency_lowercase = currency.toLowerCase();
        var currency_symbols = {
            "usd": "$",
            "eur": "€",
            "cny": "¥",
            "gbp": "£",
            "cad": "$",
            "rub": "<img src='/themes/default/images/ruble.gif'/>",
            "hkd": "$",
            "jpy": "¥",
            "aud": "$",
            "brl": "R$",
            "inr": "₹",
            "krw": "₩",
            "mxn": "$",
            "idr": "Rp",
            "chf": "Fr",
			  "twd": "NT$"
        };
        $(".exchange").html(currencyCNName[currency_lowercase] + '(' + currency_uppercase + ')<i class="arrow"></i>');

        if (currency_lowercase == "btc") {
            $.each([$('.market-cap'), $('.price'), $('.volume')], function () {
                selector_type = this.selector
                $.each(this, function (key, value) {
                    amount = $(this).data("btc");

                    if (amount != "?") {
                        amount = parseFloat(amount)
                        if (selector_type == ".price") {
                            amount = format_crypto(amount);
                        } else if (selector_type == ".volume") {
                            amount = format_crypto_volume(amount);
                        } else {
                            amount = format_market_cap(amount);
                        }
                    }
                    $(this).html(amount + " BTC")
                });
            });
        }
        else if (currency_lowercase == "cny") {
            $.each([$('.market-cap'), $('.price'), $('.volume')], function () {
                selector_type = this.selector
                $.each(this, function (key, value) {
                    amount = $(this).data("cny");

                    if (amount != "?") {
                        amount = parseFloat(amount)
                        if (selector_type == ".price") {
                            amount = format_crypto(amount);
                        } else if (selector_type == ".volume") {
                            amount = format_crypto_volume(amount);
                        } else {
                            amount = format_market_cap(amount);
                        }
                        $(this).html(currency_symbols[currency_lowercase] + amount)
                    } else {
                        $(this).html(amount)
                    }

                });
            });
        }
        else if (currency_lowercase == "eth") {
            foreign_amount = $("#currency-exchange-rates").data(currency_lowercase);
            $.each([$('.market-cap'), $('.price'), $('.volume')], function () {
                selector_type = this.selector
                $.each(this, function (key, value) {
                    slug = $(this).closest('tr').attr("id");
                    amount = $(this).data("usd");

                    if (amount != "?") {
                        amount = parseFloat(amount) / foreign_amount
                        if (selector_type == ".price") {
                            if (slug == "id-ethereum") {
                                amount = 1;
                            }
                            amount = format_crypto(amount);
                        } else if (selector_type == ".volume") {
                            amount = format_crypto_volume(amount);
                        } else {
                            amount = format_market_cap(amount);
                        }
                    }
                    $(this).html(amount + " ETH")
                });
            });
        } else {
            foreign_amount = $("#currency-exchange-rates").data(currency_lowercase);
            $.each([$('.market-cap'), $('.price'), $('.volume')], function () {
                selector_type = this.selector
                $.each(this, function (key, value) {
                    amount = $(this).data("usd");

                    if (amount != "?") {
                        amount = parseFloat(amount) / foreign_amount
                        if (selector_type == ".price") {
                            amount = format_crypto(amount);
                        } else if (selector_type == ".volume") {
                            amount = format_crypto_volume(amount);
                        } else {
                            amount = format_market_cap(amount);
                        }
                        $(this).html(currency_symbols[currency_lowercase] + amount);
                    } else {
                        $(this).html(amount);
                    }

                });
            });
        }
        data_symbol = currency_lowercase
        if (currency_lowercase != "btc") {
            data_symbol = "usd"
        }
        $.each([$('.percent-1h'), $('.percent-24h'), $('.percent-7d')], function () {
            $.each(this, function (key, value) {
                slug = $(this).closest('tr').attr("id");
                if (slug == "id-ethereum" && currency_lowercase == "eth") {
                    $(this).html("0.00" + "%")
                } else {
                    convert_percent($(this), data_symbol)
                }
            });
        });
    }
    function toggle_native() {

        $(".exchange").html("平台价格 <i class=\"arrow\"></i>");
        $.each([$('.price'), $('.volume')], function () {
            selector_type = this.selector
            $.each(this, function (key, value) {
                amount = $(this).data("native");
                if (amount == null) {
                    amount = "N/A";
                }
                else if (amount != "?") {
                    amount = parseFloat(amount)
                    if (selector_type == ".price") {
                        amount = format_crypto(amount);
                    } else if (selector_type == ".volume") {
                        amount = format_crypto_volume(amount);
                    } else {
                        amount = format_market_cap(amount);
                    }
                }
                $(this).html(amount);
            });
        });
    }
    function toggle_platform() {
        $(".exchange").html("Platform" + " <i class=\"arrow\"></i>");
        $.each([$('.market-cap'), $('.price'), $('.volume')], function () {
            selector_type = this.selector
            $.each(this, function (key, value) {
                amount = $(this).data("platform");
                var platform_symbol = $(this).closest('tr').data("platformsymbol");
                if (amount == null || amount === "None") {
                    amount = "?";
                }
                else if (amount != "?") {
                    amount = parseFloat(amount)
                    if (selector_type == ".price") {
                        amount = format_crypto(amount);
                    } else if (selector_type == ".volume") {
                        amount = format_crypto_volume(amount);
                    } else {
                        amount = format_market_cap(amount);
                    }
                }
                var text = amount + " " + platform_symbol
                $(this).html(text);
            });
        });
        $.each([$('.percent-1h'), $('.percent-24h'), $('.percent-7d')], function () {
            $.each(this, function (key, value) {
                convert_percent($(this), "platform")
            });
        });
    }
    $(document).ready(function () {

        if ($('.price-toggle').length > 0) {
            $(".price-toggle").click(function () {
                var text = $(this).text();
                var currency = $(this).data('currency');

                if (currency == "native") {
                    toggle_native();
                } else if (currency == "platform") {
                    toggle_platform();
                } else {
                    toggle_currency(currency);
                }
            });
        }
        if ($('.unitList').length > 0) {
            $('.unitList a').click(function () {
                if ($(this).hasClass('active')) {
                    return;
                }
                $('.unitList a').removeClass('active');
                $(this).addClass('active')
            })
        }

        if (window.location.hash) {
            hash = window.location.hash.substring(1);

            if (hash == "native" || hash == "BTC" || hash == "ETH" || hash == "USD" || hash == "EUR" || hash == "CNY" || hash == "GBP" || hash == "CAD" || hash == "RUB" || hash == "HKD" || hash == "JPY" || hash == "AUD" || hash == "BRL" || hash == "INR" || hash == "KRW" || hash == "MXN" || hash == "IDR" || hash == "CHF") {

                if ($(".unitList a[href=#" + hash + "]").length > 0) {
                    $(".unitList a[href=#" + hash + "]").trigger("click");
                }
            }
        }



    });

    function MoreConceptDetail(btn, url, obj) {
        url = apiHost + url;
        page = parseInt(btn.attr('page')) + 1;
        var urlparam = "";
        if (url.indexOf("?") > -1) {
            urlparam = "&page=" + page;
        } else {
            urlparam = "?page=" + page;
        }
        info = $.ajax({
            url: url + urlparam,
            async: false,
            dataType: "json",
            success: function (data) {
                if (data == '') {
                    btn.css("display", "none");
                }
                else {
                    if (data != 'error') {

                        $(".tablefixed").append(data.result1);
                        $(".tableMain").append(data.result2);
                        btn.attr("page", page);
                    }
                }
            }
        });

    }
//******************************用户注册
    //手机格式
    function checkPhone(p) {

        var re = /^1(3|4|5|7|8)\d{9}$/;
        if (!re.test(p)) {
            return false;
        }
        else return true;
    }

    //发送短信验证码（手机找回）
    $('#sendsmsreg').click(function () {
        var telno = $('#user').val();
        if (telno.length == 0) {
            layer.msg("手机号码不能为空!");
        }
        else {
            $.ajax({
                url: apiHost + "tool/GetSms?telno=" + telno,
                data: telno,
                type: "get",
                async: true,
                xhrFields: {
                    withCredentials: true
                },
                success: function (data) {
                    regsmsResponse(data);
                }
            });
        }

    })

    //处理手机重置密码发送短信验证码的反馈信息
    function regsmsResponse(data) {
        var result = eval("(" + data + ")");
        if (result == "1") {
            layer.msg("手机短信验证码发送成功!");
        }
        else if (result == "0") {
            layer.msg("手机短信验证码发送成功!");
        }
        else if (result == "2") {
            layer.msg("短信验证码发送频繁, 休息下吧!");
        }
        else if (result == "3") {
            layer.msg("手机号码已注册!");
        }
        else {
            layer.msg("手机号码不能为空!");
        }
    }

    $('#register').click(function () {
        var name = $('#user').val();
        var phonecode = $('#phonecode').val();
        var pwd1 = $('#pwd').val();
        var pwd2 = $('#pwd2').val();
        var code = $('#code').val();
        //var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if (name == '' || phonecode == '' || pwd1 == '' || pwd2 == '' || code == "") {
            layer.msg('请填写完整表单再提交');
            return false
        }
        if (!checkPhone(name)) {
            layer.msg('手机号码格式不正确');
            return false
        }
        if (pwd1 !== pwd2) {
            layer.msg('两次密码输入必须一致');
            return false
        }
        if (pwd1.length < 6) {
            layer.msg('密码长度必须大于6');
            return false
        }
        var ii = layer.load(2);
        var parms = new Object();
        parms["userid"] = name;
        parms["password"] = pwd1;
        parms["confirmPwd"] = pwd2;
        parms["verifyCode"] = code;
        parms["code"] = phonecode;
        $.ajax({ 
            url: apiHost + "user/register",
            type: 'post',
            data: parms,
            async: true,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                registerResponse(data);
                layer.close(ii)
            },
            error: function () {
                layer.close(ii)
                layer.msg('网络错误，请重试')
            }
        })
    })

    //处理注册的反馈信息
    function registerResponse(data) {
        var result = eval("(" + data + ")");
        if (result.status == "success") {
            layer.msg(result.content);
            setTimeout(function () { window.location.href = '/login/'; }, 3000);
           
        }
        else {
            layer.msg(result.content);
        }

    }
//********************************

//******************************用户登录
    $('#regAccount').click(function () {
        window.location.href = '/register/';
    })
    $('#usertickerlogin').click(function () {
        window.location.href = '/login/';
    })

    $('#loginsite').click(function () {
        if ($('#user').val() == '' || $('#pwd').val() == '') {
            layer.msg('请填写账号和密码');
            return false
        }
        var ii = layer.load(2);
        var parms = new Object();
        parms["userid"] = $('#user').val().trim();
        parms["password"] = $('#pwd').val().trim();
        $.ajax({
            url: apiHost + "user/login",
            type: 'post',
            data: parms,
            async: true,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                loginResponse(data);
                layer.close(ii);//关掉加载动画
            },
            error: function () {
                layer.close(ii);
                layer.msg('网络错误，请重试')
            }
        })
    })
    //处理登录的反馈信息
    function loginResponse(data) {
        var result = eval("(" + data + ")");
        if (result.status == "success") {
            layer.msg(result.content);
            window.location.href = '/?v=' + Math.random();
        }
        else {
            layer.msg(result.content);
        }

    }
//********************************
//***********************找回密码
    function backHome() {
        window.location.href = '/';
    }
    //发送短信验证码（手机找回）
    $('#sendsms').click(function () {
        var telno = $('#phoneNum').val();
        if (telno.length == 0) {
            layer.msg("手机号码不能为空!");
        }
        else {
            $.ajax({
                url: apiHost + "tool/FindSms?telno=" + telno,
                data: telno,
                type: "get",
                async: true,
                xhrFields: {
                    withCredentials: true
                },
                success: function (data) {
                    resetsmsResponse(data);
                }
            });
        }

    })

    //处理手机重置密码发送短信验证码的反馈信息
    function resetsmsResponse(data) {
        var result = eval("(" + data + ")");
        if (result == "1") {
            layer.msg("手机短信验证码发送成功!");
        }
        else if (result == "0") {
            layer.msg("手机短信验证码发送成功!");
        }
        else if (result == "2") {
            layer.msg("短信验证码发送频繁, 休息下吧!");
        }
        else if (result == "3") {
            layer.msg("手机号码不存在!");
        }
        else {
            layer.msg("手机号码不能为空!");
        }


    }
    //手机找回提交
    $('#sendSmsbtn').click(function () {
        var mobile = $('#phoneNum').val();
        var imgcode = $('#imgcode').val();
        var phonecode = $('#phonecode').val();
        var pwd = $('#pwd').val();
        var repwd = $('#repwd').val();
        //var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;

        if (mobile == '' || imgcode == '' || phonecode == '' || pwd == '' || repwd == '') {
            layer.msg('请填写完整表单再提交');
            return false
        }

        if (!checkPhone(mobile)) {
            layer.msg('手机号码格式不正确');
            return false
        }
        if (pwd !== repwd) {
            layer.msg('两次密码输入必须一致');
            return false
        }
        if (pwd.length < 6) {
            layer.msg('密码长度必须大于6');
            return false
        }

        var ii = layer.load(2);
        var parms = new Object();

        parms["findtype"] = "phone";
        parms["mobile"] = mobile;
        parms["imgcode"] = imgcode;
        parms["code"] = phonecode;
        parms["password"] = pwd;
        parms["confirmPwd"] = repwd;

        $.ajax({
            url: apiHost + "user/findpwd",
            type: 'post',
            data: parms,
            async: true,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                mobilefindpwdResponse(data);
                layer.close(ii)
            },
            error: function () {
                layer.close(ii)
                layer.msg('网络错误，请重试')
            }
        });


    })
    
    //处理手机找回的反馈信息
    function mobilefindpwdResponse(data) {

        var result = eval("(" + data + ")");
        if (result.status == "success") {
            layer.msg("密码重设成功，请记住新密码!");
            window.location.href = '/';
        }
        else {
            layer.msg(result.content);
        }

    }

    //邮箱找回提交
    $('#sendEmail').click(function () {
        var email = $('#email').val();
        var verifycode = $('#code').val();
        var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;

        if (email == '' || verifycode == '') {
            layer.msg('请填写完整表单再提交');
            return false
        }
        if (!myreg.test(email)) {
            layer.msg('邮箱格式不正确');
            return false
        }
      
        var ii = layer.load(2);
        var parms = new Object();

        parms["findtype"] = "email";
        parms["mail"] = email;
        parms["imgcode"] = verifycode;
        $.ajax({
            url: apiHost + "user/findpwd",
            type: 'post',
            data: parms,
            async: true,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                findpwdResponse(data);
                layer.close(ii)
            },
            error: function () {
                layer.close(ii)
                layer.msg('网络错误，请重试')
            }
        });


    })

    //处理邮箱找回的反馈信息
    function findpwdResponse(data) {

        var result = eval("(" + data + ")");
        if (result.status == "success") {
            layer.msg(result.content);
            window.location.href = '/';
        }
        else {
            layer.msg(result.content);
        }

    }

    //重置密码
    $('#resetpwd').click(function () {
        var pwd1 = $('#pwd').val();
        var pwd2 = $('#pwd2').val();

        if (pwd1 == '' || pwd2 == '') {
            layer.msg('请填写完整表单再提交');
            return false
        }
        if (pwd1 !== pwd2) {
            layer.msg('两次密码输入必须一致');
            return false
        }
        if (pwd1.length < 6) {
            layer.msg('密码长度必须大于6');
            return false
        }

        var ii = layer.load(2);
        var parms = new Object();

        parms["password"] = pwd1;
        parms["code"] = $('#hCode').val().trim();
        $.ajax({
            url: apiHost + "user/resetpwd",
            type: 'post',
            data: parms,
            async: true,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                resetPwdResponse(data);
                layer.close(ii)
            },
            error: function () {
                layer.close(ii)
                layer.msg('网络错误，请重试')
            }
        });


    })
    
    //处理重设密码的反馈信息
    function resetPwdResponse(data) {

        var result = eval("(" + data + ")");
        if (result.status == "success") {
            layer.msg("重设成功，请记住新密码!");

            window.location.href = '/login/';
        }
        else {
            layer.msg(result.content);
        }

    }
//*******************************

////////用户自选////////
    function addlogin()
    {
        alert("请先登录，再进行自选操作！");
    }
    //添加自选(全网)
    function addchose() {

        $('#FocusChose').attr("disabled", "disabled");
        $('#FocusChose').html("提交中...");
        var parms = new Object();
        var coincode = $("#mcoincode").val();
        parms["coincode"] = coincode;
        parms["type"] = "1";
        $.ajax({
            url: apiHost + "user/coinfocus",
            data: parms,
            type: "post",
            async: true,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                addfocusResponse(data);
            }
        });

    }
    function addfocusResponse(data) {

        var result = eval("(" + data + ")");
        if (result.status == "success") {
            $('#FocusChose').attr("onclick", "cancelchose()");
            $('#FocusChose').attr("class", "more delete");

            $('#FocusChose').removeAttr("disabled");
            $('#FocusChose').html("移除自选");
        }
        else {
            alert(result.content);
            $('#FocusChose').removeAttr("disabled");
            $('#FocusChose').attr("class", "more add");
            $('#FocusChose').html("添加自选");
        }

    }

    //取消自选（全网）
    function cancelchose() {

        $('#FocusChose').attr("disabled", "disabled");
        $('#FocusChose').html("提交中...");
        var parms = new Object();
        var coincode = $("#mcoincode").val();
        parms["coincode"] = coincode;
        parms["type"] = "2";
        $.ajax({
            url: apiHost + "user/coinfocus",
            data: parms,
            type: "post",
            async: true,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                cancelfocusResponse(data);
            }
        });
    }
    function cancelfocusResponse(data) {

        var result = eval("(" + data + ")");
        if (result.status == "success") {
            $('#FocusChose').attr("onclick", "addchose()");
            $('#FocusChose').attr("class", "more add");
            $('#FocusChose').removeAttr("disabled");
            $('#FocusChose').html("添加自选");
        }
        else {
            alert(result.content);
            $('#FocusChose').removeAttr("disabled");
            $('#FocusChose').attr("class", "more delete");
            $('#FocusChose').html("移除自选");
        }
    }


    //添加自选(交易对)
    function addsitechose(keys) {

        var id = keys.attr("id");

        keys.attr("disabled", "disabled");
        keys.html("提交中...");
        var parms = new Object();
        var coincode = id.split("#")[1];
        var sitecode = id.split("#")[2];
        var symbolpair = id.split("#")[3];
        parms["coincode"] = coincode;
        parms["sitecode"] = sitecode;
        parms["symbolpair"] = symbolpair;
        parms["type"] = "1";

        $.ajax({
            url: apiHost + "user/coinsitefocus",
            data: parms,
            type: "post",
            async: true,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                addsitefocusResponse(data);
            }
        });
        function addsitefocusResponse(data) {

            var result = eval("(" + data + ")");
            if (result.status == "success") {
                keys.attr("onclick", "cancelsitechose($(this))");
                keys.attr("class", "more delete");

                keys.removeAttr("disabled");
                keys.html("移除自选");
            }
            else {
                alert(result.content);
                keys.removeAttr("disabled");
                keys.attr("class", "more add");
                keys.html("添加自选");
            }

        }
    }


    //取消自选（交易对）
    function cancelsitechose(keys) {

        var id = keys.attr("id");

        keys.attr("disabled", "disabled");
        keys.html("提交中...");
        var parms = new Object();
        var coincode = id.split("#")[1];
        var sitecode = id.split("#")[2];
        var symbolpair = id.split("#")[3];
        parms["coincode"] = coincode;
        parms["sitecode"] = sitecode;
        parms["symbolpair"] = symbolpair;
        parms["type"] = "2";
        $.ajax({
            url: apiHost + "user/coinsitefocus",
            data: parms,
            type: "post",
            async: true,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                cancelsitefocusResponse(data);
            }
        });


        function cancelsitefocusResponse(data) {


            var result = eval("(" + data + ")");
            if (result.status == "success") {
                keys.attr("onclick", "addsitechose($(this))");
                keys.attr("class", "more add");
                keys.removeAttr("disabled");
                keys.html("添加自选");
            }
            else {
                alert(result.content);
                keys.removeAttr("disabled");
                keys.attr("class", "more delete");
                keys.html("移除自选");
            }
        }
    }

//（自选列表）移除自选
    function removesitechose(keys) {
        var id = keys.attr("id");
        //var row=keys.closest("tr").index();
        //alert("abc"+row);
        var parms = new Object();
        var coincode = id.split("#")[1];
        var sitecode = id.split("#")[2];
        var symbolpair = id.split("#")[3];
        parms["coincode"] = coincode;
        parms["sitecode"] = sitecode;
        parms["symbolpair"] = symbolpair;
        parms["type"] = "2";
        delCustom(symbolpair, function () {
            keys.attr("disabled", "disabled");
            keys.html("提交中...");
            $.ajax({
                url: apiHost + "user/coinsitefocus",
                data: parms,
                type: "post",
                async: true,
                xhrFields: {
                    withCredentials: true
                },
                success: function (data) {
                    removesitefocusResponse(data);
                    $('.layui-layer-close').trigger('click');
                }
                
            });

        });

        function removesitefocusResponse(data) {


            var result = eval("(" + data + ")");
            if (result.status == "success") {
                keys.parents("tr").remove();
                var row = keys.parents("tr").attr('id').replace('_2','');
                //alert('row'+row);
                var tbRows = $("#table tr");
                for (var i = 1; i < tbRows.length; i++) {
                    tbRows.eq(i).find("td:first-child").html(i);
                }
                $('#'+row).remove();

            }
            else {
                keys.removeAttr("disabled");
                keys.html("移除自选");
            }
        }
    }

    function delCustom(text, callback) {
        var div = '<div class="delbox" style="padding: 10px;text-align: center;margin-top: 10px"><p>是否删除' + text + '？</p><div class="btngroup" style="margin-top:20px"><button class="sure">删除</button><button class="cancel">取消</button></div></div>'
        var text = $(this);
        layer.open({
            type: 1,
            title: '删除自选',
            area: ['200px', '150px'],
            shadeClose: true, //点击遮罩关闭
            content: div
        });
        $('body').on('click', '.delbox .sure', function () {
            return callback()
        });
        $('body').on('click', '.delbox .cancel', function () {
            $('.layui-layer-close').trigger('click')
        })
    }

///////////////////////

    ///////以下是广告设置////////
    function getCookie(key) {
        if (document.cookie.length > 0) {
            c_start = document.cookie.indexOf(key + "=");
            if (c_start != -1) {
                c_start = c_start + key.length + 1;
                c_end = document.cookie.indexOf(";", c_start);
                if (c_end == -1) c_end = document.cookie.length;
                return document.cookie.substring(c_start, c_end)
            }
            else {
                return ''
            }
        } else {
            return ''
        }
    }
        function checkCooieTimeout(key) {
        if (getCookie(key) != '') {
            var old = getCookie(key).split('#')[1];
            var now = new Date().getDate().toString();
            if (old >= now) {
                return false//没过期
            }
        }
        return true //过期
    }

  function setCookie(key, date) {
        if (!date) {
            date = (parseInt(new Date().getDate() )+ 6).toString();
        }
        var val = Math.random();
        document.cookie = key + '=' + val + '#' + date;
    }
    function setOutlink(option, type) {
        if (option.id == '' || option.id == undefined) {
            console.log('广告id有误');
            return
        }
        if (option.url == '' || option.url == undefined) {
            console.log(option.id + '：链接地址有误');
            return
        }
        if (option.img == '' || option.img == undefined) {
            console.log(option.id + '：图片地址有误');
            return
        }
        var str = $('<div><a href=""><img src="" alt=""></a><span class="close"></span></div>');
        str.find('a').attr('href', option.url).attr('id', option.id);
        str.find('img').attr('src', option.img);
        if (type == 'top') {
            $('.theBox-top').append(str);
            $('.theBox-top .close').click(function () {
                console.log('close');
                setCookie(option.id)
            })
        }
        else if (type == 'mid_01') {
            $('.theBox-mid_1').append(str);
            $('.theBox-mid .close').click(function () {
                console.log('close');
                setCookie(option.id)
            })
        }
        else if (type == 'mid_02') {
            $('.theBox-mid_2').append(str);
            $('.theBox-mid .close').click(function () {
                console.log('close');
                setCookie(option.id)
            })
        }
        else {
            $('.theBox-bottom').append(str);
            $('.theBox-bottom .close').click(function () {
                console.log('close');
                setCookie(option.id)
            })
        }

    }
	
	
    function loaduserinfo() {

        $.ajax({
            url: apiHost + 'user/userinfo/', 
            async: false,
            dataType: "json",
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                if (null != data && null != data.Account && data.Account.length > 0)
                {
                   
                    $("#userinfo").css("display", "block");
                    $("#username").html(data.UserName);
                } else {
                    $(".loginBar").css("display", "block");
                }
               
            }
        });
    }