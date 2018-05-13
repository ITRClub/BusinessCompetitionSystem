<!DOCTYPE html>
<html lang="zh_CN">

<head>
	<?php $this->load->view('include/header'); ?>
	<title>交易记录 / ITRClub商赛系统个人中心</title>
</head>

<body>

<div id="wrapper">
	<?php $this->load->view('include/ucNav'); ?>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">资金变动</h1></div>
		</div>
		<div class="panel panel-default">
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>类型</th>
								<th>币名</th>
								<th>数量</th>
								<th>单价</th>
								<th>总价</th>
								<th>时间</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($list as $info){ ?>
							<tr>
								<td><?php echo $info['id']; ?></td>
								<td><?php echo $info['type']==1?"买入":"卖出"; ?></td>
								<td><?php echo $info['coin_name']; ?></td>
								<td><?php echo $info['coin_num']; ?></td>
								<td><?php echo $info['unit_price']; ?></td>
								<td><?php echo $info['money']; ?></td>
								<td><?php echo $info['create_time']; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('include/script'); ?>

</body>
</html>
