<!-- Menu toggle button -->
<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="btn_notif">
    <i class="fa fa-bell-o"></i>
    <?php if(count(Auth::user()->unreadNotifications) > 0): ?>
    <span class="label label-warning" id="jml_notif"><?php echo e(count(Auth::user()->unreadNotifications)); ?></span>
    <?php endif; ?>
</a>
<ul class="dropdown-menu">
    <li class="header">
    <?php if(count(Auth::user()->unreadNotifications) > 0): ?>
    <li class="header">
        <span id="header_notif"><?php echo e(count(Auth::user()->unreadNotifications)); ?> Notif
            Baru</span>

        <span style="float: right;"><a href="#" id="readAll">Tandai Telah Dibaca
                Semua</a></span>
    </li>
    <?php else: ?>
    <li class="header">Tidak Ada Notifikasi Baru</li>
    <?php endif; ?>
    </li>
    <li>
        <!-- Inner Menu: contains the notifications -->
        <ul class="menu" id="list_notif">
            <!-- start notification -->

            <?php echo $__env->yieldContent('content'); ?>


            <!-- end notification -->
        </ul>
    </li>
    <?php if(count(Auth::user()->notifications) > 0): ?>
    <li class="footer"><p style="height: 4px;"></p></li>
    
    <?php endif; ?>
</ul>
<?php /**PATH C:\xampp\htdocs\siteri\resources\views/notifikasi/template.blade.php ENDPATH**/ ?>