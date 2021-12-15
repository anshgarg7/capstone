<?php
    $command = escapeshellcmd('python test1.py');
    $output = shell_exec($command);
    echo $output;
?>
