<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php if (CURRENT_URL == 'admin/dashboard') echo 'active'; ?> " aria-current="page" href="<?= APP_URL . '/admin/dashboard' ?>">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (CURRENT_URL == 'admin/category') echo 'active'; ?>" href="<?= APP_URL . '/admin/category' ?>">
                    <span data-feather="coffee"></span>
                    Category
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (CURRENT_URL == 'admin/posts') echo 'active'; ?>" href="<?= APP_URL . '/admin/posts' ?>">
                    <span data-feather="file"></span>
                    Posts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (CURRENT_URL == 'admin/comments') echo 'active'; ?>" href="<?= APP_URL . '/admin/comments' ?>">
                    <span data-feather="users"></span>
                    Comments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (CURRENT_URL == 'admin/users') echo 'active'; ?>" href="<?= APP_URL . '/admin/users' ?>">
                    <span data-feather="users"></span>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= APP_URL ?>/admin/logout">
                    <span data-feather="log-out"></span>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>