
 
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Company Dashboard</h2>
            </div>
            <div class="col-lg-3 margin-tb">
                <a class="btn btn-success" href="<?php echo e(route('companies.index')); ?>"> Company</a>
            </div>
            <div class="col-lg-3 margin-tb">
                <a class="btn btn-success" href="<?php echo e(route('employees.index')); ?>"> Employee</a>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="<?php echo e(route('companies.create')); ?>"> Create New Company</a>
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
            <th>Company Name</th>
            <th>Email</th>
            <th>Logo</th>
            <th>Website</th>
            <th width="280px">Action</th>
        </tr>
        <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e(++$i); ?></td>
            <td><?php echo e($company->name); ?></td>
            <td><?php echo e($company->email); ?></td>
            <td><img src="/company_logo/<?php echo e($company->logo); ?>" width="100px"></td>
            <td><?php echo e($company->website); ?></td>
            <td>
                <form action="<?php echo e(route('companies.destroy',$company->id)); ?>" method="POST">
   
                    <a class="btn btn-info" href="<?php echo e(route('companies.show',$company->id)); ?>">Show</a>
    
                    <a class="btn btn-primary" href="<?php echo e(route('companies.edit',$company->id)); ?>">Edit</a>
   
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
  
    <?php echo $companies->links(); ?>

      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('companies.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\New folder\Laravel-8-CRUD\resources\views/companies/index.blade.php ENDPATH**/ ?>