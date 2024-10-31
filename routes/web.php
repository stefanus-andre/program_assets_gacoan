<?php
namespace App\Http\Controllers;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RegistrasiAssetController;

use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\User\UserController;

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\DeptController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\JobLevelController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MtcController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PeriodicMtcController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ReasonController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UomController;
use App\Http\Controllers\WarrantyController;
use App\Http\Controllers\ProfileController; // Pastikan ini sesuai dengan namespace baru
use App\Models\Master\MasterRegistrasiModel;

// Show the login form
Route::get('/', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login'); // Pastikan nama metode ditulis kecil
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    // Route::resource('products', );
});

// registrasi data asset
Route::prefix('admin/registrasi_asset')->group(function(){
    Route::get('/lihat_data_registrasi_asset', [RegistrasiAssetController::class, 'HalamanRegistrasiAsset']);
    Route::get('/get_data_registrasi_asset',[RegistrasiAssetController::class, 'GetDataRegistrasiAsset']);
    Route::post('/tambah_data_registrasi_asset', [RegistrasiAssetController::class,'AddDataRegistrasiAsset']);
    Route::get('/get_detail_data_asset/{id}', [RegistrasiAssetController::class,'GetDetailDataRegistrasiAsset']);
    Route::put('/admin/registrasi_asset/update_data_registrasi_asset/{id}', [RegistrasiAssetController::class, 'update']);
    Route::delete('/delete_data_registrasi_asset/{id}', [RegistrasiAssetController::class, 'DeleteDataRegistrasiAsset']);
    Route::get('/export_data_asset', [RegistrasiAssetController::class,'ExportToExcel']);
    Route::post('/import', [RegistrasiAssetController::class, 'import'])->name('import');
   
}); 
Route::get('/admin/registrasi_asset/get_detail/{id}', [RegistrasiAssetController::class, 'GetDetailDataRegistrasiAsset']);
Route::put('/admin/registrasi_asset/update_data_registrasi_asset/{id}', [RegistrasiAssetController::class, 'update']);
Route::post('admin/registrasi_asset/approve', [RegistrasiAssetController::class, 'approve']);
Route::get('/assets/details/{register_code}', [RegistrasiAssetController::class, 'TampilDataQR'])->name('assets.details');
Route::get('/get-location/{id}', [LocationController::class, 'GetLocation']);

