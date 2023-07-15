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
                        <strong class="me-auto mx-2">Quote</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?php echo e(session('status')); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>
        <h3 class="mt-3">Quote Management</h3>
        <hr>
        
        <div class="table-responsive col-8">
            <table id="kt_datatable_dom_positioning"
                class="table table-striped table-row-gray-{100-900} gy-8 gs-8 border rounded">
                <a href="<?php echo e(route('quote.create')); ?>" class="btn btn-sm btn-primary mt-3 mb-5 mx-4"><i
                        class="la la-plus"></i>Add</a>
                <a href="<?php echo e(url('/admin/quote/import')); ?>" class="btn btn-sm btn-success mt-3 mb-5"><i
                        class="la la-cloud-upload-alt"></i>Import</a>
                <thead class="text-center">
                    <tr class="fw-bold fs- text-gray-800 px-8">
                        <th>S.No</th>
                        <th>Quote</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php $__currentLoopData = $quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="font-bold text-center disable-row" id="tr_<?php echo e($quote->id); ?>">
                            <td scope="row"><?php echo e(++$i); ?></td>
                            <td><?php echo e($quote->name); ?></td>
                            <td><?php echo e($quote->category->name); ?></td>
                            <td><?php echo e($quote->subcategory->name); ?></td>
                            <td class="flex">
                                <a href="<?php echo e(route('quote.edit', $quote->id)); ?>"
                                    class="btn btn-sm btn-secondary align-self-center mx-2 flex"><i
                                        class="la la-pencil-alt"></i>Edit</a>
                                <form class="d-inline mb-10"
                                    action="<?php echo e(route('quote.destroy', ['quote' => $quote->id])); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger align-self-center p-3 mt-3"><i
                                            class="la la-trash-alt"></i>Delete</button>
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
                    "language": {
                        "lengthMenu": "Show _MENU_",
                    },
                    "pageLength": 5,
                    "dom": 'lfrtip'
                });
                $('.disable-btn').on('click', function() {
                    var row = $(this).closest('tr');
                    row.addClass('disabled');
                    row.find(':a').attr('disabled', true);
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
<?php /**PATH C:\xampp\htdocs\Metro\resources\views/pages/quote/index.blade.php ENDPATH**/ ?>