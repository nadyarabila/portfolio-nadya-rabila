<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';

requireAdminGuest();

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $result = attemptAdminLogin($username, $password);

    if ($result['ok']) {
        header('Location: ' . adminUrl('dashboard.php'));
        exit;
    }

    $error = $result['message'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — <?= e(APP_NAME) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= e(adminAsset('css/admin.css')) ?>">
</head>
<body class="admin-body login-page">
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo"><span>Nara</span>Admin</div>
                <h1>Masuk Panel Admin</h1>
                <p>Kelola konten portfolio <?= e(APP_NAME) ?></p>
            </div>

            <?php if ($error !== ''): ?>
                <div class="alert alert-error" role="alert">
                    <i class="fas fa-circle-exclamation"></i>
                    <?= e($error) ?>
                </div>
            <?php endif; ?>

            <form method="post" action="" class="login-form" autocomplete="off">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" value="<?= e($username) ?>"
                               placeholder="admin" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password"
                               placeholder="••••••••" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-right-to-bracket"></i> Login
                </button>
            </form>

            <p class="login-footer-note">
                <a href="<?= e(dirname(adminBaseUrl())) ?>/index.php"><i class="fas fa-arrow-left"></i> Kembali ke website</a>
            </p>
        </div>
    </div>
</body>
</html>
