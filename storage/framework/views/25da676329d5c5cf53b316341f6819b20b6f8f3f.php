<?php if(isset($dataTypeContent->{$row->field})): ?>
    <br>
    <small><?php echo e(__('voyager::form.field_password_keep')); ?></small>
<?php endif; ?>
<input type="password"
       <?php if($row->required == 1 && !isset($dataTypeContent->{$row->field})): ?> required <?php endif; ?>
       class="form-control"
       name="<?php echo e($row->field); ?>"
       value="">
<?php /**PATH /var/www/vhosts/topol.kz/httpdocs/vendor/tcg/voyager/resources/views/formfields/password.blade.php ENDPATH**/ ?>