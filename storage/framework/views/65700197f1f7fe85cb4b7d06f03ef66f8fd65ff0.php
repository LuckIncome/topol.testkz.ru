<?php $__env->startSection('title',($seoTitle ? $seoTitle : __('general.searchResults'))); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : __('general.searchResults'))); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',env('APP_URL').'/images/og.jpg'); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','search-page'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page search-page" data-ng-controller="SearchController as sc">
        <div class="content-sidebar">
            <h1><?php echo app('translator')->get('general.searchResults'); ?></h1>
            <div class="content col-9">
                <div class="search input-group" data-ng-init="searchInputInline = '<?php echo e($input); ?>'">
                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('general.searchPlaceholder'); ?>"
                           data-ng-model="searchInputInline"
                           aria-label="<?php echo app('translator')->get('general.searchPlaceholder'); ?>" aria-describedby="button-addon1"
                           value="<?php echo e($input); ?>">
                    <div class="input-group-append">
                        <button class="btn" type="button" id="button-addon1"
                                data-ng-click="sc.openSearchPage(searchInputInline)"><?php echo app('translator')->get('general.search'); ?></button>
                    </div>
                </div>
                <p class="result"><?php echo app('translator')->get('general.searchFound',['input'=>$input, 'total' => $items->total()]); ?></p>
                <div class="items">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item img-hover">
                            <span class="key"><?php echo e(str_pad($key+1, 2, "0", STR_PAD_LEFT)); ?>.</span>
                            <?php if(class_basename($item) == 'Product'): ?>
                                <a href="<?php echo e($item->full_link); ?>" class="image">
                                    <picture>
                                        <source srcset="<?php echo e($item->thumbnailSmall); ?>" type="image/webp">
                                        <source srcset="<?php echo e(Voyager::image($item->getThumbnail($item->image,'small'))); ?>"
                                                type="image/pjpeg">
                                        <img src="<?php echo e(Voyager::image($item->getThumbnail($item->image,'small'))); ?>"
                                             alt="<?php echo e($item->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?>">
                                    </picture>
                                </a>
                            <?php endif; ?>
                            <div class="text">
                                <?php if(!is_null($item->date)): ?><p class="date"><?php echo e($item->date); ?></p><?php endif; ?>
                                <a href="<?php echo e($item->full_link); ?>"
                                   class="title"><?php echo e($item->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?> <i
                                            class="icon"></i></a>
                                <p class="description"><?php echo e(Str::limit($item->getTranslatedAttribute('excerpt',$locale,$fallbackLocale), (class_basename($item) == 'Product') ? 250 : 290 , '...')); ?></p>
                            </div>
                        </div>
                        <?php if(!$loop->last): ?>
                            <hr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php echo $items->links(); ?>

            </div>
            <div class="sidebar col-3">
                <?php echo $__env->make('partials.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/pages/search.blade.php ENDPATH**/ ?>