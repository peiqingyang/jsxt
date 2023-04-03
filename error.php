<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login Error</title>
	<style>
		body {
			height: 100vh;
			background: linear-gradient(#141e30, #243b55);
			display: flex;
			justify-content: center;
			align-items: center;
			font-size: 16px;
			color: #03e9f4;
		}

		.loginBox {
			width: 400px;
			height: 364px;
			background-color: #0c1622;
			margin: 100px auto;
			border-radius: 10px;
			box-shadow: 0 15px 25px 0 rgba(0, 0, 0, .6);
			padding: 40px;
			box-sizing: border-box;
		}

		h2 {
			text-align: center;
			color: rgb(208, 255, 0);
			margin-bottom: 30px;
			font-family: 'Courier New', Courier, monospace;
		}



		.countdown {
			margin-top: 20px;
			font-size: 18px;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<div class="loginBox">
		<h2>用户名或密码错误</h2>
		<p>请重新输入正确的用户名和密码。</p>
		<div class="countdown">倒计时：3秒</div>
	</div>

	<script>
		// 定义倒计时的秒数
		var countdownSeconds = 3;
		// 获取用于显示倒计时的元素
		var countdownElem = document.querySelector('.countdown');
		// 设置一个计时器，在每秒钟更新倒计时
		var countdownInterval = setInterval(function() {
			countdownSeconds--;
			if (countdownSeconds <= 0) {
				// 如果倒计时结束，清除计时器并重定向回登录页面
				clearInterval(countdownInterval);
				window.location.href = 'login.html';
			} else {
				// 否则更新倒计时元素的内容
				countdownElem.innerHTML = '倒计时：' + countdownSeconds + '秒';
			}
		}, 1000);
	</script>
</body>
</html>
