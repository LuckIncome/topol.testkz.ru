<?php $__env->startSection('title',$sale->title); ?>
<?php $__env->startSection('image',\Voyager::image($sale->thumbic)); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('seo_title',$sale->seo_title); ?>
<?php $__env->startSection('meta_description',$sale->meta_description); ?>
<?php $__env->startSection('meta_keywords',$sale->meta_keywords); ?>
<?php $__env->startSection('page_class','single-post'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page single-post">
        <div class="content-sidebar">
            <h1><?php echo e($sale->title); ?></h1>
            <?php echo $__env->make('partials.breadcrumbs',['title'=>__('general.catalogTitle'),'titleLink'=>route('catalog.index'),'subtitle'=> $category->getTranslatedAttribute('name',$locale,$fallbackLocale), 'subtitleLink'=> $category->link, 'childTitle'=> $sale->title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content col-9">
                <div class="text-content">
                    <?php echo $sale->body; ?>

                </div>
                <?php if(count($images)): ?>
                    <div class="gallery-slider">
                        <div class="slider-data">
                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $picture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <picture>
                                    <source srcset="<?php echo e($picture['webp']); ?>" type="image/webp">
                                    <source srcset="<?php echo e($picture['original']); ?>" type="image/pjpeg">
                                    <img src="<?php echo e($picture['original']); ?>" alt="<?php echo e($sale->seo_title); ?>">
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
                <div class="text-content">
                    <?php echo $sale->body_footer; ?>

                </div>
            </div>
            <div class="sidebar col-3">
                <?php echo $__env->make('partials.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/sales/show.blade.php ENDPATH**/ ?>