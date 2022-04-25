<?php $__env->startSection('title',($seoTitle ? $seoTitle : $page->title)); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : $page->title)); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',\Voyager::image($page->thumbic)); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','posts'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page posts">
        <div class="content-sidebar">
            <h1><?php echo e($page->title); ?></h1>
            <?php echo $__env->make('partials.breadcrumbs',['title'=>__('general.pageAbout'),'titleLink'=>route('pages.about'),'subtitle' => $page->title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content col-9">
                <div class="items">
                    <?php if($projects->count()): ?>
                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item img-hover">
                                <a href="<?php echo e(route('projects.show',$post)); ?>" class="image">
                                    <picture>
                                        <source srcset="<?php echo e($post->webpImage); ?>" type="image/webp">
                                        <source srcset="<?php echo e($post->bigThumb); ?>" type="image/pjpeg">
                                        <img src="<?php echo e($post->bigThumb); ?>" alt="<?php echo e($post->seo_title ? $post->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $post->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?>">
                                    </picture>
                                </a>
                                <div class="text">
                                    <p class="date"><?php echo e($post->getTranslatedAttribute('category',$locale,$fallbackLocale)); ?></p>
                                    <a href="<?php echo e(route('projects.show',$post)); ?>" class="title"><?php echo e($post->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?> <i class="icon"></i></a>
                                    <p class="description"><?php echo e(Str::limit($post->getTranslatedAttribute('excerpt',$locale,$fallbackLocale), 165, '...')); ?></p>
                                    <a href="<?php echo e(route('projects.show',$post)); ?>" class="btn-dark"><?php echo app('translator')->get('general.more'); ?></a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p class="text-center d-flex w-100 justify-content-center"><?php echo app('translator')->get('general.noFiles'); ?></p>
                    <?php endif; ?>
                </div>
                <?php echo $projects->links(); ?>

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
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/projects/index.blade.php ENDPATH**/ ?>