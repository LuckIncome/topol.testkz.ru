<?php $__env->startSection('title',($seoTitle ? $seoTitle : __('general.usefulInformation'))); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : __('general.usefulInformation'))); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',env('APP_URL').'/images/og.jpg'); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','base'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page posts services">
        <div class="content-sidebar">
            <h1><?php echo app('translator')->get('general.usefulInformation'); ?></h1>
            <?php echo $__env->make('partials.breadcrumbs',['title'=>__('general.usefulInformation')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content col-9">
                <div class="items">
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item img-hover">
                            <picture class="image">
                                <source srcset="<?php echo e($page->webpImage); ?>" type="image/webp">
                                <source srcset="<?php echo e($page->bigThumb); ?>" type="image/pjpeg">
                                <img src="<?php echo e($page->bigThumb); ?>"
                                     alt="<?php echo e($page->seo_title ? $page->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $page->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?>">
                            </picture>
                            <div class="text">
                                <a href="<?php echo e(route('info.show',$page)); ?>"
                                   class="title"><?php echo e($page->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?> <i
                                            class="icon"></i></a>
                                <p class="description"><?php echo e($page->getTranslatedAttribute('excerpt',$locale,$fallbackLocale)); ?></p>
                                <a href="<?php echo e(route('info.show',$page)); ?>" class="btn-dark"><?php echo app('translator')->get('general.more'); ?></a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="sidebar col-3">
                <?php echo $__env->make('partials.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/pages/info.blade.php ENDPATH**/ ?>