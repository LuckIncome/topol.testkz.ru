<?php $__env->startSection('title',($seoTitle ? $seoTitle : __('general.catalogTitle'))); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : __('general.catalogTitle'))); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',env('APP_URL').'/images/og.jpg'); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','catalog'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page catalog main-catalog">
        <div class="content-nosidebar">
            <div class="content col-12">
                <h1><?php echo app('translator')->get('general.catalogTitle'); ?></h1>
                <?php echo $__env->make('partials.breadcrumbs',['title'=>($seoTitle ? $seoTitle : __('general.catalogTitle'))], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="items">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <a href="<?php echo e($category->link); ?>">
                                <picture class="image">
                                    <source srcset="<?php echo e($category->webpImage); ?>" type="image/webp">
                                    <source srcset="<?php echo e($category->bigThumb); ?>" type="image/pjpeg">
                                    <img src="<?php echo e($category->bigThumb); ?>" alt="<?php echo e($category->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?>">
                                </picture>
                                <p><?php echo e($category->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?> <i class="icon"></i></p>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/catalog/main.blade.php ENDPATH**/ ?>