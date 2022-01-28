<?php
include __DIR__ . "/../Layouts/header.php";
include __DIR__ . "/../Layouts/navbar.php";
?>
    <div class="container">
        <form action="<?= url('loginPost'); ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email"
                       value="<?php
                       if (isset($_SESSION['old']['email'])) {
                           echo $_SESSION['old']['email'];
                           unset($_SESSION['old']['email']);
                       }
                       ?>" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mx-1">Войти</button>
                <a href="<?= url('register'); ?>" class="btn btn-danger mx-1">Зарегестрироваться</a>
            </div>
        </form>
    </div>
<?php
include __DIR__ . "/../Layouts/footer.php";
?>