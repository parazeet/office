<?php

function dd() {
    echo "<pre>";

    foreach (func_get_args() as $val) {
        var_dump($val);
    }

    echo "</pre>";
    exit;
}