Route::group([RoleMiddleware::class => ':admin'], function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    // Asset Route
    Route::get('/admin/halaman_asset', [AdminController::class, 'HalamanAsset']);
    Route::get('/admin/GetDataAsset', [AdminController::class, 'GetDataAsset']);
    Route::get('/admin/get_detail_data_asset/{id}', [AdminController::class, 'GetDetailDataAsset']);
    Route::post('/admin/add_data_asset', [AdminController::class, 'AddDataAsset']);

    // Regist Assets
    Route::get('/admin/regist', [AssetsController::class, 'HalamanAssets']);
    Route::get('/admin/regist', [AssetsController::class, 'HalamanAssets'])->name('Admin.asset');
    Route::post('/add-regist', [AssetsController::class, 'AddDataAssets'])->name('add-regist');
    Route::get('/get-regist', [AssetsController::class, 'GetAssets'])->name('get.asset');
    Route::get('/admin/regists', [AssetsController::class, 'Index'])->name('Admin.asset');
    Route::get('/admin/regists/edit/{id}', [AssetsController::class, 'showEditForm'])->name('edit.asset');
    Route::put('/admin/regists/edit/{id}', [AssetsController::class, 'updateDataAssets'])->name('update.asset');
    Route::delete('/admin/regists/delete/{id}', [AssetsController::class, 'deleteDataAssets'])->name('delete.asset');
    Route::get('/add-regist', [AssetsController::class, 'showForm'])->name('addDataAsset');

    Route::get('/admin/get-regist', [AssetsController::class, 'GetAssets']);


    // Regist Assets Equipment
    Route::get('/admin/registeqp', [AssetsController::class, 'HalamanAssetsEquipment']);
    Route::get('/admin/registeqp', [AssetsController::class, 'HalamanAssetsEquipment'])->name('Admin.assetequipment');
    Route::post('/add-regist', [AssetsController::class, 'AddDataAssets'])->name('add-regist');
    Route::get('/get-regist', [AssetsController::class, 'GetAssets'])->name('get.asset');
    Route::get('/admin/regists', [AssetsController::class, 'Index'])->name('Admin.asset');
    Route::get('/admin/regists/edit/{id}', [AssetsController::class, 'showEditForm'])->name('edit.asset');
    Route::put('/admin/regists/edit/{id}', [AssetsController::class, 'updateDataAssets'])->name('update.asset');
    Route::delete('/admin/regists/delete/{id}', [AssetsController::class, 'deleteDataAssets'])->name('delete.asset');
    Route::get('/add-regist', [AssetsController::class, 'showForm'])->name('addDataAsset');
    
    
    // Approval Reg OPS SM
    Route::get('/admin/approval-reg', [AssetsController::class, 'HalamanApproval']);
    Route::get('/admin/approval-reg', [AssetsController::class, 'HalamanApproval'])->name('Admin.approval-reg');
    Route::post('/add-approval-reg', [AssetsController::class, 'AddDataApproval'])->name('add.approval-reg');
    Route::get('/get-approval-reg', [AssetsController::class, 'GetApproval'])->name('get.approval-reg');
    Route::get('/admin/approval-regs', [AssetsController::class, 'Index'])->name('Admin.approval-reg');
    Route::get('/admin/approval-regs/edit/{id}', [AssetsController::class, 'showEditForm'])->name('edit.approval-reg');
    Route::put('/admin/approval-regs/edit/{id}', [AssetsController::class, 'updateDataApproval'])->name('update.approval-reg');
    Route::delete('/admin/approval-regs/delete/{id}', [AssetsController::class, 'deleteDataApproval'])->name('delete.approval-reg');
    
    // Review Reg OPS SM
    Route::get('/admin/review-reg', [AssetsController::class, 'HalamanReview']);
    Route::get('/admin/review-reg', [AssetsController::class, 'HalamanReview'])->name('Admin.review-reg');
    Route::post('/add-review-reg', [AssetsController::class, 'AddDataReview'])->name('add.review-reg');
    Route::get('/get-review-reg', [AssetsController::class, 'GetReview'])->name('get.review-reg');
    Route::get('/admin/review-regs', [AssetsController::class, 'Index'])->name('Admin.review-reg');
    Route::get('/admin/review-regs/edit/{id}', [AssetsController::class, 'showEditForm'])->name('edit.review-reg');
    Route::put('/admin/review-regs/edit/{id}', [AssetsController::class, 'updateDataReview'])->name('update.review-reg');
    Route::delete('/admin/review-regs/delete/{id}', [AssetsController::class, 'deleteDataReview'])->name('delete.review-reg');

    

    // Route::get('/admin/regist', [AssetsController::class, 'index'])->name('admin.assets');
    // Route::post('/admin/regist', [AssetsController::class, 'addDataAssets'])->name('add-asset');
    // Route::get('/admin/regists/{id}', [AssetsController::class, 'getAssets'])->name('get.asset');
    // Route::get('/admin/regists/edit/{id}', [AssetsController::class, 'showEditForm'])->name('edit.asset');
    // Route::put('/admin/regists/edit/{id}', [AssetsController::class, 'updateDataAssets'])->name('update.asset');
    // Route::delete('/admin/regists/{id}', [AssetsController::class, 'deleteDataAssets'])->name('delete.asset');

    // Brand
    Route::get('/admin/brand', [BrandController::class, 'HalamanBrand']);
    Route::get('/admin/brand', [BrandController::class, 'HalamanBrand'])->name('Admin.brand');
    Route::post('/add-brand', [BrandController::class, 'AddDataBrand'])->name('add.brand');
    Route::get('/get-brand', [BrandController::class, 'GetBrand'])->name('get.brand');
    Route::get('/admin/brands', [BrandController::class, 'Index'])->name('Admin.brand');
    Route::get('/admin/brands/edit/{id}', [BrandController::class, 'showEditForm'])->name('edit.brand');
    Route::put('/admin/brands/edit/{id}', [BrandController::class, 'updateDataBrand'])->name('update.brand');
    Route::delete('/admin/brands/delete/{id}', [BrandController::class, 'deleteDataBrand'])->name('delete.brand');
    Route::get('/admin/get-brand', [BrandController::class, 'GetBrand'])->name('get.brand');

    // Category
    Route::get('/admin/category', [CategoryController::class, 'HalamanCategory']);
    Route::get('/admin/category', [CategoryController::class, 'HalamanCategory'])->name('Admin.category');
    Route::post('/add-category', [CategoryController::class, 'AddDataCategory'])->name('add-category');
    Route::get('/get-category', [CategoryController::class, 'GetCategory'])->name('get.category');
    Route::get('/admin/categorys', [CategoryController::class, 'Index'])->name('Admin.category');
    Route::get('/admin/categorys/edit/{id}', [CategoryController::class, 'showEditForm'])->name('edit.category');
    Route::put('/admin/categorys/edit/{id}', [CategoryController::class, 'updateDataCategory'])->name('update.category');
    Route::delete('/admin/categorys/delete/{id}', [CategoryController::class, 'deleteDataCategory'])->name('delete.category');
    // Sub Category
    Route::get('/admin/subcategory', [SubCategoryController::class, 'HalamanSubCategory']);
    Route::get('/admin/subcategory', [SubCategoryController::class, 'HalamanSubCategory'])->name('Admin.subcategory');
    Route::post('/add-subcategory', [SubCategoryController::class, 'AddDataSubCategory'])->name('add-subcategory');
    Route::get('/get-subcategory', [SubCategoryController::class, 'GetSubCategory'])->name('get.subcategory');
    Route::get('/admin/subcategorys', [SubCategoryController::class, 'Index'])->name('Admin.subcategory');
    Route::get('/admin/subcategorys/edit/{id}', [SubCategoryController::class, 'showEditForm'])->name('edit.subcategory');
    Route::put('/admin/subcategorys/edit/{id}', [SubCategoryController::class, 'updateDataSubCategory'])->name('update.subcategory');
    Route::delete('/admin/subcategorys/delete/{id}', [SubCategoryController::class, 'deleteDataSubCategory'])->name('delete.subcategory');
    // Checklist
    Route::get('/admin/checklist', [ChecklistController::class, 'HalamanChecklist']);
    Route::get('/admin/checklist', [ChecklistController::class, 'HalamanChecklist'])->name('Admin.checklist');
    Route::post('/add-checklist', [ChecklistController::class, 'AddDataChecklist'])->name('add.checklist');
    Route::get('/get-checklist', [ChecklistController::class, 'GetChecklist'])->name('get.checklist');
    Route::get('/admin/checklists', [ChecklistController::class, 'Index'])->name('Admin.checklist');
    Route::get('/admin/checklists/edit/{id}', [ChecklistController::class, 'showEditForm'])->name('edit.checklist');
    Route::put('/admin/checklists/edit/{id}', [ChecklistController::class, 'updateDataChecklist'])->name('update.checklist');
    Route::delete('/admin/checklists/delete/{id}', [ChecklistController::class, 'deleteDataChecklist'])->name('delete.checklist');
    // Control
    Route::get('/admin/control', [ControlController::class, 'HalamanControl']);
    Route::get('/admin/control', [ControlController::class, 'HalamanControl'])->name('Admin.control');
    Route::post('/add-control', [ControlController::class, 'AddDataControl'])->name('add.control');
    Route::get('/get-control', [ControlController::class, 'GetControl'])->name('get.control');
    Route::get('/admin/controls', [ControlController::class, 'Index'])->name('Admin.control');
    Route::get('/admin/controls/edit/{id}', [ControlController::class, 'showEditForm'])->name('edit.control');
    Route::put('/admin/controls/edit/{id}', [ControlController::class, 'updateDataControl'])->name('update.control');
    Route::delete('/admin/controls/delete/{id}', [ControlController::class, 'deleteDataControl'])->name('delete.control');
    // Condition
    Route::get('/admin/condition', [ConditionController::class, 'HalamanCondition']);
    Route::get('/admin/condition', [ConditionController::class, 'HalamanCondition'])->name('Admin.condition');
    Route::post('/add-condition', [ConditionController::class, 'AddDataCondition'])->name('add-condition');
    Route::get('/get-condition', [ConditionController::class, 'GetCondition'])->name('get.condition');
    Route::get('/admin/conditions', [ConditionController::class, 'Index'])->name('Admin.condition');
    Route::get('/admin/conditions/edit/{id}', [ConditionController::class, 'showEditForm'])->name('edit.condition');
    Route::put('/admin/conditions/edit/{id}', [ConditionController::class, 'updateDataCondition'])->name('update.condition');
    Route::delete('/admin/conditions/delete/{id}', [ConditionController::class, 'deleteDataCondition'])->name('delete.condition');
    // Dept
    Route::get('/admin/dept', [DeptController::class, 'HalamanDept']);
    Route::get('/admin/dept', [DeptController::class, 'HalamanDept'])->name('Admin.dept');
    Route::post('/add-dept', [DeptController::class, 'AddDataDept'])->name('add.dept');
    Route::get('/get-dept', [DeptController::class, 'GetDept'])->name('get.dept');
    Route::get('/admin/depts', [DeptController::class, 'Index'])->name('Admin.dept');
    Route::get('/admin/depts/edit/{id}', [DeptController::class, 'showEditForm'])->name('edit.dept');
    Route::put('/admin/depts/edit/{id}', [DeptController::class, 'updateDataDept'])->name('update.dept');
    Route::delete('/admin/depts/delete/{id}', [DeptController::class, 'deleteDataDept'])->name('delete.dept');
    // Division
    Route::get('/admin/division', [DivisionController::class, 'HalamanDivision']);
    Route::get('/admin/division', [DivisionController::class, 'HalamanDivision'])->name('Admin.division');
    Route::post('/add-division', [DivisionController::class, 'AddDataDivision'])->name('add.division');
    Route::get('/get-division', [DivisionController::class, 'GetDivision'])->name('get.division');
    Route::get('/admin/divisions', [DivisionController::class, 'Index'])->name('Admin.division');
    Route::get('/admin/divisions/edit/{id}', [DivisionController::class, 'showEditForm'])->name('edit.division');
    Route::put('/admin/divisions/edit/{id}', [DivisionController::class, 'updateDataDivision'])->name('update.division');
    Route::delete('/admin/divisions/delete/{id}', [DivisionController::class, 'deleteDataDivision'])->name('delete.division');
    // Group User
    Route::get('/admin/groupuser', [GroupUserController::class, 'HalamanGroupUser']);
    Route::get('/admin/groupuser', [GroupUserController::class, 'HalamanGroupUser'])->name('Admin.groupuser');
    Route::post('/add-groupuser', [GroupUserController::class, 'AddDataGroupUser'])->name('add-groupuser');
    Route::get('/get-groupuser', [GroupUserController::class, 'GetGroupUser'])->name('get.groupuser');
    Route::get('/admin/groupusers', [GroupUserController::class, 'Index'])->name('Admin.groupuser');
    Route::get('/admin/groupusers/edit/{id}', [GroupUserController::class, 'showEditForm'])->name('edit.groupuser');
    Route::put('/admin/groupusers/edit/{id}', [GroupUserController::class, 'updateDataGroupUser'])->name('update.groupuser');
    Route::delete('/admin/groupusers/delete/{id}', [GroupUserController::class, 'deleteDataGroupUser'])->name('delete.groupuser');
    // Job Level
    Route::get('/admin/joblevel', [JobLevelController::class, 'HalamanJobLevel']);
    Route::get('/admin/joblevel', [JobLevelController::class, 'HalamanJobLevel'])->name('Admin.joblevel');
    Route::post('/add-joblevel', [JobLevelController::class, 'AddDataJobLevel'])->name('add.joblevel');
    Route::get('/get-joblevel', [JobLevelController::class, 'GetJobLevel'])->name('get.joblevel');
    Route::get('/admin/joblevels', [JobLevelController::class, 'Index'])->name('Admin.joblevel');
    Route::get('/admin/joblevels/edit/{id}', [JobLevelController::class, 'showEditForm'])->name('edit.joblevel');
    Route::put('/admin/joblevels/edit/{id}', [JobLevelController::class, 'updateDataJobLevel'])->name('update.joblevel');
    Route::delete('/admin/joblevels/delete/{id}', [JobLevelController::class, 'deleteDataJobLevel'])->name('delete.joblevel');
    // Layout
    Route::get('/admin/layout', [LayoutController::class, 'HalamanLayout']);
    Route::get('/admin/layout', [LayoutController::class, 'HalamanLayout'])->name('Admin.layout');
    Route::post('/add-layout', [LayoutController::class, 'AddDataLayout'])->name('add.layout');
    Route::get('/get-layout', [LayoutController::class, 'GetLayout'])->name('get.layout');
    Route::get('/admin/layouts', [LayoutController::class, 'Index'])->name('Admin.layout');
    Route::get('/admin/layouts/edit/{id}', [LayoutController::class, 'showEditForm'])->name('edit.layout');
    Route::put('/admin/layouts/edit/{id}', [LayoutController::class, 'updateDataLayout'])->name('update.layout');
    Route::delete('/admin/layouts/delete/{id}', [LayoutController::class, 'deleteDataLayout'])->name('delete.layout');
    // Location
    Route::get('/admin/location', [LocationController::class, 'HalamanLocation']);
    Route::get('/admin/location', [LocationController::class, 'HalamanLocation'])->name('Admin.location');
    Route::post('/add-location', [LocationController::class, 'AddDataLocation'])->name('add.location');
    Route::get('/get-location', [LocationController::class, 'GetLocation'])->name('get.location');
    Route::get('/admin/locations', [LocationController::class, 'Index'])->name('Admin.location');
    Route::get('/admin/locations/edit/{id}', [LocationController::class, 'showEditForm'])->name('edit.location');
    Route::put('/admin/locations/edit/{id}', [LocationController::class, 'updateDataLocation'])->name('update.location');
    Route::delete('/admin/locations/delete/{id}', [LocationController::class, 'deleteDataLocation'])->name('delete.location');
    // Mtc
    Route::get('/admin/mtc', [MtcController::class, 'HalamanMtc']);
    Route::get('/admin/mtc', [MtcController::class, 'HalamanMtc'])->name('Admin.mtc');
    Route::post('/add-mtc', [MtcController::class, 'AddDataMtc'])->name('add.mtc');
    Route::get('/get-mtc', [MtcController::class, 'GetMtc'])->name('get.mtc');
    Route::get('/admin/mtcs', [MtcController::class, 'Index'])->name('Admin.mtc');
    Route::get('/admin/mtcs/edit/{id}', [MtcController::class, 'showEditForm'])->name('edit.mtc');
    Route::put('/admin/mtcs/edit/{id}', [MtcController::class, 'updateDataMtc'])->name('update.mtc');
    Route::delete('/admin/mtcs/delete/{id}', [MtcController::class, 'deleteDataMtc'])->name('delete.mtc');
    // People
    Route::get('/admin/people', [PeopleController::class, 'HalamanPeople']);
    Route::get('/admin/people', [PeopleController::class, 'HalamanPeople'])->name('Admin.people');
    Route::post('/add-people', [PeopleController::class, 'AddDataPeople'])->name('add.people');
    Route::get('/get-people', [PeopleController::class, 'GetPeople'])->name('get.people');
    Route::get('/admin/peoples', [PeopleController::class, 'Index'])->name('Admin.people');
    Route::get('/admin/peoples/edit/{id}', [PeopleController::class, 'showEditForm'])->name('edit.people');
    Route::put('/admin/peoples/edit/{id}', [PeopleController::class, 'updateDataPeople'])->name('update.people');
    Route::delete('/admin/peoples/delete/{id}', [PeopleController::class, 'deleteDataPeople'])->name('delete.people');
    // Periodic Mtc
    Route::get('/admin/periodic', [PeriodicMtcController::class, 'HalamanPeriodicMtc']);
    Route::get('/admin/periodic', [PeriodicMtcController::class, 'HalamanPeriodicMtc'])->name('Admin.periodic');
    Route::post('/add-periodic', [PeriodicMtcController::class, 'AddDataPeriodicMtc'])->name('add.periodic');
    Route::get('/get-periodic', [PeriodicMtcController::class, 'GetPeriodicMtc'])->name('get.periodic');
    Route::get('/admin/periodics', [PeriodicMtcController::class, 'Index'])->name('Admin.periodic');
    Route::get('/admin/periodics/edit/{id}', [PeriodicMtcController::class, 'showEditForm'])->name('edit.periodic');
    Route::put('/admin/periodics/edit/{id}', [PeriodicMtcController::class, 'updateDataPeriodicMtc'])->name('update.periodic');
    Route::delete('/admin/periodics/delete/{id}', [PeriodicMtcController::class, 'deleteDataPeriodicMtc'])->name('delete.periodic');

    Route::get('/admin/get-periodic', [PeriodicMtcController::class, 'GetPeriodicMtc']);


    // Priority
    Route::get('/admin/priority', [PriorityController::class, 'HalamanPriority']);
    Route::get('/admin/priority', [PriorityController::class, 'HalamanPriority'])->name('Admin.priority');
    Route::post('/add-priority', [PriorityController::class, 'AddDataPriority'])->name('add-priority');
    Route::get('/get-priority', [PriorityController::class, 'GetPriority'])->name('get.priority');
    Route::get('/admin/prioritys', [PriorityController::class, 'Index'])->name('Admin.priority');
    Route::get('/admin/prioritys/edit/{id}', [PriorityController::class, 'showEditForm'])->name('edit.priority');
    Route::put('/admin/prioritys/edit/{id}', [PriorityController::class, 'updateDataPriority'])->name('update.priority');
    Route::delete('/admin/prioritys/delete/{id}', [PriorityController::class, 'deleteDataPriority'])->name('delete.priority');
    // Reason
    Route::get('/admin/reason', [ReasonController::class, 'HalamanReason']);
    Route::get('/admin/reason', [ReasonController::class, 'HalamanReason'])->name('Admin.reason');
    Route::post('/add-reason', [ReasonController::class, 'AddDataReason'])->name('add.reason');
    Route::get('/get-reason', [ReasonController::class, 'GetReason'])->name('get.reason');
    Route::get('/admin/reasons', [ReasonController::class, 'Index'])->name('Admin.reason');
    Route::get('/admin/reasons/edit/{id}', [ReasonController::class, 'showEditForm'])->name('edit.reason');
    Route::put('/admin/reasons/edit/{id}', [ReasonController::class, 'updateDataReason'])->name('update.reason');
    Route::delete('/admin/reasons/delete/{id}', [ReasonController::class, 'deleteDataReason'])->name('delete.reason');
    // Reason SO
    Route::get('/admin/reasonso', [ReasonSoController::class, 'HalamanReasonSo']);
    Route::get('/admin/reasonso', [ReasonSoController::class, 'HalamanReasonSo'])->name('Admin.reasonso');
    Route::post('/add-reasonso', [ReasonSoController::class, 'AddDataReasonSo'])->name('add.reasonso');
    Route::get('/get-reasonso', [ReasonSoController::class, 'GetReasonSo'])->name('get.reasonso');
    Route::get('/admin/reasonsos', [ReasonSoController::class, 'IndexSo'])->name('Admin.reasonso');
    Route::get('/admin/reasonsos/edit/{id}', [ReasonSoController::class, 'showEditFormSo'])->name('edit.reasonso');
    Route::put('/admin/reasonsos/edit/{id}', [ReasonSoController::class, 'updateDataReasonSo'])->name('update.reasonso');
    Route::delete('/admin/reasonsos/delete/{id}', [ReasonSoController::class, 'deleteDataReasonSo'])->name('delete.reasonso');
    // Region
    Route::get('/admin/region', [RegionController::class, 'HalamanRegion']);
    Route::get('/admin/region', [RegionController::class, 'HalamanRegion'])->name('Admin.region');
    Route::post('/add-region', [RegionController::class, 'AddDataRegion'])->name('add.region');
    Route::get('/get-region', [RegionController::class, 'GetRegion'])->name('get.region');
    Route::get('/admin/regions', [RegionController::class, 'Index'])->name('Admin.region');
    Route::get('/admin/regions/edit/{id}', [RegionController::class, 'showEditForm'])->name('edit.region');
    Route::put('/admin/regions/edit/{id}', [RegionController::class, 'updateDataRegion'])->name('update.region');
    Route::delete('/admin/regions/delete/{id}', [RegionController::class, 'deleteDatsRegion'])->name('delete.region');

    Route::get('/admin/get-region', [RegionController::class, 'getRegion'])->name('get.region');

    // Repair
    Route::get('/admin/repair', [RepairController::class, 'HalamanRepair']);
    Route::get('/admin/repair', [RepairController::class, 'HalamanRepair'])->name('Admin.repair');
    Route::post('/add-repair', [RepairController::class, 'AddDataRepair'])->name('add.repair');
    Route::get('/get-repair', [RepairController::class, 'GetRepair'])->name('get.repair');
    Route::get('/admin/repairs', [RepairController::class, 'Index'])->name('Admin.repair');
    Route::get('/admin/repairs/edit/{id}', [RepairController::class, 'showEditForm'])->name('edit.repair');
    Route::put('/admin/repairs/edit/{id}', [RepairController::class, 'updateDataRepair'])->name('update.repair');
    Route::delete('/admin/repairs/delete/{id}', [RepairController::class, 'deleteDataRepair'])->name('delete.repair');
    // Supplier
    Route::get('/admin/supplier', [SupplierController::class, 'HalamanSupplier']);
    Route::get('/admin/supplier', [SupplierController::class, 'HalamanSupplier'])->name('Admin.supplier');
    Route::post('/add-supplier', [SupplierController::class, 'AddDataSupplier'])->name('add.supplier');
    Route::get('/get-supplier', [SupplierController::class, 'GetSupplier'])->name('get.supplier');
    Route::get('/admin/suppliers', [SupplierController::class, 'Index'])->name('Admin.supplier');
    Route::get('/admin/suppliers/edit/{id}', [SupplierController::class, 'showEditForm'])->name('edit.supplier');
    Route::put('/admin/suppliers/edit/{id}', [SupplierController::class, 'updateDataSupplier'])->name('update.supplier');
    Route::delete('/admin/suppliers/delete/{id}', [SupplierController::class, 'deleteDataSupplier'])->name('delete.supplier');

    Route::get('/admin/get-supplier', [SupplierController::class, 'GetSupplier']);

    // Type
    Route::get('/admin/type', [TypeController::class, 'HalamanType']);
    Route::get('/admin/type', [TypeController::class, 'HalamanType'])->name('Admin.type');
    Route::post('/add-type', [TypeController::class, 'AddDataType'])->name('add.type');
    Route::get('/get-type', [TypeController::class, 'GetType'])->name('get.type');
    Route::get('/admin/types', [TypeController::class, 'Index'])->name('Admin.type');
    Route::get('/admin/types/edit/{id}', [TypeController::class, 'showEditForm'])->name('edit.type');
    Route::put('/admin/types/edit/{id}', [TypeController::class, 'updateDataType'])->name('update.type');
    Route::delete('/admin/types/delete/{id}', [TypeController::class, 'deleteDataType'])->name('delete.type');
    // Uom
    Route::get('/admin/uom', [UomController::class, 'HalamanUom']);
    Route::get('/admin/uom', [UomController::class, 'HalamanUom'])->name('Admin.uom');
    Route::post('/add-uom', [UomController::class, 'AddDataUom'])->name('add.uom');
    Route::get('/get-uom', [UomController::class, 'GetUom'])->name('get.uom');
    Route::get('/admin/uoms', [UomController::class, 'Index'])->name('Admin.uom');
    Route::get('/admin/uoms/edit/{id}', [UomController::class, 'showEditForm'])->name('edit.uom');
    Route::put('/admin/uoms/edit/{id}', [UomController::class, 'updateDataUom'])->name('update.uom');
    Route::delete('/admin/uoms/delete/{id}', [UomController::class, 'deleteDataUom'])->name('delete.uom');
    // User
    Route::get('/admin/user', [UserController::class, 'HalamanUser']);
    Route::get('/admin/user', [UserController::class, 'HalamanUser'])->name('Admin.user');
    Route::post('/add-user', [UserController::class, 'AddDataUser'])->name('add.user');
    Route::get('/get-user', [UserController::class, 'GetUser'])->name('get.user');
    Route::get('/admin/users', [UserController::class, 'Index'])->name('Admin.user');
    Route::get('/admin/users/edit/{id}', [UserController::class, 'showEditForm'])->name('edit.user');
    Route::put('/admin/users/edit/{id}', [UserController::class, 'updateDataUser'])->name('update.user');
    Route::delete('/admin/users/delete/{id}', [UserController::class, 'deleteDataUser'])->name('delete.user');
    // Warranty
    Route::get('/admin/warranty', [WarrantyController::class, 'HalamanWarranty']);
    Route::get('/admin/warranty', [WarrantyController::class, 'HalamanWarranty'])->name('Admin.warranty');
    Route::post('/add-warranty', [WarrantyController::class, 'AddDataWarranty'])->name('add.warranty');
    Route::get('/get-warranty', [WarrantyController::class, 'GetWarranty'])->name('get.warranty');
    Route::get('/admin/warrantys', [WarrantyController::class, 'Index'])->name('Admin.warranty');
    Route::get('/admin/warrantys/edit/{id}', [WarrantyController::class, 'showEditForm'])->name('edit.warranty');
    Route::put('/admin/warrantys/edit/{id}', [WarrantyController::class, 'updateDataWarranty'])->name('update.warranty');
    Route::delete('/admin/warrantys/delete/{id}', [WarrantyController::class, 'deleteDataWarranty'])->name('delete.warranty');

    Route::get('/admin/get-warranty', [WarrantyController::class, 'GetWarranty']);
    // City
    Route::get('/admin/city', [CityController::class, 'HalamanCity']);
    Route::get('/admin/city', [CityController::class, 'HalamanCity'])->name('Admin.city');
    Route::post('/add-city', [CityController::class, 'AddDataCity'])->name('add.city');
    Route::get('/get-city', [CityController::class, 'GetCity'])->name('get.city');
    Route::get('/admin/citys', [CityController::class, 'Index'])->name('Admin.city');
    Route::get('/admin/citys/edit/{id}', [CityController::class, 'showEditForm'])->name('edit.city');
    Route::put('/admin/citys/edit/{id}', [CityController::class, 'updateDataCity'])->name('update.city');
    Route::delete('/admin/citys/delete/{id}', [CityController::class, 'deleteDataCity'])->name('delete.city');


    //Resto
    Route::get('/admin/get-resto', [RestoController::class, 'GetDataResto']);

});




Route::group([RoleMiddleware::class => ':user'], function(){
    Route::get('/user/dashboard', [UserController::class, 'dashboard']);
});