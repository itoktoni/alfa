<aside id="sidebar-left" class="sidebar-left">
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul id="left" class="nav nav-main">
                    <li>
                        <a href="{{ route('home') }}">
                            <i class="fa fa-home" aria-hidden="true"
                                style="font-size: 23px;margin-left:-2px;margin-right:5px"></i>
                            <span>{{ __('Home') }}</span>
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
                    <li
                        class="nav-parent {{ $module === $menu->system_action_module ? 'nav-expanded nav-active' : '' }}">
                        <a id="linkMenu">
                            <i class="fas fa-bars" aria-hidden="true"></i>
                            <span class="text-capitalize">
                                {{ $menu->system_module_name == 'Module' ? __($menu->system_module_name.'s') : __($menu->system_module_name) }}
                            </span>
                        </a>
                        <ul class="nav nav-children">
                            @foreach ($action_list as $data_action)
                            @if($menu->system_module_code === $data_action->system_module_code &&
                            $data_action->system_action_show == '1')
                            <li onclick="rmSidebar()"
                                {{ $action_code == $data_action->system_action_code ? 'class=nav-active' : '' }}>
                                <a id="childMenu" href="{!! route($data_action->system_action_code) !!}">
                                    @php
                                    $function_name = Helper::functionToLabel($data_action->system_action_function)->__toString();
                                    @endphp
                                    @if (strpos($function_name, 'report'))
                                    {{ __(str_replace('Index', 'Data', $function_name)) }}
                                    {{ $menu->system_module_name == 'Module' ? __($menu->system_module_name.'s') : __($menu->system_module_name) }}
                                    @else
                                    @if($function_name == 'Pending')
                                    {{ 'Rekap Linen ' }}
                                    @elseif($function_name == 'Hilang')
                                    {{ 'Rekap Pending/Hilang' }}
                                    @else  
                                        {{ $menu->system_module_name == 'Module' ? __($menu->system_module_name.'s') : __($menu->system_module_name) }}
                                        {{ __(str_replace('Index', 'Data', $function_name)) }}  
                                        @endif
                                    @endif
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
        </div>
    </div>
</aside>