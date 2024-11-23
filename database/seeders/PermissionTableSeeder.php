<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
        
            ['name' => 'create-register-asset', 'type' => 'register'],
            ['name' => 'read-register-asset', 'type' => 'register'],
            ['name' => 'update-register-asset', 'type' => 'register'],
            ['name' => 'delete-register-asset', 'type' => 'register'],

            ['name' => 'create-asset-movement', 'type' => 'movement'],
            ['name' => 'read-asset-movement', 'type' => 'movement'],
            ['name' => 'update-asset-movement', 'type' => 'movement'],
            ['name' => 'delete-asset-movement', 'type' => 'movement'],

            ['name' => 'create-master-data-asset', 'type' => 'master'],
            ['name' => 'read-master-data-asset', 'type' => 'master'],
            ['name' => 'update-master-data-asset', 'type' => 'master'],
            ['name' => 'delete-master-data-asset', 'type' => 'master'],

            ['name' => 'create-master-asset-equipment-data', 'type' => 'equipment'],
            ['name' => 'read-master-asset-equipment-data', 'type' => 'equipment'],
            ['name' => 'update-master-asset-equipment-data', 'type' => 'equipment'],
            ['name' => 'delete-master-asset-equipment-data', 'type' => 'equipment'],

            ['name' => 'create-master-brand-data', 'type' => 'brand'],
            ['name' => 'read-master-brand-data', 'type' => 'brand'],
            ['name' => 'update-master-brand-data', 'type' => 'brand'],
            ['name' => 'delete-master-brand-data', 'type' => 'brand'],

            ['name' => 'create-master-category-data', 'type' => 'category'],
            ['name' => 'read-master-category-data', 'type' => 'category'],
            ['name' => 'update-master-category-data', 'type' => 'category'],
            ['name' => 'delete-master-category-data', 'type' => 'category'],

            ['name' => 'create-master-sub-category-data', 'type' => 'sub-category'],
            ['name' => 'read-master-sub-category-data', 'type' => 'sub-category'],
            ['name' => 'update-master-sub-category-data', 'type' => 'sub-category'],
            ['name' => 'delete-master-sub-category-data', 'type' => 'sub-category'],

            ['name' => 'create-master-checklist-data', 'type' => 'checklist'],
            ['name' => 'read-master-checklist-data',   'type' => 'checklist'],
            ['name' => 'update-master-checklist-data', 'type' => 'checklist'],
            ['name' => 'delete-master-checklist-data', 'type' => 'checklist'],

            ['name' => 'create-master-condition-data', 'type' => 'condition'],
            ['name' => 'read-master-condition-data',    'type'=> 'condition'],
            ['name' => 'update-master-condition-data', 'type' => 'condition'],
            ['name' => 'delete-master-condition-data', 'type' => 'condition'],

            
            ['name' => 'create-master-condition-data', 'type' => 'condition'],
            ['name' => 'read-master-condition-data',    'type'=> 'condition'],
            ['name' => 'update-master-condition-data', 'type' => 'condition'],
            ['name' => 'delete-master-condition-data', 'type' => 'condition'],


            ['name' => 'create-master-control-checklist-data', 'type' => 'control-checklist'],
            ['name' => 'read-master-control-checklist-data',    'type'=> 'control-checklist'],
            ['name' => 'update-master-control-checklist-data', 'type' => 'control-checklist'],
            ['name' => 'delete-master-control-checklist-data', 'type' => 'control-checklist'],

            ['name' => 'create-master-department-data', 'type' => 'department'],
            ['name' => 'read-master-department-data',   'type' => 'department'],
            ['name' => 'update-master-department-data', 'type' => 'department'],
            ['name' => 'delete-master-department-data', 'type' => 'department'],

            ['name' => 'create-master-division-data', 'type' => 'division'],
            ['name' => 'read-master-division-data',   'type' => 'division'],
            ['name' => 'update-master-division-data', 'type' => 'division'],
            ['name' => 'delete-master-division-data', 'type' => 'division'],

            ['name' => 'create-master-group-user-data', 'type' => 'group-user'],
            ['name' => 'read-master-group-user-data',   'type' => 'group-user'],
            ['name' => 'update-master-group-user-data', 'type' => 'group-user'],
            ['name' => 'delete-master-group-user-data', 'type' => 'group-user'],

            ['name' => 'create-master-job-level-data', 'type' => 'job-level'],
            ['name' => 'read-master-job-level-data',   'type' => 'job-level'],
            ['name' => 'update-master-job-level-data', 'type' => 'job-level'],
            ['name' => 'delete-master-job-level-data', 'type' => 'job-level'],

            ['name' => 'create-master-layout-data', 'type' => 'layout'],
            ['name' => 'read-master-layout-data',   'type' => 'layout'],
            ['name' => 'update-master-layout-data', 'type' => 'layout'],
            ['name' => 'delete-master-layout-data', 'type' => 'layout'],

            ['name' => 'create-master-location-data', 'type' => 'location'],
            ['name' => 'read-master-location-data',   'type' => 'location'],
            ['name' => 'update-master-location-data', 'type' => 'location'],
            ['name' => 'delete-master-location-data', 'type' => 'location'],

            ['name' => 'create-master-maintenance-data', 'type' => 'maintenance'],
            ['name' => 'read-master-maintenance-data',   'type' => 'maintenance'],
            ['name' => 'update-master-maintenance-data', 'type' => 'maintenance'],
            ['name' => 'delete-master-maintenance-data', 'type' => 'maintenance'],

            ['name' => 'create-master-people-data', 'type' => 'people'],
            ['name' => 'read-master-people-data',   'type' => 'people'],
            ['name' => 'update-master-people-data', 'type' => 'people'],
            ['name' => 'delete-master-people-data', 'type' => 'people'],


            ['name' => 'create-master-tipe-asset-data', 'type' => 'tipe-asset'],
            ['name' => 'read-master-tipe-asset-data',   'type' => 'tipe-asset'],
            ['name' => 'update-master-tipe-asset-data', 'type' => 'tipe-asset'],
            ['name' => 'delete-master-tipe-asset-data', 'type' => 'tipe-asset'],

            ['name' => 'create-master-tipe-asset-data', 'type' => 'tipe-asset'],
            ['name' => 'read-master-tipe-asset-data',   'type' => 'tipe-asset'],
            ['name' => 'update-master-tipe-asset-data', 'type' => 'tipe-asset'],
            ['name' => 'delete-master-tipe-asset-data', 'type' => 'tipe-asset'],

            ['name' => 'create-master-tipe-asset-data', 'type' => 'tipe-asset'],
            ['name' => 'read-master-tipe-asset-data',   'type' => 'tipe-asset'],
            ['name' => 'update-master-tipe-asset-data', 'type' => 'tipe-asset'],
            ['name' => 'delete-master-tipe-asset-data', 'type' => 'tipe-asset'],

            ['name' => 'create-master-tipe-asset-data', 'type' => 'tipe-asset'],
            ['name' => 'read-master-tipe-asset-data',   'type' => 'tipe-asset'],
            ['name' => 'update-master-tipe-asset-data', 'type' => 'tipe-asset'],
            ['name' => 'delete-master-tipe-asset-data', 'type' => 'tipe-asset'],







        ];
        
        foreach ($permissions as $permission) {
             Permission::create(
                [
                    'name' => $permission['name'],
                    'type' => $permission['type'],
                ],
                
            );
        }
    }
}
