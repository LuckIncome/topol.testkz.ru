<header>
    <div class="upper">
        <div class="container">
            <div class="row">
                <div class="content">
                    <?php echo e(menu('header_menu','vendor.voyager.menu.default',['isParent' => true])); ?>

                    <div class="social-lang">
                        <p class="working-days"><?php echo e($graph->value); ?></p>
                        <ul class="lang">
                            <li class="<?php if($locale == 'ru'): ?> active <?php endif; ?>"><a
                                        href="<?php echo e(route('locale.set','ru')); ?>">RUS</a></li>
                            <li class="sep">|</li>
                            <li class="<?php if($locale == 'kz'): ?> active <?php endif; ?>"><a
                                        href="<?php echo e(route('locale.set','kz')); ?>">KAZ</a></li>
                            <li class="sep">|</li>
                            <li class="<?php if($locale == 'en'): ?> active <?php endif; ?>"><a
                                        href="<?php echo e(route('locale.set','en')); ?>">ENG</a></li>
                        </ul>
                        <ul class="socials">
                            <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="social <?php echo e($social->name); ?> icon-w"><a href="<?php echo e($social->link); ?>" target="_blank"><img src="<?php echo e(Voyager::image($social->icon)); ?>"
                                                                                                                 alt="<?php echo e($social->value); ?>"></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="downer">
        <div class="container">
            <div class="row">
                <div class="content">
                    <a href="<?php echo e(route('pages.home')); ?>" class="logo col-2"><img src="<?php echo e(Voyager::image(setting('site.logo'))); ?>" alt="<?php echo app('translator')->get('general.siteName'); ?>"></a>
                    <div class="search input-group col-6" data-ng-controller="SearchController as sc">
                        <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('general.searchPlaceholder'); ?>" data-ng-model="searchInput"
                               aria-label="<?php echo app('translator')->get('general.searchPlaceholder'); ?>" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn" type="button" id="button-addon2" data-ng-click="sc.searchByInput(searchInput)"><?php echo app('translator')->get('general.search'); ?></button>
                        </div>
                        <div class="search-results">
                            <ul data-ng-if="sc.searchItems.length > 0">
                                <li data-ng-repeat="item in sc.searchItems track by $index"><a href="#" data-ng-href="{{item.full_link}}">{{item.item}}: <span>{{item.name}}</span></a></li>
                            </ul>
                            <p data-ng-if="sc.searchItems.length <= 0"><?php echo app('translator')->get('general.noSearchResults'); ?></p>
                            <a data-ng-if="sc.searchItems.length > 0" href="#" data-ng-click="sc.openSearchPage(searchInput)" class="text-link"><?php echo app('translator')->get('general.showAllSearchResults'); ?></a>
                            <span class="close" data-ng-click="sc.closeResults()">&times;</span>
                        </div>
                    </div>
                    <div class="btns col-4">
                        <div class="phones">
                            <ul>
                                <?php
                                    $arrPhone = explode(' ', $phones->where('is_main',true)->first()->value);
                                    $mainPhone = $arrPhone[0]. ' ' .$arrPhone[1].' <span>'.implode(' ',array_diff($arrPhone, [$arrPhone[0],$arrPhone[1]])).'</span>';
                                ?>
                                <li class="dropdown">
                                    <a href="<?php echo e($phones->where('is_main',true)->first()->link); ?>" style="" class="dropdown-toggle phone">
                                        <i class="icon-phone"><img src="<?php echo e(Voyager::image($phones->where('is_main',true)->first()->icon)); ?>" alt="Topol.kz - контакты"></i><?php echo $mainPhone; ?>


                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php $__currentLoopData = $phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $phone1 = explode(' ', $phone->value);
                                                $phone2 = $phone1[0]. ' ' .$phone1[1].' <span>'.implode(' ',array_diff($phone1, [$phone1[0],$phone1[1]])).'</span>';
                                            ?>
                                            <?php if(!$phone->is_main): ?>
                                                <li class=" ">
                                                    <a href="<?php echo e($phone->link); ?>" style="" class="dropdown-toggle phone">
                                                        <i class="icon-phone"><img src="<?php echo e(Voyager::image($phone->icon)); ?>" alt="Topol.kz - контакты"></i><?php echo $phone2; ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <a href="#" class="btn-darkgreen callback-btn" data-toggle="modal" data-target="#callbackModal"
                           data-page="Кнопка в шапке"><?php echo app('translator')->get('general.callbackBtn'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="fixed-menu" class="fixed-header">
        <div class="container">
            <div class="row">
                <div class="content">
                    <div class="block">
                        <a href="<?php echo e(route('pages.home')); ?>" class="logo">
                            <img src="<?php echo e(Voyager::image(setting('site.logo'))); ?>" alt="<?php echo app('translator')->get('general.siteName'); ?>">
                        </a>
                        <?php echo e(menu('header_menu','vendor.voyager.menu.default',['isParent' => true])); ?>

                        <div class="btns col-4">
                            <div class="phones">
                                <ul>
                                    <?php
                                        $arrPhone = explode(' ', $phones->where('is_main',true)->first()->value);
                                        $mainPhone = $arrPhone[0]. ' ' .$arrPhone[1].' <span>'.implode(' ',array_diff($arrPhone, [$arrPhone[0],$arrPhone[1]])).'</span>';
                                    ?>
                                    <li class="dropdown">
                                        <a href="<?php echo e($phones->where('is_main',true)->first()->link); ?>" style="" class="dropdown-toggle phone">
                                            <i class="icon-phone"><img src="<?php echo e(Voyager::image($phones->where('is_main',true)->first()->icon)); ?>" alt="Topol.kz - контакты"></i><?php echo $mainPhone; ?>


                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <?php $__currentLoopData = $phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $phone1 = explode(' ', $phone->value);
                                                    $phone2 = $phone1[0]. ' ' .$phone1[1].' <span>'.implode(' ',array_diff($phone1, [$phone1[0],$phone1[1]])).'</span>';
                                                ?>
                                                <?php if(!$phone->is_main): ?>
                                                    <li class=" ">
                                                        <a href="<?php echo e($phone->link); ?>" style="" class="dropdown-toggle phone">
                                                            <i class="icon-phone"><img src="<?php echo e(Voyager::image($phone->icon)); ?>" alt="Topol.kz - контакты"></i><?php echo $phone2; ?>

                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <a href="#" class="btn-darkgreen callback-btn" data-toggle="modal"
                               data-target="#callbackModal" data-page="Кнопка в шапке"><?php echo app('translator')->get('general.callbackBtn'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mob-fixed-menu">
        <div class="hamburger menu-btn" id="nav-hamb">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div id="nav-mobile">
            <div class="menu-content">
                <div class="search input-group col-6" data-ng-controller="SearchController as sc">
                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('general.searchPlaceholder'); ?>" data-ng-model="searchInput"
                           aria-label="<?php echo app('translator')->get('general.searchPlaceholder'); ?>" aria-describedby="button-addon3">
                    <div class="input-group-append">
                        <button class="btn" type="button" id="button-addon3" data-ng-click="sc.searchByInput(searchInput)"><?php echo app('translator')->get('general.search'); ?></button>
                    </div>
                    <div class="search-results">
                        <ul data-ng-if="sc.searchItems.length > 0">
                            <li data-ng-repeat="item in sc.searchItems track by $index"><a href="#" data-ng-href="{{item.full_link}}">{{item.item}}: <span>{{item.name}}</span></a></li>
                        </ul>
                        <p data-ng-if="sc.searchItems.length <= 0"><?php echo app('translator')->get('general.noSearchResults'); ?></p>
                        <a data-ng-if="sc.searchItems.length > 0" href="#" data-ng-click="sc.openSearchPage(searchInput)" class="text-link"><?php echo app('translator')->get('general.showAllSearchResults'); ?></a>
                        <span class="close" data-ng-click="sc.closeResults()">&times;</span>
                    </div>
                </div>
                <?php echo e(menu('header_menu','vendor.voyager.menu.default-m',['isParent' => true])); ?>

                <div class="btm-content">
                    <a href="<?php echo e($phones->where('is_main',true)->first()->link); ?>" class="phone"> <i class="icon-phone"><img src="<?php echo e(Voyager::image($phones->where('is_main',true)->first()->icon)); ?>" alt="Topol.kz - контакты"></i><?php echo e($phones->where('is_main',true)->first()->value); ?></a>
                    <a href="<?php echo e($phones->where('is_main',false)->first()->link); ?>" class="phone"> <i class="icon-phone whatsapp"><img src="<?php echo e(Voyager::image($phones->where('is_main',false)->first()->icon)); ?>" alt="Topol.kz - контакты"></i><?php echo e($phones->where('is_main',false)->first()->value); ?></a>

                    <ul class="lang">
                        <li class="<?php if($locale == 'ru'): ?> active <?php endif; ?>"><a
                                    href="<?php echo e(route('locale.set','ru')); ?>">RUS</a></li>
                        <li class="sep">|</li>
                        <li class="<?php if($locale == 'kz'): ?> active <?php endif; ?>"><a
                                    href="<?php echo e(route('locale.set','kz')); ?>">KAZ</a></li>
                        <li class="sep">|</li>
                        <li class="<?php if($locale == 'en'): ?> active <?php endif; ?>"><a
                                    href="<?php echo e(route('locale.set','en')); ?>">ENG</a></li>
                    </ul>
                    <ul class="socials">
                        <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="social <?php echo e($social->name); ?> icon-w"><a href="<?php echo e($social->link); ?>" target="_blank"><img src="<?php echo e(Voyager::image($social->icon)); ?>"
                                                                                                         alt="<?php echo e($social->value); ?>"></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <p><?php echo app('translator')->get('general.orderText'); ?></p>
                    <a href="#" class="btn-darkgreen" data-toggle="modal" data-target="#callbackModal"
                       data-page="Кнопка в шапке"><?php echo app('translator')->get('general.callbackBtn'); ?></a>
                </div>
            </div>
        </div>
        <a href="<?php echo e(route('pages.home')); ?>" class="logo">
            <img src="<?php echo e(Voyager::image(setting('site.logo'))); ?>" alt="<?php echo app('translator')->get('general.siteName'); ?>">
            <img class="opened" src="<?php echo e(Voyager::image(setting('site.logo_w'))); ?>" alt="<?php echo app('translator')->get('general.siteName'); ?>">
        </a>
        <div class="phones">
            <a href="<?php echo e($phones->where('is_main',false)->first()->link); ?>" class="phone whatsapp"><i class="icon-phone"><img src="<?php echo e(Voyager::image($phones->where('is_main',false)->first()->icon)); ?>"
                                                                                                                  alt="Topol.kz - контакты"></i></a>
            <a href="<?php echo e($phones->where('is_main',true)->first()->link); ?>" class="phone"><i class="icon-phone"><img src="<?php echo e(Voyager::image($phones->where('is_main',true)->first()->icon)); ?>"
                                                                                                                 alt="Topol.kz - контакты"></i></a>
        </div>
    </div>
</header><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/partials/header.blade.php ENDPATH**/ ?>