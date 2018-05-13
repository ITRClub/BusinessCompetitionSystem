<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('include/header'); ?>
	<link href="<?php echo base_url('assets/css'); ?>/transactionSite.css?v=1.18" rel="stylesheet">
	<title><?php echo $coinCNName; ?>价格 / ITRClub商赛系统</title>
</head>

<body>

<?php $this->load->view('include/nav'); ?>

<div class="content">
	<div class="box coinHead">
		<div class="boxTit">
			<h1>
				<img src="<?php echo base_url('assets/img/coin').'/'.$coinName.'.png'; ?>"><?php echo $coinCNName; ?>(<?php echo $coinENName; ?>)
			</h1>
		</div>
		<div class="price1">
			<div class="main">
				<div id="<?php echo $coinName; ?>_last"></div>
				<br>
				涨跌幅：<span id="<?php echo $coinName; ?>_extent">4.54%</span>
			</div>
		</div>
		<div class="lowheight">
			<div>
				<span>开盘价</span><div id="<?php echo $coinName; ?>_open"></div>
			</div>
			<div>
				<span>24H最高</span><div id="<?php echo $coinName; ?>_high"></div>
			</div>
			<div>
				<span>24H最低</span><div id="<?php echo $coinName; ?>_low"></div>
			</div>
		</div>
	</div>

	<div class="tabBox">
		<div class="boxTit">
			<h2 id='tabBox_1' class="tabtit active" style="width:50%" onclick="changeTabBox('1');"><?php echo strtoupper($coinName); ?>介绍</h2>
			<h2 id='tabBox_2' class="tabtit" style="width:50%" onclick="changeTabBox('2');">基本信息</h2>
		</div>
		<div id='tabTextBox_1' class="tabBody">
			<div class="textBox maxHeight">
				<?php echo $coinDesc; ?>
			</div>
			<div class="seemore"><span class="expandcoindesc">点击展开</span></div>
		</div>
		
		<!-- ▼ 币种基本信息 ▼ -->
		<div id='tabTextBox_2' class="tabBody" style="display:none">
			<ul class="tableinfo">
				<li class="longlist">
					<span class="tit">中文名</span>
					<?php echo $coinCNName; ?>
				</li>
				<li class="shotlist">
					<div class="tit">英文名</div>
					<?php echo $coinENName; ?>
				</li>
				<li>
					<div class="tit">简称</div>
					<?php echo strtoupper($coinName); ?>
				</li>
			</ul>
		</div>
		<!-- ▲ 币种基本信息 ▲ -->
		
	</div>

	<?php if($this->session->userdata('isLogin')===1){ ?>

	<div class="box mainInfo">
		<div class="leftside">
			<input type="hidden" id="type" value="1">
			<input type="hidden" id="balance" value="<?php echo $balance; ?>">

			<div class="val">交易中心</div>
			<br>
			<button class="btn btn-danger" id="type_1" onclick="changeTransType()">买入</button> | <button class="btn btn-default" id="type_2" onclick="changeTransType()">卖出</button>
			<!--font style="color:orange;font-weight:bold;font-size:15px;">（备注：卖出货币前请点击“买入”按钮切换）</font-->
			<br>
			<div class="tit">交易币数：<input id="coinNum" class="input" placeholder="请输入欲交易的货币数量" oninput="calMoney()"></div>
			<div class="tit" id="money"></div>
			<div class="tit" id="balance_show"></div>
			<div class="tit" id="coinBalance_show"></div>
			<br>
			<button class="btn btn-primary" onclick="submitTrans()" id="submitTrans">提交交易</button>
		</div>
	</div>

	<?php }else{ ?>

	<div class="box mainInfo">
		<div class="leftside">
			<div class="val">亲，您还没登录所以无法交易哦！<br>请<a href="<?php echo base_url('login'); ?>">点此登录 / 注册</a>哈~</div>
		</div>
	</div>

	<?php } ?>
</div>

<?php $this->load->view('include/script'); ?>

<script>
var token="<?php echo $token; ?>";
var coinName="<?php echo $coinName; ?>";

<?php if($this->session->userdata('isLogin')===1){ ?>
updateBalance();
<?php } ?>

// 点击展开/收起币种介绍
$('.expandcoindesc').click(function() {
	if (!$(this).hasClass('active')) {
		$(this).closest('.tabBody').find('.textBox').css('max-height', 'none');
		$(this).closest('.tabBody').find('.textBox').css('padding-bottom', '20px');
		$(this).addClass('active').text('点击收起');
	} else {
		$(this).closest('.tabBody').find('.textBox').css('max-height', '70px');
		$(this).closest('.tabBody').find('.textBox').css('padding-bottom', '0');
		$(this).removeClass('active').text('点击展开');
	}
});


