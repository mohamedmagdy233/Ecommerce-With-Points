<?php

namespace App\Enums;

enum RoleEnum: string
{
    case VIEW_HOME = 'view_home';  // Permission to view the home/dashboard page
    case VIEW_ADMINS = 'view_admins';  // Permission to view the admins list
    case VIEW_CUSTOMERS = 'view_customers';  // Permission to view the customers list
    case VIEW_CATEGORIES = 'view_categories';  // Permission to view categories
    case VIEW_PRODUCTS = 'view_products';  // Permission to view products
    case VIEW_WASTES_SECTION = 'view_wastes_section';  // Permission to view waste sections
    case VIEW_WASTES = 'view_wastes';  // Permission to view wastes
    case VIEW_TRANSFER_POINTS = 'view_transfer_points';  // Permission to view transfer points
    case VIEW_ORDERS = 'view_orders';  // Permission to view orders
    case VIEW_INVITE_LINKS = 'view_invite_links';  // Permission to view invitation links
    case VIEW_SETTINGS = 'view_settings';  // Permission to view settings
    case LOGOUT = 'logout';  // Permission to logout (not typically used for permission checking)

    // Additional permissions that correspond to actions in your application

    case ADD_NEW_CUSTOMER = 'add_customer';
    case EDIT_NEW_CUSTOMER = 'edit_customer';
    case DELETE_NEW_CUSTOMER = 'delete_customer';

    case ADD_NEW_ADMIN = 'add_admin';
    case EDIT_NEW_ADMIN = 'edit_admin';
    case DELETE_NEW_ADMIN = 'delete_admin';


    case ADD_CATEGORY = 'add_category';
    case EDIT_CATEGORY = 'edit_category';
    case DELETE_CATEGORY = 'delete_category';

    case ADD_PRODUCT = 'add_product';        // Permission to add a product
    case EDIT_PRODUCT = 'edit_product';      // Permission to edit a product
    case DELETE_PRODUCT = 'delete_product';  // Permission to delete a product

    case ADD_WASTES_SECTION = 'add_wastes_section';        // Permission to add a waste section
    case EDIT_WASTES_SECTION = 'edit_wastes_section';      // Permission to edit a waste section
    case DELETE_WASTES_SECTION = 'delete_wastes_section';  // Permission to delete a waste section
    case ADD_WASTE = 'add_waste';        // Permission to add a waste
    case EDIT_WASTE = 'edit_waste';      // Permission to edit a waste
    case DELETE_WASTE = 'delete_waste';  // Permission to delete a waste

    case ADD_ORDER = 'add_order';        // Permission to add an order
    case EDIT_ORDER = 'edit_order';      // Permission to edit an order
    case DELETE_ORDER = 'delete_order';  // Permission to delete an order
    case ADD_SETTING = 'add_setting';        // Permission to add a setting
    case EDIT_SETTING = 'edit_setting';      // Permission to edit a setting
    case DELETE_SETTING = 'delete_setting';  // Permission to delete a setting

    public function toArabic(): string
    {
        return match ($this) {
            self::VIEW_HOME => 'عرض الصفحة الرئيسية',
            self::VIEW_ADMINS => 'عرض قائمة المسؤولين',
            self::VIEW_CUSTOMERS => 'عرض قائمة العملاء',
            self::VIEW_CATEGORIES => 'عرض الفئات',
            self::VIEW_PRODUCTS => 'عرض المنتجات',
            self::VIEW_WASTES_SECTION => 'عرض أقسام النفايات',
            self::VIEW_WASTES => 'عرض النفايات',
            self::VIEW_TRANSFER_POINTS => 'عرض نقاط التحويل',
            self::VIEW_ORDERS => 'عرض الطلبات',
            self::VIEW_INVITE_LINKS => 'عرض روابط الدعوة',
            self::VIEW_SETTINGS => 'عرض الإعدادات',
            self::LOGOUT => 'تسجيل الخروج',

            // Additional translations
            self::ADD_NEW_CUSTOMER => 'إضافة عميل جديد',
            self::EDIT_NEW_CUSTOMER => 'تعديل عميل جديد',
            self::DELETE_NEW_CUSTOMER => 'حذف عميل جديد',

            self::ADD_NEW_ADMIN => 'إضافة مسؤول جديد',
            self::EDIT_NEW_ADMIN => 'تعديل مسؤول جديد',
            self::DELETE_NEW_ADMIN => 'حذف مسؤول جديد',

            self::ADD_CATEGORY => 'إضافة فئة',
            self::EDIT_CATEGORY => 'تعديل فئة',
            self::DELETE_CATEGORY => 'حذف فئة',

            self::ADD_PRODUCT => 'إضافة منتج',
            self::EDIT_PRODUCT => 'تعديل منتج',
            self::DELETE_PRODUCT => 'حذف منتج',

            self::ADD_WASTES_SECTION => 'إضافة قسم النفايات',
            self::EDIT_WASTES_SECTION => 'تعديل قسم النفايات',
            self::DELETE_WASTES_SECTION => 'حذف قسم النفايات',
            self::ADD_WASTE => 'إضافة نفاية',
            self::EDIT_WASTE => 'تعديل نفاية',
            self::DELETE_WASTE => 'حذف نفاية',

            self::ADD_ORDER => 'إضافة طلب',
            self::EDIT_ORDER => 'تعديل طلب',
            self::DELETE_ORDER => 'حذف طلب',
            self::ADD_SETTING => 'إضافة إعداد',
            self::EDIT_SETTING => 'تعديل إعداد',
            self::DELETE_SETTING => 'حذف إعداد',
        };
    }




}
