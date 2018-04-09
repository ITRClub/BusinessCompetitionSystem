<!DOCTYPE HTML>
<!--
	Identity by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>BCS商赛系统-用户注册</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="<?php echo $base_url; ?>/assets/js/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/ie8.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<span class="avatar"><img src="<?php echo $base_url; ?>/assets/img/avatar.jpg" alt="" /></span>
							<h1>用户注册</h1>
							<p>BCS商赛系统用户中心</p>
						</header>

						<hr />
						<!--<h2>Extra Stuff!</h2>-->
						<form method="post" action="#">
							<div class="field">
								<input type="text" name="username" id="username" placeholder="用户账号" />
							</div>
							<div class="field">
								<input type="password" name="password" id="password" placeholder="用户密码" />
                            </div>
                            <div class="field">
								<input type="password" name="password2" id="password2" placeholder="再次输入" />
                            </div>
							<ul class="actions">
								<li><a id="regbutton" href="javascript:doRegisterRequest()" class="button">注册</a></li>
								<li><a href="javascript:history.go(-1)" class="button">返回</a></li>
							</ul>
						</form>
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li>&copy;2012-<script>document.write(new Date().getFullYear());</script> ITRClub</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="<?php echo $base_url; ?>/assets/js/respond.min.js"></script><![endif]-->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>
			<script type="text/javascript" src="<?php echo $base_url; ?>/assets/js/jquery-1.9.0.js"></script>
			<script type="text/javascript" src="<?php echo $base_url; ?>/assets/js/common.js"></script>
			<script type="text/javascript" src="<?php echo $base_url; ?>/assets/js/register.js"></script>
			<!-- Onekey Register Support -->
			<script type="text/javascript" language="javascript" charset="UTF-8">
				document.onkeydown = function(event) {
					var listener = event || window.event || arguments.callee.caller.arguments[0];
					if(listener && listener.keyCode==13) {
						document.getElementById("regbutton").click();
					}
				};
			</script>

	</body>
</html>
