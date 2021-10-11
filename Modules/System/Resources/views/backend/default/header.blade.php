<header class="header">
    <div class="logo-container">
        <div onclick="window.open('{{ URL::to('/') }}','_blank');" href="{{ url('/') }}" target="_blank" class="logo">
            <img src="{{ Helper::files('logo/'.config('website.logo')) }}"
                style="height: 45px;margin-left: 0px;cursor:pointer" alt="{{ config('app.name') }}" />
        </div>
        <div id="leftMenu" class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened"
            data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
    
    <div class="header-right">
       
        <ul class="notifications">
            @if(config('website.notification'))
            <li class="mail">
                <a onclick="showEmail();" class="dropdown-toggle notification-icon">
                    <i class="fa fa-envelope"></i>
                    <span class="badge">4</span>
                </a>
                <div class="dropdown-menu notification-menu">
                    <div class="notification-title">
                        Messages
                    </div>
                    <div class="content">
                        <ul>
                            <li>
                                <a href="#" class="clearfix">
                                    <span class="title">Joseph Doe</span>
                                    <span class="message">Lorem ipsum dolor sit.</span>
                                </a>
                            </li>
                        </ul>
                        <hr />
                        <div class="text-right">
                            <a href="#" class="view-more">View All</a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="notif">
                <a onclick="showNotif();" class="dropdown-toggle notification-icon">
                    <i class="fa fa-bell"></i>
                    <span class="badge">3</span>
                </a>
                <div class="dropdown-menu notification-menu">
                    <div class="notification-title">
                        Alerts
                    </div>
                    <div class="content">
                        <ul>
                            <li>
                                <a href="#" class="clearfix">
                                    <div class="image">
                                        <i class="fa fa-thumbs-down bg-danger"></i>
                                    </div>
                                    <span class="title">Server is Down!</span>
                                    <span class="message">Just now</span>
                                </a>
                            </li>
                        </ul>
                        <hr />
                        <div class="text-right">
                            <a href="#" class="view-more">View All</a>
                        </div>
                    </div>
                </div>
            </li>
            @endif

            <li>
                <a id="rightMenu" href="#" style="border:none;background-color: #191c21;color:white;"
                    class="sidebar-right-toggle notification-icon" data-open="sidebar-right">
                    <i style="color: white;" class="fa fa-folder-open"></i>
                </a>
            </li>
        </ul>
        <span class="separator"></span>
        <div id="userbox" onclick="showProfile();" class="userbox">
            <div class="drop">
                <figure class="profile-picture">

                    <img class="img-circle"
                        src="{{ Avatar::create(Auth::user()->name)->setFontSize(40)->toBase64() }}" />

                </figure>
                <div class="profile-info">
                    <span class="name">@auth{{ Auth::user()->username }}@endauth</span>
                    <span class="role">@auth{{ Auth::user()->group_user }}@endauth</span>
                </div>
                <i class="fa custom-caret"></i>
            </div>
            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    @auth
                    @if( config('website.developer_setting') == Auth::user()->group_user)
                    <li class="divider"></li>

                    <li>
                        <a data-turbolinks="false" role="menuitem" tabindex="-1" class="header-menu" href="{{ route('route') }}">
                            <i class="fa fa-globe"></i> &nbsp;
                            {{ __('List Routes') }}
                        </a>
                    </li>

                    <li>
                        <a data-turbolinks="false" role="menuitem" tabindex="-1" href="{{ route('configuration') }}">
                            <i class="fa fa-wrench"></i> &nbsp; {{ __('System Setting') }}
                        </a>
                    </li>

                    <li>
                        <a data-turbolinks="false" role="menuitem" tabindex="-1" href="{{ route('console') }}">
                            <i class="fa fa-terminal"></i> &nbsp;{{ __('System Console') }}
                        </a>
                    </li>

                    <li>
                        <a data-turbolinks="false" role="menuitem" tabindex="-1" class="header-menu" href="{{ route('language') }}">
                            <i class="fa fa-toggle-on"></i> &nbsp;
                            {{ __('Language') }}
                        </a>
                    </li>

                    @endif

                    <li class="divider"></li>

                    <li>
                        <a data-turbolinks="false" role="menuitem" tabindex="-1" href="{{ route('reset_password') }}">&nbsp;
                            <i class="fa fa-lock"></i>
                            &nbsp;{{ __('Change Password') }}
                        </a>
                    </li>

                    <li class="divider"></li>

                    <li>
                        <a data-turbolinks="false" id="logout" class="header-menu" role="menuitem" tabindex="-1" href="{{ route('logout') }}">
                            &nbsp;<i class="fa fa-power-off"></i>
                            &nbsp;{{ __('Logout') }}
                        </a>
                    </li>
                    
                    @endauth
                </ul>
            </div>
        </div>
    </div>
    
</header>