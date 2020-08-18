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

Route::get('/', 'Controller@main')->name('main');

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

    Route::get('chairity', 'Chairitycontroller@index')->name('chairity.index');
    Route::get('chairity/create', 'Chairitycontroller@create')->name('chairity.create');
    Route::post('chairity/chairityaddrequest', 'Chairitycontroller@chairityaddrequest')->name('chairity.chairityaddrequest');
    Route::get('chairity/destroy/{id}', 'Chairitycontroller@destroy')->name('chairity.destroy');
    Route::get('chairity/edit/{id}', 'Chairitycontroller@edit')->name('chairity.edit');
    Route::post('chairity/chairityupdaterequest', 'Chairitycontroller@chairityupdaterequest')->name('chairity.chairityupdaterequest');





});
Route::get('assessment/report/{id}', 'AssessmentController@report')->name('assessment.report');



Route::middleware(['role:Admin|Teacher'])->group(function () {

    Route::get('assessment/assessmentedit/{id}', 'AssessmentController@assessmentedit')->name('assessment.assessmentedit');
    Route::post('assessment/updateassessment', 'AssessmentController@updateassessment')->name('assessment.updateassessment');
    Route::get('assessment/updatemarks/{id}', 'AssessmentController@updatemarks')->name('assessment.updatemarks');
    Route::post('assessment/updatemarksrequest', 'AssessmentController@updatemarksrequest')->name('assessment.updatemarksrequest');
    Route::get('assessment/marksassign/{id}', 'AssessmentController@marksassign')->name('assessment.marksassign');
    Route::post('assessment/addmarks', 'AssessmentController@addmarks')->name('assessment.addmarks');
    Route::get('assessment/assessmentdelete/{id}', 'AssessmentController@assessmentdelete')->name('assessment.assessmentdelete');
    Route::get('assessment/deletemarks/{id}', 'AssessmentController@deletemarks')->name('assessment.deletemarks');
    Route::get('assessment/create/{id}', 'AssessmentController@create')->name('assessment.create');
    Route::post('assessment/addassessmentrequest', 'AssessmentController@addassessmentrequest')->name('assessment.addassessmentrequest');

});





Route::get('timetable', 'TimetableController@index')->name('timetable.index');

Route::get('voucher/', 'VoucherController@index')->name('voucher.index');
Route::get('voucher/view/{id}', 'VoucherController@view')->name('voucher.view');
Route::get('timetable/view/{id}', 'TimetableController@view')->name('timetable.view');
Route::get('assessment', 'AssessmentController@index')->name('assessment.index');
Route::get('assessment/viewassessments/{id?}', 'AssessmentController@viewassessments')->name('assessment.viewassessments');
Route::get('assessment/marks/{id}', 'AssessmentController@marks')->name('assessment.marks');



/*
 * Teacher Routes
 *
 * */

Route::group(['middleware' => ['auth','role:Teacher']], function ()
{
    Route::post('attendance', 'AttendanceController@store')->name('teacher.attendance.store');
    Route::get('attendance-create/{classid}', 'AttendanceController@createByTeacher')->name('teacher.attendance.create');
});

/*
 * Parent Routes
 * */

Route::group(['middleware' => ['auth','role:Parent']], function ()
{
    Route::get('attendance/{attendance}', 'AttendanceController@show')->name('attendance.show');
});

/*
 * Student Route
 * */
Route::group(['middleware' => ['auth','role:Student']], function () {


});
