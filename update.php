<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['content'])) {
        $id = (int)$_POST['id'];
        $name = trim($_POST['name']);
        $content = trim($_POST['content']);

        if ($name !== '' && $content !== '') {
            $stmt = $pdo->prepare('UPDATE posts SET name = ?, content = ? WHERE id = ?');
            $stmt->execute([$name, $content, $id]);
            header('Location: edit_complete.php');
            exit;
        } else {
            echo "エラー: 名前と投稿内容を入力してください。";
        }
    } else {
        echo "エラー: 不正なリクエストです。";
    }
}