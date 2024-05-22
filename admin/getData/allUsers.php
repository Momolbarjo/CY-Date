<?php
$lines = file("../../data/users.csv", FILE_IGNORE_NEW_LINES);
$index = 0;
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
        echo "<td>
        <form action='sanctions.php' method='post'>
        <input type='hidden' name='index' value='$index'>
            <label>Report:
                <input type='radio' name='sanction' value='report' class='select-user'><br>
            </label>
            <label>Ban:
                <input type='radio' name='sanction' value='ban' class='select-user'>
            </label>
            <label>Reason for ban:
                <input type='text' name='ban_reason'>
            </label>
            <label>Deban:
                <input type='radio' name='sanction' value='deban' class='select-user'>
            </label>
            <input value='send' type='submit'>
        </form>
        </td>";
        echo "<td>
        <form action='../../web/message/message.php' method='POST'>
            <input type = 'hidden' name='user' value = '{$users[2]}'>
            <button type='submit'>Users message</button>
        </form> 
        </td>
        <td>
        <form action='sanctions.php' method='post'>
        <input type='hidden' name='delete_index' value='$index'>
        <input type='hidden' name='filename' value='../data/users.csv'>
        <button type='submit' name='delete'>❌</button>
        </form>
        </td>";
        echo '</tr>';
    }
    $index++;
}

echo '</table>';

?>
