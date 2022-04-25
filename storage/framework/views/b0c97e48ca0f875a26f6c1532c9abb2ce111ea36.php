<?php $__env->startSection('title',($seoTitle ? $seoTitle : __('general.home'))); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : __('general.home'))); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',env('APP_URL').'/images/og.jpg'); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','home'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page main">
        <div class="home-slider">
            <div class="slider-content">
                <?php $__currentLoopData = $homeSliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$homeSlider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="slider">
                        <div class="text">
                            <?php if($key == 0): ?>
                                <h1><?php echo e($homeSlider->title); ?></h1>
                            <?php else: ?>
                                <h2><?php echo e($homeSlider->title); ?></h2>
                            <?php endif; ?>
                            <p><?php echo e($homeSlider->description); ?></p>
                            <div class="btns">
                                <a href="<?php echo e($homeSlider->btn_link); ?>" class="btn-light"><?php echo e($homeSlider->btn_text); ?></a>
                            </div>
                        </div>
                        <picture>
                            <source srcset="<?php echo e($homeSlider->webpImage); ?>" type="image/webp">
                            <source srcset="<?php echo e($homeSlider->bigThumb); ?>" type="image/jpeg">
                            <img src="<?php echo e($homeSlider->bigThumb); ?>" alt="<?php echo e($homeSlider->title); ?>">
                        </picture>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="slider-arrows">
                <button class="arrow prevSlide"><span class="sr-only">Previous</span><i
                            class="icon"></i>
                </button>
                <button class="arrow nextSlide"><span class="sr-only">Next</span><i class="icon"></i>
                </button>
            </div>
        </div>
        <!--FEATURED PRODUCTS TAB START-->
        <div class="featured-products">
            <nav>
                <div class="nav nav-tabs align-items-end" id="nav-tab" role="tablist">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="nav-item nav-link <?php if($key == 0): ?> active <?php endif; ?>" id="nav-<?php echo e($category->id); ?>-tab"
                           data-toggle="tab"
                           href="#nav-<?php echo e($category->id); ?>" role="tab"
                           aria-controls="nav-<?php echo e($category->id); ?>"
                           aria-selected="<?php echo e($key == 0 ? 'true' : 'false'); ?>"><?php echo e($category->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <a href="/catalog/akcionnyj-tovar" class="nav-item nav-link external">Акционный товар</a>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="nav-<?php echo e($category->id); ?>"
                         role="tabpanel"
                         aria-labelledby="nav-<?php echo e($category->id); ?>-tab">
                        <?php if($category->slug == 'uslugi'): ?>
                        <a href="<?php echo e($category->link); ?>" class="btn-dark"><?php echo app('translator')->get('general.allServices'); ?></a>
                        <?php elseif($category->slug == 'akcii'): ?>
                            <a href="<?php echo e($category->link); ?>" class="btn-dark"><?php echo app('translator')->get('general.allSales'); ?></a>
                        <?php else: ?>
                            <a href="<?php echo e($category->link); ?>" class="btn-dark"><?php echo app('translator')->get('general.goCatalog'); ?></a>
                        <?php endif; ?>
                        <div class="tab-slider <?php if($category->categories->count() < 3 || $services->count() < 3 || $sales->count() < 3): ?> not-slider <?php endif; ?>">
                            <div class="content">
                                <?php if($category->slug == 'katalog-produkcii'): ?>
                                    <?php $__currentLoopData = $category->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php ($cat->webp = $cat->bg); ?>
                                        <div class="item img-hover">
                                            <a href="<?php echo e($cat->link); ?>" class="image">
                                                <picture class="default">
                                                    <source srcset="<?php echo e($cat->webpImage); ?>"
                                                            type="image/webp">
                                                    <source srcset="<?php echo e($cat->bigThumb); ?>"
                                                            type="image/pjpeg">
                                                    <img src="<?php echo e($cat->bigThumb); ?>"
                                                         alt="<?php echo e($cat->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?>">
                                                </picture>
                                                <picture class="bg">
                                                    <source srcset="<?php echo e($cat->webp); ?>"
                                                            type="image/webp">
                                                    <source srcset="<?php echo e(\Voyager::image($cat->thumbnail('big','bg'))); ?>"
                                                            type="image/pjpeg">
                                                    <img src="<?php echo e(\Voyager::image($cat->thumbnail('big','bg'))); ?>"
                                                         alt="<?php echo e($cat->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?>">
                                                </picture>
                                            </a>
                                            <a href="<?php echo e($cat->link); ?>"
                                               class="name"><?php echo e($cat->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?>

                                                <i class="icon"></i></a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php elseif($category->slug == 'uslugi'): ?>
                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item img-hover">
                                            <a href="<?php echo e(route('catalog.show',[$category,$service->slug])); ?>" class="image">
                                                <picture>
                                                    <source srcset="<?php echo e($service->webpImage); ?>"
                                                            type="image/webp">
                                                    <source srcset="<?php echo e($service->bigThumb); ?>"
                                                            type="image/pjpeg">
                                                    <img src="<?php echo e($service->bigThumb); ?>"
                                                         alt="<?php echo e($service->seo_title ? $service->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $service->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?>">
                                                </picture>
                                            </a>
                                            <a href="<?php echo e(route('catalog.show',[$category,$service->slug])); ?>" class="name"><?php echo e($service->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?> <i class="icon"></i></a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item img-hover">
                                            <a href="<?php echo e(route('catalog.show',[$category,$sale->slug])); ?>" class="image">
                                                <picture>
                                                    <source srcset="<?php echo e($sale->webpImage); ?>"
                                                            type="image/webp">
                                                    <source srcset="<?php echo e($sale->bigThumb); ?>"
                                                            type="image/pjpeg">
                                                    <img src="<?php echo e($sale->bigThumb); ?>"
                                                         alt="<?php echo e($sale->seo_title ? $sale->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $sale->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?>">
                                                </picture>
                                            </a>
                                            <a href="<?php echo e(route('catalog.show',[$category,$sale->slug])); ?>" class="name"><?php echo e($sale->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?> <i class="icon"></i></a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <!--FEATURED PRODUCTS TAB END-->
        <div class="action-block about">
            <picture>
                <source srcset="<?php echo e($about->webpImage); ?>" type="image/webp">
                <source srcset="<?php echo e($about->bigThumb); ?>" type="image/pjpeg">
                <img src="<?php echo e($about->bigThumb); ?>"
                     alt="<?php echo e($about->getTranslatedAttribute('seo_title',$locale,$fallbackLocale)); ?>">
            </picture>
            <div class="text">
                <h2><?php echo e($about->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?></h2>
                <p><?php echo e($about->getTranslatedAttribute('excerpt',$locale,$fallbackLocale)); ?></p>
                <a href="<?php echo e(route('pages.about')); ?>" class="btn-dark">Подробнее о нас</a>
            </div>
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
                                        <img src="<?php echo e($advantage->bigThumb); ?>" alt="<?php echo e($advantage->title); ?>">
                                    </picture>
                                    <div class="text">
                                        <h2><?php echo e($advantage->title); ?></h2>
                                        <p><?php echo e($advantage->text); ?></p>
                                        <a href="<?php echo e(route('pages.about')); ?>" class="btn-dark"><?php echo app('translator')->get('general.moreAboutUs'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="projects posts block-header">
            <div class="header">
                <h2><?php echo app('translator')->get('general.ourProjects'); ?></h2>
                <a href="<?php echo e(route('projects.index')); ?>" class="btn-dark"><?php echo app('translator')->get('general.allProjects'); ?></a>
            </div>
            <div class="items">
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item img-hover">
                        <a class="image" href="<?php echo e(route('projects.show',$project)); ?>">
                            <picture>
                                <source srcset="<?php echo e($project->webpImage); ?>" type="image/webp">
                                <source srcset="<?php echo e($project->bigThumb); ?>" type="image/pjpeg">
                                <img src="<?php echo e($project->bigThumb); ?>"
                                     alt="<?php echo e($project->seo_title ? $project->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $project->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?>">
                            </picture>
                        </a>
                        <p class="category"><?php echo e($project->getTranslatedAttribute('category',$locale,$fallbackLocale)); ?></p>
                        <a href="<?php echo e(route('projects.show',$project)); ?>"
                           class="title"><?php echo e($project->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?> <i
                                    class="icon"></i></a>
                        <p class="description"><?php echo e(Str::limit($project->getTranslatedAttribute('excerpt',$locale,$fallbackLocale), $key == 0 ? 160 : 70 , '...')); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="partners block-header">
            <div class="header">
                <h2><?php echo app('translator')->get('general.ourPartners'); ?></h2>
                <a href="<?php echo e(route('about.show','nashi-partnery')); ?>" class="btn-dark"><?php echo app('translator')->get('general.allPartners'); ?></a>
            </div>
            <div class="slider-data">
                <div class="content">
                    <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item" data-toggle="popover" data-trigger="hover" data-placement="bottom"
                             data-content="<?php echo e($partner->description); ?>">
                            <picture>
                                <source srcset="<?php echo e($partner->webpImage); ?>" type="image/webp">
                                <source srcset="<?php echo e($partner->bigThumb); ?>" type="image/pjpeg">
                                <img src="<?php echo e($partner->bigThumb); ?>" alt="<?php echo e($partner->name); ?>">
                            </picture>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="slider-arrows">
                    <button class="arrow prevSlide"><span class="sr-only">Previous</span><i
                                class="icon"></i>
                    </button>
                    <button class="arrow nextSlide"><span class="sr-only">Next</span><i class="icon"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="posts block-header">
            <div class="header">
                <h2><?php echo app('translator')->get('general.pageNews'); ?></h2>
                <a href="<?php echo e(route('posts.index')); ?>" class="btn-dark"><?php echo app('translator')->get('general.allNews'); ?></a>
            </div>
            <div class="items">
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item img-hover">
                        <a class="image" href="<?php echo e(route('posts.show',$post)); ?>">
                            <picture>
                                <source srcset="<?php echo e($post->webpImage); ?>" type="image/webp">
                                <source srcset="<?php echo e($post->bigThumb); ?>" type="image/pjpeg">
                                <img src="<?php echo e($post->bigThumb); ?>"
                                     alt="<?php echo e($post->seo_title ? $post->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $post->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?>">
                            </picture>
                        </a>
                        <p class="date"><?php echo e(\Carbon\Carbon::parse($post->post_date)->translatedFormat('d F Y')); ?></p>
                        <a href="<?php echo e(route('posts.show',$post)); ?>"
                           class="title"><?php echo e($post->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?> <i
                                    class="icon"></i></a>
                        <p class="description"><?php echo e(Str::limit($post->getTranslatedAttribute('excerpt',$locale,$fallbackLocale), 105, '...')); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/home.blade.php ENDPATH**/ ?>