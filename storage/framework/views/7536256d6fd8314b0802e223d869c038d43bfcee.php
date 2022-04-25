<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<?php echo $__env->make('partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body class="<?php echo $__env->yieldContent('page_class'); ?>" data-ng-app="topol">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5NND4ND"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="preloader-wrapper">
    <div class="preloader">
        <span class="char">t</span>
        <span class="char">o</span>
        <span class="char">p</span>
        <span class="char">o</span>
        <span class="char">l</span>
    </div>
</div>
<main id="main">
    <div class="container">
        <div class="row">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</main>
<?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/app.blade.php ENDPATH**/ ?>