<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('include/header'); ?>
	<title>登录 / ITRClub商赛系统个人中心</title>
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">欢迎登录 ITRClub商赛系统个人中心</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<input type="number" class="form-control" placeholder="手机号 / Phone" id="phone" onkeyup='if(event.keyCode==13)$("#password").focus();' autofocus>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="密码 / Password" id="password" onkeyup='if(event.keyCode==13)toLogin();'>
						</div>
						<a href="<?php echo base_url('register'); ?>" class="btn btn-lg btn-primary" style="width:49%;">注册 / Register</a> <button id="login_btn" onclick="toLogin();" class="btn btn-lg btn-success" style="width:49%;">登入 / Login</button>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->load->view('include/script'); ?>

<script>
function toLogin(){
	phone=$("#phone").val();
	password=$("#password").val();

	if(phone==""){
		$("#tips").html("手机号不能为空");
		$("#tipsModal").modal('show');
		return false;
	}
	if(password==""){
		$("#tips").html("密码不能为空！");
		$("#tipsModal").modal('show');
		return false;
	}
	
	$.ajax({
		url:APP_URL+"toLogin",
		type:"post",
		dataType:"json",
		data:{"phone":phone,"password":password},
		error:function(e){
			console.log(e);
		},
		success:function(ret){
			if(ret.code=="200"){
				window.location.href=ret.data['redirectUrl'];
			}else if(ret.code=="1"){
				$("#tips").html("验证码错误！");
				$("#tipsModal").modal('show');
				return false;
			}else if(ret.code=="0"){
				$("#tips").html("手机号或密码错误！");
				$("#tipsModal").modal('show');
				return false;
			}else{
				console.log(ret);
				$("#tips").html("未知错误！请联系管理员！");
				$("#tipsModal").modal('show');
				return false;
			}
		}
	});
}

</script>

<?php $this->load->view('include/tipsModal'); ?>

</body>
</html>
