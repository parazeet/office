<?php
include __DIR__ . "/../Layouts/header.php";
include __DIR__ . "/../Layouts/navbar.php";
?>
    <div class="container">
        <form action="<?= url('registerStore'); ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
            <div class="mb-3">
                <label for="reg_name" class="form-label">Name</label>
                <input type="name" minlength="3" class="form-control" id="reg_name" aria-describedby="emailName" name="name"
                       value="<?php
                       if (isset($_SESSION['old']['name'])) {
                           echo $_SESSION['old']['name'];
                           unset($_SESSION['old']['name']);
                       }
                       ?>" required>
            </div>
            <div class="mb-3">
                <label for="reg_email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="reg_email" aria-describedby="emailHelp" name="email"
                       value="<?php
                       if (isset($_SESSION['old']['email'])) {
                           echo $_SESSION['old']['email'];
                           unset($_SESSION['old']['email']);
                       }
                       ?>" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="reg_password" class="form-label">Password</label>
                <input type="password" minlength="6" class="form-control" id="reg_password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="reg_password_conf" class="form-label">Password Confirm</label>
                <input type="password" minlength="6" class="form-control" id="reg_password_conf" name="password_conf" required>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mx-1">Зарегистрироваться</button>
                <a href="<?= url('login'); ?>" class="btn btn-danger mx-1">Назад</a>
            </div>
        </form>
    </div>
<?php
include __DIR__ . "/../Layouts/footer.php";
?>