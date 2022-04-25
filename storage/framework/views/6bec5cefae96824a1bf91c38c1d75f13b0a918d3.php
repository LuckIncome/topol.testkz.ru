<div class="modal" id="callbackModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo app('translator')->get('general.callbackBtn'); ?></h5>
                <p><?php echo app('translator')->get('general.fillFormText'); ?></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L16 16M16 1L1 16" stroke="#AEAEAE" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('feedback.inline')); ?>" enctype="multipart/form-data">
                    <input type="text" name="name" class="form-control" required placeholder="<?php echo app('translator')->get('general.namePlaceholder'); ?> *"
                           autocomplete="off">
                    <input type="tel" name="phone" class="form-control" required placeholder="<?php echo app('translator')->get('general.phonePlaceholder'); ?> *"
                           autocomplete="off">
                    <input type="email" name="email" class="form-control" placeholder="Email"
                           autocomplete="off">
                    <div class="form-group">
                        <textarea name="comment" cols="30" rows="3" placeholder="<?php echo app('translator')->get('general.commentPlaceholder'); ?>"></textarea>
                    </div>
                    <div class="submission">
                        <div class="checker">
                            <label class="checkbox-check">
                                <input type="checkbox" name="agreement" checked required>
                                <span class="checkmark"></span>
                                <span><?php echo app('translator')->get('general.termsAgree'); ?> <a href="<?php echo e(route('page.terms')); ?>"><?php echo app('translator')->get('general.more'); ?></a></span>
                            </label>
                        </div>
                    </div>
                <?php echo e(csrf_field()); ?>

                    <?php echo htmlFormSnippet(); ?>

                    <input type="hidden" class="page-name" name="page" value="">
                    <input type="hidden" name="pageLink" value="<?php echo e(\Request::url()); ?>">
                    <button type="submit" class="btn"><?php echo app('translator')->get('general.sendRequestButton'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="consultationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo app('translator')->get('general.getConsultation'); ?></h5>
                <p><?php echo app('translator')->get('general.fillFormText'); ?></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L16 16M16 1L1 16" stroke="#AEAEAE" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('feedback.inline')); ?>" enctype="multipart/form-data">
                    <input type="text" name="name" class="form-control" required placeholder="<?php echo app('translator')->get('general.namePlaceholder'); ?> *"
                           autocomplete="off">
                    <input type="tel" name="phone" class="form-control" required placeholder="<?php echo app('translator')->get('general.phonePlaceholder'); ?> *"
                           autocomplete="off">
                    <input type="email" name="email" class="form-control" placeholder="Email"
                           autocomplete="off">
                    <div class="submission">
                        <div class="checker">
                            <label class="checkbox-check">
                                <input type="checkbox" name="agreement" checked required>
                                <span class="checkmark"></span>
                                <span><?php echo app('translator')->get('general.termsAgree'); ?> <a href="<?php echo e(route('page.terms')); ?>"><?php echo app('translator')->get('general.more'); ?></a></span>
                            </label>
                        </div>
                    </div>
                <?php echo e(csrf_field()); ?>

                    <input type="hidden" class="page-name" name="page" value="">
                    <input type="hidden" name="pageLink" value="<?php echo e(\Request::url()); ?>">
                    <button type="submit" class="btn"><?php echo app('translator')->get('general.sendRequestButton'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="successModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="/images/icons/success.png" alt="Успешно">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L16 16M16 1L1 16" stroke="#AEAEAE" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <h3><?php echo app('translator')->get('general.thanks'); ?></h3>
                <p><?php echo app('translator')->get('general.successText'); ?></p>
                <a href="/" class="callback-btn btn-dark"><?php echo app('translator')->get('general.returnHome'); ?></a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/partials/modals.blade.php ENDPATH**/ ?>