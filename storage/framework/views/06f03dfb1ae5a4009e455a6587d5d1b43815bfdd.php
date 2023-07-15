<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <?php echo e(theme()->getView('layout/partials/_header')); ?>

        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <?php echo e(theme()->getView('layout/partials/_sidebar')); ?>

            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    
                    <?php echo e(theme()->getView('layout/partials/_content', compact('slot'))); ?>

                </div>
                <!--end::Content wrapper-->
                <?php echo e(theme()->getView('layout/partials/_footer')); ?>

            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->
<?php echo e(theme()->getView('partials/layout-builder/drawer/_main')); ?>

<?php echo e(theme()->getView('partials/_drawers')); ?>

<?php /**PATH C:\xampp\htdocs\Metro\resources\views/layout/demo1/_default.blade.php ENDPATH**/ ?>