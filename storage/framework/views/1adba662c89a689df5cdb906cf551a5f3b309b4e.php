<?php $__env->startSection('title',($seoTitle ? $seoTitle : $current_category->getTranslatedAttribute('name',$locale,$fallbackLocale))); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : $current_category->getTranslatedAttribute('name',$locale,$fallbackLocale))); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',\Voyager::image($current_category->thumbic)); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','catalog-products subcategories products'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page catalog-products subcategories products">
        <div class="content-sidebar" data-ng-controller="CatalogController as cat">
            <h1><?php echo e($current_category->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?></h1>
            <ul class="breadcrumbs">
                <li><a href="/"><?php echo app('translator')->get('general.home'); ?></a></li>
                <?php $__currentLoopData = $current_category->parents->reverse(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="sep"><i class="fa fa-angle-right"></i></li>
                    <li>
                        <a href="<?php echo e($parentCat->link); ?>"><?php echo e($parentCat->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li class="sep"><i class="fa fa-angle-right"></i></li>
                <li class="current">
                    <span><?php echo e($current_category->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?></span></li>
            </ul>
            <a href="#" class="filter-btn-xs btn-darkgreen" data-toggle="modal"
               data-target="#catalogFilters"><?php echo app('translator')->get('general.filter'); ?></a>
            <div class="content col-9" data-ng-init="cat.initFunctions('<?php echo e($current_category->slug); ?>')">
                <div class="items">
                    <?php if($current_category->categories->count()): ?>
                        <?php $__currentLoopData = $current_category->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item img-hover">
                                <a href="<?php echo e($subcat->link); ?>" class="image">
                                    <picture>
                                        <source srcset="<?php echo e($subcat->webpImage); ?>" type="image/webp">
                                        <source srcset="<?php echo e($subcat->bigThumb); ?>" type="image/pjpeg">
                                        <img src="<?php echo e($subcat->bigThumb); ?>"
                                             alt="<?php echo e($subcat->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?>">
                                    </picture>
                                </a>
                                <a href="<?php echo e($subcat->link); ?>"
                                   class="name"><?php echo e($subcat->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?> <i
                                        class="icon"></i></a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <div class="item img-hover" data-ng-if="cat.products.length"
                         data-ng-repeat="product in cat.filtered_products=(cat.products | filter:cat.updateFilters) | orderBy:cat.orderExpression | limitTo:cat.pageSize:(cat.currentPage - 1) * cat.pageSize track by product.id">
                        <a data-ng-href="{{product.web_link}}" href="#" class="image">
                            <picture>
                                <source srcset="#" data-ng-srcset="{{product.webp_link}}" type="image/webp">
                                <source srcset="#" data-ng-srcset="{{product.image_link}}" type="image/pjpeg">
                                <img src="#" data-ng-src="{{product.image_link}}"
                                     alt="{{product.seo_title ? product.seo_title : product.name}}">
                            </picture>
                        </a>
                        <a href="#" data-ng-href="{{product.web_link}}" class="name">{{product.name}} <i
                                class="icon"></i></a>
                        <p class="description">{{product.excerpt}}</p>
                    </div>
                </div>
                <ul data-ng-if="cat.filtered_products.length > cat.pageSize" data-uib-pagination
                    data-total-items="cat.filtered_products.length" data-ng-model="cat.currentPage"
                    data-max-size="4" data-template-url="/js/angular/templates/pagination.html"
                    class="pagination-sm" data-boundary-link="false" data-rotate="false"
                    data-items-per-page="cat.pageSize"></ul>
                <?php if(!$current_category->categories->count()): ?>
                    <div class="products" data-ng-if="!cat.products.length && !cat.loading"><p
                            class=""><?php echo app('translator')->get('general.categoryEmpty'); ?></p></div>
                <?php endif; ?>
				<p class="d-flex w-100 justify-content-start mt-5 pre-line-text"><?php echo e(\Str::limit($current_category->getTranslatedAttribute('excerpt',$locale,$fallbackLocale),1500,'.')); ?></p>

            </div>
            <div class="sidebar col-3">
                <ul class="sidebar-menu">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li <?php if($cat->id == $current_category->id): ?> class="active" <?php endif; ?> ><a
                                href="<?php echo e($cat->link); ?>"><?php echo e($cat->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <div class="filter">
                    <strong><?php echo app('translator')->get('general.filterProducts'); ?></strong>
                    <div class="items">
                        <div class="item" data-ng-repeat="(categoryKey, category) in cat.filters"
                             data-ng-init="cat.filter[category]={}">
                            <div class="header">
                                <p class="name"
                                   data-ng-if="categoryKey !='brand'">{{categoryKey}}</p>
                                <p class="name" data-ng-if="categoryKey=='brand'"><?php echo app('translator')->get('general.brand'); ?></p>
                                <a class="collapseBtn"
                                   data-toggle="collapse"
                                   data-ng-href="#collapse-{{$index}}"
                                   role="button"
                                   aria-expanded="true"
                                   aria-controls="collapse-{{$index}}">
                                    <i class="fa fa-angle-down"></i> </a>
                            </div>
                            <div class="collapse show" id="collapse-{{$index}}">
                                <div class="checkboxes">
                                    <div class="box custom-control custom-checkbox"
                                         data-ng-repeat="(key, value) in category | filtersLimitTo: category.filtersLimit"
                                         data-ng-if="key !='filtersLimit'"><label> <input type="checkbox"
                                                                                          class="custom-control-input"
                                                                                          name="example1"
                                                                                          data-ng-model="cat.filters[categoryKey][key]">
                                            <span class="custom-control-label">{{key}}</span><span
                                                class="count">({{(cat.filtered_products | filter:key:true).length}}
                                                )</span></label>
                                    </div>
                                    <a class="more" data-ng-show="cat.showMoreFilter(category)"
                                       data-ng-click="category.filtersLimit=category.length"><?php echo app('translator')->get('general.showMore'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $__env->make('partials.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="modal" id="catalogFilters">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1L16 16M16 1L1 16" stroke="#AEAEAE" stroke-width="2"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="filter mob-filter">
                                <strong><?php echo app('translator')->get('general.filterProducts'); ?></strong>
                                <div class="items">
                                    <div class="item" data-ng-repeat="(categoryKey, category) in cat.filters"
                                         data-ng-init="cat.filter[category]={}">
                                        <div class="header">
                                            <p class="name"
                                               data-ng-if="categoryKey !='brand'">{{categoryKey}}</p>
                                            <p class="name" data-ng-if="categoryKey=='brand'"><?php echo app('translator')->get('general.brand'); ?></p>
                                            <a class="collapseBtn"
                                               data-toggle="collapse"
                                               data-ng-href="#collapse-mob-{{$index}}"
                                               role="button"
                                               aria-expanded="false"
                                               aria-controls="collapse-mob-{{$index}}">
                                                <i class="fa fa-angle-down"></i> </a>
                                        </div>
                                        <div class="collapse" id="collapse-mob-{{$index}}">
                                            <div class="checkboxes">
                                                <div class="box custom-control custom-checkbox"
                                                     data-ng-repeat="(key, value) in category | filtersLimitTo: category.filtersLimit"
                                                     data-ng-if="key !='filtersLimit'"><label> <input type="checkbox"
                                                                                                      class="custom-control-input"
                                                                                                      name="example1"
                                                                                                      data-ng-model="cat.filters[categoryKey][key]">
                                                        <span class="custom-control-label">{{key}}</span><span
                                                            class="count">({{(cat.filtered_products | filter:key:true).length}}
                                                            )</span></label>
                                                </div>
                                                <a class="more" data-ng-show="cat.showMoreFilter(category)"
                                                   data-ng-click="category.filtersLimit=category.length"><?php echo app('translator')->get('general.showMore'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="/js/angular/catalog.controller.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/catalog/products.blade.php ENDPATH**/ ?>