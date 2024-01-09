
 
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Employee Dashboard</h2>
            </div>
            <div class="col-lg-2 margin-tb">
                <a class="btn btn-success" href="<?php echo e(route('companies.index')); ?>"> Company</a>
            </div>
            <div class="col-lg-2 margin-tb">
                <a class="btn btn-success" href="<?php echo e(route('employees.index')); ?>"> Employee</a>
            </div>
            <div class="col-lg-2 margin-tb">
                <a class="btn btn-success" href="<?php echo e(route('signout')); ?>"> Logout</a>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="<?php echo e(route('employees.create')); ?>"> Create New Employee</a>
            </div>
        </div>
    </div>
   
    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th width="280px">Action</th>
        </tr>
        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e(++$i); ?></td>
            <td><?php echo e($employee->first_name); ?></td>
            <td><?php echo e($employee->last_name); ?></td>
            <td>
                <form action="<?php echo e(route('employees.destroy',$employee->id)); ?>" method="POST">
   
                    <a class="btn btn-info" href="<?php echo e(route('employees.show',$employee->id)); ?>">Show</a>
    
                    <a class="btn btn-primary" href="<?php echo e(route('employees.edit',$employee->id)); ?>">Edit</a>
   
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
  
    <?php echo $employees->links(); ?>

      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employees.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel-CRUD\resources\views/employees/index.blade.php ENDPATH**/ ?>