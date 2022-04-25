<ul class="<?php echo e(!isset($isParent) ? 'nav navbar-nav menu' : 'dropdown-menu'); ?>">
    <?php

        if (Voyager::translatable($items)) {
            $items = $items->load('translations');
        }

    ?>

    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php

            $originalItem = $item;
            if (Voyager::translatable($item)) {
                $item = $item->translate($options->locale);
            }

            $isActive = null;
            $styles = null;
            $icon = null;
            $hasPage = false;
                if($originalItem->route == 'pages.about'){
                    $exclude = ['obuchenie','nashi-proekty'];
                    $pages = \App\Page::where('type','about')->where('slug','!=','o-kompanii')->where('status',\App\Page::STATUS_ACTIVE)->orderBy('sort_id')->get()->each(function ($item) use ($exclude){
                        if (!in_array($item->slug,$exclude)){
                            $item->url = route('about.show',$item);
                        }else {
                            $item->url = ($item->slug == 'obuchenie') ? route('programs.index') : route('projects.index');
                        }
                    });
                    $originalItem->setAttribute('pages',$pages);
                    $hasPage = true;
                }

                 if($originalItem->route == 'info.index'){
                    $pages = \App\Page::where('type','info')->where('slug','!=','terms')->where('status',\App\Page::STATUS_ACTIVE)->orderBy('sort_id')->get()->each(function ($item) {
                        $item->url = route('info.show',$item);
                    });
                    $originalItem->setAttribute('pages',$pages);
                    $hasPage = true;
                }

                 if($originalItem->route == 'catalog.index'){
                    $pages = \App\Category::where('parent_id',null)->where('active',true)->orderBy('order')->get()->each(function ($item) {
                        $item->url = route('catalog.show',$item);
                    });
                    $originalItem->setAttribute('pages',$pages);
                    $hasPage = true;
                }

            if (!in_array(class_basename($originalItem) ,['Page','Category'])){
                // Background Color or Color
                if (isset($options->color) && $options->color == true) {
                    $styles = 'color:'.$item->color;
                }
                if (isset($options->background) && $options->background == true) {
                    $styles = 'background-color:'.$item->color;
                }

                // Check if link is current
                if(url($originalItem->link()) == url()->current()){
                    $isActive = 'active';
                }

                // Set Icon
                if(isset($options->icon) && $options->icon == true){
                    $icon = '<i class="' . $item->icon_class . '"></i>';
                }

            }

            $originalItem->setAttribute('hasPage',$hasPage);
        ?>
        <?php if(!in_array(class_basename($originalItem) ,['Page','Category'])): ?>
            <li class="nav-item <?php echo e($isActive); ?> <?php echo e(($originalItem->hasPage || !$originalItem->children->isEmpty()) ? 'dropdown':''); ?>">
                <a href="<?php echo e(url($originalItem->link())); ?>" target="<?php echo e($originalItem->target); ?>" style="<?php echo e($styles); ?>">
                    <?php echo e($item->title); ?>

                </a>
                <?php if(!$originalItem->children->isEmpty()): ?>
                    <?php echo $__env->make('voyager::menu.default', ['items' => $originalItem->children, 'options' => $options, 'isParent' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                <?php if($originalItem->hasPage): ?>
                    <?php echo $__env->make('voyager::menu.default', ['items' => $originalItem->pages, 'options' => $options, 'isParent' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </li>
        <?php else: ?>
            <li class="<?php echo e($originalItem->url == url()->current() ? 'active' : ''); ?>">
                <a href="<?php echo e($originalItem->url); ?>">
                    <?php echo e($item->title ? $item->title : $item->name); ?>

                </a>
                <?php if($originalItem->hasPage): ?>
                    <?php echo $__env->make('voyager::menu.default', ['items' => $originalItem->pages, 'options' => $options, 'isParent' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </li>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</ul>
<?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/vendor/voyager/menu/default.blade.php ENDPATH**/ ?>