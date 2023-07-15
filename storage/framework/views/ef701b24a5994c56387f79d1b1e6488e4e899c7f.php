<!DOCTYPE html>

<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"<?php echo theme()->printHtmlAttributes('html'); ?>

    <?php echo e(theme()->printHtmlClasses('html')); ?>>


<head>
    <meta charset="utf-8" />
    <title><?php echo e(ucfirst(theme()->getOption('meta', 'title'))); ?> | Keenthemes</title>
    <meta name="description" content="<?php echo e(ucfirst(theme()->getOption('meta', 'description'))); ?>" />
    <meta name="keywords" content="<?php echo e(theme()->getOption('meta', 'keywords')); ?>" />
    <link rel="canonical" href="<?php echo e(ucfirst(theme()->getOption('meta', 'canonical'))); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="<?php echo e(getAsset(theme()->getOption('assets', 'favicon'))); ?>" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <?php echo e(theme()->includeFonts()); ?>

    

    <?php if(theme()->hasVendorFiles('css')): ?>
        
        <?php $__currentLoopData = array_unique(theme()->getVendorFiles('css')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(util()->isExternalURL($file)): ?>
                <link rel="stylesheet" href="<?php echo e($file); ?>" />
            <?php else: ?>
                <?php echo preloadCss(getAsset($file)); ?>

            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    <?php endif; ?>

    <?php if(theme()->hasOption('page', 'assets/custom/css')): ?>
        
        <?php $__currentLoopData = array_unique(theme()->getOption('page', 'assets/custom/css')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo preloadCss(getAsset($file)); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    <?php endif; ?>

    <?php if(theme()->hasOption('assets', 'css')): ?>
        
        <?php $__currentLoopData = array_unique(theme()->getOption('assets', 'css')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(strpos($file, 'plugins') !== false): ?>
                <?php echo preloadCss(getAsset($file)); ?>

            <?php else: ?>
                <link href="<?php echo e(getAsset($file)); ?>" rel="stylesheet" type="text/css" />
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    <?php endif; ?>

    <?php if(theme()->getViewMode() === 'preview'): ?>
        <?php echo e(theme()->getView('partials/trackers/_ga-general')); ?>

        <?php echo e(theme()->getView('partials/trackers/_ga-tag-manager-for-head')); ?>

    <?php endif; ?>

    <?php echo $__env->yieldContent('styles'); ?>
</head>




<body <?php echo theme()->printHtmlAttributes('body'); ?> <?php echo theme()->printHtmlClasses('body'); ?> <?php echo theme()->printCssVariables('body'); ?> data-kt-name="metronic">

    <?php echo $__env->make('partials/theme-mode/_init', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    
    <?php if(theme()->hasOption('assets', 'js')): ?>
        
        <?php $__currentLoopData = array_unique(theme()->getOption('assets', 'js')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <script src="<?php echo e(getAsset($file)); ?>"></script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    <?php endif; ?>

    <?php if(theme()->hasVendorFiles('js')): ?>
        
        <?php $__currentLoopData = array_unique(theme()->getVendorFiles('js')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(util()->isExternalURL($file)): ?>
                <script src="<?php echo e($file); ?>"></script>
            <?php else: ?>
                <script src="<?php echo e(getAsset($file)); ?>"></script>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    <?php endif; ?>

    <?php if(theme()->hasOption('page', 'assets/custom/js')): ?>
        
        <?php $__currentLoopData = array_unique(theme()->getOption('page', 'assets/custom/js')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <script src="<?php echo e(getAsset($file)); ?>"></script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    <?php endif; ?>
    

    <?php if(theme()->getViewMode() === 'preview'): ?>
        <?php echo e(theme()->getView('partials/trackers/_ga-tag-manager-for-body')); ?>

    <?php endif; ?>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>


</html>
<?php /**PATH C:\xampp\htdocs\Metro\resources\views/base/base.blade.php ENDPATH**/ ?>