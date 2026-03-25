<?php
include 'conn.php';

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';

if ($username && $email) {
    $sql = "INSERT INTO users (username, email) VALUES ('$username', '$email')";
    if (mysqli_query($conn, $sql)) {
        header("Location: home.html");
        exit();
    } else {
        echo "خطأ أثناء حفظ البيانات: " . mysqli_error($conn);
    }
} else {
    echo "الرجاء إدخال جميع البيانات المطلوبة.";
}
?>