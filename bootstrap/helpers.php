<?php

use App\Models\Setting;
use App\Models\User;

// Social Links
if (!function_exists('siteSocialLinks')) {
    function siteSocialLinks()
    {
        $adminUsers = User::role('Admin')->first();
        return $adminUsers;
    }
}

// Settings
if (!function_exists('settings')) {
    function settings()
    {
        $settings = Setting::first();
        return $settings;
    }
}
