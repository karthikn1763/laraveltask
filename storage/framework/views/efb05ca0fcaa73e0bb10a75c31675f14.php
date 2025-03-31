

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="text-primary">Edit Form</h2>

    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('form.update', $form->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo e($form->name); ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo e($form->email); ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Upload File</label>
            <input type="file" name="file" class="form-control">
            <?php if($form->file_path): ?>
                <p>Current File: <a href="<?php echo e(asset('storage/' . $form->file_path)); ?>" target="_blank">View</a></p>
            <?php endif; ?>
        </div>

        <h4 class="mt-4">Form Items</h4>
        <div id="items-container">
            <?php $__currentLoopData = $form->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item-group mb-2">
                <input type="text" name="items[<?php echo e($index); ?>][name]" value="<?php echo e($item['item_name']); ?>" class="form-control d-inline w-25" placeholder="Item Name" required>
                <input type="number" name="items[<?php echo e($index); ?>][quantity]" value="<?php echo e($item['quantity']); ?>" class="form-control d-inline w-25" placeholder="Quantity" required>
                <input type="number" name="items[<?php echo e($index); ?>][price]" value="<?php echo e($item['price']); ?>" class="form-control d-inline w-25" placeholder="Price" required>
                <button type="button" class="btn btn-danger btn-sm remove-item">X</button>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <button type="button" class="btn btn-secondary mt-2" id="add-item">+ Add More</button>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>

<style>
    .item-group {
        display: flex;
        gap: 10px;
    }
    .remove-item {
        height: 38px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let itemIndex = <?php echo e(count($form->items)); ?>;
        
        document.getElementById('add-item').addEventListener('click', function () {
            let container = document.getElementById('items-container');
            let newItem = `
                <div class="item-group mb-2">
                    <input type="text" name="items[\${itemIndex}][name]" class="form-control d-inline w-25" placeholder="Item Name" required>
                    <input type="number" name="items[\${itemIndex}][quantity]" class="form-control d-inline w-25" placeholder="Quantity" required>
                    <input type="number" name="items[\${itemIndex}][price]" class="form-control d-inline w-25" placeholder="Price" required>
                    <button type="button" class="btn btn-danger btn-sm remove-item">X</button>
                </div>`;
            container.insertAdjacentHTML('beforeend', newItem);
            itemIndex++;
        });

        document.getElementById('items-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\yb\form_submission\resources\views/form/edit.blade.php ENDPATH**/ ?>