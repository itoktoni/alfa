<aside id="sidebar-left" class="sidebar-left">
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul id="left" class="nav nav-main">
                    <li>
                        <a data-turbolinks="false" id=" linkMenu" href="{{ route('home') }}">
                            <i class="fa fa-home" aria-hidden="true"
                                style="font-size: 23px;margin-left:-2px;margin-right:5px"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    @if(isset($menu_list))
                    @foreach ($menu_list as $menu)
                    @if($menu->system_module_single == "1")
                    <li>
                        <a id="linkMenu" href="{{ $menu->system_module_link }}">
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                            <span>{{ $menu->system_module_name }} </span>
                        </a>
                    </li>
                    @else
                    @if($menu->system_module_show == '1' && $menu->system_module_enable == '1')
                    <li class="nav-parent {{ $module === $menu->system_action_module ? 'nav-expanded nav-active' : '' }}">
                        <a id="linkMenu">
                            <i class="fas fa-bars" aria-hidden="true"></i>
                            <span class="text-capitalize"> {{ $menu->system_module_name }}</span>
                        </a>
                        <ul class="nav nav-children">
                            @foreach ($action_list as $data_action)
                            @if($menu->system_module_code === $data_action->system_module_code && $data_action->system_action_show == '1')
                            <li onclick="rmSidebar()"
                                {{ $action_code == $data_action->system_action_code ? 'class=nav-active' : '' }}>
                                <a id="childMenu" href="{!! route($data_action->system_action_code) !!}">
                                    {{ $data_action->system_action_name }}
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    @endif
                    @endforeach
                    @endif
                </ul>
            </nav>
            <hr class="separator" />
        </div>
    </div>
</aside>
