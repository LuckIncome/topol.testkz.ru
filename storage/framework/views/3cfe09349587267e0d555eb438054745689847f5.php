<footer class="<?php echo $__env->yieldContent('page_class'); ?>">
    <div class="container">
        <div class="row">
            <div class="info-block col-5">
                <a href="<?php echo e(route('pages.home')); ?>" class="logo"><img src="<?php echo e(Voyager::image(setting('site.logo'))); ?>"
                                                                    alt="<?php echo app('translator')->get('general.siteName'); ?>"></a>
                <div class="menu">
                    <?php $__currentLoopData = $categoriesFooter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="<?php if($category->slug == 'katalog-produkcii'): ?> col-5 <?php else: ?> col-7 <?php endif; ?> cat">
                            <a href="<?php echo e($category->link); ?>"
                               class="strong"><?php echo e($category->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?></a>
                            <ul>
                                <?php if($category->categories->count()): ?>
                                    <?php $__currentLoopData = $category->categories->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e($item->link); ?>"><?php echo e($item->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <?php $__currentLoopData = $servicesFooter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(route('catalog.show',[$category,$service->slug])); ?>"><?php echo e($service->getTranslatedAttribute('title',$locale,$fallbackLocale)); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="pages">
                    <ul>
                        <li><a href="<?php echo e(route('pages.about')); ?>"><?php echo app('translator')->get('general.pageAbout'); ?></a></li>
                        <li><a href="<?php echo e(route('posts.index')); ?>"><?php echo app('translator')->get('general.pageNews'); ?></a></li>
                        <li><a href="<?php echo e(route('info.index')); ?>"><?php echo app('translator')->get('general.pageInfo'); ?></a></li>
                        <li><a href="<?php echo e(route('pages.contacts')); ?>"><?php echo app('translator')->get('general.contacts'); ?></a></li>
                    </ul>
                </div>
                <div class="contacts">
                    <?php $__currentLoopData = $footerPhones->where('is_main',true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($phone->link); ?>" class="phone"><i class="icon"><img
                                        src="<?php echo e(Voyager::image($phone->icon)); ?>"
                                        alt="Topol.kz - контакты"></i> <?php echo e($phone->value); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($email->link); ?>" class="mail"><i class="icon"><img src="<?php echo e(Voyager::image($email->icon)); ?>"
                                                                                 alt="Topol.kz - контакты"></i> <?php echo e($email->value); ?>

                    </a>
                    <?php $__currentLoopData = $footerPhones->where('is_main',false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($phone->link); ?>" class="whatsapp"><i class="icon"><img
                                        src="<?php echo e(Voyager::image($phone->icon)); ?>"
                                        alt="Topol.kz - контакты"></i> <?php echo e($phone->value); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="socials">
                        <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($social->link); ?>" target="_blank" class="item <?php echo e($social->name); ?>"><img
                                        src="<?php echo e(Voyager::image($social->icon)); ?>" alt="<?php echo e($social->value); ?>"></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <a href="<?php echo e(route('pages.home')); ?>" class="mob-logo"><img src="<?php echo e(Voyager::image(setting('site.logo'))); ?>"
                                                                    alt="<?php echo app('translator')->get('general.siteName'); ?>"></a>
            <div class="maps offset-1 col-6">
                <nav>
                    <div class="nav nav-tabs align-items-end" id="nav-mapsTab" role="tablist">
                        <?php $__currentLoopData = $filials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$filial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="nav-item nav-link <?php echo e($key == 0 ? 'active' : ''); ?>" id="nav-office-<?php echo e($key); ?>-tab"
                               data-toggle="tab"
                               href="#nav-office-<?php echo e($key); ?>" role="tab"
                               aria-controls="nav-office-<?php echo e($key); ?>"
                               aria-selected="<?php echo e($key == 0 ? 'true' : 'false'); ?>"><?php echo e($filial->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </nav>
                <div class="tab-content" id="nav-mapsContent">
                    <?php $__currentLoopData = $filials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$filial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tab-pane fade <?php echo e($key == 0 ? 'show active' : ''); ?>" id="nav-office-<?php echo e($key); ?>"
                             role="tabpanel"
                             aria-labelledby="nav-office-<?php echo e($key); ?>-tab">
                            <div class="map" id="map-<?php echo e($key); ?>" data-coordinates="<?php echo e($filial->map->value); ?>">
                                <p class="text"><?php echo e($filial->address); ?>

                                    <?php echo app('translator')->get('general.phone'); ?> <?php echo e($filial->phones->first()->value); ?>

                                    <?php echo app('translator')->get('general.fax'); ?> <?php echo e($filial->fax->value); ?>

                                    <?php echo app('translator')->get('general.schedule'); ?> <?php echo e($filial->graph); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="copyright">
                <p><?php echo e(setting('site.copyrights')); ?></p>
                <p><a href="<?php echo e(route('sitemap')); ?>"><?php echo app('translator')->get('general.sitemap'); ?></a></p>
                
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/partials/footer.blade.php ENDPATH**/ ?>