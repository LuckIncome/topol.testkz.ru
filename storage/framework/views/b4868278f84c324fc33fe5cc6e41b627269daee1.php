<?php $__env->startSection('title',($seoTitle ? $seoTitle : $subcategory->getTranslatedAttribute('name',$locale,$fallbackLocale))); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : $subcategory->getTranslatedAttribute('name',$locale,$fallbackLocale))); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',\Voyager::image($subcategory->thumbic)); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','catalog-products subcategories'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page catalog-products subcategories">
        <div class="content-sidebar">
            <h1><?php echo e($subcategory->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?></h1>
            <?php echo $__env->make('partials.breadcrumbs',[
            'title'=>($seoTitle ? $seoTitle : $category->getTranslatedAttribute('name',$locale,$fallbackLocale)),
            'titleLink' => route('catalog.show',$category),
            'subtitle' => $subcategory->getTranslatedAttribute('name',$locale,$fallbackLocale)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content col-9">
                <?php if($subcategory->categories->count()): ?>
                    <div class="items">
                        <?php $__currentLoopData = $subcategory->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item img-hover">
                                <a href="<?php echo e(route('catalog.products',[$category,$subcategory,$subcat])); ?>" class="image">
                                    <picture>
                                        <source srcset="<?php echo e($subcat->webpImage); ?>" type="image/webp">
                                        <source srcset="<?php echo e($subcat->bigThumb); ?>" type="image/pjpeg">
                                        <img src="<?php echo e($subcat->bigThumb); ?>"
                                             alt="<?php echo e($subcat->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?>">
                                    </picture>
                                </a>
                                <a href="<?php echo e(route('catalog.products',[$category,$subcategory,$subcat])); ?>"
                                   class="name"><?php echo e($subcat->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?> <i
                                            class="icon"></i></a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="text-center d-flex w-100 justify-content-start"><?php echo app('translator')->get('general.noFiles'); ?></p>
                <?php endif; ?>
            </div>
            <div class="sidebar col-3">
                <ul class="sidebar-menu">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li <?php if($cat->id == $category->id): ?> class="active" <?php endif; ?> ><a href="<?php echo e(route('catalog.show',[$cat])); ?>"><?php echo e($cat->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php echo $__env->make('partials.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/catalog/child.blade.php ENDPATH**/ ?>