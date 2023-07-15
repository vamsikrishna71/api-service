<?php
    $label = $label ?? __('Submit');
    $message = $message ?? __('Please wait...');
?>

<!--begin::Indicator-->
<span class="indicator-label">
    <?php echo e($label); ?>

</span>
<span class="indicator-progress">
    <?php echo e($message); ?>

    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
</span>
<!--end::Indicator-->
<?php /**PATH C:\xampp\htdocs\Metro\resources\views/partials/general/_button-indicator.blade.php ENDPATH**/ ?>