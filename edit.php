<!DOCTYPE html>
<html>
<head>
    <title>編集ページ</title>
</head>
<body>
    <?php
    require 'db.php';

    // 投稿データを取得
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $stmt = $pdo->prepare('SELECT * FROM posts WHERE id = ?');
        $stmt->execute([$id]);
        $post = $stmt->fetch();

        if (!$post) {
            echo "<p>エラー: 投稿が見つかりません。</p>";
            exit;
        }
    } else {
        echo "<p>エラー: IDが指定されていません。</p>";
        exit;
    }
    ?>

    <h1>編集ページ</h1>
    <form method="post" action="update.php">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <label for="name">名前:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'); ?>" required>
        <br><br>
        <label for="content">投稿内容:</label>
        <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        <br><br>
        <input type="submit" value="更新">
        <a href="index.php"><button type="button">戻る</button></a>
    </form>
</body>
</html>