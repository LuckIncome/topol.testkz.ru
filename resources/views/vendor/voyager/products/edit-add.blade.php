@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('css')
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
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form"
              action="@if(isset($dataTypeContent->id)){{ route('voyager.products.update', $dataTypeContent->id) }}@else{{ route('voyager.products.store') }}@endif"
              method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <!-- ### TITLE ### -->
                    <div class="panel">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

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
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'name',
                                '_field_trans' => get_field_translations($dataTypeContent, 'name')
                            ])
                            <input type="text" class="form-control" id="title" name="name"
                                   placeholder="Название товара"
                                   value="@if(isset($dataTypeContent->name)){{ $dataTypeContent->name }}@endif">
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
                                @php
                                    $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                                    $exclude = ['name', 'excerpt','description', 'image', 'slug', 'images', 'category_id','relateds','meta_description','meta_keywords','seo_title'];
                                @endphp

                                @foreach($dataTypeRows as $row)
                                    @if(!in_array($row->field, $exclude))
                                        @php
                                            $display_options = isset($row->details->display) ? $row->details->display : NULL;
                                        @endphp
                                        @if (isset($row->details->formfields_custom))
                                            @include('voyager::formfields.custom.' . $row->details->formfields_custom)
                                        @else
                                            <div class="form-group @if($row->type == 'hidden') hidden @endif @if(isset($display_options->width)){{ 'col-md-' . $display_options->width }}@endif" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                                {{ $row->slugify }}
                                                @if($row->type !== 'relationship')
                                                    <label for="name">{{ $row->display_name }}</label>
                                                @endif
                                                @include('voyager::multilingual.input-hidden-bread-edit-add')
                                                @if($row->type == 'relationship')
                                                    @include('voyager::formfields.relationship')
                                                @else
                                                    {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                                @endif

                                                @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                                    {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                                @endforeach
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>
                    {{--Main features--}}
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
                            @if($dataTypeContent->featuresRu)
                                @foreach($dataTypeContent->featuresRu as $key => $char)
                                    <div class="form-group new_feature{{($key > 0)?$key:null}}">
                                        <label>
                                            <span class="panel-desc">Группа (Например : Приемущества)</span>
                                            <input type="text" class="form-control"
                                                   name="featureRu_group{{($key > 0)?$key:null}}"
                                                   placeholder="Группа" value="{{$char['group']}}">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Название</span>
                                            <input type="text" class="form-control"
                                                   name="featureRu_name{{($key > 0)?$key:null}}"
                                                   placeholder="Габариты" value="{{$char['name']}}">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Значение</span>
                                            <input type="text" class="form-control"
                                                   name="featureRu_value{{($key > 0)?$key:null}}"
                                                   placeholder="30х50х20" value="{{$char['value']}}">
                                        </label>
                                        <a class="remove">&times;</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div id="featuresGroupKz" class="panel-body">
                            @if($dataTypeContent->featuresKz)
                                @foreach($dataTypeContent->featuresKz as $key => $char)
                                    <div class="form-group new_feature{{($key > 0)?$key:null}}">
                                        <label>
                                            <span class="panel-desc">Группа (Например : Приемущества)</span>
                                            <input type="text" class="form-control"
                                                   name="featureKz_group{{($key > 0)?$key:null}}"
                                                   placeholder="Группа" value="{{$char['group']}}">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Название</span>
                                            <input type="text" class="form-control"
                                                   name="featureKz_name{{($key > 0)?$key:null}}"
                                                   placeholder="Габариты" value="{{$char['name']}}">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Значение</span>
                                            <input type="text" class="form-control"
                                                   name="featureKz_value{{($key > 0)?$key:null}}"
                                                   placeholder="30х50х20" value="{{$char['value']}}">
                                        </label>
                                        <a class="remove">&times;</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div id="featuresGroupEn" class="panel-body">
                            @if($dataTypeContent->featuresEn)
                                @foreach($dataTypeContent->featuresEn as $key => $char)
                                    <div class="form-group new_feature{{($key > 0)?$key:null}}">
                                        <label>
                                            <span class="panel-desc">Группа (Например : Приемущества)</span>
                                            <input type="text" class="form-control"
                                                   name="featureEn_group{{($key > 0)?$key:null}}"
                                                   placeholder="Группа" value="{{$char['group']}}">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Название</span>
                                            <input type="text" class="form-control"
                                                   name="featureEn_name{{($key > 0)?$key:null}}"
                                                   placeholder="Габариты" value="{{$char['name']}}">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Значение</span>
                                            <input type="text" class="form-control"
                                                   name="featureEn_value{{($key > 0)?$key:null}}"
                                                   placeholder="30х50х20" value="{{$char['value']}}">
                                        </label>
                                        <a class="remove">&times;</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="panel-body">
                            <input class="btn btn-primary" type='button' value='Добавить' id='addFeatureRuButton'>
                            <input class="btn btn-primary" type='button' value='Добавить' id='addFeatureKzButton'>
                            <input class="btn btn-primary" type='button' value='Добавить' id='addFeatureEnButton'>
                        </div>
                    </div>

                    {{--Main Characteristics--}}
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
                            @if($dataTypeContent->charsRu)
                                @foreach($dataTypeContent->charsRu as $key => $char)
                                    <div class="form-group new_char{{($key > 0)?$key:null}}">
                                        <label>
                                            <span class="panel-desc">Название</span>
                                            <input type="text" class="form-control"
                                                   name="charRu{{($key > 0)?$key:null}}"
                                                   placeholder="Габариты" value="{{$char['name']}}">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Значение</span>
                                            <input type="text" class="form-control"
                                                   name="charRu_value{{($key > 0)?$key:null}}"
                                                   placeholder="30х50х20" value="{{$char['value']}}">
                                        </label>
                                        <a class="remove">&times;</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div id="characteristicGroupKz" class="panel-body">
                            @if($dataTypeContent->charsKz)
                                @foreach($dataTypeContent->charsKz as $key => $char)
                                    <div class="form-group new_char{{($key > 0)?$key:null}}">
                                        <label>
                                            <span class="panel-desc">Название</span>
                                            <input type="text" class="form-control"
                                                   name="charKz{{($key > 0)?$key:null}}"
                                                   placeholder="Габариты" value="{{$char['name']}}">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Значение</span>
                                            <input type="text" class="form-control"
                                                   name="charKz_value{{($key > 0)?$key:null}}"
                                                   placeholder="30х50х20" value="{{$char['value']}}">
                                        </label>
                                        <a class="remove">&times;</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div id="characteristicGroupEn" class="panel-body">
                            @if($dataTypeContent->charsEn)
                                @foreach($dataTypeContent->charsEn as $key => $char)
                                    <div class="form-group new_char{{($key > 0)?$key:null}}">
                                        <label>
                                            <span class="panel-desc">Название</span>
                                            <input type="text" class="form-control"
                                                   name="charEn{{($key > 0)?$key:null}}"
                                                   placeholder="Габариты" value="{{$char['name']}}">
                                        </label>
                                        <label>
                                            <span class="panel-desc">Значение</span>
                                            <input type="text" class="form-control"
                                                   name="charEn_value{{($key > 0)?$key:null}}"
                                                   placeholder="30х50х20" value="{{$char['value']}}">
                                        </label>
                                        <a class="remove">&times;</a>
                                    </div>
                                @endforeach
                            @endif
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
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'excerpt',
                                '_field_trans' => get_field_translations($dataTypeContent, 'excerpt')
                            ])
                            @php
                                $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                                $row = $dataTypeRows->where('field', 'excerpt')->first();

                            @endphp
                            {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
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
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'description',
                                '_field_trans' => get_field_translations($dataTypeContent, 'description')
                            ])
                            @php
                                $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                                $row = $dataTypeRows->where('field', 'description')->first();

                            @endphp
                            {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
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
                                       {!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug") !!}
                                       value="@if(isset($dataTypeContent->slug)){{ $dataTypeContent->slug }}@endif">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Категория</label>
                                <select class="form-control" name="category_id">
                                    @foreach(TCG\Voyager\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}"
                                                @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id) selected="selected"@endif>{{ $category->name }}</option>
                                    @endforeach
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
                            @if(isset($dataTypeContent->image))
                                <img src="{{ filter_var($dataTypeContent->image, FILTER_VALIDATE_URL) ? $dataTypeContent->image : Voyager::image( $dataTypeContent->image ) }}"
                                     style="width:50%"/>
                            @endif
                            <input type="file" name="image">
                        </div>
                    </div>

                    {{--<!-- ### IMAGES ### -->--}}
                    {{--<div class="panel panel-bordered panel-primary">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title"><i class="icon wb-image"></i> Галерея</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a class="panel-action voyager-angle-down" data-toggle="panel-collapse"--}}
                                   {{--aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}
                            {{--@if(isset($dataTypeContent->images))--}}
                                {{--@foreach(json_decode($dataTypeContent->images) as $image)--}}
                                    {{--<img src="{{ filter_var($image, FILTER_VALIDATE_URL) ? $image : Voyager::image( $image ) }}"--}}
                                         {{--style="width:10%"/>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                            {{--<input type="file" name="images[]" multiple>--}}
                        {{--</div>--}}
                    {{--</div>--}}
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
                                @foreach($variants as $variant)
                                    <option value="{{$variant->id}}"
                                            @if($dataTypeContent->relateds && in_array($variant->id,unserialize($dataTypeContent->relateds))) selected @endif>{{$variant->name}}</option>
                                @endforeach
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
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'meta_keywords',
                                '_field_trans' => get_field_translations($dataTypeContent, 'meta_keywords')
                            ])
                            @php
                                $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                                $includes = ['meta_description','meta_keywords','seo_title'];
                            @endphp

                            @foreach($dataTypeRows as $row)
                                @if(in_array($row->field, $includes))
                                    @php
                                        $display_options = isset($row->details->display) ? $row->details->display : NULL;
                                    @endphp
                                    @if (isset($row->details->formfields_custom))
                                        @include('voyager::formfields.custom.' . $row->details->formfields_custom)
                                    @else
                                        <div class="form-group @if($row->type == 'hidden') hidden @endif @if(isset($display_options->width)){{ 'col-md-' . $display_options->width }}@endif" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                            {{ $row->slugify }}
                                            @if($row->type !== 'relationship')
                                                <label for="name">{{ $row->display_name }}</label>
                                            @endif
                                            @include('voyager::multilingual.input-hidden-bread-edit-add')
                                            @if($row->type == 'relationship')
                                                @include('voyager::formfields.relationship')
                                            @else
                                                {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                            @endif

                                            @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                                {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">
                @if(isset($dataTypeContent->id))Обновить @else <i
                        class="icon wb-plus-circle"></i> Создать @endif
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
              enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            {{ csrf_field() }}
            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
        </form>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('#slug').slugify();

            @if ($isModelTranslatable)
            $('.side-body').multilingual({"editing": true});
                    @endif

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
            @if($dataTypeContent->charsRu && count($dataTypeContent->charsRu))
                counterCharRu = {{count($dataTypeContent->charsRu)}} +1;
            @endif

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
            @if($dataTypeContent->charsKz && count($dataTypeContent->charsKz))
                counterCharKz = {{count($dataTypeContent->charsKz)}} +1;
            @endif

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
            @if($dataTypeContent->charsEn && count($dataTypeContent->charsEn))
                counterCharEn = {{count($dataTypeContent->charsEn)}} +1;
            @endif

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
            @if($dataTypeContent->featuresRu && count($dataTypeContent->featuresRu))
                counterFeatureRu = {{count($dataTypeContent->featuresRu)}} +1;
            @endif

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
            @if($dataTypeContent->featuresKz && count($dataTypeContent->featuresKz))
                counterFeatureKz = {{count($dataTypeContent->featuresKz)}} +1;
            @endif

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
            @if($dataTypeContent->featuresEn && count($dataTypeContent->featuresEn))
                counterFeatureEn = {{count($dataTypeContent->featuresEn)}} +1;
            @endif

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
@stop
