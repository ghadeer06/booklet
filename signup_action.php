<?php
include 'conn.php';

$username = isset($_POST['username']) ? $_POST['username'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

if ($username && $email) {
    $sql = "INSERT INTO users (username, email) VALUES ('$username', '$email')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: home.php");
        exit();
    } else {
        echo "حدث خطأ أثناء حفظ البيانات: " . mysqli_error($conn);
    }
} else {
    echo "الرجاء إدخال جميع البيانات المطلوبة.";
}
?>