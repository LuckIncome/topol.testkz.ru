<?php $__env->startSection('title',($seoTitle ? $seoTitle : $page->title)); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : $page->seo_title)); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',\Voyager::image($page->thumbic)); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','base'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page base">
        <div class="content-sidebar">
            <h1><?php echo e($page->title); ?></h1>
            <?php echo $__env->make('partials.breadcrumbs',['title'=>__('general.usefulInformation'),'titleLink'=>route('info.index'),'subtitle' => $page->title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content col-9">
                <div class="docs">
                    <?php $__currentLoopData = $normatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $normative): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="doc">
                            <p class="date"><?php echo e(\Carbon\Carbon::parse($normative->created_at)->translatedFormat('d F Y')); ?></p>
                            <strong><?php echo e($normative->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?></strong>
                            <?php if($normative->file): ?>
                                <a target="_blank" href="<?php echo e($normative->file); ?>" class="btn-dark"><?php echo app('translator')->get('general.downloadFile'); ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="sidebar col-3">
                <ul class="sidebar-menu">
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li <?php if($page->id == $item->id): ?> class="active" <?php endif; ?>><a href="<?php echo e(route('info.show',$item)); ?>"><?php echo e($item->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php echo $__env->make('partials.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/pages/normatives.blade.php ENDPATH**/ ?>