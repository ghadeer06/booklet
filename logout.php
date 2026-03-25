<?php
session_start();
session_destroy(); // نحذف كل بيانات الجلسة
header("Location: main.html");
exit();
?>