<?php $__env->startSection('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height: 100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }

        a.remove {
            margin-left: 10px;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>
    <h1 class="page-title">
        <i class="<?php echo e($dataType->icon); ?>"></i>
        <?php echo e(__('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular); ?>

    </h1>
    <?php echo $__env->make('voyager::multilingual.language-selector', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form"
              action="<?php if(isset($dataTypeContent->id)): ?><?php echo e(route('voyager.products.update', $dataTypeContent->id)); ?><?php else: ?><?php echo e(route('voyager.products.store')); ?><?php endif; ?>"
              method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            <?php if(isset($dataTypeContent->id)): ?>
                <?php echo e(method_field("PUT")); ?>

            <?php endif; ?>
            <?php echo e(csrf_field()); ?>


            <div class="row">
                <div class="col-md-8">
                    <!-- ### TITLE ### -->
                    <div class="panel">
                        <?php if(count($errors) > 0): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="voyager-character"></i> Название Товара
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?php echo $__env->make('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'name',
                                '_field_trans' => get_field_translations($dataTypeContent, 'name')
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="text" class="form-control" id="title" name="name"
                                   placeholder="Название товара"
                                   value="<?php if(isset($dataTypeContent->name)): ?><?php echo e($dataTypeContent->name); ?><?php endif; ?>">
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Основы товара</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <?php
                                    $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                                    $exclude = ['name', 'excerpt','description', 'image', 'slug', 'images', 'category_id','relateds','meta_description','meta_keywords','seo_title'];
                                ?>

                                <?php $__currentLoopData = $dataTypeRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!in_array($row->field, $exclude)): ?>
                                        <?php
                                            $display_options = isset($row->details->display) ? $row->details->display : NULL;
                                        ?>
                                        <?php if(isset($row->details->formfields_custom)): ?>
                                            <?php echo $__env->make('voyager::formfields.custom.' . $row->details->formfields_custom, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php else: ?>
                                            <div class="form-group <?php if($row->type == 'hidden'): ?> hidden <?php endif; ?> <?php if(isset($display_options->width)): ?><?php echo e('col-md-' . $display_options->width); ?><?php endif; ?>" <?php if(isset($display_options->id)): ?><?php echo e("id=$display_options->id"); ?><?php endif; ?>>
                                                <?php echo e($row->slugify); ?>

                                                <?php if($row->type !== 'relationship'): ?>
                                                    <label for="name"><?php echo e($row->display_name); ?></label>
                                                <?php endif; ?>
                                                <?php echo $__env->make('voyager::multilingual.input-hidden-bread-edit-add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php if($row->type == 'relationship'): ?>
                                                    <?php echo $__env->make('voyager::formfields.relationship', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php else: ?>
                                                    <?php echo app('voyager')->formField($row, $dataType, $dataTypeContent); ?>

                                                <?php endif; ?>

                                                <?php $__currentLoopData = app('voyager')->afterFormFields($row, $dataType, $dataTypeContent); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $after): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo $after->handle($row, $dataType, $dataTypeContent); ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                        </div>
                    </div>
                    
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Особенности и функции товара
                                <span class="panel-desc">Что включает, Приемущества и т.д)</span></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <div id="featuresGroupRu" class="panel-body">
                            <?php if($dataTypeContent->featuresRu): ?>
                                <?php $__currentLoopData = $dataTypeContent->featuresRu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $char): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group new_feature<?php echo e(($key > 0)?$key:null); ?>">
                                        <label>
                                            <span class="panel-desc">Группа (Например : Приемущества)</span>
                                            <input type="text" class="form-control"
                                                   name="featureRu_group<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="Группа" value="<?php echo e($char['group']); ?>">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Название</span>
                                            <input type="text" class="form-control"
                                                   name="featureRu_name<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="Габариты" value="<?php echo e($char['name']); ?>">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Значение</span>
                                            <input type="text" class="form-control"
                                                   name="featureRu_value<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="30х50х20" value="<?php echo e($char['value']); ?>">
                                        </label>
                                        <a class="remove">&times;</a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <div id="featuresGroupKz" class="panel-body">
                            <?php if($dataTypeContent->featuresKz): ?>
                                <?php $__currentLoopData = $dataTypeContent->featuresKz; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $char): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group new_feature<?php echo e(($key > 0)?$key:null); ?>">
                                        <label>
                                            <span class="panel-desc">Группа (Например : Приемущества)</span>
                                            <input type="text" class="form-control"
                                                   name="featureKz_group<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="Группа" value="<?php echo e($char['group']); ?>">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Название</span>
                                            <input type="text" class="form-control"
                                                   name="featureKz_name<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="Габариты" value="<?php echo e($char['name']); ?>">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Значение</span>
                                            <input type="text" class="form-control"
                                                   name="featureKz_value<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="30х50х20" value="<?php echo e($char['value']); ?>">
                                        </label>
                                        <a class="remove">&times;</a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <div id="featuresGroupEn" class="panel-body">
                            <?php if($dataTypeContent->featuresEn): ?>
                                <?php $__currentLoopData = $dataTypeContent->featuresEn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $char): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group new_feature<?php echo e(($key > 0)?$key:null); ?>">
                                        <label>
                                            <span class="panel-desc">Группа (Например : Приемущества)</span>
                                            <input type="text" class="form-control"
                                                   name="featureEn_group<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="Группа" value="<?php echo e($char['group']); ?>">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Название</span>
                                            <input type="text" class="form-control"
                                                   name="featureEn_name<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="Габариты" value="<?php echo e($char['name']); ?>">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Значение</span>
                                            <input type="text" class="form-control"
                                                   name="featureEn_value<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="30х50х20" value="<?php echo e($char['value']); ?>">
                                        </label>
                                        <a class="remove">&times;</a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="panel-body">
                            <input class="btn btn-primary" type='button' value='Добавить' id='addFeatureRuButton'>
                            <input class="btn btn-primary" type='button' value='Добавить' id='addFeatureKzButton'>
                            <input class="btn btn-primary" type='button' value='Добавить' id='addFeatureEnButton'>
                        </div>
                    </div>

                    
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Основные характеристики товара
                                <span class="panel-desc">(Радиус действия, Габариты и т.д)</span></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <div id="characteristicGroupRu" class="panel-body">
                            <?php if($dataTypeContent->charsRu): ?>
                                <?php $__currentLoopData = $dataTypeContent->charsRu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $char): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group new_char<?php echo e(($key > 0)?$key:null); ?>">
                                        <label>
                                            <span class="panel-desc">Название</span>
                                            <input type="text" class="form-control"
                                                   name="charRu<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="Габариты" value="<?php echo e($char['name']); ?>">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Значение</span>
                                            <input type="text" class="form-control"
                                                   name="charRu_value<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="30х50х20" value="<?php echo e($char['value']); ?>">
                                        </label>
                                        <a class="remove">&times;</a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <div id="characteristicGroupKz" class="panel-body">
                            <?php if($dataTypeContent->charsKz): ?>
                                <?php $__currentLoopData = $dataTypeContent->charsKz; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $char): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group new_char<?php echo e(($key > 0)?$key:null); ?>">
                                        <label>
                                            <span class="panel-desc">Название</span>
                                            <input type="text" class="form-control"
                                                   name="charKz<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="Габариты" value="<?php echo e($char['name']); ?>">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Значение</span>
                                            <input type="text" class="form-control"
                                                   name="charKz_value<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="30х50х20" value="<?php echo e($char['value']); ?>">
                                        </label>
                                        <a class="remove">&times;</a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <div id="characteristicGroupEn" class="panel-body">
                            <?php if($dataTypeContent->charsEn): ?>
                                <?php $__currentLoopData = $dataTypeContent->charsEn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $char): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group new_char<?php echo e(($key > 0)?$key:null); ?>">
                                        <label>
                                            <span class="panel-desc">Название</span>
                                            <input type="text" class="form-control"
                                                   name="charEn<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="Габариты" value="<?php echo e($char['name']); ?>">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Значение</span>
                                            <input type="text" class="form-control"
                                                   name="charEn_value<?php echo e(($key > 0)?$key:null); ?>"
                                                   placeholder="30х50х20" value="<?php echo e($char['value']); ?>">
                                        </label>
                                        <a class="remove">&times;</a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="panel-body">
                            <input class="btn btn-primary" type='button' value='Добавить' id='addCharRuButton'>
                            <input class="btn btn-primary" type='button' value='Добавить' id='addCharKzButton'>
                            <input class="btn btn-primary" type='button' value='Добавить' id='addCharEnButton'>
                        </div>
                    </div>

                    <!-- ### CONTENT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Краткое Описание</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen"
                                   aria-hidden="true"></a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <?php echo $__env->make('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'excerpt',
                                '_field_trans' => get_field_translations($dataTypeContent, 'excerpt')
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php
                                $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                                $row = $dataTypeRows->where('field', 'excerpt')->first();

                            ?>
                            <?php echo app('voyager')->formField($row, $dataType, $dataTypeContent); ?>

                        </div>
                    </div><!-- .panel -->

                    <!-- ### CONTENT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Описание</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen"
                                   aria-hidden="true"></a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <?php echo $__env->make('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'description',
                                '_field_trans' => get_field_translations($dataTypeContent, 'description')
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php
                                $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                                $row = $dataTypeRows->where('field', 'description')->first();

                            ?>
                            <?php echo app('voyager')->formField($row, $dataType, $dataTypeContent); ?>

                        </div>
                    </div><!-- .panel -->

                </div>
                <div class="col-md-4">
                    <!-- ### DETAILS ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-clipboard"></i> Детали товара
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="slug">ЧПУ ссылка</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       placeholder="slug"
                                       <?php echo isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug"); ?>

                                       value="<?php if(isset($dataTypeContent->slug)): ?><?php echo e($dataTypeContent->slug); ?><?php endif; ?>">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Категория</label>
                                <select class="form-control" name="category_id">
                                    <?php $__currentLoopData = TCG\Voyager\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"
                                                <?php if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id): ?> selected="selected"<?php endif; ?>><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- ### IMAGE ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-image"></i> Изображение</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?php if(isset($dataTypeContent->image)): ?>
                                <img src="<?php echo e(filter_var($dataTypeContent->image, FILTER_VALIDATE_URL) ? $dataTypeContent->image : Voyager::image( $dataTypeContent->image )); ?>"
                                     style="width:50%"/>
                            <?php endif; ?>
                            <input type="file" name="image">
                        </div>
                    </div>

                    
                    
                        
                            
                            
                                
                                   
                            
                        
                        
                            
                                
                                    
                                         
                                
                            
                            
                        
                    
                    <!-- ### Variations ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-image"></i> Вариативные товары</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body" style="overflow: visible;">
                            <select name="relateds[]" id="variations" multiple>
                                <option value="null"></option>
                                <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($variant->id); ?>"
                                            <?php if($dataTypeContent->relateds && in_array($variant->id,unserialize($dataTypeContent->relateds))): ?> selected <?php endif; ?>><?php echo e($variant->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <!-- ### Metas ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-image"></i> Meta Данные</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body" style="overflow: visible;">
                            <?php echo $__env->make('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'meta_keywords',
                                '_field_trans' => get_field_translations($dataTypeContent, 'meta_keywords')
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php
                                $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                                $includes = ['meta_description','meta_keywords','seo_title'];
                            ?>

                            <?php $__currentLoopData = $dataTypeRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(in_array($row->field, $includes)): ?>
                                    <?php
                                        $display_options = isset($row->details->display) ? $row->details->display : NULL;
                                    ?>
                                    <?php if(isset($row->details->formfields_custom)): ?>
                                        <?php echo $__env->make('voyager::formfields.custom.' . $row->details->formfields_custom, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php else: ?>
                                        <div class="form-group <?php if($row->type == 'hidden'): ?> hidden <?php endif; ?> <?php if(isset($display_options->width)): ?><?php echo e('col-md-' . $display_options->width); ?><?php endif; ?>" <?php if(isset($display_options->id)): ?><?php echo e("id=$display_options->id"); ?><?php endif; ?>>
                                            <?php echo e($row->slugify); ?>

                                            <?php if($row->type !== 'relationship'): ?>
                                                <label for="name"><?php echo e($row->display_name); ?></label>
                                            <?php endif; ?>
                                            <?php echo $__env->make('voyager::multilingual.input-hidden-bread-edit-add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php if($row->type == 'relationship'): ?>
                                                <?php echo $__env->make('voyager::formfields.relationship', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php else: ?>
                                                <?php echo app('voyager')->formField($row, $dataType, $dataTypeContent); ?>

                                            <?php endif; ?>

                                            <?php $__currentLoopData = app('voyager')->afterFormFields($row, $dataType, $dataTypeContent); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $after): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo $after->handle($row, $dataType, $dataTypeContent); ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">
                <?php if(isset($dataTypeContent->id)): ?>Обновить <?php else: ?> <i
                        class="icon wb-plus-circle"></i> Создать <?php endif; ?>
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="<?php echo e(route('voyager.upload')); ?>" target="form_target" method="post"
              enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            <?php echo e(csrf_field()); ?>

            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="<?php echo e($dataType->slug); ?>">
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        $('document').ready(function () {
            $('#slug').slugify();

            <?php if($isModelTranslatable): ?>
            $('.side-body').multilingual({"editing": true});
                    <?php endif; ?>

            runChars();
            runFeatures();

            new SlimSelect({
                select: '#variations'
            })
        });

        function runChars() {
            $('#characteristicGroupKz').hide();
            $('#characteristicGroupEn').hide();
            $('#characteristicGroupRu').show();
            $('#addCharRuButton').show();
            $('#addCharKzButton').hide();
            $('#addCharEnButton').hide();

            $('.language-selector').find('input[type=radio]').change(function () {
                var locale = $(this).attr('id');
                if (locale == 'ru') {
                    $('#characteristicGroupKz').hide();
                    $('#addCharKzButton').hide();
                    $('#characteristicGroupEn').hide();
                    $('#addCharEnButton').hide();
                    $('#characteristicGroupRu').show();
                    $('#addCharRuButton').show();

                } else if (locale == 'kz'){
                    $('#characteristicGroupKz').show();
                    $('#addCharKzButton').show();
                    $('#characteristicGroupRu').hide();
                    $('#characteristicGroupEn').hide();
                    $('#addCharRuButton').hide();
                    $('#addCharEnButton').hide();
                }else {
                    $('#characteristicGroupKz').hide();
                    $('#addCharKzButton').hide();
                    $('#characteristicGroupRu').hide();
                    $('#characteristicGroupEn').show();
                    $('#addCharRuButton').hide();
                    $('#addCharEnButton').show();
                }
            });

            /*CharacteristicsRU add remove dynamic start*/
            var counterCharRu = 1;
            <?php if($dataTypeContent->charsRu && count($dataTypeContent->charsRu)): ?>
                counterCharRu = <?php echo e(count($dataTypeContent->charsRu)); ?> +1;
            <?php endif; ?>

            $("#addCharRuButton").click(function () {

                if (counterCharRu > 50) {
                    alert("Не более 50 характеристик");
                    return false;
                }

                var newTextBoxDiv = $(document.createElement('div'))
                    .attr("class", 'form-group new_char' + counterCharRu);

                newTextBoxDiv.after().html('<label><span class="panel-desc">Название #' + counterCharRu + '</span>' +
                    '<input type="text" class="form-control" name="charRu' + counterCharRu +
                    '" value=""></label>' + '<label><span class="panel-desc">Значение #' + counterCharRu + '</span>' +
                    '<input type="text" class="form-control" name="charRu_value' + counterCharRu +
                    '" value=""></label><a class="remove">&times;</a>');
                newTextBoxDiv.appendTo("#characteristicGroupRu");
                counterCharRu++;
            });

            $(".remove").click(function () {
                if (counterCharRu == 1) {
                    alert("No more textbox to remove");
                    return false;
                }
                counterCharRu--;
                $(this).parent().remove();
            });

            $("#characteristicGroupRu").on("click", ".remove", function (e) { //user click on remove text links
                e.preventDefault();
                $(this).parent('div').remove();
                counterCharRu--;
            });
            /*CharacteristicsRU add remove dynamic end*/


            /*CharacteristicsKZ add remove dynamic start*/
            var counterCharKz = 1;
            <?php if($dataTypeContent->charsKz && count($dataTypeContent->charsKz)): ?>
                counterCharKz = <?php echo e(count($dataTypeContent->charsKz)); ?> +1;
            <?php endif; ?>

            $("#addCharKzButton").click(function () {

                if (counterCharKz > 50) {
                    alert("Не более 50 характеристик");
                    return false;
                }

                var newTextBoxDiv = $(document.createElement('div'))
                    .attr("class", 'form-group new_char' + counterCharKz);

                newTextBoxDiv.after().html('<label><span class="panel-desc">Название #' + counterCharKz + '</span>' +
                    '<input type="text" class="form-control" name="charKz' + counterCharKz +
                    '" value=""></label>' + '<label><span class="panel-desc">Значение #' + counterCharKz + '</span>' +
                    '<input type="text" class="form-control" name="charKz_value' + counterCharKz +
                    '" value=""></label><a class="remove">&times;</a>');
                newTextBoxDiv.appendTo("#characteristicGroupKz");
                counterCharKz++;
            });

            $(".remove").click(function () {
                if (counterCharKz == 1) {
                    alert("No more textbox to remove");
                    return false;
                }
                counterCharKz--;
                $(this).parent().remove();
            });

            $("#characteristicGroupKz").on("click", ".remove", function (e) { //user click on remove text links
                e.preventDefault();
                $(this).parent('div').remove();
                counterCharKz--;
            });
            /*CharacteristicsKz add remove dynamic end*/


            /*CharacteristicsEN add remove dynamic start*/
            var counterCharEn = 1;
            <?php if($dataTypeContent->charsEn && count($dataTypeContent->charsEn)): ?>
                counterCharEn = <?php echo e(count($dataTypeContent->charsEn)); ?> +1;
            <?php endif; ?>

            $("#addCharEnButton").click(function () {

                if (counterCharEn > 50) {
                    alert("Не более 50 характеристик");
                    return false;
                }

                var newTextBoxDiv = $(document.createElement('div'))
                    .attr("class", 'form-group new_char' + counterCharEn);

                newTextBoxDiv.after().html('<label><span class="panel-desc">Название #' + counterCharEn + '</span>' +
                    '<input type="text" class="form-control" name="charEn' + counterCharEn +
                    '" value=""></label>' + '<label><span class="panel-desc">Значение #' + counterCharEn + '</span>' +
                    '<input type="text" class="form-control" name="charEn_value' + counterCharEn +
                    '" value=""></label><a class="remove">&times;</a>');
                newTextBoxDiv.appendTo("#characteristicGroupEn");
                counterCharEn++;
            });

            $(".remove").click(function () {
                if (counterCharEn == 1) {
                    alert("No more textbox to remove");
                    return false;
                }
                counterCharEn--;
                $(this).parent().remove();
            });

            $("#characteristicGroupEn").on("click", ".remove", function (e) { //user click on remove text links
                e.preventDefault();
                $(this).parent('div').remove();
                counterCharEn--;
            });
            /*CharacteristicsKz add remove dynamic end*/
        }

        function runFeatures() {
            $('#featuresGroupKz').hide();
            $('#featuresGroupEn').hide();
            $('#featuresGroupRu').show();
            $('#addFeatureRuButton').show();
            $('#addFeatureKzButton').hide();
            $('#addFeatureEnButton').hide();

            $('.language-selector').find('input[type=radio]').change(function () {
                var locale = $(this).attr('id');
                if (locale == 'ru') {
                    $('#featuresGroupKz').hide();
                    $('#featuresGroupEn').hide();
                    $('#featuresGroupRu').show();
                    $('#addFeatureKzButton').hide();
                    $('#addFeatureEnButton').hide();
                    $('#addFeatureRuButton').show();

                } else if (locale == 'kz'){
                    $('#featuresGroupKz').show();
                    $('#featuresGroupEn').hide();
                    $('#featuresGroupRu').hide();
                    $('#addFeatureKzButton').show();
                    $('#addFeatureEnButton').hide();
                    $('#addFeatureRuButton').hide();
                }else {
                    $('#featuresGroupKz').hide();
                    $('#featuresGroupEn').show();
                    $('#featuresGroupRu').hide();
                    $('#addFeatureKzButton').hide();
                    $('#addFeatureEnButton').show();
                    $('#addFeatureRuButton').hide();
                }
            });

            /*FeautersRU add remove dynamic start*/
            var counterFeatureRu = 1;
            <?php if($dataTypeContent->featuresRu && count($dataTypeContent->featuresRu)): ?>
                counterFeatureRu = <?php echo e(count($dataTypeContent->featuresRu)); ?> +1;
            <?php endif; ?>

            $("#addFeatureRuButton").click(function () {

                if (counterFeatureRu > 50) {
                    alert("Не более 50 характеристик");
                    return false;
                }

                var newTextBoxDiv = $(document.createElement('div'))
                    .attr("class", 'form-group new_feature' + counterFeatureRu);

                newTextBoxDiv.after().html('<label><span class="panel-desc">Группа #' + counterFeatureRu + '</span>' +
                    '<input type="text" class="form-control" name="featureRu_group' + counterFeatureRu +
                    '" value=""></label>'+'<label><span class="panel-desc">Название #' + counterFeatureRu + '</span>' +
                    '<input type="text" class="form-control" name="featureRu_name' + counterFeatureRu +
                    '" value=""></label>' + '<label><span class="panel-desc">Значение #' + counterFeatureRu + '</span>' +
                    '<input type="text" class="form-control" name="featureRu_value' + counterFeatureRu +
                    '" value=""></label><a class="remove">&times;</a>');
                newTextBoxDiv.appendTo("#featuresGroupRu");
                counterFeatureRu++;
            });

            $(".remove").click(function () {
                if (counterFeatureRu == 1) {
                    alert("No more textbox to remove");
                    return false;
                }
                counterFeatureRu--;
                $(this).parent().remove();
            });

            $("#featuresGroupRu").on("click", ".remove", function (e) { //user click on remove text links
                e.preventDefault();
                $(this).parent('div').remove();
                counterFeatureRu--;
            });
            /*CharacteristicsRU add remove dynamic end*/


            /*CharacteristicsKZ add remove dynamic start*/
            var counterFeatureKz = 1;
            <?php if($dataTypeContent->featuresKz && count($dataTypeContent->featuresKz)): ?>
                counterFeatureKz = <?php echo e(count($dataTypeContent->featuresKz)); ?> +1;
            <?php endif; ?>

            $("#addFeatureKzButton").click(function () {

                if (counterFeatureKz > 50) {
                    alert("Не более 50 характеристик");
                    return false;
                }

                var newTextBoxDiv = $(document.createElement('div'))
                    .attr("class", 'form-group new_feature' + counterFeatureKz);

                newTextBoxDiv.after().html('<label><span class="panel-desc">Группа #' + counterFeatureKz + '</span>' +
                    '<input type="text" class="form-control" name="featureKz_group' + counterFeatureKz +
                    '" value=""></label>'+'<label><span class="panel-desc">Название #' + counterFeatureKz + '</span>' +
                    '<input type="text" class="form-control" name="featureKz_name' + counterFeatureKz +
                    '" value=""></label>' + '<label><span class="panel-desc">Значение #' + counterFeatureKz + '</span>' +
                    '<input type="text" class="form-control" name="featureKz_value' + counterFeatureKz +
                    '" value=""></label><a class="remove">&times;</a>');
                newTextBoxDiv.appendTo("#featuresGroupKz");
                counterFeatureKz++;
            });

            $(".remove").click(function () {
                if (counterFeatureKz == 1) {
                    alert("No more textbox to remove");
                    return false;
                }
                counterFeatureKz--;
                $(this).parent().remove();
            });

            $("#featuresGroupKz").on("click", ".remove", function (e) { //user click on remove text links
                e.preventDefault();
                $(this).parent('div').remove();
                counterFeatureKz--;
            });
            /*CharacteristicsKz add remove dynamic end*/


            /*CharacteristicsEN add remove dynamic start*/
            var counterFeatureEn = 1;
            <?php if($dataTypeContent->featuresEn && count($dataTypeContent->featuresEn)): ?>
                counterFeatureEn = <?php echo e(count($dataTypeContent->featuresEn)); ?> +1;
            <?php endif; ?>

            $("#addFeatureEnButton").click(function () {

                if (counterFeatureEn > 50) {
                    alert("Не более 50 характеристик");
                    return false;
                }

                var newTextBoxDiv = $(document.createElement('div'))
                    .attr("class", 'form-group new_feature' + counterFeatureEn);

                newTextBoxDiv.after().html('<label><span class="panel-desc">Группа #' + counterFeatureEn + '</span>' +
                    '<input type="text" class="form-control" name="featureEn_group' + counterFeatureEn +
                    '" value=""></label>'+'<label><span class="panel-desc">Название #' + counterFeatureEn + '</span>' +
                    '<input type="text" class="form-control" name="featureEn_name' + counterFeatureEn +
                    '" value=""></label>' + '<label><span class="panel-desc">Значение #' + counterFeatureEn + '</span>' +
                    '<input type="text" class="form-control" name="featureEn_value' + counterFeatureEn +
                    '" value=""></label><a class="remove">&times;</a>');
                newTextBoxDiv.appendTo("#featuresGroupEn");
                counterFeatureEn++;
            });

            $(".remove").click(function () {
                if (counterFeatureEn == 1) {
                    alert("No more textbox to remove");
                    return false;
                }
                counterFeatureEn--;
                $(this).parent().remove();
            });

            $("#featuresGroupEn").on("click", ".remove", function (e) { //user click on remove text links
                e.preventDefault();
                $(this).parent('div').remove();
                counterFeatureEn--;
            });
            /*CharacteristicsKz add remove dynamic end*/
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('voyager::master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/topol.kz/httpdocs/resources/views/vendor/voyager/products/edit-add.blade.php ENDPATH**/ ?>