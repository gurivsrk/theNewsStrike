<div class="sidebar" data-color="black" data-active-color="primary">
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ getImageById(siteInfo('favicon')) }}">
            </div>
        </a>
        <a href="#" class="simple-text logo-normal">
            {{ siteInfo('website_title') }}
        </a>
    </div>
    @can('all')
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ @$elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            @can('editor')
            <li class="{{ @$elementHead == 'gallery' ? 'active' : '' }}">
                <a href="{{ route('gallery.index') }}">
                    <i class="nc-icon nc-image"></i>
                    <p>{{ __('Gallery') }}</p>
                </a>
            </li>
            <li class="{{ @$elementHead == 'menu' ? 'active' : '' }}">
                <a href="{{ route('gallery.index') }}">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>{{ __('Menu') }}</p>
                </a>
            </li>
            <li class="{{ @$elementHead == 'faqs' ? 'active' : '' }}">
                <a href="{{ route('gallery.index') }}">
                    <i class="nc-icon nc-bulb-63"></i>
                    <p>{{ __('FAQs') }}</p>
                </a>
            </li>
            @endcan
            @can('admin')
            <li class="{{ @$elementHead == 'customization'?'active':''}}">
                <a data-toggle="collapse" aria-expanded="{{ @$elementHead == 'customization' ? 'true' : 'false'}}" class="{{ @$elementHead == 'customization'?'':'collapsed'}} " href="#customization">
                    <i class="nc-icon nc-settings-gear-65"></i>
                    <p>
                            {{ __('customization') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ @$elementHead == 'customization' ? 'show' : ''}}" id="customization">
                    <ul class="nav">
                        <li class="{{ @$elementSub == 'customization' ? 'active' : '' }}">
                            <a href="{{ route('staticPages.edit', 'gd') }}">
                                <span class="sidebar-mini-icon">{{ __('GS') }}</span>
                                <span class="sidebar-normal">{{ __('General Setting') }}</span>
                            </a>
                        </li>
                    <li class="{{ @$elementSub == 'customCode' ? 'active' : '' }}">
                        <a href="{{ route('custom-code.index') }}">
                            <span class="sidebar-mini-icon">{{ __('CC') }}</span>
                                <span class="sidebar-normal">{{ __('Custom Code') }}</span>
                        </a>
                    </li>
                    </ul>
                </div>
            </li>
            <li class="{{ @$elementActive == 'user' || @$elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" class="collapsed" href="#pages">
                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>
                            {{ __('Pages') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pages">
                    <ul class="nav">
                        <li class="{{ @$elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">{{ __('LA') }}</span>
                                <span class="sidebar-normal">{{ __(' List All') }}</span>
                            </a>
                        </li>
                        {{-- <li class="{{ @$elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">{{ __('UP') }}</span>
                                <span class="sidebar-normal">{{ __(' User Profile ') }}</span>
                            </a>
                        </li>
                        <li class="{{ @$elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            <li class="{{ @$elementActive == 'user' || @$elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" class="collapsed" href="#newsletter">
                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>
                            {{ __('Newsletter') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="newsletter">
                    <ul class="nav">
                        <li class="{{ @$elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">{{ __('LA') }}</span>
                                <span class="sidebar-normal">{{ __(' List All') }}</span>
                            </a>
                        </li>
                        {{-- <li class="{{ @$elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">{{ __('UP') }}</span>
                                <span class="sidebar-normal">{{ __(' User Profile ') }}</span>
                            </a>
                        </li>
                        <li class="{{ @$elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            <li class="{{ @$elementActive == 'user' || @$elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" class="collapsed" href="#userMangement">
                    <i class="nc-icon nc-circle-10"></i>
                    <p>
                            {{ __('User Mangement') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="userMangement">
                    <ul class="nav">
                        <li class="{{ @$elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">{{ __('UP') }}</span>
                                <span class="sidebar-normal">{{ __(' User Profile ') }}</span>
                            </a>
                        </li>
                        <li class="{{ @$elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan
            <li class="{{ @$elementActive == 'icons' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'icons') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>
            <li class="{{ @$elementActive == 'map' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'map') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __('Maps') }}</p>
                </a>
            </li>
            <li class="{{ @$elementActive == 'notifications' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'notifications') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
            <li class="{{ @$elementActive == 'tables' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'tables') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>{{ __('Table List') }}</p>
                </a>
            </li>
            <li class="{{ @$elementActive == 'typography' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'typography') }}">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>{{ __('Typography') }}</p>
                </a>
            </li>
            <li class="active-pro {{ @$elementActive == 'upgrade' ? 'active' : '' }}">
                <a href="#" class="bg-danger">
                    <i class="nc-icon nc-spaceship text-white"></i>
                    <p class="text-white">{{ __('Upgrade to PRO') }}</p>
                </a>
            </li>
        </ul>
    </div>
    @endcan
</div>

