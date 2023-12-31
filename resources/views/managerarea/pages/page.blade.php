{{-- Master Layout --}}
@extends('cortex/tenants::managerarea.layouts.default')

{{-- Page Title --}}
@section('title')
    {{ extract_title(Breadcrumbs::render()) }}
@endsection

@push('inline-scripts')
    {!! JsValidator::formRequest(Cortex\Pages\Http\Requests\Managerarea\PageFormRequest::class)->selector("#managerarea-cortex-pages-pages-create-form, #managerarea-cortex-pages-pages-{$page->getRouteKey()}-update-form")->ignore('.skip-validation') !!}
@endpush

{{-- Main Content --}}
@section('content')

    @includeWhen($page->exists, 'cortex/tenants::managerarea.partials.modal', ['id' => 'delete-confirmation'])

    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ Breadcrumbs::render() }}</h1>
        </section>

        {{-- Main content --}}
        <section class="content">

            <div class="nav-tabs-custom">
                @includeWhen($page->exists, 'cortex/tenants::managerarea.partials.actions', ['name' => 'page', 'model' => $page, 'resource' => trans('cortex/pages::common.page'), 'routePrefix' => 'managerarea.cortex.pages.pages'])
                {!! Menu::render('managerarea.cortex.pages.pages.tabs', 'nav-tab') !!}

                <div class="tab-content">

                    <div class="tab-pane active" id="details-tab">

                        @if ($page->exists)
                            {{ Form::model($page, ['url' => route('managerarea.cortex.pages.pages.update', ['page' => $page]), 'method' => 'put', 'id' => "managerarea-cortex-pages-pages-{$page->getRouteKey()}-update-form"]) }}
                        @else
                            {{ Form::model($page, ['url' => route('managerarea.cortex.pages.pages.store'), 'id' => 'managerarea-cortex-pages-pages-create-form']) }}
                        @endif

                            <div class="row">

                                <div class="col-md-8">

                                    <div class="row">

                                        <div class="col-md-12">

                                            {{-- Title --}}
                                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                                {{ Form::label('title', trans('cortex/pages::common.title'), ['class' => 'control-label']) }}
                                                {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => trans('cortex/pages::common.title'), 'data-slugify' => '[name="slug"]', 'required' => 'required', 'autofocus' => 'autofocus']) }}

                                                @if ($errors->has('title'))
                                                    <span class="help-block">{{ $errors->first('title') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            {{-- Subtitle --}}
                                            <div class="form-group{{ $errors->has('subtitle') ? ' has-error' : '' }}">
                                                {{ Form::label('subtitle', trans('cortex/pages::common.subtitle'), ['class' => 'control-label']) }}
                                                {{ Form::text('subtitle', null, ['class' => 'form-control', 'placeholder' => trans('cortex/pages::common.subtitle'), 'required' => 'required']) }}

                                                @if ($errors->has('subtitle'))
                                                    <span class="help-block">{{ $errors->first('subtitle') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            {{-- Tags --}}
                                            <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                                                {{ Form::label('tags[]', trans('cortex/auth::common.tags'), ['class' => 'control-label']) }}
                                                {{ Form::hidden('tags', '', ['class' => 'skip-validation']) }}
                                                {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-width' => '100%', 'data-tags' => 'true']) }}

                                                @if ($errors->has('tags'))
                                                    <span class="help-block">{{ $errors->first('tags') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            {{-- Excerpt --}}
                                            <div class="form-group{{ $errors->has('excerpt') ? ' has-error' : '' }}">
                                                {{ Form::label('excerpt', trans('cortex/pages::common.excerpt'), ['class' => 'control-label']) }}
                                                {{ Form::textarea('excerpt', null, ['class' => 'form-control tinymce', 'placeholder' => trans('cortex/pages::common.excerpt'), 'rows' => 5]) }}

                                                @if ($errors->has('excerpt'))
                                                    <span class="help-block">{{ $errors->first('excerpt') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            {{-- Content --}}
                                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                                {{ Form::label('content', trans('cortex/pages::common.content'), ['class' => 'control-label']) }}
                                                {{ Form::textarea('content', null, ['class' => 'form-control tinymce', 'placeholder' => trans('cortex/pages::common.content'), 'rows' => 5]) }}

                                                @if ($errors->has('content'))
                                                    <span class="help-block">{{ $errors->first('content') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="row">

                                        <div class="col-md-12">

                                            {{-- Slug --}}
                                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                                {{ Form::label('slug', trans('cortex/pages::common.slug'), ['class' => 'control-label']) }}
                                                {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => trans('cortex/pages::common.slug'), 'required' => 'required']) }}

                                                @if ($errors->has('slug'))
                                                    <span class="help-block">{{ $errors->first('slug') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            {{-- URI --}}
                                            <div class="form-group{{ $errors->has('uri') ? ' has-error' : '' }}">
                                                {{ Form::label('uri', trans('cortex/pages::common.uri'), ['class' => 'control-label']) }}
                                                {{ Form::text('uri', null, ['class' => 'form-control', 'placeholder' => trans('cortex/pages::common.uri'), 'required' => 'required']) }}

                                                @if ($errors->has('uri'))
                                                    <span class="help-block">{{ $errors->first('uri') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            {{-- Route --}}
                                            <div class="form-group{{ $errors->has('route') ? ' has-error' : '' }}">
                                                {{ Form::label('route', trans('cortex/pages::common.route'), ['class' => 'control-label']) }}
                                                {{ Form::text('route', null, ['class' => 'form-control', 'placeholder' => trans('cortex/pages::common.route'), 'required' => 'required']) }}

                                                @if ($errors->has('route'))
                                                    <span class="help-block">{{ $errors->first('route') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            {{-- Middleware --}}
                                            <div class="form-group{{ $errors->has('middleware') ? ' has-error' : '' }}">
                                                {{ Form::label('middleware', trans('cortex/pages::common.middleware'), ['class' => 'control-label']) }}
                                                {{ Form::text('middleware', null, ['class' => 'form-control', 'placeholder' => trans('cortex/pages::common.middleware'), 'required' => 'required']) }}

                                                @if ($errors->has('middleware'))
                                                    <span class="help-block">{{ $errors->first('middleware') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            {{-- Sort Order --}}
                                            <div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">
                                                {{ Form::label('sort_order', trans('cortex/pages::common.sort_order'), ['class' => 'control-label']) }}
                                                {{ Form::number('sort_order', null, ['class' => 'form-control', 'placeholder' => trans('cortex/pages::common.sort_order')]) }}

                                                @if ($errors->has('sort_order'))
                                                    <span class="help-block">{{ $errors->first('sort_order') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            {{-- View --}}
                                            <div class="form-group{{ $errors->has('view') ? ' has-error' : '' }}">
                                                {{ Form::label('view', trans('cortex/pages::common.view'), ['class' => 'control-label']) }}
                                                {{ Form::text('view', null, ['class' => 'form-control', 'placeholder' => trans('cortex/pages::common.view'), 'required' => 'required']) }}

                                                @if ($errors->has('view'))
                                                    <span class="help-block">{{ $errors->first('view') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            {{-- Is Active --}}
                                            <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
                                                {{ Form::label('is_active', trans('cortex/pages::common.is_active'), ['class' => 'control-label']) }}
                                                {{ Form::select('is_active', [1 => trans('cortex/pages::common.yes'), 0 => trans('cortex/pages::common.no')], null, ['class' => 'form-control select2', 'data-minimum-results-for-search' => 'Infinity', 'data-width' => '100%', 'required' => 'required']) }}

                                                @if ($errors->has('is_active'))
                                                    <span class="help-block">{{ $errors->first('is_active') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="pull-right">
                                        {{ Form::button(trans('cortex/pages::common.submit'), ['class' => 'btn btn-primary btn-flat', 'type' => 'submit']) }}
                                    </div>

                                    @include('cortex/tenants::managerarea.partials.timestamps', ['model' => $page])

                                </div>

                            </div>

                        {{ Form::close() }}

                    </div>

                </div>

            </div>

        </section>

    </div>

@endsection
