<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Form</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
</head>
<body>
    <nav>
        <a href="<?php echo e(url('/dashboard')); ?>">Dashboard</a>
        <a href="<?php echo e(url('/logout')); ?>">Logout</a>
    </nav>

    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
</html>
<?php  ?>