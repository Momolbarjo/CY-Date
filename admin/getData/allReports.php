<?php
$lines = file("../../data/reports.csv", FILE_IGNORE_NEW_LINES);
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
            <label>Report:
                <input type='radio' name='sanction' value='reportByReports' class='select-user'><br>
            </label>
            <label>Ban:
                <input type='radio' name='sanction' value='banByReports' class='select-user'>
            </label>
            <label>Reason for ban:
                <input type='text' name='ban_reason'>
            </label>
            <input value='send' type='submit'>
        </form>
        </td>
        <td>
        <form action='sanctions.php' method='post'>
        <input type='hidden' name='delete_index' value='$index'>
        <input type='hidden' name='filename' value='../data/reports.csv'>
        <button type='submit' name='delete'>❌</button>
        </form>
        </td>";
        echo '</tr>';
    
    $index++;
}

echo '</table>';

?>
