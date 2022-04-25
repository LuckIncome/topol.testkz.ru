<?php $__env->startSection('title',($seoTitle ? $seoTitle : $page->title)); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : $page->seo_title)); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',\Voyager::image($page->thumbic)); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','base'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page static-page">
        <div class="content-sidebar">
            <h1><?php echo e($page->title); ?></h1>
            <?php echo $__env->make('partials.breadcrumbs',['title'=>__('general.pageAbout'),'titleLink'=>route('pages.about'),'subtitle' => $page->title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content col-9">
                <div class="static-page-content">
                    <?php echo $page->body; ?>

                </div>
                <?php if(count($images)): ?>
                    <div class="gallery-slider">
                        <div class="slider-data">
                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $picture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item">
                                    <picture>
                                        <source srcset="<?php echo e($picture['webp']); ?>" type="image/webp">
                                        <source srcset="<?php echo e($picture['original']); ?>" type="image/pjpeg">
                                        <img src="<?php echo e($picture['original']); ?>" alt="<?php echo e($page->seo_title ? $page->seo_title : $page->title); ?>">
                                    </picture>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="slider-arrows">
                            <button class="arrow prevSlide"><span class="sr-only">Previous</span><i
                                        class="icon"></i>
                            </button>
                            <button class="arrow nextSlide"><span class="sr-only">Next</span><i
                                        class="icon"></i>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="static-page-content">
                    <?php echo $page->body_footer; ?>

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
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/pages/aboutShow.blade.php ENDPATH**/ ?>