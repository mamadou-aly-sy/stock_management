<?php use Core\Session;?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=link_to('css/bootstrap.min.css')?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a href="#" class="navbar-brand"></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-2 ml-auto">
                <?php if (!Session::contain('user_id')): ?>
                    <li class="nav-item active">
                        <a href="<?=link_to('admin/login')?>" class="nav-link">تسجيل الدخول</a>
                    </li>
                <?php endif?>
                <?php if (Session::contain('user_id')): ?>
                    <li class="nav-item active">
                        <a href="<?=link_to('admin/logout')?>" class="nav-link">تسجيل الخروج </a>
                    </li>
                <?php endif?>
            </ul>
        </div>
    </nav>
    <?=$pageContent?>
</body>
</html>