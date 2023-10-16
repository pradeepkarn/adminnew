<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'admin/index';
$route['dashboard'] = 'admin/dashboard';
$route['switchlanguage/(:any)'] = 'LanguageSwitcher/switchLang/';
$route['login'] = 'admin/login';
$route['rememberme/(:any)'] = 'admin/rememberme';
$route['forgot'] = 'admin/forgot';
$route['logout'] = 'admin/logout';


$route['tenants'] = 'tenants/tenantsList';
$route['add-tenants'] = 'tenants/addTenants';
$route['delete-tenants/(:any)'] = 'tenants/deleteTenants';
$route['edit-tenants/(:any)'] = 'tenants/editTenants';

$route['owners'] = 'owners/ownersList';
$route['add-owners'] = 'owners/addOwners';
$route['delete-owners/(:any)'] = 'owners/deleteOwners';
$route['edit-owners/(:any)'] = 'owners/editOwners';

$route['properties'] = 'properties/propertiesList';
$route['add-properties'] = 'properties/addProperties';
$route['delete-properties/(:any)'] = 'properties/deleteProperties';
$route['edit-properties/(:any)'] = 'properties/editProperties';

$route['contracts'] = 'contracts/contractsList';
$route['add-contracts'] = 'contracts/addContracts';
$route['renew-contracts/(:any)'] = 'contracts/renewContracts';
$route['delete-contracts/(:any)'] = 'contracts/deleteContracts';
$route['edit-contracts/(:any)'] = 'contracts/editContracts';




$route['expense'] = 'expense/expenseList';
$route['add-expense'] = 'expense/addexpense';
$route['insert-expense'] = 'expense/insertexpense';
$route['delete-Expense/(:any)'] = 'expense/deleteExpense';
$route['editexpense/(:any)'] = 'expense/editExpense';







$route['permission'] = 'permissions/permission';
$route['addpermission']  = 'permissions/addpermission';
$route['savepermission'] = 'permissions/savepermission';
$route['editpermission/(:any)'] = 'permissions/editpermission';
$route['deletepermission/(:any)'] = 'permissions/deletepermission';

$route['users'] = 'users/userlist';
$route['adduser'] = 'users/adduser';
$route['saveuser'] = 'users/saveuser';
$route['deleteuser/(:any)'] = 'users/deleteuser';
$route['edituser/(:any)'] = 'users/edituser';


$route['add-realestate-offer'] = 'RealEstateOffers/add_realestate_offer';
$route['realstate/insertestate'] = 'RealEstateOffers/insertEstate';
$route['realstate-offer-list'] = 'RealEstateOffers/realEstateOffersList';
$route['edit-realestate-offer/(:any)'] = 'RealEstateOffers/edit_realestate_offer';
$route['delete-realestate-offer/(:any)'] = 'RealEstateOffers/delete_offer';
$route['delete-offfer-image/(:any)/(:any)'] = 'RealEstateOffers/delete_offer_img';

#API
$route['api/v1/realstate-offer-list'] = 'RealEstateOffersApi/offer_list';
$route['api/v1/realstate-offer-details/(:any)'] = 'RealEstateOffersApi/offer_details';
$route['api/v1/realstate-offer-search'] = 'RealEstateOffersApi/offer_search';
$route['api/v1/realstate-offer-search-params'] = 'RealEstateOffersApi/offer_search_params';

#Reports
$route['reports/pending-installments'] = 'Reports/getPendingInstallments';
$route['reports/expiring-contracts'] = 'Reports/getExpiringContracts';
$route['reports/expiring-contracts/(:any)'] = 'Reports/getExpiringContracts';
$route['reports/pending-installments/(:any)'] = 'Reports/getPendingInstallments';