function changeTabBox(tabBoxId){
	tabBoxClass=$("#tabBox_"+tabBoxId).attr("class");

	if(tabBoxClass.indexOf("active")==-1){
		$("[id^=tabBox_]").attr("class","tabtit");
		$("#tabBox_"+tabBoxId).attr("class","tabtit active");
		
		$("[id^=tabTextBox_]").attr("style","display:none;");
		$("#tabTextBox_"+tabBoxId).attr("style","");
	}
}


function calMoney(){
	coinNum=$("#coinNum").val();
	balance=$("#balance").val();
	type=$("#type").val();
	length=coinNum.length;
	dotLoc=coinNum.indexOf(".");

	// 检测币数是否为小数类型
	if(!isDecimal(coinNum)){
		$("#coinNum").val(coinNum.substr(0,length-1));
		return false;
	}

	// 检测币数的小数点后是否超过8位
	if(dotLoc>0){
		decimalLength=length-dotLoc-1;
		if(decimalLength>8){
			alert("交易币数量的小数仅限8位！");
			$("#coinNum").val(coinNum.substr(0,dotLoc+9));
			return false;
		}
	}

	price=$("#"+coinName+"_last").html();
	price=price.substr(1);
	money=coinNum*price;

	// 交易额大于当前钱包余额
	if(money>balance && type==1){
		alert("交易金额大于当前余额，请注意！");
		$("#submitTrans").attr("disabled","disabled");
	}else{
		$("#submitTrans").removeAttr("disabled");
	}
	
	$("#money").html("交易金额："+money.toFixed(2));
}


function isDecimal(String){
var Letters="1234567890.";
var i,c;
if(String.charAt(0)=='-'||String.charAt(String.length-1)=='-'){
	return false;
}
for(i=0;i<String.length;i++){
	c=String.charAt(i);
	if(Letters.indexOf(c)<0){
		return false;
	}
}
return true;
}


function changeTransType(){
	type=$("#type").val();

	if(type==1){
		$("#type").val("2");
		$("#type_1").attr("class","btn btn-default");
		$("#type_2").attr("class","btn btn-success");
	}else if(type==2){
		$("#type").val("1");
		$("#type_1").attr("class","btn btn-danger");
		$("#type_2").attr("class","btn btn-default");
	}
}


function submitTrans(){
	coinNum=$("#coinNum").val();
	type=$("#type").val();

	if(!isDecimal(coinNum)){
		alert("交易币数含有非法字符串！请检查！");
		return false;
	}

	$.ajax({
		url:APP_URL+"transaction/toTransaction",
		type:"post",
		dataType:"json",
		data:{"token":token,"type":type,"coinName":coinName,"coinNum":coinNum},
		error:function(e){
			console.log(e);
		},
		success:function(ret){
			console.log(ret);

			if(ret.code=="200"){
				updateBalance();
			}else if(ret.message=="noCoinBalance"){
				alert("持有货币数量不足！");
			}else if(ret.message=="noBalance"){
				alert("余额不足！");
			}else if(ret.message=="transFailed"){
				alert("交易失败！请联系管理员！");
			}else{
				alert("未知错误！");
			}
		}
	});
}


function updateBalance(){
	$.ajax({
		url:APP_URL+"api/wallet/getInfo",
		dataType:"json",
		type:"get",
		error:function(e){
			console.log(e);
		},
		success:function(ret){
			balance=ret.data['balance'];
			allCoinBalance=JSON.parse(ret.data['coin_balance']);
			coinBalance=allCoinBalance[coinName];
			$("#balance_show").html("USD余额："+balance);
			$("#coinBalance_show").html(coinName.toUpperCase()+"余额："+coinBalance);
		}
	});
}
</script>

<!-- ▼ 自动刷新币价脚本 ▼ -->
<script>
// 自动刷新时间间隔秒数
var updateTime=10;

// 首次加载页面成功后先刷新第一次
refreshCoin(['<?php echo $coinName; ?>']);
// 自动刷新
window.setInterval("refreshCoin(['<?php echo $coinName; ?>'])",updateTime*1000);
</script>
<!-- ▲ 自动刷新币价脚本 ▲ -->

</body>
</html>