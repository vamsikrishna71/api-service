<?php $__env->startSection('content'); ?>

    <?php
        $layout = theme()->getOption('layout', 'main/type');
        theme()->addHtmlClass('body', 'app-' . $layout);
    ?>
    <?php echo $__env->make('layout/demo1/_default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('base.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Metro\resources\views/layout/demo1/master.blade.php ENDPATH**/ ?>