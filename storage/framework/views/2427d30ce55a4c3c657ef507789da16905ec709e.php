<div class="subscription">
    <div class="inline-form">
        <p><?php echo app('translator')->get('general.subscribeTitle'); ?></p>
        <form action="<?php echo e(route('subscribe')); ?>">
            <input type="email" name="email" required placeholder="Email">
            <?php echo e(csrf_field()); ?>

            <?php echo htmlFormSnippet(); ?>

            <button type="submit" class="btn-darkgreen"><?php echo app('translator')->get('general.subscribeBtn'); ?></button>
        </form>
    </div>
    <div class="text-success">
        <p><?php echo app('translator')->get('general.subscribeThanks'); ?></p>
    </div>
</div>
<div class="socials">
    <p><?php echo app('translator')->get('general.inSocials'); ?></p>
    <ul>
        <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="<?php echo e($social->link); ?>"><i class="icon <?php echo e($social->name); ?>"></i> <?php echo e($social->value); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/partials/subscribe.blade.php ENDPATH**/ ?>