<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// 连接数据库
$servername = "127.0.0.1";
$username = "jsxt";
$password = "password";
$dbname = "jsxt";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// 检查连接
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}

// 获取题目 ID
$question_id = $_POST['requests_id'];
$user = $_POST['user'];
$fenshu = $_POST['fenshu'];
//查询是否有改用的分数，如果有直接使用，如果没有创建
// 查询fenshu表中是否存在user为$user的记录
$sql_fenshu_user = "SELECT * FROM fenshu WHERE user = '$user'";
$result_fenshu_user = $conn->query($sql_fenshu_user);

// 检查查询是否成功
if (!$result_fenshu_user) {
    die("查询失败: " . $conn->error);
}

// 如果查询结果为空，则插入一条新记录
if ($result_fenshu_user->num_rows == 0) {
    $sql = "INSERT INTO fenshu (user, fenshu ,dqid) VALUES ('$user', 0 ,0)";
    if ($conn->query($sql) === TRUE) {
        // echo "新记录插入成功";
    } else {
        // echo "插入记录时出错: " . $conn->error;
    }
}


// 查询题目的命令和答案
$sql = "SELECT commd, pass, fenshu FROM requests WHERE id = $question_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}

// 解析查询结果
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $commd = $row['commd'];
    $pass = $row['pass'];
    $fenshu = $row['fenshu'];

    // 连接到服务器
    // 连接到服务器
$connection = ssh2_connect($_POST['ip'], 22);

if (!$connection) {
  // 连接失败
  $error = "连接服务器失败，请检查您的IP、用户名和密码";
  header("Location: main.php?error=" . urlencode($error));
  exit;
}

// 认证用户名和密码
ssh2_auth_password($connection, $_POST['username'], $_POST['password']);

// 连接成功
// ...


    // 执行命令
    $stream = ssh2_exec($connection, $commd);
    stream_set_blocking($stream, true);
    $output = stream_get_contents($stream);
    fclose($stream);
    // 检查命令输出是否包含答案
    if (strpos($output, $pass) !== false) {
        // 更新用户得分
        $sql = "UPDATE fenshu SET fenshu = fenshu + $fenshu WHERE user = '{$_POST['user']}'";
        mysqli_query($conn, $sql);
        $dqid = $question_id+1;
        $sql = "UPDATE fenshu SET dqid = $dqid WHERE user = '{$_POST['user']}'";
        mysqli_query($conn, $sql);

        // 查询用户得分
        $sql = "SELECT fenshu FROM fenshu WHERE user = '{$_POST['user']}'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $score = $row['fenshu'];

        // 返回得分结果
        header("Location: main.php");
        exit;
    } else {
        // 返回空结果
        $dqid = $question_id++;
        $sql = "UPDATE fenshu SET fenshu = $dqid WHERE user = '{$_POST['user']}'";
        mysqli_query($conn, $sql);
        header("Location: main.php");
        exit;
    }
} else {
    // 返回错误结果
    header('Content-Type: application/json');
    echo json_encode(array('error' => '题目不存在'));
}

//更新当前id
    // $sql = "UPDATE fenshu SET dqid = dqid + 1 WHERE user = '$user'";
    // $dqid_status=mysqli_query($conn, $sql);
    // 如果查询结果为空，则插入一条新记录
// if (true) {
//     $sql = "UPDATE fenshu SET dqid = dqid + 1 WHERE user = '$user'";
//     if ($conn->query($sql) === TRUE) {
//         echo "新记录插入成功";
//     } else {
//         echo "插入记录时出错: " . $conn->error;
//     }
// }

// 关闭连接
mysqli_close($conn);
?>
