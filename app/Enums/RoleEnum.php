<?php

namespace App\Enums;

enum RoleEnum : int
{
    // Admin Dashboard
    case SUPER_ADMIN = 1;
    case ADMIN_FINANCE = 2;
    case ADMIN_MARKETING = 3;
    case ADMIN_SUPPORT = 4;

    // Partner Dashboard
    case PARTNER_ADMIN = 5;
    case PARTNER_FINANCE = 6;
    case PARTNER_RESERVATION = 7;

    // Client Dashboard
    case CLIENT = 8;


    public function lang(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => trns('super_admin'),
            self::ADMIN_FINANCE => trns('admin_finance'),
            self::ADMIN_MARKETING => trns('admin_marketing'),
            self::ADMIN_SUPPORT => trns('admin_support'),
            self::PARTNER_ADMIN => trns('partner_admin'),
            self::PARTNER_FINANCE => trns('partner_finance'),
            self::PARTNER_RESERVATION => trns('partner_reservation'),
            self::CLIENT => trns('client'),
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'super_admin',
            self::ADMIN_FINANCE => 'admin_finance',
            self::ADMIN_MARKETING => 'admin_marketing',
            self::ADMIN_SUPPORT => 'admin_support',
            self::PARTNER_ADMIN => 'partner_admin',
            self::PARTNER_FINANCE => 'partner_finance',
            self::PARTNER_RESERVATION => 'partner_reservation',
            self::CLIENT => 'client',
        };
    }
}
