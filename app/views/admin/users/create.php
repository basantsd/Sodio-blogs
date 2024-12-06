<?php include BASE_PATH.'/app/views/admin/include/header.inc.php'; ?>
<div class="container-fluid">
    <div class="row">
        
    <?php include BASE_PATH.'/app/views/admin/include/sidenav.inc.php'; ?>
        <main class="col-md-9 my-4 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Add User</h2>
            </div>
            <?php  if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            <form action="<?= APP_URL.'/admin/users/create'; ?>" method="POST" enctype="multipart/form-data" >
                <input type="hidden" value="<?= $_SESSION['csrf_token']; ?>" name="csrf_token">
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="userName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="userName" name="name">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="userMobile" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="userMobile" name="mobile_no">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="userStatus" class="form-label">Status</label>
                        <select class="form-select" name="status" id="userStatus">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="userEmail" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="userEmail" name="email">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="userPwd" class="form-label">Password</label>
                        <input type="password" class="form-control" id="userPwd" name="password">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </main>
    </div>
</div>
<?php include BASE_PATH.'/app/views/admin/include/footer.inc.php'; ?>