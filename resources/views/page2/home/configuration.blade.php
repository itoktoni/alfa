@extends(Helper::setExtendBackend())
@component('components.date', ['array' => ['date']])
@endcomponent
@component('components.editor', ['array' => ['editor']])
@endcomponent
@component('components.jscolor')
@endcomponent
@section('content')
<div class="row">
    <div class="panel-body">
        {!! Form::open(['route' => 'configuration', 'class' => 'form-horizontal', 'files' => true]) !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">Configuration ( {{ config('website.name') }} )</h2>
            </header>

            <div class="panel-body line">
                <div class="row">

                    <div class="col-md-4 col-lg-3">
                        <section class="panel">
                            <div class="">
                                <div class="text-center">
                                    @if(empty(config('website.favicon')))
                                    <img src="{{ Helper::vendor('default/favicon.png') }}"
                                        class="img-thumbnail rounded center-block img-responsive">
                                    @else
                                    <img src="{{ Helper::asset('/files/logo/'.config('website.favicon')) }}"
                                        class="img-thumbnail rounded center-block img-responsive">
                                    @endif
                                </div>
                            </div>
                        </section>
                        <h5 class="text-center">Favicon :<code>W: 50px & H: 50px </code></h5>
                        <hr class="dotted short">
                        <div class="col-md-12">
                            <input type="file" name="favicon" class="btn btn-default btn-sm btn-block">
                        </div>
                        <br>

                        <br>
                        <br>
                        <hr>
                        <section class="panel">
                            <div class="">
                                <div class="text-center">
                                    @if(empty(config('website.logo')))
                                    <img src="{{ Helper::vendor('/default/logo.png') }}"
                                        class="img-thumbnail rounded center-block img-responsive" alt="no profile">
                                    @else
                                    <img src="{{ Helper::asset('/files/logo/'.config('website.logo')) }}"
                                        class="img-thumbnail rounded center-block img-responsive" alt="John Doe">
                                    @endif
                                </div>
                            </div>
                        </section>
                        <h5 class="text-center">Logo <code>W: 50px-100px & H: 230px</code></h5>
                        <hr class="dotted short">
                        <div class="col-md-12 space">
                            <input type="file" name="logo" class="btn btn-default btn-sm btn-block">
                        </div>
                        <br>
                        <br>
                        <hr>
                        <h5 class="text-center">Primary</h5>
                        <div class="col-md-12">
                            {!! Form::text('color', config('website.color'), ['class' => 'form-control jscolor']) !!}
                        </div>

                        <br>
                        <hr>
                        <h5 class="text-center">Secondary</h5>
                        <div class="col-md-12">
                            {!! Form::text('colors', config('website.colors'), ['class' => 'form-control jscolor']) !!}
                        </div>
                        <br>
                        <hr>
                    </div>

                    <div class="col-md-8 col-lg-9">

                        <div class="panel-group" id="accordion">
                            <div class="panel panel-accordion">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapse1One">
                                            Information
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1One" class="accordion-body collapse in">
                                    <div class="panel-body line">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Website Name</label>
                                            <div class="col-md-4">
                                                <input type="text" name="name" value="{{ config('website.name') }}"
                                                    required="" class="form-control">
                                            </div>

                                            <label class="col-md-2 control-label">Environment</label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="env">
                                                    <option
                                                        {{ config('website.env') == 'local' ? 'selected=selected' : '' }}
                                                        value="local">Local</option>
                                                    <option
                                                        {{ config('website.env') == 'dev' ? 'selected=selected' : '' }}
                                                        value="dev">Dev</option>
                                                    <option
                                                        {{ config('website.env') == 'production' ? 'selected=selected' : '' }}
                                                        value="production">Production
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Show Setting</label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="developer_setting">
                                                    @foreach($group as $g)
                                                    <option
                                                        {{ config('website.developer_setting') == $g->group_user_code ? 'selected' : '' }}
                                                        value="{{ $g->group_user_code }}">
                                                        {{ $g->group_user_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <label class="col-md-2 control-label">Database Driver</label>
                                            <div class="col-md-4">
                                                {{ Form::select('DB_CONNECTION', $database_driver, config('database.default'), ['placeholder' => 'Please Select Database', 'class' => 'form-control']) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Phone</label>
                                            <div class="col-md-4">
                                                <input type="text" value="{{ config('website.phone') }}" name="phone"
                                                    class="form-control">
                                            </div>

                                            <label class="col-md-2 control-label">Email Pengirim</label>
                                            <div class="col-md-4">
                                                <input type="text" value="{{ config('mail.from.name') }}"
                                                    name="mail_name" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Nama Owner</label>
                                            <div class="col-md-4">
                                                <input type="text" value="{{ config('website.owner') }}" name="owner"
                                                    class="form-control">
                                            </div>
                                            <label class="col-md-2 control-label">Alamat Email</label>
                                            <div class="col-md-4">
                                                <input type="text" value="{{ config('website.email') }}" name="email"
                                                    class="form-control">
                                                <input type="text" value="{{ config('website.warehouse') }}"
                                                    name="warehouse" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Backend</label>
                                            <div class="col-md-4">
                                                {{ Form::select('backend', $backend, config('website.backend'), ['placeholder' => 'Please Select Template', 'class' => 'form-control']) }}
                                            </div>
                                            <label class="col-md-2 control-label">Frontend</label>
                                            <div class="col-md-4">
                                                {{ Form::select('frontend', $frontend, config('website.frontend'), ['placeholder' => 'Please Select Template', 'class' => 'form-control']) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Debug</label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="live">
                                                    <option value="1">Live</option>
                                                    <option value="0">Maintenance</option>
                                                    <option value="2">Under Construction</option>
                                                </select>
                                            </div>
                                            <label class="col-md-2 control-label">Debug Bar</label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="debug">
                                                    <option {{ config('app.debug') == '1' ? 'selected=selected' : '' }}
                                                        value="1">Show DebugBar</option>
                                                    <option {{ config('app.debug') == '0' ? 'selected=selected' : '' }}
                                                        value="0">Hidden DebugBar</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Address</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control lite" rows="3" name="address"
                                                    cols="50">{{ config('website.address') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Auth::user()->group_user == 'developer')
                            <div class="panel panel-accordion">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                            href="#address">
                                            Cache
                                        </a>
                                    </h4>
                                </div>
                                <div id="address" class="accordion-body collapse">
                                    <div class="panel-body line">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Session</label>
                                            <div class="col-md-4">
                                                {{ Form::select('session', $session_driver, config('session.driver'), ['placeholder' => 'Please Select Session', 'class' => 'form-control']) }}
                                            </div>
                                            <label class="col-md-2 control-label">Cache</label>
                                            <div class="col-md-4">
                                                {{ Form::select('cache', $cache_driver, config('cache.default'), ['placeholder' => 'Please Select Cache', 'class' => 'form-control']) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Session Expire</label>
                                            <div class="col-md-4">
                                                <input type="text" name="website_session"
                                                    value="{{ config('website.session') }}" class="form-control">
                                            </div>
                                            <label class="col-md-2 control-label">Cache Expire</label>
                                            <div class="col-md-4">
                                                <input type="text" name="website_cache"
                                                    value="{{ config('website.cache') }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-accordion">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapse1Two">
                                            Database
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1Two" class="accordion-body collapse">
                                    <div class="panel-body line">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">
                                                Database Name
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" name="DB_DATABASE" value="{{ env('DB_DATABASE') }}"
                                                    class="form-control">
                                            </div>
                                            <label class="col-md-2 control-label">
                                                Database Host
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" name="DB_HOST" value="{{ env('DB_HOST') }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Username
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" name="DB_USERNAME" value="{{ env('DB_USERNAME') }}"
                                                    class="form-control">
                                            </div>
                                            <label class="col-md-2 control-label"> Password
                                            </label>
                                            <div class="col-md-4">
                                                <input readonly onfocus="this.removeAttribute('readonly')"
                                                    type="password" name="DB_PASSWORD" value="{{ env('DB_PASSWORD') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-accordion">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapse1Three">
                                            Email
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1Three" class="accordion-body collapse">
                                    <div class="panel-body line">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">
                                                Mail Driver
                                            </label>
                                            <div class="col-md-4">
                                                {{ Form::select('MAIL_DRIVER', $mail_driver, config('mail.driver'), ['placeholder' => 'Please Select Template', 'class' => 'form-control']) }}
                                            </div>
                                            <label class="col-md-2 control-label">
                                                Mail Host
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" name="MAIL_HOST" value="{{ config('mail.host') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">
                                                Mail Port
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" name="MAIL_PORT" value="{{ config('mail.port') }}"
                                                    class="form-control">
                                            </div>
                                            <label class="col-md-2 control-label"> Encryption
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" name="MAIL_ENCRYPTION"
                                                    value="{{ config('mail.encryption') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Username
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" name="MAIL_USERNAME"
                                                    value="{{ config('mail.username') }}" class="form-control">
                                            </div>
                                            <label class="col-md-2 control-label"> Password
                                            </label>
                                            <div class="col-md-4">
                                                <input readonly onfocus="this.removeAttribute('readonly')"
                                                    type="password" name="MAIL_PASSWORD"
                                                    value="{{ config('mail.password') }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="panel panel-accordion">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapse1Four">
                                            Page
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1Four" class="accordion-body collapse">
                                    <div class="panel-body line">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">SEO</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="3" name="seo"
                                                    cols="50">{{ config('website.seo') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Checkout</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control editor" rows="7" name="header"
                                                    cols="50"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Description</label>
                                            <div class="col-md-10" style="margin-bottom: 5px;">
                                                <textarea class="form-control editor" rows="2"
                                                    name="description">{{ config('website.description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Promo</label>
                                            <div class="col-md-10" style="margin-bottom: 5px;">
                                                <textarea class="form-control editor" rows="2"
                                                    name="promo">{{ config('website.promo') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Footer</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="3" name="footer"
                                                    cols="50">{{ config('website.footer') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="navbar-fixed-bottom" id="menu_action">
                <div class="text-right" style="padding:5px">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>

        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection