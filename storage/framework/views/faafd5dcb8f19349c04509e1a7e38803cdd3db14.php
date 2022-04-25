<?php $__env->startSection('title',($seoTitle ? $seoTitle : __('general.sitemap'))); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : __('general.sitemap'))); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',env('APP_URL').'/images/og.jpg'); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','base'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page sitemap-page">
        <div class="content-sidebar">
            <h1><?php echo app('translator')->get('general.sitemap'); ?></h1>
            <?php echo $__env->make('partials.breadcrumbs',['title'=>($seoTitle ? $seoTitle : __('general.sitemap'))], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content col-9">
                <ul class="sitemap">
                    <li><a href="<?php echo e(route('pages.home')); ?>"><?php echo app('translator')->get('general.home'); ?> <i class="icon"></i></a></li>
                    <li><a href="<?php echo e(route('search')); ?>"><?php echo app('translator')->get('general.search'); ?> <i class="icon"></i></a></li>
                    <li><a href="<?php echo e(route('catalog.index')); ?>"><?php echo app('translator')->get('general.catalogTitle'); ?> <i class="icon"></i></a>
                        <ul class="sitemap">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e($category->link); ?>"><?php echo e($category->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?>

                                        <i
                                                class="icon"></i></a>
                                    <?php if($category->slug == 'uslugi'): ?>
                                        <ul class="sitemap">
                                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <a href="<?php echo e(route('catalog.show',[$category,$service->slug])); ?>"><?php echo e($service->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?>

                                                        <i class="icon"></i></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php elseif($category->slug == 'akcii'): ?>
                                        <ul class="sitemap">
                                            <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <a href="<?php echo e(route('catalog.show',[$category,$sale->slug])); ?>"><?php echo e($sale->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?>

                                                        <i class="icon"></i></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php else: ?>
                                        <ul class="sitemap">
                                            <?php $__currentLoopData = $category->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <a href="<?php echo e($cat->link); ?>"><?php echo e($cat->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?>

                                                        <i class="icon"></i></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo e(route('info.index')); ?>"><?php echo app('translator')->get('general.pageInfo'); ?> <i class="icon"></i></a>
                        <ul class="sitemap">
                            <?php $__currentLoopData = $infoPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $infoPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('info.show',$infoPage)); ?>"><?php echo e($infoPage->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?> <i class="icon"></i></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo e(route('pages.about')); ?>"><?php echo app('translator')->get('general.pageAbout'); ?> <i class="icon"></i></a>
                        <ul class="sitemap">
                            <?php $__currentLoopData = $aboutPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $infoPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('about.show',$infoPage)); ?>"><?php echo e($infoPage->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?> <i class="icon"></i></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <li><a href="<?php echo e(route('pages.contacts')); ?>"><?php echo app('translator')->get('general.contacts'); ?> <i class="icon"></i></a></li>
                    <li><a href="<?php echo e(route('posts.index')); ?>"><?php echo app('translator')->get('general.pageNews'); ?> <i class="icon"></i></a></li>
                    <li><a href="<?php echo e(route('page.terms')); ?>"><?php echo app('translator')->get('general.terms'); ?> <i class="icon"></i></a></li>
                </ul>
            </div>
            <div class="sidebar col-3">
                <?php echo $__env->make('partials.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/pages/sitemap.blade.php ENDPATH**/ ?>