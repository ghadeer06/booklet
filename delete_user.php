<?php
session_start();

// إذا ما فيه مستخدم مسجّل دخول
if (!isset($_SESSION['username'])) {
    header("Location: main.html");
    exit();
}

// معلومات الاتصال بقاعدة البيانات
$host = "localhost";
$user = "root";     // غيريه إذا عندك باسورد
$pass = "";
$dbname = "bookstore";

$conn = new mysqli($host, $user, $pass, $dbname);

// فحص الاتصال
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];

// حذف المستخدم من جدول users
$sql = "DELETE FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

// حذف تعليقاته من comments.json
$jsonPath = __DIR__ . "/comment.json";

if (file_exists($jsonPath)) {
    $data = json_decode(file_get_contents($jsonPath), true);

    if (isset($data[$username])) {
        unset($data[$username]);
        file_put_contents($jsonPath, json_encode($data, JSON_PRETTY_PRINT));
    }
}

// تسجيل الخروج
session_unset();
session_destroy();

// العودة للصفحة الرئيسية
header("Location: main.html");
exit();

?>