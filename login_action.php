<?php
include 'conn.php';
session_start();

$username = $_POST['username'] ?? '';

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['username'] = $username; 
    header("Location: home.php"); 
    exit();
} else {
    // عرض رسالة الخطأ بشكل منسق داخل صفحة HTML
    echo '
    <div style="
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 15px;
        margin: 20px auto;
        width: fit-content;
        border-radius: 5px;
        font-family: Arial, sans-serif;
    ">
        ️username not found⚠.
    </div>
    ';
}

?>

<html lang="ar">
<head>
<meta charset="UTF-8">
<title>error</title>
<style>
a.signup {
	align-items: center; 
    font-size: 10px;
    font-weight: bold;
    color: #007bff;
    text-decoration: none;
    padding: 10px 20px;
    border: 2px solid #007bff;
    border-radius: 5px;
    transition: 0.3s;
}
a.signup:hover {
    background-color: #007bff;
    color: #fff;
}
</style>
</head>
<body>
<form>
    <div class="inline-text">
        <span>make an account!</span>
        <a href="sign_up.html">SIGN UP!</a>
    </div>
</form>


</body>
</html>