<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="{{ route('adminHome') }}">
            <img src="{{ getFile(isset($setting) ? $setting->logo : null)}}" class="header-brand-img" alt="logo">
        </a>
        <!-- LOGO -->
    </div>
    <ul class="side-menu">
        <li><h3>{{ trns('elements') }}</h3></li>

        @can('view_home')
            <li class="slide">
                <a class="side-menu__item {{ Route::currentRouteName() == 'adminHome' ? 'active' : '' }}" href="{{ route('adminHome') }}">
                    <i class="fa fa-home side-menu__icon"></i>
                    <span class="side-menu__label">{{ trns('home') }}</span>
                </a>
            </li>
        @endcan

        @can('view_admins')
            <li class="slide">
                <a class="side-menu__item {{ Route::currentRouteName() == 'admins.index' ? 'active' : '' }}" href="{{ route('admins.index') }}">
                    <i class="fa fa-users side-menu__icon"></i>
                    <span class="side-menu__label">{{ trns('admins') }}</span>
                </a>
            </li>
        @endcan

        @can('view_customers')
            <li class="slide">
                <a class="side-menu__item {{ Route::currentRouteName() == 'customers.index' ? 'active' : '' }}" href="{{ route('customers.index') }}">
                    <i class="fa fa-user-friends side-menu__icon"></i>
                    <span class="side-menu__label">{{ trns('customers') }}</span>
                </a>
            </li>
        @endcan

        @can('view_categories')
            <li class="slide">
                <a class="side-menu__item {{ Route::currentRouteName() == 'categories.index' ? 'active' : '' }}" href="{{ route('categories.index') }}">
                    <i class="fa fa-box-open side-menu__icon"></i>
                    <span class="side-menu__label">{{ trns('categories') }}</span>
                </a>
            </li>
        @endcan

        @can('view_products')
            <li class="slide">
                <a class="side-menu__item {{ Route::currentRouteName() == 'products.index' ? 'active' : '' }}" href="{{ route('products.index') }}">
                    <i class="fa fa-box side-menu__icon"></i>
                    <span class="side-menu__label">{{ trns('products') }}</span>
                </a>
            </li>
        @endcan

        @can('view_wastes_section')
            <li class="slide">
                <a class="side-menu__item {{ Route::currentRouteName() == 'wastes_section.index' ? 'active' : '' }}" href="{{ route('wastes_section.index') }}">
                    <i class="fa fa-trash side-menu__icon"></i>
                    <span class="side-menu__label">{{ trns('waste_section') }}</span>
                </a>
            </li>
        @endcan

        @can('view_wastes')
            <li class="slide">
                <a class="side-menu__item {{ Route::currentRouteName() == 'wastes.index' ? 'active' : '' }}" href="{{ route('wastes.index') }}">
                    <i class="fa fa-trash-restore-alt side-menu__icon"></i>
                    <span class="side-menu__label">{{ trns('wastes') }}</span>
                </a>
            </li>
        @endcan

        @can('view_transfer_points')
            <li class="slide">
                <a class="side-menu__item {{ Route::currentRouteName() == 'transfer_points.index' ? 'active' : '' }}" href="{{ route('transfer_points.index') }}">
                    <i class="fa fa-exchange-alt side-menu__icon"></i>
                    <span class="side-menu__label">{{ trns('transfer_points') }}</span>
                </a>
            </li>
        @endcan

        @can('view_orders')
            <li class="slide">
                <a class="side-menu__item {{ Route::currentRouteName() == 'orders.index' ? 'active' : '' }}" href="{{ route('orders.index') }}">
                    <i class="fa fa-list side-menu__icon"></i>
                    <span class="side-menu__label">{{ trns('orders') }}</span>
                </a>
            </li>
        @endcan

        @can('view_orders')
            <li class="slide">
                <a class="side-menu__item {{ Route::currentRouteName() == 'orders.showOrder' ? 'active' : '' }}" href="{{ route('orders.showOrder') }}">
                    <i class="fa fa-list side-menu__icon"></i>
                    <span class="side-menu__label">طلبات التوصيل</span>
                </a>
            </li>
        @endcan

{{--        @can('view_invite_links')--}}
{{--            <li class="slide">--}}
{{--                <a class="side-menu__item {{ Route::currentRouteName() == 'invite_links.index' ? 'active' : '' }}" href="{{ route('invite_links.index') }}">--}}
{{--                    <i class="fa fa-link side-menu__icon"></i>--}}
{{--                    <span class="side-menu__label">{{ trns('invitation_link') }}</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        @endcan--}}

        @can('view_settings')
            <li class="slide">
                <a class="side-menu__item {{ Route::currentRouteName() == 'settingIndex' ? 'active' : '' }}" href="{{ route('settingIndex') }}">
                    <i class="fa fa-wrench side-menu__icon"></i>
                    <span class="side-menu__label">{{ trns('settings') }}</span>
                </a>
            </li>
        @endcan

        @can('logout')
            <li class="slide">
                <a class="side-menu__item {{ Route::currentRouteName() == 'admin.logout' ? 'active' : '' }}" href="{{ route('admin.logout') }}">
                    <i class="fa fa-lock side-menu__icon"></i>
                    <span class="side-menu__label">{{ trns('logout') }}</span>
                </a>
            </li>
        @endcan

    </ul>
</aside>
