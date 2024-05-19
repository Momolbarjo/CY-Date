<?php
$lines = file("../../data/banned.csv", FILE_IGNORE_NEW_LINES);
$index = 0;
echo '<table>';
echo '<tr>';

foreach($lines as $line){
    $users = str_getcsv($line);
        echo '<tr>';
        for ($i = 0; $i < count($users); $i++) {
             echo "<td>{$users[$i]}</td>";
        }
        echo "<td>
        <form action='sanctions.php' method='post'>
        <input type='hidden' name='index' value='$index'>
            <label>Deban:
                <input type='radio' name='sanction' value='debanfromBanned' class='select-user'>
            </label>
            <input value='send' type='submit'>
        </form>
        </td>";
        echo '</tr>';
    $index++;
}

echo '</table>';

?>
