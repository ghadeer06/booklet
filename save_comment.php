<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: main.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book = $_POST['book'];
    $comment = trim($_POST['comment']);
    $user = $_SESSION['username'];

    if ($comment !== "") {
        $file = "comments.json";
        $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

        $data[$book][] = [
            "user" => htmlspecialchars($user),
            "text" => htmlspecialchars($comment)
        ];

        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}

header("Location: home.php");
exit();
?>