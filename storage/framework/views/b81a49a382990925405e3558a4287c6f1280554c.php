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
                        <strong class="me-auto mx-2">Subcategory</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?php echo e(session('status')); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>
        <h3 class="mt-3">Sub Category Management</h3>
        <hr>
        <a href="<?php echo e(route('subcategory.create')); ?>" class="btn btn-sm btn-primary mt-3 mb-5"><i
                class="la la-plus"></i>Add</a>
        
        <div class="table-responsive col-6 float-left">
            <table id="kt_datatable_dom_positioning"
                class="table border rounded table-striped table-row-bordered gy-5 gs-7">
                <thead class="text-center">
                    <tr class="text-gray-800 fw-bold fs-6 px-7">
                        <th>S.No</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="font-bold text-center" id="tr_<?php echo e($subcategory->id); ?>">
                            <td scope="row"><?php echo e(++$i); ?></td>
                            <td><?php echo e($subcategory->category->name); ?></td>
                            <td><?php echo e($subcategory->name); ?></td>
                            <td>
                                <a href="<?php echo e(route('subcategory.edit', $subcategory->id)); ?>"
                                    class="btn btn-sm btn-secondary align-self-center mx-2"><i
                                        class="la la-pencil-alt"></i>Edit</a>
                                <form class="d-inline"
                                    action="<?php echo e(route('subcategory.destroy', ['subcategory' => $subcategory->id])); ?>"
                                    method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger align-self-center p-3 mt-3"><i
                                            class="la la-trash-alt"></i>Disable</button>
                                </form>
                                
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo $subcategories->links(); ?>

        </div>
    </div>
    <?php $__env->startSection('scripts'); ?>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <script>
            $("#kt_datatable_dom_positioning").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "pageLength": 5,
                "dom": 'lfrtip'
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
<?php /**PATH C:\xampp\htdocs\Metro\resources\views/pages/subcategory/index.blade.php ENDPATH**/ ?>