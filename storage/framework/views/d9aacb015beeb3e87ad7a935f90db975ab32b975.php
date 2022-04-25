<ul class="breadcrumbs">
    <li><a href="/"><?php echo app('translator')->get('general.home'); ?></a></li>
    <li class="sep"><i class="fa fa-angle-right"></i></li>
    <?php if(isset($subtitle)): ?>
        <?php if(isset($titleLink)): ?>
            <li><a href="<?php echo e($titleLink); ?>"><?php echo e($title); ?></a></li>
        <?php else: ?>
            <li class="current"><span><?php echo e($title); ?></span></li>
        <?php endif; ?>
        <li class="sep"><i class="fa fa-angle-right"></i></li>
        <?php if(isset($childTitle)): ?>
            <li><a href="<?php echo e($subtitleLink); ?>"><?php echo e($subtitle); ?></a></li>
            <li class="sep"><i class="fa fa-angle-right"></i></li>
            <?php if(isset($subChildTitle)): ?>
                    <li><a href="<?php echo e($childLink); ?>"><?php echo e($childTitle); ?></a></li>
                    <li class="sep"><i class="fa fa-angle-right"></i></li>
                    <li class="current"><span><?php echo e($subChildTitle); ?></span></li>
            <?php else: ?>
                    <li class="current"><span><?php echo e($childTitle); ?></span></li>
            <?php endif; ?>
        <?php else: ?>
            <li class="current"><span><?php echo e($subtitle); ?></span></li>
        <?php endif; ?>
    <?php else: ?>
        <li class="current"><span><?php echo e($title); ?></span></li>
    <?php endif; ?>
</ul>
<?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/partials/breadcrumbs.blade.php ENDPATH**/ ?>