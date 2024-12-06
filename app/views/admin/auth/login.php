<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Admin Login</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >

    <!-- Custom styles for this template -->
    <link href="<?= APP_URL ?>/css/auth.css" rel="stylesheet">
</head>

<body class="text-center"> 
    <main class="form-signin">
        <form method="POST" action="<?= APP_URL . '/admin/login'; ?>">
            <h1>Welcome Back Admin </h1>
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
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
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <a class="w-100 btn btn-lg btn-link" href="<?= APP_URL ?>/admin/forgot-password">Forgot Password</a>
            <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y'); ?></p>
        </form>
    </main>



</body>

</html>