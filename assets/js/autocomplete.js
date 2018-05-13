var socketUrl = '//socket.feixiaohao.com/lcc';
var apiHots = "//mapi.feixiaohao.com/";
var con = $('<div class="autocomplete"></div>');
var tit = $('<div class="tit"></div>');
var ul = $('<ul class="datalist"></ul>');
var s = $('<style>.autocomplete{position:absolute;border:1px solid #eaecef;background:#fff;overflow:hidden;max-width:250px;z-index:999999;box-shadow: 2px 2px 3px #999}.autocomplete ul{padding:0;margin:0;display:block;padding:5px}.autocomplete ul li{height:35px;line-height:35px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;padding:0 5px}.autocomplete ul li a{color:#676a6c;text-decoration:none;font-size:14px;display:block}.autocomplete ul li:hover{background:#3499da;color:#fff}.autocomplete ul li:hover a{color:#fff}.autocomplete .tit{border-bottom:1px solid #eaecef;padding:5px;font-size: 14px;font-family: "Microsoft YaHei",sans-serif;background: #f1f1f1;line-height: normal!important}.autocomplete ul li a img{margin-right: 5px;vertical-align: -2px;}</style>')
var $li = $('<li><a href=""><img src="" alt=""></a></li>');
$('head').append(s);

function getCoin(callback) {
	try {
		$.getJSON(apiHots+ 'search/relatedallword', function (result) {
				return callback(result)
			}
		)
	} catch (e) {
		console.log(e)
	}
}

