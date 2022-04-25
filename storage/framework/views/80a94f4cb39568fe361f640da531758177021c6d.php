<?php $__env->startSection('title',$service->title); ?>
<?php $__env->startSection('image',\Voyager::image($service->thumbic)); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('seo_title',$service->seo_title); ?>
<?php $__env->startSection('meta_description',$service->meta_description); ?>
<?php $__env->startSection('meta_keywords',$service->meta_keywords); ?>
<?php $__env->startSection('page_class','single-post'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page single-post">
        <div class="content-sidebar">
            <h1><?php echo e($service->title); ?></h1>
            <?php echo $__env->make('partials.breadcrumbs',['title'=>__('general.catalogTitle'),'titleLink'=>route('catalog.index'),'subtitle'=> $category->getTranslatedAttribute('name',$locale,$fallbackLocale), 'subtitleLink'=> $category->link, 'childTitle'=> $service->title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content col-9">
                <div class="text-content">
                    <?php echo $service->body; ?>

                </div>
                <?php if(count($images)): ?>
                    <div class="gallery-slider">
                        <div class="slider-data">
                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $picture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <picture>
                                    <source srcset="<?php echo e($picture['webp']); ?>" type="image/webp">
                                    <source srcset="<?php echo e($picture['original']); ?>" type="image/pjpeg">
                                    <img src="<?php echo e($picture['original']); ?>" alt="Большой каталог раций и радиостанций">
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
                    <?php echo $service->body_footer; ?>

                </div>
                <a href="#" class="btn-darkgreen" data-toggle="modal" data-target="#consultationModal" data-page="<?php echo e($service->title); ?> | Услуга"><?php echo app('translator')->get('general.getConsultation'); ?></a>
            </div>
            <div class="sidebar col-3">
                <a href="#" class="btn-darkgreen sidebar-btn"  data-toggle="modal" data-target="#consultationModal" data-page="<?php echo e($service->title); ?> | Услуга"><?php echo app('translator')->get('general.getConsultation'); ?></a>
                <?php echo $__env->make('partials.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/services/show.blade.php ENDPATH**/ ?>