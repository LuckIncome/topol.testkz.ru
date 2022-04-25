<?php $__env->startSection('title',($seoTitle ? $seoTitle : $page->title)); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : $page->seo_title)); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',\Voyager::image($page->thumbic)); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','base'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page single-post about-page">
        <div class="content-sidebar">
            <h1><?php echo e($page->title); ?></h1>
            <?php echo $__env->make('partials.breadcrumbs',['title'=>($seoTitle ? $seoTitle : $page->title)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content col-9">
                <div class="text-content">
                  <?php echo $page->body; ?>

                </div>
                <div class="tab-slider">
                    <div class="content">
                        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item img-hover">
                            <a href="<?php echo e(route('about.show',$item)); ?>" class="image">
                                <picture>
                                    <source srcset="<?php echo e($item->webpImage); ?>" type="image/webp">
                                    <source srcset="<?php echo e($item->bigThumb); ?>" type="image/pjpeg">
                                    <img src="<?php echo e($item->bigThumb); ?>"
                                         alt="<?php echo e($item->seo_title ? $item->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $item->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?>">
                                </picture>
                            </a>
                            <a href="<?php echo e(route('about.show',$item)); ?>" class="name"><?php echo e($item->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?> <i class="icon"></i></a>
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
                <div class="text-content">
                    <?php echo $page->body_footer; ?>

                </div>
                <div class="action-tab-block">
                    <nav>
                        <div class="nav nav-tabs align-items-end" id="nav-advantages-tab" role="tablist">
                            <?php $__currentLoopData = $advantages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$advantage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="nav-item nav-link <?php echo e($i == 0 ? 'active': ''); ?>" id="nav-av-<?php echo e($i); ?>-tab" data-toggle="tab"
                                   href="#nav-av-<?php echo e($i); ?>" role="tab"
                                   aria-controls="nav-av-<?php echo e($i); ?>" aria-selected="<?php echo e($i == 0 ? 'true' : 'false'); ?>">
                                    <img src="<?php echo e(Voyager::image($advantage->icon)); ?>" class="svg" alt="<?php echo e($advantage->icon_text); ?>">
                                    <span><?php echo e($advantage->icon_text); ?></span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </nav>
                    <div id="nav-advTabContent" class="tab-content" role="tablist">
                        <?php $__currentLoopData = $advantages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $advantage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card tab-pane fade  <?php echo e($i == 0 ? 'show active': ''); ?>" id="nav-av-<?php echo e($i); ?>" role="tabpanel"
                                 aria-labelledby="nav-av-<?php echo e($i); ?>-tab">
                                <div class="card-header <?php echo e($i == 0 ? 'active-acc': ''); ?> " role="tab" id="heading-av-<?php echo e($i); ?>">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" href="#collapse-av-<?php echo e($i); ?>"
                                           aria-expanded="<?php echo e($i == 0 ? 'true' : 'false'); ?>"
                                           aria-controls="collapse-av-<?php echo e($i); ?>">
                                            <img src="<?php echo e(Voyager::image($advantage->icon)); ?>" class="svg"
                                                 alt="<?php echo e($advantage->icon_text); ?>">
                                            <span><?php echo e($advantage->icon_text); ?></span>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse-av-<?php echo e($i); ?>" class="collapse <?php echo e($i == 0 ? 'show': ''); ?>" role="tabpanel"
                                     aria-labelledby="heading-av-<?php echo e($i); ?>" data-parent="#nav-advTabContent">
                                    <div class="card-body">
                                        <div class="action-block about">
                                            <picture>
                                                <source srcset="<?php echo e($advantage->webpImage); ?>" type="image/webp">
                                                <source srcset="<?php echo e($advantage->bigThumb); ?>" type="image/pjpeg">
                                                <img src="<?php echo e($advantage->bigThumb); ?>"
                                                     alt="<?php echo e($advantage->title); ?>">
                                            </picture>
                                            <div class="text">
                                                <h2><?php echo e($advantage->title); ?></h2>
                                                <p><?php echo e($advantage->text); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="sidebar col-3">
                <?php echo $__env->make('partials.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/pages/about.blade.php ENDPATH**/ ?>