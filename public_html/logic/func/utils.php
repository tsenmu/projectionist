<?php
function utils_generate_alert()
{
    $type = $_REQUEST['type'];
    $message = $_REQUEST['message'];
    echo <<<EOT
<div class="alert alert-dismissable fade in $type">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>$message</strong>
</div>
EOT;
}
?>

