<?php include BASE_PATH.'/app/views/admin/include/header.inc.php'; ?>
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row">
        
    <?php include BASE_PATH.'/app/views/admin/include/sidenav.inc.php'; ?>
        <main class="col-md-9 my-4 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>All Post Comments</h2>
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
                            <th>Post Name</th>
                            <th>Comment </th>
                            <th>User Name</th>
                            <th>Create At</th>
                            <th>Approved</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if($comments){
                            foreach ($comments as $comment): ?>
                                <tr>
                                    <td><?= $comment['title']; ?></td>
                                    <td><?= $comment['comment']; ?></td>
                                    <td><?= $comment['name']; ?></td>
                                    <td><?= $comment['created_at']; ?></td>
                                    <td><?= ucfirst($comment['is_approved']) ;?></td>
                                    <td>
                                        <button onclick="populateAndShowModal(<?= htmlspecialchars(json_encode($comment)) ?>)" class="btn btn-info">View</button>
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


<div class="modal" tabindex="-1" id="commentModal" >
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="<?= APP_URL.'/admin/comment/status' ?>" method="post">
      <div class="modal-header">
        <h5 class="modal-title">Comment View</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
                    <div class="form-group">
                        <label for="commentText">Comment Text:</label>
                        <textarea id="commentText" class="form-control" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="commentApproval">Approval Status:</label>
                        <select id="commentApproval" class="form-control" name="is_approved">
                            <option value="pending">Pending</option>
                            <option value="approved">Approve</option>
                            <option value="rejected">Reject</option>
                        </select>
                    </div>
                    <input type="hidden" id="commentId" name="comment_id">
               
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#commonTable').DataTable();
});

function populateAndShowModal(comment) {
    $('#commentId').val(comment.id);
    $('#commentText').val(comment.comment);
    $('#commentApproval').val(comment.is_approved);
    $('#commentModal').modal('show');
}


</script>
<?php include BASE_PATH.'/app/views/admin/include/footer.inc.php'; ?>
