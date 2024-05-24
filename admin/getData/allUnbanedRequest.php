<?php
$lines = file("../../data/unban.csv", FILE_IGNORE_NEW_LINES);

if (!empty($lines)) {
    $index = 0;
    echo '<table>';
    echo '<tr>';

    foreach($lines as $line){
        if (trim($line) == '') {
            continue;
        }
        $users = str_getcsv($line);
        echo '<tr>';
        for ($i = 0; $i < count($users); $i++) {
            echo "<td>{$users[$i]}</td>";
        }
        echo "<td>
        <form action='sanctions.php' method='post'>
        <input type='hidden' name='index' value='$index'>
            <label>Deban:
                <input type='radio' name='sanction' value='request' class='select-user'>
            </label>
            <input value='send' type='submit'>
        </form>
        </td>
        <td>
        <form action='sanctions.php' method='post'>
        <input type='hidden' name='delete_index' value='$index'>
        <input type='hidden' name='filename' value='../data/unban.csv'>
        <button type='submit' name='delete'>❌</button>
        </form>
        </td>";
        echo '</tr>';
    
        $index++;
    }

    echo '</table>';
}
?>
