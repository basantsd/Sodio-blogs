<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Create New Account</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="<?= APP_URL ?>/css/auth.css" rel="stylesheet">
</head>

<body class="text-center"> 
    <main class="form-signin">
        <form method="POST" action="<?= APP_URL.'/register' ?>">
            <h1>Sodio Blogs</h1>
            <h1 class="h3 mb-3 fw-normal">Create New Account</h1>
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <div class="form-floating">
                <input type="text" class="form-control" name="name" id="userNmae" placeholder="Jhon Deo">
                <label for="userNmae">Name</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" name="email" id="userEmail" placeholder="name@example.com">
                <label for="userEmail">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
            <a class="w-100 btn btn-lg btn-link" href="<?= APP_URL.'/login' ?>">Already have an account ?</a>
            <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y'); ?></p>
        </form>
    </main>



</body>

</html>