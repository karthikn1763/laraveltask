

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Create New Form</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('form.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        
        <div class="mb-3">
            <label>Upload File:</label>
            <input type="file" name="file" class="form-control">
        </div>

       
        <h4>Items</h4>
        <table class="table" id="itemsTable">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th><button type="button" class="btn btn-success" id="addRow">+</button></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="items[0][name]" class="form-control" required></td>
                    <td><input type="number" name="items[0][quantity]" class="form-control" required></td>
                    <td><input type="number" step="0.01" name="items[0][price]" class="form-control" required></td>
                    <td><button type="button" class="btn btn-danger removeRow">X</button></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<script>
    let rowIndex = 1;

    document.getElementById('addRow').addEventListener('click', function() {
        let table = document.getElementById('itemsTable').getElementsByTagName('tbody')[0];
        let row = table.insertRow();
        row.innerHTML = `
            <td><input type="text" name="items[${rowIndex}][name]" class="form-control" required></td>
            <td><input type="number" name="items[${rowIndex}][quantity]" class="form-control" required></td>
            <td><input type="number" step="0.01" name="items[${rowIndex}][price]" class="form-control" required></td>
            <td><button type="button" class="btn btn-danger removeRow">X</button></td>
        `;
        rowIndex++;
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('removeRow')) {
            event.target.closest('tr').remove();
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php  ?>