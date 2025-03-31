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
        <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </nav>

    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>

</html><?php /**PATH C:\Users\yb\form_submission\resources\views/layouts/app.blade.php ENDPATH**/ ?>