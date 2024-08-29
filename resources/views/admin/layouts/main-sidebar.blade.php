<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="{{route('adminHome')}}">
            <img src="{{ getFile(isset($setting) ? $setting->logo : null)}}"
                 class="header-brand-img" alt="logo">
        </a>
        <!-- LOGO -->
    </div>
    <ul class="side-menu">
        <li><h3>{{ trns('elements') }}</h3></li>
        <li class="slide">
            <a class="side-menu__item  {{ Route::currentRouteName() == 'adminHome' ? 'active' : '' }}" href="{{route('adminHome')}}">
                <i class="fa fa-home side-menu__icon"></i>
                <span class="side-menu__label">{{ trns('home') }}</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item  {{ Route::currentRouteName() == 'admins.index' ? 'active' : '' }}" href="{{route('admins.index')}}">
                <i class="fa fa-users side-menu__icon"></i>
                <span class="side-menu__label">{{ trns('admins') }}</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item  {{ Route::currentRouteName() == 'customers.index' ? 'active' : '' }}" href="{{route('customers.index')}}">
                <i class="fa fa-user-friends side-menu__icon"></i>
                <span class="side-menu__label">{{ trns('customers') }}</span>
            </a>
        </li>


        <li class="slide">
            <a class="side-menu__item  {{ Route::currentRouteName() == 'products.index' ? 'active' : '' }}" href="{{route('products.index')}}">
                <i class="fa fa-box side-menu__icon"></i>
                <span class="side-menu__label">{{ trns('products') }}</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item  {{ Route::currentRouteName() == 'wastes.index' ? 'active' : '' }}" href="{{route('wastes.index')}}">
                <i class="fa fa-trash side-menu__icon"></i>
                <span class="side-menu__label">{{ trns('wastes') }}</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item  {{ Route::currentRouteName() == 'transfer_points.index' ? 'active' : '' }}" href="{{route('transfer_points.index')}}">
                <i class="fa fa-exchange-alt side-menu__icon"></i>
                <span class="side-menu__label">{{ trns('transfer_points') }}</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item  {{ Route::currentRouteName() == 'orders.index' ? 'active' : '' }}" href="{{route('orders.index')}}">
                <i class="fa fa-list side-menu__icon"></i>
                <span class="side-menu__label">{{ trns('orders') }}</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item  {{ Route::currentRouteName() == 'invite_links.index' ? 'active' : '' }}" href="{{route('invite_links.index')}}">
                <i class="fa fa-link side-menu__icon"></i>
                <span class="side-menu__label">{{ trns('invitation_link') }}</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item  {{ Route::currentRouteName() == 'settingIndex' ? 'active' : '' }}" href="{{route('settingIndex')}}">
                <i class="fa fa-wrench side-menu__icon"></i>
                <span class="side-menu__label">{{ trns('settings') }}</span>
            </a>
        </li>


        <li class="slide">
            <a class="side-menu__item {{ Route::currentRouteName() == 'admin.logout' ? 'active' : '' }}" href="{{route('admin.logout')}}">
                <i class="fa fa-lock side-menu__icon"></i>
                <span class="side-menu__label">{{ trns('logout') }}</span>
            </a>
        </li>

    </ul>
</aside>

