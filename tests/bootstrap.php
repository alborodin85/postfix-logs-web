<?php

shell_exec(escapeshellcmd('php artisan migrate:fresh --seed'));

function v_dump(mixed $data): void
{
    var_export($data);
    echo "\n";
    ob_flush();
}
