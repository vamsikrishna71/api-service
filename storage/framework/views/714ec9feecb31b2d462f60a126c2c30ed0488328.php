<?php
    $menu = bootstrap()->getHorizontalMenu();
    \App\Core\Adapters\Menu::filterMenuPermissions($menu->items);
?>

<!--begin::Menu wrapper-->
<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
     data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
    <!--begin::Menu-->
    <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
        <?php echo $menu->build(); ?>

    </div>
    <!--end::Menu-->
</div>
<!--end::Menu wrapper-->
<?php /**PATH C:\xampp\htdocs\Metro\resources\views/layout/demo1/partials/header/_menu/_menu.blade.php ENDPATH**/ ?>