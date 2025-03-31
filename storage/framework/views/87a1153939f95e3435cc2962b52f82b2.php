

<?php $__env->startSection('content'); ?>
<h2>Dashboard</h2>
<a href="<?php echo e(url('/form/create')); ?>" class="btn">Create New Form</a>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>File</th>
        <th>Actions</th>
    </tr>
    <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($form->name); ?></td>
        <td><?php echo e($form->email); ?></td>
        <td>
            <?php if($form->file_path): ?>
                <a href="<?php echo e(asset('storage/'.$form->file_path)); ?>" target="_blank">View File</a>
            <?php else: ?>
                No File
            <?php endif; ?>
        </td>
        <td>
            <a href="<?php echo e(url('/form/edit/'.$form->id)); ?>" class="btn">Edit</a>
            <form action="<?php echo e(url('/form/delete/'.$form->id)); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn delete">Delete</button>
            </form>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php  ?>