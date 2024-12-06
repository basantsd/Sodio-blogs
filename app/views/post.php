<?php include BASE_PATH.'/app/views/include/header.inc.php'; ?>

<div class="container my-5">
    <img class="w-100 my-3" style="max-height:600px;" src="<?= UPLOAD_URL.$post['image']; ?>" />

    <div style="max-width: 700px; " class="mx-auto text-secondary position-relative">
        <div class="text-center mb-4">
            <h1 class="text-center font-weight-bold text-dark"><?= $post['title']; ?></h1>
            <div>
                <small class="text-dark">
                    Publish Date <span class="text-primary"><?= date('Y M d',strtotime($post['publish_date'])) ?></span>
                </small>
            </div>
        </div>

        <div>
            <?= $post['description'] ?>
        </div>

        <div class="container mt-4">
            <h2>Leave a Comment</h2>
            <form action="<?= APP_URL.'/add-comment' ?>" method="POST">
                <div class="mb-3">
                    <input type="hidden" name="post_id" value="<?=$post['id'];?>" />
                    <label for="comment" class="form-label">Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="5" placeholder="Write your comment here" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
        </div>

        <div class="container mt-4">
            <h2>Comments</h2>
            <ul class="list-group">
                <?php foreach ($comments as $comment): ?>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-1"><?= htmlspecialchars($comment['name']); ?></h5>
                        <small>Posted on <?= htmlspecialchars(date("F j, Y, g:i a", strtotime($comment['created_at']))); ?></small>
                    </div>
                    <p class="mb-1"><?= htmlspecialchars($comment['comment']); ?></p>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>


    </div>
</div>

<?php include BASE_PATH.'/app/views/include/footer.inc.php'; ?>