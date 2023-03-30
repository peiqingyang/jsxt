<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<title>答题系统</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f1f1f1;
		}
		.container {
			background-color: #fff;
			padding: 20px;
			max-width: 500px;
			margin: 50px auto;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			border-radius: 5px;
			text-align: center;
		}
		h1 {
			color: #333;
			margin-top: 0;
		}
		label {
			display: inline-block;
			width: 100px;
			margin-bottom: 10px;
			text-align: left;
		}
		input[type=text], input[type=password] {
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 4px;
			resize: vertical;
		}
		input[type=submit] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
		input[type=submit]:hover {
			background-color: #45a049;
		}
		.error-message {
			color: red;
			font-size: 14px;
			margin-top: 10px;
			text-align: left;
		}
        .logo {
			margin-bottom: 20px;
		}
        .question {
			margin-top: 20px;
			text-align: left;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 4px;
		}
        .score {
			margin-top: 20px;
			font-size: 18px;
		}
		.modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 200px;
    height: 100px;
    background-color: white;
    border: 1px solid black;
    padding: 20px;
    text-align: center;
  }
	</style>
</head>
<body>
    
	<div class="container">
        <img class="logo" src="hello.png" alt="Logo">
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            $user = $_SESSION['username'];
        } else {
            // 用户未登录
        }
// 连接数据库
$servername = "127.0.0.1";
$username = "jsxt";
$password = "password";
$dbname = "jsxt";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (isset($_GET['error'])) {
	// 显示连接失败的消息
	echo "<div style='color: red'>" . $_GET['error'] . "</div>";
}
// 检查连接
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}

// 查询 fenshu 表中的 dqid 字段
$result = mysqli_query($conn, "SELECT dqid FROM fenshu WHERE user = '$user'");
// 检查查询结果中是否有行数
if (mysqli_num_rows($result) > 0) {
  // 如果有行数，则获取第一行的 dqid 值
  $row = mysqli_fetch_assoc($result);
  $dqid = $row["dqid"];
} else {
  // 如果没有行数，则将 dqid 赋值为 1
  $dqid = 1;
}

// echo $dqid;
//查询requests表中题目id最大多少
$sql = "SELECT MAX(id) as max_id FROM requests";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// 输出最大值并将其作为 $zdid 的值
	$row = $result->fetch_assoc();
	$zdid = $row["max_id"];
	// echo $zdid;
  } else {
	// 如果查询结果为空，将 $zdid 的值设为 0
	$zdid = 0;
  }
// echo $zdid;
// 现在 $dqid 变量中包含了要么是查询结果中的 dqid 值，要么是默认值 1
if ($dqid > $zdid){
	
		$query = "SELECT fenshu FROM fenshu WHERE user = '$user'";

	// 执行查询
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
    	$fenshu = $row['fenshu'];
		
		echo "<div class='question'>";
        echo "<h3>$user  答题结束   $fenshu   分</h3>";
		// echo $fenshu;
        echo "</div>";
		die();
}
// 查询题目
$sql = "SELECT  id, requests, fenshu FROM requests WHERE id = '$dqid'";
$result = mysqli_query($conn, $sql);

// 渲染题目
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $current_question_id = $row['id'];
        $a_fenshu = $row['fenshu'];
        echo "<div class='question'>";
        echo "<h3>题目：" . $row['requests'] . "</h3>";
        echo "<p>分数：" . $row['fenshu'] . "</p>";
        echo "</div>";
    }
    // echo "<input type='hidden' name='requests_id' value='" . $current_question_id . "'>";
} else {
    // echo "0 结果";
}
//查询当前分数
// echo $user;
$query = "SELECT fenshu FROM fenshu WHERE user = '$user'";

// 执行查询
$result = mysqli_query($conn, $query);

// 检查查询是否成功
if ($result) {
    // 获取查询结果
    $row = mysqli_fetch_assoc($result);
    $fenshu = $row['fenshu'];

    // 输出当前用户的分数
    // echo "当前用户 $user 的分数是 $fenshu";
} else {
    // echo "查询失败：" . mysqli_error($connection);
}
// $user=$_POST['username'];
// 关闭连接
mysqli_close($conn);
?>
		<h1>答题系统</h1>
		<link rel="stylesheet" href="style.css">
		<form method="post" action="submit.php">
			<label for="ip">IP 地址:</label>
			<input type="text" id="ip" name="ip" required><br>
			<label for="username">用户名:</label>
			<input type="text" id="username" name="username" required><br>
			<label for="password">密码:</label>
			<input type="password" id="password" name="password" required><br>
            <input type="hidden" id="requests_id" name="requests_id" value="<?php echo $current_question_id; ?>">
            <input type="hidden" id="fenshu" name="fenshu" value="<?php echo $a_fenshu; ?>">
            <input type="hidden" id="user" name="user" value="<?php echo $user; ?>">
           	<input type="submit" value="提交" id="submitBtn">

			<script src="dengdai.js"></script>
		</form>
        <div id="score" class="score">得分：<?php echo $fenshu;?></div>
	</div>
</body>
</html>
