<?php $__env->startSection('title',($seoTitle ? $seoTitle : __('general.contacts'))); ?>
<?php $__env->startSection('seo_title', ($seoTitle ? $seoTitle : __('general.contacts'))); ?>
<?php $__env->startSection('meta_keywords', $keywords); ?>
<?php $__env->startSection('meta_description', $description); ?>
<?php $__env->startSection('image',env('APP_URL').'/images/og.jpg'); ?>
<?php $__env->startSection('url',url()->current()); ?>
<?php $__env->startSection('page_class','contacts-page'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page contacts-page">
        <div class="content-nosidebar">
            <div class="content col-12">
                <h1><?php echo e(__('general.contacts')); ?></h1>
                <?php echo $__env->make('partials.breadcrumbs',['title'=>__('general.contacts')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="page-content">
                    <div class="maps">
                        <nav>
                            <div class="nav nav-tabs align-items-end" id="nav-page-mapsTab" role="tablist">
                                <?php $__currentLoopData = $filials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$filial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="nav-item nav-link <?php echo e($key == 0 ? 'active' : ''); ?>"
                                       id="nav-page-office-<?php echo e($key); ?>-tab"
                                       data-toggle="tab"
                                       href="#nav-page-office-<?php echo e($key); ?>" role="tab"
                                       aria-controls="nav-page-office-<?php echo e($key); ?>"
                                       aria-selected="<?php echo e($key == 0 ? 'true' : 'false'); ?>"><?php echo e($filial->getTranslatedAttribute('name',$locale,$fallbackLocale)); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-mapsContentPage">
                            <?php $__currentLoopData = $filials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$filial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php echo e($key == 0 ? 'show active' : ''); ?>"
                                     id="nav-page-office-<?php echo e($key); ?>" role="tabpanel"
                                     aria-labelledby="nav-page-office-<?php echo e($key); ?>-tab">
                                    <div class="contacts-content">
                                        <div class="map" id="map-page-<?php echo e($key); ?>"
                                             data-coordinates="<?php echo e($filial->map->value); ?>">
                                            <p class="text"><?php echo e($filial->address); ?>

                                                <?php echo app('translator')->get('general.phone'); ?> <?php echo e($filial->phones->first()->value); ?>;
                                                <?php echo app('translator')->get('general.fax'); ?> <?php echo e($filial->fax->value); ?>

                                                <?php echo app('translator')->get('general.schedule'); ?> <?php echo e($filial->graph); ?></p>
                                        </div>
                                        <div class="info">
                                            <ul>
                                                <li>
                                                    <span><?php echo app('translator')->get('general.schedule'); ?></span>
                                                    <p><?php echo e($filial->graph); ?></p>
                                                </li>
                                                <li>
                                                    <span><?php echo app('translator')->get('general.phoneFull'); ?></span>
                                                    <p>
                                                        <a href="<?php echo e($filial->phones->first()->link); ?>"><?php echo e($filial->phones->first()->value); ?></a>
                                                    </p>
                                                </li>
                                                <li>
                                                    <span><?php echo app('translator')->get('general.fax'); ?></span>
                                                    <p><a href="<?php echo e($filial->fax->link); ?>"><?php echo e($filial->fax->value); ?></a></p>
                                                </li>
                                                <li>
                                                    <span>E-mail:</span>
                                                    <p><a href="<?php echo e($filial->email->link); ?>"><?php echo e($filial->email->value); ?></a>
                                                    </p>
                                                </li>
                                                <li>
                                                    <span><?php echo app('translator')->get('general.address'); ?></span>
                                                    <p><?php echo e($filial->address); ?></p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="feedback">
                        <form action="<?php echo e(route('feedback.inline')); ?>">
                            <input type="text" name="name" class="form-control" required
                                   placeholder="<?php echo app('translator')->get('general.namePlaceholder'); ?>"
                                   autocomplete="off">
                            <input type="tel" name="phone" class="form-control" required
                                   placeholder="<?php echo app('translator')->get('general.phonePlaceholder'); ?>"
                                   autocomplete="off">
                            <div class="submission">
                                <div class="checker">
                                    <label class="checkbox-check">
                                        <input type="checkbox" name="agreement" checked required>
                                        <span class="checkmark"></span>
                                        <span><?php echo app('translator')->get('general.termsAgree'); ?> <a
                                                href="<?php echo e(route('page.terms')); ?>"><?php echo app('translator')->get('general.more'); ?></a></span>
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="page" value="Контакты">
                            <input type="hidden" name="pageLink" value="<?php echo e(\Request::url()); ?>">
                            <?php echo e(csrf_field()); ?>

                            <?php echo htmlFormSnippet(); ?>

                            <button type="submit" class="btn"><?php echo app('translator')->get('general.sendRequestButton'); ?></button>
                        </form>
                        <div class="text">
                            <?php echo setting('site.formText_'.$locale); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/pages/contacts.blade.php ENDPATH**/ ?>