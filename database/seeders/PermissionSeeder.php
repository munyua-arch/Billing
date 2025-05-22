<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            // User & Role Management
            'user-list', 'user-create', 'user-edit', 'user-delete', 'user-suspend',
            'role-list', 'role-create', 'role-edit', 'role-delete', 'permission-assign',
        
            // Customer Management
            'customer-list', 'customer-create', 'customer-edit', 'customer-delete', 
            'customer-suspend', 'customer-import', 'customer-export',
        
            // Billing & Payments
            'invoice-generate', 'invoice-edit', 'invoice-void', 'invoice-refund',
            'payment-process', 'payment-reverse', 'discount-apply', 'tax-manage',
            'plan-create', 'plan-edit', 'plan-delete',
        
            // Network & Services
            'service-activate', 'service-suspend', 'service-terminate', 
            'bandwidth-assign', 'ip-manage', 'radius-sync', 'qos-configure',
        
            // Support & Tickets
            'ticket-create', 'ticket-assign', 'ticket-resolve', 'ticket-delete',
            'knowledgebase-manage', 'announcement-send',
        
            // Reports & Analytics
            'report-financial', 'report-usage', 'report-customer', 'report-network',
            'report-export-pdf', 'report-export-excel',
        
            // System & Configuration
            'settings-global', 'backup-manage', 'log-view', 'api-manage',
            'integration-payment-gateway', 'integration-sms-email',
        ];


        foreach($permissions as $key => $permission)
        {
            Permission::create(['name' => $permission]);
        }
    }
}