function autoComplete(a, result) {
    function quicksearch(key, data) {
        var result = { coin: [], exchange: [] };
        if (key === '') {
            return result
        }
        key = key.toLowerCase();
        for (var h = 0; h < data.length; h++) {//判断简称全等
            var cell = data[h].toLowerCase().split('#');
            if (cell[0][0] === '0' && cell[4] === key) {
                if (result.coin.length !== 5) {
                    //console.log('do', 0);
                    result.coin.push(data[h])
                }
            }
        }

        for (var g = 0; g < data.length; g++) {//判断全称全等
            var cell = data[g].toLowerCase().split('#');
            if (cell[0][0] === '0' && cell[2] === key && cell[4] !== key) {
                if (result.coin.length !== 5) {
                    //console.log('do', 1);
                    result.coin.push(data[g])
                }
            }
        }

        for (var i = 0; i < data.length; i++) {//单字符下判断全名的首字母和简称首字母中文
            var cell = data[i].toLowerCase().split('#');
            if (key.length == 1) {
                if (cell[0][0] === '0' && result.coin.length !== 5 && (cell[2].indexOf(key) === 0 || cell[3].indexOf(key) === 0 || cell[4].indexOf(key) === 0)) {
                    //console.log('do', 2);
                    result.coin.push(data[i])
                } else if (cell[0][0] === '1' && result.exchange.length !== 5 && (cell[2].indexOf(key) === 0 || cell[1].indexOf(key) === 0)) {
                    //console.log('do', 2.5);
                    result.exchange.push(data[i])
                }
            }
        }

        for (var j = 0; j < data.length; j++) {//单字符下判断全名简称中文是否包含key
            var cell = data[j].toLowerCase().split('#');
            if (key.length == 1 && result.coin.length !== 5) {
                if (cell[0][0] === '0' && (cell[2].indexOf(key) > 0 || cell[3].indexOf(key) > 0 || cell[4].indexOf(key) > 0)) {
                    //console.log('do', 5);
                    result.coin.push(data[j])
                } else if (cell[0][0] === '1' && result.exchange.length !== 5 && (cell[2].indexOf(key) > 0 || cell[1].indexOf(key) > 0)) {
                    //console.log('do', 5.5);
                    result.exchange.push(data[j])
                }
            }
        }

        for (var e = 0; e < data.length; e++) {//多个字母的情况下全称中文是否由关键字开头
            var cell = data[e].toLowerCase().split('#');
            if (cell[0][0] === '0' && result.coin.length !== 5 && key.length > 1) {
                if ((cell[2].indexOf(key) === 0 || cell[3].indexOf(key) === 0 || cell[4].indexOf(key) === 0) && cell[4] !== key && cell[2] !== key) {
                    //console.log('do', 3);
                    result.coin.push(data[e]);
                }
            } else if (cell[0][0] === '1' && result.exchange.length !== 5 && key.length > 1 && (cell[2].indexOf(key) === 0 || cell[1].indexOf(key) === 0)) {
                //console.log('do', 3.5);
                result.exchange.push(data[e])
            }
        }


        for (var f = 0; f < data.length; f++) {//多个字母的情况下全称中文是否包含key
            var cell = data[f].toLowerCase().split('#');
            if (cell[0][0] === '0' && result.coin.length !== 5 && key.length > 1) {
                if ((cell[2].indexOf(key) > 0 || cell[3].indexOf(key) > 0 || cell[4].indexOf(key) > 0) && cell[4] !== key && cell[4][0] !== key) {
                    //console.log('do', 4);
                    result.coin.push(data[f]);
                }
            } else if (cell[0][0] === '1' && result.exchange.length !== 5 && key.length > 1 && (cell[2].indexOf(key) > 0 || cell[1].indexOf(key) > 0)) {
                //console.log('do', 4.5);
                result.exchange.push(data[f])
            }
        }
        return result
    }

    function quickSearch() {
        var q = a.val().toString().replace("\'", '');
        //console.log(q);
        if (q === '') {
            $('body').find('.autocomplete').remove();
            return
        }
        var ul1 = ul.clone();
        var ul2 = ul.clone();
        var h = '30px';
        var w = parseInt(a.css('width')) + parseInt(a.css('padding-left')) + parseInt(a.css('padding-right')) + 'px';
        var connew = con.clone();
        var data = quicksearch(q, result);
        if (data.coin.length === 0 && data.exchange.length === 0) {
            $('body').find('.autocomplete').remove();
            return
        }
        for (var e = 0; e < data.coin.length; e++) {
            var str = data.coin[e].split('#');
            var cell = $li.clone();
            var img = '';
            if (str[5]) {//是否有小图
                img = '<img src="//static.feixiaohao.com/' + str[5] + '">';
            }
            cell.find('a').attr('href', '/currencies/' + str[1] + "/").attr('title', str[1]).html(img + str[2] + '(' + str[4] + ')');
            ul1.append(cell);
        }
        for (var g = 0; g < data.exchange.length; g++) {
            var str = data.exchange[g].split('#');
            var cell = $li.clone();
            var img = '';
            if (str[4]) {//是否有小图
                img = '<img src="//static.feixiaohao.com/' + str[4] + '">';
            }
            cell.find('a').attr('href', '/exchange/' + str[1] + "/").attr('title', str[1]).html(img + str[2]);
            ul2.append(cell);
        }

        if (ul1.find('li').length != 0) {
            tit.clone().text('货币').appendTo(connew);
            ul1.appendTo(connew);
        }
        if (ul2.find('li').length != 0) {
            tit.clone().text('市场').appendTo(connew);
            ul2.appendTo(connew);
        }

        $('body').find('.autocomplete').remove();
        var o = a.closest('.searchForm');
        if (!o.hasClass('searchForm2')) {
            h = '55px'
        } else {
            h = '30px'
        }
        if (o.hasClass('titSearch')) {
            h = '30px'
        }

        connew.css('top', h).css('min-width', w);
        o.append(connew);

        $('body').click(function () {
            $('body').find('.autocomplete').remove();
        });
        $('body').find('.autocomplete').find('a').click(function (e) {
            e.stopPropagation();
            a.val($(this).text());
            $('body').find('.autocomplete').remove();
        })
    }

    a[0].oninput = quickSearch;
    a[0].propertychange = quickSearch;


    a.focus(function () {
        $(document).keydown(function (event) {
            if (event.keyCode == 13) {
                var btn = a.closest('.searchForm').find('.icon-search').trigger('click');
                var btn = a.closest('.searchForm').find('button').trigger('click');
            }
        });
    })
}