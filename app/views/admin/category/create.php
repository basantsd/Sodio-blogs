<?php include BASE_PATH . '/app/views/admin/include/header.inc.php'; ?>
<div class="container-fluid">
    <div class="row">

        <?php include BASE_PATH . '/app/views/admin/include/sidenav.inc.php'; ?>
        <main class="col-md-9 my-4 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Add Category</h2>
            </div>
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            <form action="<?= APP_URL . '/admin/category/create'; ?>" method="POST">
                <input type="hidden" value="<?= $_SESSION['csrf_token']; ?>" name="csrf_token">
                <div class="row">
                    <div class="mb-3 col-12">
                        <label for="catName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="catName" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </main>
    </div>
</div>
<?php include BASE_PATH . '/app/views/admin/include/footer.inc.php'; ?>