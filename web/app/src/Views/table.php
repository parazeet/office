<?php
    if (!empty($lastTen)) {
        foreach ($lastTen as $key => $value) {
            $type = $value['type'] == 'costs' ? 'Расход' : 'Доход';
            echo "<tr>
              <td>{$value['sum']}</td>
              <td>{$type}</td>
              <td>{$value['comment']}</td>
              <td>{$value['created_at']}</td>
            </tr>";
        }
    }
?>