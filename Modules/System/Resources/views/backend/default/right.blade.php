<aside id="sidebar-right" class="sidebar-right">
    <div class="panel-header">
        <div class="row">
            <div class="col-md-8">
                <div class="visible-xs logo-container" style="background-color: white;width: 100%;padding:6px;">
                    <a id="linkMenu" href="{{ url('/') }}" target="_blank" class="logo">
                        @if(file_exists(Helper::files('logo/'.config('website.logo'))))
                        <img src="{{ Helper::files('logo/'.config('website.logo')) }}"
                            style="height: 45px;margin-left: 0px;cursor:pointer" alt="{{ config('app.name') }}" />
                        @else
                        <img src="{{ Helper::vendor('default/logo.png') }}"
                            style="height: 45px;margin-left: 0px;cursor:pointer" alt="{{ config('app.name') }}" />
                        @endif
                    </a>
                </div>
            </div>
            <div style="position: absolute !important;top: 5px;right: 15px;margin-top:  10px;">
                <div style="border-radius: 50%;width: 30px;height: 30px;" class="visible-xs mobile-close">
                    <i style="color: white;margin-right: 25px;margin-top: -20px;margin-left: -9.5px;"
                        class="fa fa-close" aria-label="Toggle sidebar"></i>
                </div>
            </div>
        </div>
    </div>
    <div id="right" class="nano">
        <div class="nano-content" style="padding:10px 10px 10px 10px;border:none;">
            <nav id="menu" style="border:none;" class="nav-main" role="navigation">
                <div id="right-group" class="list-group">
                    @isset($group_list)
                    @foreach($group_list->sortBy('system_group_module_sort') as $group)
                    <div id="linkMenu"
                        onclick="location.href = '{{ route('access_group',[$group->system_group_module_code]) }}';"
                        href="{{ route('access_group',[$group->system_group_module_code]) }}"
                        class="pointer linkRight list-group-item {{ (Session(Auth::User()->username.'_group_access') == $group->system_group_module_code ? 'active' : '') }}">
                        <span>{{ __($group->system_group_module_name) }}</span>
                    </div>
                    @endforeach
                    @endisset
                    @if(isset(Auth::user()->group_user) && Auth::user()->group_user == 'developer')
                    <div id="reboot" onclick="location.href ='{{ route('reboot') }}';" class="list-group-item">
                        <span>{{ __('reboot') }}</span>
                    </div>
                    @endif
                </div>
            </nav>
        </div>
    </div>
</aside>