<style>
.pageheader .memubtn:before{
    content:url("<?php echo base_url('assets/img'); ?>/menu.svg");
    display: block;
    margin-left: 10px;
    margin-top: 10px;
}
</style>
<nav class="memu">
	<div class="list">
		<div class="memuheader">导航
			<div class="back"></div>
		</div>
		<ul class="navList">
			<li>
				<div><a href="<?php echo base_url('ucenter'); ?>">个人中心</a></div>
			</li>
			<li>
				<div>行情</div>
				<ul>
					<li>
						<a href="<?php echo base_url('transaction/'); ?>">所有</a>
					</li>
					<li>
						<a href="<?php echo base_url('transaction/coinDetail/btc'); ?>">BTC</a>
					</li>
					<li>
						<a href="<?php echo base_url('transaction/coinDetail/bch'); ?>">BCH</a>
					</li>
					<li>
						<a href="<?php echo base_url('transaction/coinDetail/eth'); ?>">ETH</a>
					</li>
					<li>
						<a href="<?php echo base_url('transaction/coinDetail/ltc'); ?>">LTC</a>
					</li>
					<li>
						<a href="<?php echo base_url('transaction/coinDetail/xrp'); ?>">XRP</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>
<div class="pageheader">
	<div class="memubtn"></div>
	<div class="logo">
		<!--a href="/">
			<img src="<?php echo base_url('assets/img'); ?>/fav.ico">
		</a-->
	</div>
</div>
