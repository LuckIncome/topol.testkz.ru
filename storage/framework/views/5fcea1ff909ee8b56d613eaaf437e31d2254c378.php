<?php $__env->startSection('title',($seoTitle ? $seoTitle : $page->title)); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : $page->title)); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',\Voyager::image($page->thumbic)); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','base'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page base">
        <div class="content-sidebar">
            <h1><?php echo e($page->title); ?></h1>
            <?php echo $__env->make('partials.breadcrumbs',['title'=>__('general.pageAbout'),'titleLink'=>route('pages.about'),'subtitle' => $page->title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content col-9">
                <div class="docs partners reviews">
                    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($review->bigThumb); ?>" class="fb" data-fancybox="reviews">
                        <picture>
                            <source srcset="<?php echo e($review->webpImage); ?>" type="image/webp">
                            <source srcset="<?php echo e($review->bigThumb); ?>" type="image/pjpeg">
                            <img src="<?php echo e($review->bigThumb); ?>"
                                 alt="<?php echo e($review->getTranslatedAttribute('alt',$locale,$fallbackLocale)); ?>">
                        </picture>
                        
                            
                            
                            
                                 
                        
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="sidebar col-3">
                <ul class="sidebar-menu">
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->id == $page->id): ?>
                            <li class="active"><span><?php echo e($item->title); ?></span></li>
                        <?php else: ?>
                            <li><a href="<?php echo e($item->url); ?>"><?php echo e($item->title); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php echo $__env->make('partials.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/pages/reviews.blade.php ENDPATH**/ ?>