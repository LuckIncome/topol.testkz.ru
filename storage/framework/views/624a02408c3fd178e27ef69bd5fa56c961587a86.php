<?php if(class_basename($dataTypeContent) == 'Category'): ?>
    
    <?php if(isset($options->relationship) && !method_exists( $dataType->model_name, \Illuminate\Support\Str::camel($row->field) ) ): ?>
        <p class="label label-warning"><i
                class="voyager-warning"></i> <?php echo e(__('voyager::form.field_select_dd_relationship', ['method' => \Illuminate\Support\Str::camel($row->field).'()', 'class' => $dataType->model_name])); ?>

        </p>
    <?php endif; ?>
    <?php if($dataTypeContent->id !== null): ?>
        <?php
            $dataTypeContent->{$row->field} = json_decode($dataTypeContent->{$row->field})
        ?>
        <select class="form-control select2" name="<?php echo e($row->field); ?>[]" multiple>
            <?php if(isset($options->relationship)): ?>
                

                <?php if( method_exists( $dataType->model_name, \Illuminate\Support\Str::camel($row->field) ) ): ?>
                    <?php $selected_values = isset($dataTypeContent) ? $dataTypeContent->{\Illuminate\Support\Str::camel($row->field)}() : []; ?>
                    <?php
                    $relationshipListMethod = \Illuminate\Support\Str::camel($row->field) . 'List';
                    if (isset($dataTypeContent) && method_exists($dataTypeContent, $relationshipListMethod)) {
                        $relationshipOptions = $dataTypeContent->$relationshipListMethod();
                    } else {
                        $relationshipClass = get_class(app($dataType->model_name)->{\Illuminate\Support\Str::camel($row->field)}()->getRelated());
                        $relationshipOptions = $relationshipClass::all();
                    }
                    ?>

                    <?php $__currentLoopData = $relationshipOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relationshipOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php if(is_object($relationshipOption)): ?>
                            <option value="<?php echo e($relationshipOption->{$options->relationship->key}); ?>"
                                    <?php if(in_array($relationshipOption->{$options->relationship->key}, $selected_values)): ?> selected="selected" <?php endif; ?>><?php echo e($relationshipOption->{$options->relationship->label}); ?></option>
                        <?php else: ?>
                            <option value="<?php echo e($relationshipOption[$options->relationship->key]); ?>"
                                    <?php if(in_array($relationshipOption[$options->relationship->key], $selected_values)): ?> selected="selected" <?php endif; ?>><?php echo e($relationshipOption[$options->relationship->label]); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php elseif(isset($options->options)): ?>
                <?php $__currentLoopData = $options->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $selected = ''; ?>
                    <?php if(is_array($dataTypeContent->{$row->field}) && in_array($key, $dataTypeContent->{$row->field})): ?>
                        <?php $selected = 'selected="selected"'; ?>
                    <?php elseif(!is_null(old($row->field)) && in_array($key, old($row->field))): ?>
                        <?php $selected = 'selected="selected"'; ?>
                    <?php endif; ?>
                    <option value="<?php echo e($key); ?>" <?php echo $selected; ?>>
                        <?php echo e($label); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
    <?php else: ?>
        <p class="label label-warning"><i
                class="voyager-warning"></i> Фильтры можно добавить после создания категории, при редактировании категории (Фильтры используют аттрибуты товаров данной категории)
        </p>
    <?php endif; ?>
<?php else: ?>
    
    <?php if(isset($options->relationship) && !method_exists( $dataType->model_name, \Illuminate\Support\Str::camel($row->field) ) ): ?>
        <p class="label label-warning"><i
                class="voyager-warning"></i> <?php echo e(__('voyager::form.field_select_dd_relationship', ['method' => \Illuminate\Support\Str::camel($row->field).'()', 'class' => $dataType->model_name])); ?>

        </p>
    <?php endif; ?>
    <?php
        $dataTypeContent->{$row->field} = json_decode($dataTypeContent->{$row->field})
    ?>
    <select class="form-control select2" name="<?php echo e($row->field); ?>[]" multiple>
        <?php if(isset($options->relationship)): ?>
            
            <?php if( method_exists( $dataType->model_name, \Illuminate\Support\Str::camel($row->field) ) ): ?>
                <?php $selected_values = isset($dataTypeContent) ? $dataTypeContent->{\Illuminate\Support\Str::camel($row->field)}()->pluck($options->relationship->key)->all() : []; ?>
                <?php
                $relationshipListMethod = \Illuminate\Support\Str::camel($row->field) . 'List';
                if (isset($dataTypeContent) && method_exists($dataTypeContent, $relationshipListMethod)) {
                    $relationshipOptions = $dataTypeContent->$relationshipListMethod();
                } else {
                    $relationshipClass = get_class(app($dataType->model_name)->{\Illuminate\Support\Str::camel($row->field)}()->getRelated());
                    $relationshipOptions = $relationshipClass::all();
                }
                ?>
                <?php $__currentLoopData = $relationshipOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relationshipOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($relationshipOption->{$options->relationship->key}); ?>"
                            <?php if(in_array($relationshipOption->{$options->relationship->key}, $selected_values)): ?> selected="selected" <?php endif; ?>><?php echo e($relationshipOption->{$options->relationship->label}); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php elseif(isset($options->options)): ?>
            <?php $__currentLoopData = $options->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $selected = ''; ?>
                <?php if(is_array($dataTypeContent->{$row->field}) && in_array($key, $dataTypeContent->{$row->field})): ?>
                    <?php $selected = 'selected="selected"'; ?>
                <?php elseif(!is_null(old($row->field)) && in_array($key, old($row->field))): ?>
                    <?php $selected = 'selected="selected"'; ?>
                <?php endif; ?>
                <option value="<?php echo e($key); ?>" <?php echo $selected; ?>>
                    <?php echo e($label); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </select>
<?php endif; ?>
<?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/vendor/voyager/formfields/select_multiple.blade.php ENDPATH**/ ?>