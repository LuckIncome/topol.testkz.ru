<?php $__env->startSection('title',($seoTitle ? $seoTitle : $page->title)); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : $page->seo_title)); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',\Voyager::image($page->thumbic)); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','posts'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page posts services programs-page" data-ng-controller="SearchController as sc">
        <div class="content-sidebar">
            <h1><?php echo e($page->title); ?></h1>
            <?php echo $__env->make('partials.breadcrumbs',['title'=>__('general.pageAbout'),'titleLink'=>route('pages.about'),'subtitle' => $page->title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content col-9">
                <div class="tab-info">
                    <nav>
                        <div class="nav nav-tabs align-items-end" id="nav-productTab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-programs-tab" data-toggle="tab"
                               href="#nav-programs" role="tab"
                               aria-controls="nav-programs" aria-selected="true"><?php echo app('translator')->get('general.programs'); ?></a>
                            <a class="nav-item nav-link" id="nav-certs-tab" data-toggle="tab" href="#nav-certs"
                               role="tab"
                               aria-controls="nav-certs" aria-selected="false"><?php echo app('translator')->get('general.registry'); ?></a>

                        </div>
                    </nav>
                    <div class="tab-content" id="nav-programsTabContent">
                        <div class="tab-pane fade show active" id="nav-programs" role="tabpanel"
                             aria-labelledby="nav-programs-tab">
                            <div class="items">
                                <?php if($programs->count()): ?>
                                    <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item img-hover">
                                            <a href="<?php echo e(route('programs.show',$post)); ?>" class="image">
                                                <picture>
                                                    <source srcset="<?php echo e($post->webpImage); ?>" type="image/webp">
                                                    <source srcset="<?php echo e($post->bigThumb); ?>"
                                                            type="image/pjpeg">
                                                    <img src="<?php echo e($post->bigThumb); ?>"
                                                         alt="<?php echo e($post->seo_title ? $post->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $post->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?>">
                                                </picture>
                                            </a>
                                            <div class="text">
                                                <a href="<?php echo e(route('programs.show',$post)); ?>"
                                                   class="title"><?php echo e($post->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?>

                                                    <i class="icon"></i></a>
                                                <p class="description"><?php echo e(Str::limit($post->getTranslatedAttribute('excerpt',$locale,$fallbackLocale), 165, '...')); ?></p>
                                                <a href="<?php echo e(route('programs.show',$post)); ?>"
                                                   class="btn-dark"><?php echo app('translator')->get('general.more'); ?></a>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $programs->links(); ?>

                                <?php else: ?>
                                    <p class="text-center d-flex w-100 justify-content-center"><?php echo app('translator')->get('general.noFiles'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-certs" role="tabpanel"
                             aria-labelledby="nav-certs-tab">
                            <div class="search input-group">
                                <input type="text" class="form-control" data-ng-model="certInput"
                                       placeholder="<?php echo app('translator')->get('general.registryPlaceholder'); ?>"
                                       aria-label="<?php echo app('translator')->get('general.registryPlaceholder'); ?>"
                                       aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn" type="button" id="button-addon1" data-ng-click="sc.searchCert(certInput)"><?php echo app('translator')->get('general.find'); ?></button>
                                </div>
                            </div>
                            <div class="items">
                                <div class="items-head">
                                    <p><?php echo app('translator')->get('general.fullName'); ?></p>
                                    <p><?php echo app('translator')->get('general.certNumber'); ?></p>
                                </div>
                                <div class="item" data-ng-repeat="item in sc.certItems track by $index">
                                    <p>{{item.full_name}}</p>
                                    <p>№{{item.number}}</p>
                                </div>
                                <div class="item" data-ng-if="sc.certItems.length <= 0">
                                   <p><?php echo app('translator')->get('general.certNotFound'); ?></p>
                                   <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
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
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/programs/index.blade.php ENDPATH**/ ?>