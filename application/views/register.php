<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('include/header'); ?>
	<title>注册 / ITRClub商赛系统个人中心</title>
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">欢迎注册 ITRClub商赛系统</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<input class="form-control" placeholder="团队名称" id="teamName" onkeyup='if(event.keyCode==13)$("#realName").focus();'>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="个人真实姓名" id="realName" onkeyup='if(event.keyCode==13)$("#phone").focus();'>
						</div>
						<div class="form-group">
							<input type="number" class="form-control" placeholder="手机号" id="phone" onkeyup='if(event.keyCode==13)$("#password").focus();'>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="密码" id="password" onkeyup='if(event.keyCode==13)$("#verifyPassword").focus();'>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="再次输入密码" id="verifyPassword" onkeyup='if(event.keyCode==13)toRegister();'>
						</div>
						<button id="login_btn" onclick="toRegister();" class="btn btn-lg btn-success btn-block">注册 / Register</button>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->load->view('include/script'); ?>

<script>
var token="<?php echo $token; ?>";

function toRegister(){
	teamName=$("#teamName").val();
	realName=$("#realName").val();
	phone=$("#phone").val();
	password=$("#password").val();
	verifyPassword=$("#verifyPassword").val();

	if(teamName==""){
		$("#tips").html("团队名称不能为空！");
		$("#tipsModal").modal('show');
		return false;
	}
	if(realName==""){
		$("#tips").html("个人真实姓名不能为空！");
		$("#tipsModal").modal('show');
		return false;
	}
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
	if(verifyPassword==""){
		$("#tips").html("再次输入密码不能为空！");
		$("#tipsModal").modal('show');
		return false;
	}
	if(password!=verifyPassword){
		$("#tips").html("两次输入的密码不相符！");
		$("#tipsModal").modal('show');
		return false;
	}

	$.ajax({
		url:APP_URL+"user/toRegister",
		type:"post",
		dataType:"json",
		data:{"token":token,"teamName":teamName,"realName":realName,"phone":phone,"password":password},
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
			}else if(ret.code=="2"){
				$("#tips").html("此手机号已存在！");
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
