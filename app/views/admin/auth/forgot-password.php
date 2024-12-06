<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Admin Forgot Password</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= APP_URL ?>/css/auth.css" rel="stylesheet">
</head>

<body class="text-center"> 
    <main class="form-signin">
        <form method="POST" action="<?= APP_URL . '/admin/forgot-password'; ?>">
            <h1 class="h3 mb-3 fw-normal">Forgot Password</h1>
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="admin@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <button class="w-100  mt-2 btn btn-lg btn-primary" type="submit">Send Mail</button>
            <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y'); ?></p>
        </form>
    </main>



</body>

</html>