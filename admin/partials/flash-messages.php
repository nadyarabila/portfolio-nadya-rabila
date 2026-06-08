<?php

$flashes = getFlashes();
foreach ($flashes as $flash):
    $class = $flash['type'] === 'success' ? 'alert-success' : ($flash['type'] === 'error' ? 'alert-error' : 'alert-info');
    $icon = $flash['type'] === 'success' ? 'fa-circle-check' : ($flash['type'] === 'error' ? 'fa-circle-exclamation' : 'fa-circle-info');
?>
<div class="alert <?= e($class) ?>" role="alert">
    <i class="fas <?= e($icon) ?>"></i>
    <?= e($flash['message']) ?>
</div>
<?php endforeach; ?>
