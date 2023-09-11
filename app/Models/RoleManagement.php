<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleManagement extends Model
{
    use HasFactory;
    protected $fillable = [
        'role',
        'make_admin_user',
        'manage_admin_users',
        'edit_admin_users',
        'change_admin_picture',
        'assign_admin_role',
        'remove_admin_user',
        'create_admin_user',
        'manage_registered_users',
        'activate_registered_users',
        'block_registered_users',
        'edit_registered_users',
        'change_registered_users_picture',
        'manage_newsletter_subscribers',
        'role_management',
        'manage_categories',
        'manage_items',
        'transaction_log',
        'payment_notifications',
        'manage_pending_orders',
        'manage_confirmed_orders',
        'manage_delivered_orders',
        'manage_cancelled_orders',
        'manage_general_inbox',
        'send_emails',
        'manage_project_photos',
        'date_created',
        'created_by',
        'date_updated',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
