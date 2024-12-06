<?php include BASE_PATH.'/app/views/admin/include/header.inc.php'; ?>
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row">
        
    <?php include BASE_PATH.'/app/views/admin/include/sidenav.inc.php'; ?>
        <main class="col-md-9 my-4 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>All Users</h2>
                <a class="btn btn-success " href="<?= APP_URL . '/admin/users/create' ?>"> Add Users</a>
            </div>
            <?php  if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            
            <div class="table-responsive my-4">
                <table id="commonTable" class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Join Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if($users){
                            foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['name']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td><?= $user['mobile_no']; ?></td>
                                    <td><?= $user['created_at']; ?></td>
                                    <td><?= ucwords($user['status']); ?></td>
                                    <td>
                                        <a href="<?= APP_URL ?>/admin/users/edit/<?= $user['id']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= APP_URL ?>/admin/users/delete/<?= $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php 
                            endforeach;
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#commonTable').DataTable();
});
</script>
<?php include BASE_PATH.'/app/views/admin/include/footer.inc.php'; ?>