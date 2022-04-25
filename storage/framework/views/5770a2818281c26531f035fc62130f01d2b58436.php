<?php $__env->startSection('title',$product->name); ?>
<?php $__env->startSection('image',\Voyager::image($product->thumbic)); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('seo_title',$product->seo_title); ?>
<?php $__env->startSection('meta_description',$product->meta_description); ?>
<?php $__env->startSection('meta_keywords',$product->meta_keywords); ?>
<?php $__env->startSection('page_class','product-page'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page product-page">
        <div class="content-sidebar">
            <h1><?php echo e($product->name); ?></h1>
            <ul class="breadcrumbs">
                <li><a href="/"><?php echo app('translator')->get('general.home'); ?></a></li>
                <?php $__currentLoopData = $product->parents->reverse(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="sep"><i class="fa fa-angle-right"></i></li>
                    <li><a href="<?php echo e($parentCat->link); ?>"><?php echo e($parentCat->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li class="sep"><i class="fa fa-angle-right"></i></li>
                <li class="current"><span><?php echo e($product->name); ?></span></li>
            </ul>
            <div class="content col-9">
                <div class="main-info">
                    <a href="<?php echo e(Voyager::image($product->image)); ?>" class="image fb"
                       data-fancybox="gallery-<?php echo e($product->id); ?>">
                        <picture>
                            <source srcset="<?php echo e($product->webp); ?>" type="image/webp">
                            <source srcset="<?php echo e($product->bigThumb); ?>" type="image/pjpeg">
                            <img src="<?php echo e($product->bigThumb); ?>"
                                 alt="<?php echo e($product->seo_title ? $product->seo_title : $product->name); ?>">
                        </picture>
                    </a>
                    <div class="text">
                        <div class="description">
                            <?php echo $product->description; ?>

                        </div>
                        <a href="#" class="btn-darkgreen" data-target="#callbackModal" data-toggle="modal"
                           data-page="<?php echo e($product->name); ?>  | Товар"><?php echo app('translator')->get('general.makeRequest'); ?></a>
                    </div>
                </div>
                <div class="tab-info">
                    <nav>
                        <div class="nav nav-tabs align-items-end" id="nav-productTab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-functions-tab" data-toggle="tab"
                               href="#nav-functions" role="tab"
                               aria-controls="nav-functions" aria-selected="true"><?php echo app('translator')->get('general.features'); ?></a>
                            <a class="nav-item nav-link" id="nav-chars-tab" data-toggle="tab" href="#nav-chars"
                               role="tab"
                               aria-controls="nav-chars" aria-selected="false"><?php echo app('translator')->get('general.specifications'); ?></a>
                            <?php if($product->products->count()): ?>
                                <a class="nav-item nav-link" id="nav-accessories-tab" data-toggle="tab"
                                   href="#nav-accessories"
                                   role="tab"
                                   aria-controls="nav-accessories"
                                   aria-selected="false"><?php echo app('translator')->get('general.accessories'); ?></a>
                            <?php endif; ?>

                        </div>
                    </nav>
                    <div class="tab-content" id="nav-productTabContent">

                        <div class="tab-pane fade show active" id="nav-functions" role="tabpanel"
                             aria-labelledby="nav-functions-tab">
                            <?php $__currentLoopData = $product->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="block">
                                    <strong><?php echo e($index); ?></strong>
                                    <ul>
                                        <?php $__currentLoopData = $feature; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <span><?php echo e($item['name']); ?></span>
                                                <p><?php echo e($item['value']); ?></p>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="tab-pane fade" id="nav-chars" role="tabpanel" aria-labelledby="nav-chars-tab">
                            <div class="block">
                                <ul>
                                    <li>
                                        <span><?php echo app('translator')->get('general.brand'); ?></span>
                                        <p><?php echo e($product->brand); ?></p>
                                    </li>
                                    <?php $__currentLoopData = unserialize($product->specifications); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <span><?php echo e($item['name']); ?></span>
                                            <p><?php echo e($item['value']); ?></p>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                        <?php if($product->products->count()): ?>
                            <div class="tab-pane fade" id="nav-accessories" role="tabpanel"
                                 aria-labelledby="nav-accessories-tab">
                                <div class="tab-slider <?php if($product->products->count() < 3): ?> not-slider <?php endif; ?>">
                                    <div class="content">
                                        <?php $__currentLoopData = $product->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="item img-hover">
                                                <a href="<?php echo e(env('APP_URL').$item->link); ?>" class="image">
                                                    <picture>
                                                        <source srcset="<?php echo e($item->webpImage); ?>" type="image/webp">
                                                        <source srcset="<?php echo e($item->bigThumb); ?>"
                                                                type="image/pjpeg">
                                                        <img src="<?php echo e($item->bigThumb); ?>"
                                                             alt="<?php echo e($item->seo_title ? $item->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $item->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?>">
                                                    </picture>
                                                </a>
                                                <a href="<?php echo e(env('APP_URL').$item->link); ?>"
                                                   class="name"><?php echo e($item->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?>

                                                    <i class="icon"></i></a>
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
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="sidebar col-3">
                <?php echo $__env->make('partials.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/catalog/product.blade.php ENDPATH**/ ?>