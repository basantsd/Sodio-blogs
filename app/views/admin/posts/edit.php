<?php include BASE_PATH.'/app/views/admin/include/header.inc.php'; ?>
<div class="container-fluid">
    <div class="row">
        
    <?php include BASE_PATH.'/app/views/admin/include/sidenav.inc.php'; ?>
        <main class="col-md-9 my-4 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Edit Post</h2>
            </div>
            <?php  if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            <form action="<?= APP_URL.'/admin/posts/edit/'.$post['id']; ?>" method="POST" enctype="multipart/form-data" >
                <input type="hidden" value="<?= $_SESSION['csrf_token']; ?>" name="csrf_token">
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="postTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="postTitle" name="title" value="<?= $post['title']; ?>">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="postCategory" class="form-label">Category</label>
                        <select class="form-select" name="category_id" id="postCategory">
                            <?php 
                            if($categories): 
                                foreach ($categories as $cate):
                            ?>
                                <option <?= $post['category_id'] == $cate['id'] ? 'selected' : '';  ?> value="<?= $cate['id'] ?>"><?= $cate['name'] ?></option>
                            <?php 
                                endforeach;
                            endif; 
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="postImage" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="postImage" name="postfile">
                        <img style="width: auto;max-width: 300px;height:auto; max-height:300px;" src="<?= UPLOAD_URL.$post['image']; ?>">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="postDescription" class="form-label">Description</label>
                        <textarea rows="7" class="form-control" id="postDescription" name="description"><?= $post['description']; ?></textarea>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="postPublishDate" class="form-label">Publish Date</label>
                        <input type="date" class="form-control" id="postPublishDate" name="publish_date" value="<?= $post['publish_date']; ?>">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="postStatus" class="form-label">Status</label>
                        <select class="form-select" name="status" id="postStatus">
                            <option <?= $post['status'] == 'active' ? 'selected' : '';  ?> value="active">Active</option>
                            <option <?= $post['status'] == 'inactive' ? 'selected' : '';  ?> value="inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </main>
    </div>
</div>
<?php include BASE_PATH.'/app/views/admin/include/footer.inc.php'; ?>