<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="card bg-danger text-white shadow" onclick="this.classList.add('hidden');">
    <div class="card-body">
        Error
        <div class="text-white-50 small"> <?= $message ?> </div>
    </div>
</div>