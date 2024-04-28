<?php
$lines = file("../data/users.csv", FILE_IGNORE_NEW_LINES);

echo '<table>';
echo '<tr>';

foreach($lines as $line){
    $users = str_getcsv($line);
    if (end($users) != 'admin') {
        echo '<tr>';
        for ($i = 0; $i < count($users); $i++) {
            if ($i == 9) { 
                echo "<td><img class='round-image' src='{$users[$i]}' alt='Image'></td>";
            } else {
                echo "<td>{$users[$i]}</td>";
            }
        }
        echo '<td><input type="checkbox" class="select-user"></td>';
        echo '</tr>';
    }
}

echo '</table>';

?>
