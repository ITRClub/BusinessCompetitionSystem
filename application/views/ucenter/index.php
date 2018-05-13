<!DOCTYPE html>
<html lang="zh_CN">

<head>
	<?php $this->load->view('include/header'); ?>
	<title>个人中心首页 / ITRClub商赛系统个人中心</title>
</head>

<body>
<div id="wrapper">
	<?php $this->load->view('include/ucNav'); ?>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">交易</h1></div>
			<!-- /.col-lg-12 --></div>
		<!-- /.row -->
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-credit-card fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge" id="balance_show"></div>
								<div style="font-size: 18px;">USD余额</div></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"><?php echo $logCount; ?></div>
								<div style="font-size: 18px;">成交订单</div></div>
						</div>
					</div>
					<a href="<?php echo base_url('ucenter/transaction/log'); ?>">
						<div class="panel-footer">
							<span class="pull-left">查看所有交易订单</span>
							<span class="pull-right">
								<i class="fa fa-arrow-circle-right"></i>
							</span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('include/script'); ?>

<script>
updateBalance();

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
			$("#balance_show").html("$"+balance);
		}
	});
}
</script>

</body>
</html>
