<?php
/*******************************************************************
* php script/page to manipulate htpasswd file
*
* Written by: Jacob Isreal, Isreal Consulting LLC (www.icllc.cc)
*             jisreal@icllc.cc
*
* Last updated: 09-01-2024
********************************************************************/

function editHtpasswordRow(string $user, string $pass): string
{
    $file = '.htpasswd';
    if ($pass === '') {
        $newRow = '';
        $action = 'Delete';
    } else {
        $newRow = PHP_EOL . $user . ':' . password_hash($pass, PASSWORD_DEFAULT);
        $action = 'Update';
    }

    $content = preg_replace(
        '/\R?^' . preg_quote($user, '/') . ':.*/mu',
        $newRow,
        file_get_contents($file),
        1,
        $count
    );

    if (!$count && $newRow) {
        $content .= PHP_EOL . $newRow;
        $action = 'Insert';
    }
    file_put_contents($file, ltrim($content));
    return $action;
}

echo '<h1>htpasswd Tool</h1>Enter username with blank password to delete user.<br><br>';

if (isset($_POST['user'], $_POST['pass'])) {
    printf(
        '<h3>%s of %s was successful</h3>',
        editHtpasswordRow($_POST['user'], $_POST['pass']), 
        htmlspecialchars($_POST['user'])
    );
    echo '<h4>Fetched .htpasswd content:</h4><pre>' . file_get_contents('.htpasswd') . '</pre>';
} else {
    echo '<h4>Fetched .htpasswd content:</h4><pre>' . file_get_contents('.htpasswd') . '</pre>';
}
?>

<form method="post">
    User: <input type="text" name="user"><br>
    Pass:<input type="text" name="pass"><br>
    <input type="submit" value="Submit">
</form>
