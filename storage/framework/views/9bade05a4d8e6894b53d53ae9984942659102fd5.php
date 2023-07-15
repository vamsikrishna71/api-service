<?php if (isset($component)) { $__componentOriginal6121507de807c98d4e75d845c5e3ae4201a89c9a = $component; } ?>
<?php $component = App\View\Components\BaseLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('base-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\BaseLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('styles'); ?>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <?php $__env->stopSection(); ?>
    <div class="container">
        <div class="text-center">
            <?php if(session('status')): ?>
                <div class="toast show alert-success" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="fa-solid fa-envelope"></i>
                        <strong class="me-auto mx-2">Category</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?php echo e(session('status')); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>
        <h3 class="mt-3">Category Management</h3>
        <hr>
        
        <div class="table-responsive col-6 float-left">
            <table id="kt_datatable_dom_positioning"
                class="table table-striped table-row-bordered gy-5 gs-7 border rounded wrapper">
                <a href="<?php echo e(route('category.create')); ?>" class="btn btn-sm btn-primary mt-3 mb-5"><i
                        class="la la-plus"></i>Add</a>
                <thead class="text-center">
                    <tr class="fw-bold fs-6 text-gray-800 px-7">
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="font-bold text-center disable-row" id="tr_<?php echo e($category->id); ?>">
                            <td scope="row"><?php echo e(++$i); ?></td>
                            <td><?php echo e($category->name); ?></td>
                            <td>
                                <a href="<?php echo e(route('category.edit', $category->id)); ?>"
                                    class="btn btn-sm btn-secondary align-self-center mx-2"><i
                                        class="la la-pencil-alt"></i>Edit</a>
                                <form class="d-inline"
                                    action="<?php echo e(route('category.destroy', ['category' => $category->id])); ?>"
                                    method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <input type="submit" class="btn btn-sm btn-danger align-self-center p-3"
                                        value="Disable" />
                                </form>
                            </td>
                            <td>
                                <form action="<?php echo e(route('categories.toggleStatus', $category->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <button type="submit"
                                        class="btn <?php echo e($category->status ? ' btn-light-success' : 'btn-light-danger'); ?>">
                                        <?php echo e($category->status ? 'Active' : 'Inactive'); ?>

                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
        </div>
    </div>
    <?php $__env->startSection('scripts'); ?>
        <!-- Include jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function() {
                $("#kt_datatable_dom_positioning").DataTable({
                    "pageLength": 5,
                    "dom": 'lfrtip',
                });
                $('.disable-btn').on('click', function() {
                    var row = $(this).closest('tr');
                    row.addClass('disabled');
                    row.find(':input').attr('disabled', true);
                });
            });
            var allVals = [];
            $.each(allVals, function(index, value) {
                $('table tr').filter("[data-row-id='" + value + "']").remove();
            });
        </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6121507de807c98d4e75d845c5e3ae4201a89c9a)): ?>
<?php $component = $__componentOriginal6121507de807c98d4e75d845c5e3ae4201a89c9a; ?>
<?php unset($__componentOriginal6121507de807c98d4e75d845c5e3ae4201a89c9a); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Metro\resources\views/pages/category/index.blade.php ENDPATH**/ ?>