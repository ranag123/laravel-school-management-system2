<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/profile/edit', 'HomeController@profileEdit')->name('profile.edit');
Route::put('/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::get('/profile/changepassword', 'HomeController@changePasswordForm')->name('profile.change.password');
Route::post('/profile/changepassword', 'HomeController@changePassword')->name('profile.changepassword');

Route::group(['middleware' => ['auth','role:Admin']], function ()
{
    Route::get('/roles-permissions', 'RolePermissionController@roles')->name('roles-permissions');
    Route::get('/role-create', 'RolePermissionController@createRole')->name('role.create');
    Route::post('/role-store', 'RolePermissionController@storeRole')->name('role.store');
    Route::get('/role-edit/{id}', 'RolePermissionController@editRole')->name('role.edit');
    Route::put('/role-update/{id}', 'RolePermissionController@updateRole')->name('role.update');

    Route::get('/permission-create', 'RolePermissionController@createPermission')->name('permission.create');
    Route::post('/permission-store', 'RolePermissionController@storePermission')->name('permission.store');
    Route::get('/permission-edit/{id}', 'RolePermissionController@editPermission')->name('permission.edit');
    Route::put('/permission-update/{id}', 'RolePermissionController@updatePermission')->name('permission.update');

    Route::get('assign-subject-to-class/{id}', 'GradeController@assignSubject')->name('class.assign.subject');
    Route::post('assign-subject-to-class/{id}', 'GradeController@storeAssignedSubject')->name('store.class.assign.subject');

    Route::resource('assignrole', 'RoleAssign');
    Route::resource('classes', 'GradeController');
    Route::resource('subject', 'SubjectController');
    Route::resource('teacher', 'TeacherController');
    Route::resource('parents', 'ParentsController');
    Route::resource('student', 'StudentController');
    Route::get('attendance', 'AttendanceController@index')->name('attendance.index');


    Route::get('voucher/create', 'VoucherController@create')->name( 'voucher.create');
    Route::post('voucheraddrequest', 'VoucherController@voucheraddrequest')->name( 'voucher.voucheraddrequest');
    Route::post('getstudent', 'VoucherController@getstudent');
    Route::get('voucher/destroy/{id}', 'VoucherController@destroy')->name('voucher.destroy');
    Route::get('voucher/edit/{id}', 'VoucherController@edit')->name('voucher.edit');
    Route::post('voucher/voucherupdaterequest', 'VoucherController@voucherupdaterequest')->name('voucher.voucherupdaterequest');

    Route::post('getteacher', 'TimetableController@getteacher');

    Route::get('timetable/create', 'TimetableController@create')->name( 'timetable.create');
    Route::post('timetableaddrequest', 'TimetableController@timetableaddrequest')->name( 'timetable.timetableaddrequest');
     Route::get('timetable/destroy/{id}', 'TimetableController@destroy')->name('timetable.destroy');
    Route::get('timetable/edit/{id}', 'TimetableController@edit')->name('timetable.edit');
    Route::post('timetable/timetableupdaterequest', 'TimetableController@timetableupdaterequest')->name('timetable.timetableupdaterequest');

});
Route::get('timetable', 'TimetableController@index')->name('timetable.index');

Route::get('voucher', 'VoucherController@index')->name('voucher.index');
Route::get('voucher/view/{id}', 'VoucherController@view')->name('voucher.view');

Route::get('timetable/view/{id}', 'TimetableController@view')->name('timetable.view');

Route::group(['middleware' => ['auth','role:Teacher']], function ()
{
    Route::post('attendance', 'AttendanceController@store')->name('teacher.attendance.store');
    Route::get('attendance-create/{classid}', 'AttendanceController@createByTeacher')->name('teacher.attendance.create');
});

Route::group(['middleware' => ['auth','role:Parent']], function ()
{
    Route::get('attendance/{attendance}', 'AttendanceController@show')->name('attendance.show');
});

Route::group(['middleware' => ['auth','role:Student']], function () {

});
