<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<?php $this->load->view('include/header'); ?>
	<link href="<?php echo base_url('assets/css'); ?>/transactionSite.css?v=1.18" rel="stylesheet">
	<title>交易所首页 / ITRClub商赛系统</title>
</head>

<body>
	
<?php $this->load->view('include/nav'); ?>

<div class="content">
	<div class="box">
		<div class="boxTit">
			<h1>所有货币</h1>
		</div>
		
		<div class="multTable" style="position: relative">
			<table class="tablefixed" cellspacing="0">
				<thead>
					<tr>
						<th>名称</th></tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?php echo base_url('transaction/coinDetail/btc'); ?>">
								<img src="<?php echo base_url('assets/img/coin'); ?>/btc.png" alt="BTC-比特币">BTC</a></td>
					</tr>
					<tr>
						<td>
							<a href="<?php echo base_url('transaction/coinDetail/bch'); ?>">
								<img src="<?php echo base_url('assets/img/coin'); ?>/btc.png" alt="BCH-比特现金">BCH</a></td>
					</tr>
					<tr>
						<td>
							<a href="<?php echo base_url('transaction/coinDetail/eth'); ?>">
								<img src="<?php echo base_url('assets/img/coin'); ?>/eth.png" alt="ETH-以太坊">ETH</a></td>
					</tr>
					<tr>
						<td>
							<a href="<?php echo base_url('transaction/coinDetail/ltc'); ?>">
								<img src="<?php echo base_url('assets/img/coin'); ?>/ltc.png" alt="LTC-莱特币">LTC</a></td>
					</tr>
					<tr>
						<td>
							<a href="<?php echo base_url('transaction/coinDetail/xrp'); ?>">
								<img src="<?php echo base_url('assets/img/coin'); ?>/xrp.png" alt="XRP-瑞波币">XRP</a></td>
					</tr>
				</tbody>
			</table>
			
			<div class="scrollbox">
				<table class="tableMain" cellspacing="0">
					<thead>
						<tr>
							<th style="width:50px;">名称</th>
							<th style="width:100px;">价格</th>
							<th style="width:60px;">涨幅(24h)</th>
							<th>最高价格</th>
							<th>最低价格</th>
							<th>开盘价格</th>
						</tr>
					</thead>
					<tbody>

						<!-- ▼ 币种数据行 ▼ -->
						<tr>
							<td>
								<a href="<?php echo base_url('transaction/coinDetail/btc'); ?>"><img src="<?php echo base_url('assets/img/coin'); ?>/btc.png" alt="BTC-比特币">BTC</a>
							</td>
							<td id="btc_last" class="price"></td>
							<td id="btc_extent"></td>
							<td id="btc_high" class="text-green"></td>
							<td id="btc_low" class="text-red"></td>
							<td id="btc_open" class="open"></td>
						</tr>
						<!-- ▲ 币种数据行 ▲ -->
						
						<!-- ▼ 币种数据行 ▼ -->
						<tr>
							<td>
								<a href="<?php echo base_url('transaction/coinDetail/bch'); ?>"><img src="<?php echo base_url('assets/img/coin'); ?>/btc.png" alt="BCH-比特现金">BCH</a>
							</td>
							<td id="bch_last" class="price"></td>
							<td id="bch_extent"></td>
							<td id="bch_high" class="text-green"></td>
							<td id="bch_low" class="text-red"></td>
							<td id="bch_open" class="open"></td>
						</tr>
						<!-- ▲ 币种数据行 ▲ -->
												
						<!-- ▼ 币种数据行 ▼ -->
						<tr>
							<td>
								<a href="<?php echo base_url('transaction/coinDetail/eth'); ?>"><img src="<?php echo base_url('assets/img/coin'); ?>/eth.png" alt="ETH-以太坊">ETH</a>
							</td>
							<td id="eth_last" class="price"></td>
							<td id="eth_extent"></td>
							<td id="eth_high" class="text-green"></td>
							<td id="eth_low" class="text-red"></td>
							<td id="eth_open" class="open"></td>
						</tr>
						<!-- ▲ 币种数据行 ▲ -->
						
						<!-- ▼ 币种数据行 ▼ -->
						<tr>
							<td>
								<a href="<?php echo base_url('transaction/coinDetail/ltc'); ?>"><img src="<?php echo base_url('assets/img/coin'); ?>/ltc.png" alt="LTC-莱特币">LTC</a>
							</td>
							<td id="ltc_last" class="price"></td>
							<td id="ltc_extent"></td>
							<td id="ltc_high" class="text-green"></td>
							<td id="ltc_low" class="text-red"></td>
							<td id="ltc_open" class="open"></td>
						</tr>
						<!-- ▲ 币种数据行 ▲ -->

						<!-- ▼ 币种数据行 ▼ -->
						<tr>
							<td>
								<a href="<?php echo base_url('transaction/coinDetail/xrp'); ?>"><img src="<?php echo base_url('assets/img/coin'); ?>/xrp.png" alt="XRP-瑞波币">XRP</a>
							</td>
							<td id="xrp_last" class="price"></td>
							<td id="xrp_extent"></td>
							<td id="xrp_high" class="text-green"></td>
							<td id="xrp_low" class="text-red"></td>
							<td id="xrp_open" class="open"></td>
						</tr>
						<!-- ▲ 币种数据行 ▲ -->

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="theBox theBox-bottom"></div>

<div class="footer">
	<div>
		<a href="<?php echo base_url('about'); ?>">关于我们</a>&nbsp;|&nbsp;
		<a href="<?php echo base_url('contact'); ?>">联系我们</a>&nbsp;|&nbsp;
		<a href="<?php echo base_url('help'); ?>">常见问题</a>
	</div>	
	<div>©Copyright ITRClub 2017-2018</div>
	<div>备案号：<a href="http://www.miitbeian.gov.cn">粤ICP备18045107号</a></div>
</div>

<?php $this->load->view('include/script'); ?>

<script>
// 所有币种的名称
var allCoinName=['btc','bch','eth','ltc','xrp'];
// 自动刷新时间间隔秒数
var updateTime=10;

// 首次加载页面成功后先刷新第一次
refreshCoin(allCoinName);
// 自动刷新
window.setInterval("refreshCoin(allCoinName)",updateTime*1000);
</script>

</body>
</html>