<?php include BASE_PATH . '/app/views/admin/include/header.inc.php'; ?>
<div class="container-fluid">
    <div class="row">

        <?php include BASE_PATH . '/app/views/admin/include/sidenav.inc.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 my-2">
            <h2>Dashboard </h2>
            <div class="my-4">
                <div class="py-2 px-5 mb-4 bg-light rounded-3">
                    <div class="container-fluid py-5">
                        <h1 class="display-5 fw-bold">Total Posts</h1>
                        <p class="col-md-8 fs-4">Total : <?= $totalPost ?></p>
                        <a class="btn btn-primary btn-lg" href="<?= APP_URL . '/admin/posts' ?>">View Posts</a>
                    </div>
                </div>

                <div class="row align-items-md-stretch">
                    <div class="col-md-6">
                        <div class="h-100 p-5 bg-light border rounded-3">
                            <h2>Active Users</h2>
                            <p>Total : <?= $activeUser ?></p>
                            <a class="btn btn-outline-secondary" href="<?= APP_URL . '/admin/users?status=active' ?>">View Users</a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="h-100 p-5 text-white bg-dark rounded-3">
                            <h2>Inactive Users</h2>
                            <p>Total : <?= $inactiveUser ?></p>
                            <a class="btn btn-outline-light" href="<?= APP_URL . '/admin/users?status=inactive' ?>">View Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include BASE_PATH . '/app/views/admin/include/footer.inc.php'; ?>