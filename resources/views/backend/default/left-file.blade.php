<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header" style="border-bottom: 0.1px solid grey;">

        <a href="{{ route('filemanager') }}" style="color:white;text-decoration: none;z-index: 999;">
            <div class="sidebar-title">
                <i style="margin-left:8px;font-size: 20px;margin-right: 7px;color:#ABB4BE;" class="fa fa-home" aria-hidden="true"></i>
                <span class="text-center" style="font-size: 13px;color:#ABB4BE;">BASE ROOT</span>
            </div>
        </a>

        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">

                <ul class="nav nav-main">
                     @isset ($files)
                        @foreach ($files as $file)
                             <li class="{{ $file == $name ? 'nav-active' : '' }}">
                                <a href="{{ route('file', ['name' => $file]) }}">
                                <i class="fa fa-{{ Helper::ext($file) }}" aria-hidden="true"></i>
                                <span>{{ $file }} </span>
                                </a>
                            </li>
                        @endforeach
                    @endisset

                    @isset ($directory)
                        @foreach ($directory as $dir)
                             <li>
                                <a href="{{ $dir }}">
                                    <i class="fa fa-folder" aria-hidden="true"></i>
                                    <span>{{ $dir }} </span>
                                </a>
                            </li>
                        @endforeach
                    @endisset

                    @if(isset($menu_list)) 
                    @foreach ($menu_list as $menu)
                    @if($menu->module_single == "1")
                    <li>
                        <a href="{{ $menu->module_link }}">
                            <!--<span class="pull-right label label-primary">182</span>-->
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                            <span>{{ $menu->module_name }} </span>
                        </a>
                    </li>
                    @else
                    @if($menu->module_visible == '1' && $menu->module_enable == '1')
                    <li class="nav-parent {{ Request::segment(2) === $menu->module_link ? 'nav-expanded nav-active' : '' }}">
                        <a>
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            <span class="text-capitalize"> {{ $menu->module_name }}</span>
                        </a>
                        <ul class="nav nav-children">
                            @foreach ($action_list as $data_action)
                            @if($menu->module_code === $data_action->module_code && $data_action->action_visible == '1')
                            <li{{ $data_action->action_function === Request::segment(3) && Request::segment(2) === $menu->module_link ? " class=nav-active" : '' }}>
                                <a href="{!! route("$data_action->action_code") !!}">
                                    {{ $data_action->action_name }}
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