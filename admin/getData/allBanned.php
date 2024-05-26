<?php
/* Programme en PHP qui va récupérer les personnes bannis stockés dans banned.csv pour permettre de les afficher dans le mode administrateur du site */

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
    </td>
    <td>
    <form action='sanctions.php' method='post'>
        <input type='hidden' name='delete_index' value='$index'>
        <input type='hidden' name='filename' value='../data/banned.csv'>
        <button type='submit' name='delete'>❌</button>
    </form>
    </td>";
    echo '</tr>';
    $index++;
}

echo '</table>';
?>
