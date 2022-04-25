<?php $__env->startSection('title',__('general.notFoundTitle')); ?>
<?php $__env->startSection('seo_title', __('general.notFoundTitle')); ?>
<?php $__env->startSection('meta_keywords', ''); ?>
<?php $__env->startSection('meta_description', ''); ?>
<?php $__env->startSection('image',env('APP_URL').'/images/og.jpg'); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','page-404'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page page-404">
        <div class="content-nosidebar">
            <div class="content col-12">
                <h1><?php echo app('translator')->get('general.notFoundTitle'); ?></h1>
                <?php echo $__env->make('partials.breadcrumbs',['title'=>__('general.notFoundTitle')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="notfound-content">
                    <div class="head">
                        <strong>404</strong>
                        <p><?php echo app('translator')->get('general.notFoundTitle'); ?></p>
                    </div>
                    <p><?php echo app('translator')->get('general.notFoundContent'); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/errors/404.blade.php ENDPATH**/ ?>