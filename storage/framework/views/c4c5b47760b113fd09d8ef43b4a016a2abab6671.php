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
                <div class="docs certs">
                    <?php $__currentLoopData = $certs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="doc">
                            <p class="description <?php if(!$cert->file): ?> w-100 <?php endif; ?>"><?php echo e($cert->name); ?></p>
                            <?php if($cert->file): ?>
                                <a target="_blank" href="<?php echo e($cert->file); ?>" class="btn-dark"><?php echo app('translator')->get('general.download'); ?></a>
                            <?php endif; ?>
                        </div>
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
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/pages/certs.blade.php ENDPATH**/ ?>