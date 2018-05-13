	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo base_url('ucenter'); ?>">ITRClub商赛系统-个人中心</a>
		</div>
		<!-- /.navbar-header -->

		<ul class="nav navbar-top-links navbar-right">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li>
						<a href="#"><i class="fa fa-user fa-fw"></i> 个人资料编辑</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> 登出</a>
					</li>
				</ul>
			</li>
		</ul>

		<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
			<li>
				<a href="<?php echo base_url('transaction'); ?>"><i class="fa fa-calculator fa-fw"></i> 交易所首页</a>
			</li>
			<li>
				<a href="<?php echo base_url('ucenter/transaction/log'); ?>"><i class="fa fa-list-alt fa-fw"></i> 交易记录</a>
			</li>
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
		</div>
		<!-- /.navbar-static-side -->
	</nav>
