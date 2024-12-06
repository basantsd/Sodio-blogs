<!DOCTYPE html>
<html>
<head>
    <title>404 Not Found</title>
</head>
<body>
    <h1>Blog Posts</h1>
    <?php foreach ($data['posts'] as $post): ?>
        <div>
            <h2><?= htmlspecialchars($post['title']); ?></h2>
            <p><?= htmlspecialchars($post['content']); ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
