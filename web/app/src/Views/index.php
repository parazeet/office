<?php
    include "Layouts/header.php";
    include "Layouts/navbar.php";
?>
    <div class="container mb-3">
        <div class=" row mx-0 mb-3 gx-4 gx-lg-5 justify-content-center">
            <div class="col-sm-3">
                <label for="sum" class="form-label">Сумма</label>
                <input type="number" class="form-control" id="sum" name="sum" required>
            </div>
            <div class="col-sm-3">
                <label for="type" class="form-label">Тип</label>
                <select class="form-select" name="type" id="type" required>
                    <option value="" selected>- Выберете тип -</option>
                    <option value="costs">Расход</option>
                    <option value="income">Доход</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="comment" class="form-label">Коментарий</label>
                <textarea class="form-control" id="comment" rows="1" name="comment"></textarea>
            </div>
            <div class="col-sm-3 mt-4 pt-2">
                <button type="button" class="btn btn-primary" id="add" data-router="<?= url('store'); ?>">Добавить</button>
            </div>
        </div>
        <table class="table table-striped">
            <caption>
                <?php include "total.php"; ?>
            </caption>
            <thead>
            <tr>
                <th scope="col">Сумма</th>
                <th scope="col">Тип</th>
                <th scope="col">Коментарий</th>
                <th scope="col">Дата</th>
            </tr>
            </thead>
            <tbody id="table">
            <?php include "table.php"; ?>
            </tbody>
        </table>
    </div>
<?php
    include "Layouts/footer.php";
?>