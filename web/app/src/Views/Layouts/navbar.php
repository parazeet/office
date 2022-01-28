<!-- Navigation-->
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            SPA
            <!--<svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>-->
        </a>
        <?php
            $home = url('home');
            $logout = url('logout');
            if(isset($_SESSION['user_name'])) {
                echo "<ul class=\"nav col-12 col-md-auto mb-2 justify-content-center mb-md-0\">
                        <li class=\"nav-item dropdown\">
                            <a class=\"nav-link link-secondary dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                            {$_SESSION['user_name']}
                            </a>
                            <ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                            <!--<li><hr class=\"dropdown-divider\"></li>-->
                            <li><a class=\"dropdown-item\" href=\"{$logout}\">Logout</a></li>
                            </ul>
                        </li>
                    </ul>";
            } else {
                $login = url('login');
                $register = url('register');
                echo "<div class=\"col-md-3 text-end\">
                    <a href=\"{$login}\" class=\"btn btn-outline-primary me-2\">Sing-in</a>
                    <a href=\"{$register}\" class=\"btn btn-outline-primary\">Sign-up</a>
                </div>";
            }
        ?>
    </header>

<?php

if(isset($_SESSION['message'])) {
    echo "<p class=\"alert alert-info\">{$_SESSION['message']}</p>";
    unset($_SESSION['message']);
}
if(isset($_SESSION['errors'])) {
    if (is_array($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error) {
            echo "<p class=\"alert alert-danger\">{$error}</p>";
        }
    } else {
        echo "<p class=\"alert alert-danger\">{$_SESSION['errors']}</p>";
    }
    unset($_SESSION['errors']);
}
?>
</div>