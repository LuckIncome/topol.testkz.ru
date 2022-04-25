<!DOCTYPE HTML>
<html>
<head>
    <title>Новая заявка с сайта</title>
</head>
<body>

<h1>Новая заявка с сайта</h1>
<br>
<p>Имя отправителя : <?php echo e($name); ?></p>
<p>Телефон : <?php echo e($phone); ?></p>
<?php if(isset($e_mail)): ?>
    <p>Email : <?php echo e($e_mail); ?></p>
<?php endif; ?>
<?php if(isset($comment)): ?>
    <p>Комментарии : <?php echo e($comment); ?></p>
<?php endif; ?>

<?php if(isset($page)): ?>
    <p>Со страницы : <?php echo e($page); ?></p>
<?php endif; ?>

<?php if(isset($pageLink)): ?>
    <p>Ссылка на страницу : <a href="<?php echo e($pageLink); ?>"><?php echo e($pageLink); ?></a></p>
<?php endif; ?>
</body>
</html><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/emails/callback.blade.php ENDPATH**/ ?>