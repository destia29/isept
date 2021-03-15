<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'CLUnilaController@homepage');

Route::get('/test_pdf', function(){
    $html = "<h1>HELLO WORLD</h1>";

    $pdf = PDFBarry::loadHtml($html);
    return $pdf->stream();
});

Route::get('homesearch', 'CLUnilaController@searchhome')->name('home.homesearch');

Route::get('contactus', 'CLUnilaController@contactus');

Route::post('/contactus-post', 'lcunila\MessageController@postCreate')->name('message.create');

Route::get('tag/s', 'CLUnilaController@searchtag')->name('tag.asidesearch');

Route::get('announcement', 'CLUnilaController@announcement');

Route::get('announcement/announcementdetail/{id}', 'CLUnilaController@detailannouncement')->name('announcement.detail');

Route::get('announcement/s', 'CLUnilaController@searchannouncement')->name('announcement.asidesearch');

Route::get('event', 'CLUnilaController@event');

Route::get('event/eventdetail/{id}', 'CLUnilaController@detailevent')->name('event.detail');

Route::get('event/s', 'CLUnilaController@searchevent')->name('event.asidesearch');

Route::get('ourcommitment', 'CLUnilaController@ourcommitment');

Route::get('ourservice', 'CLUnilaController@ourservice');

Route::get('toeflitp', 'CLUnilaController@toeflitp');

Route::get('toeic', 'CLUnilaController@toeic');

Route::get('ielts', 'CLUnilaController@ielts');

Route::get('englishproficiencytest', 'CLUnilaController@englishproficiencytest');

Route::get('englishproficiencytest/s', 'CLUnilaController@searcheptresult')->name('ept.searcheptresult');

Route::get('visionmission', 'CLUnilaController@visionmission');

Route::get('lcunilaprofile', 'CLUnilaController@clunilaprofile');

Route::get('/get_image/{name}', 'CLUnilaController@getStaffPictureProfile')->name('clunilaphotoprofile');

Route::get('/get_image/announcement/{name}', 'CLUnilaController@getAnnouncementPicture')->name('image_announcement');

Route::get('/get_image/event/{name}', 'CLUnilaController@getEventPicture')->name('image_event');

Route::get('/get_image/eptqr_code/{name}', 'CLUnilaController@getEptQrCode')->name('ept_qrcode');


Route::get('isclunila/forgotpassword', 'ISCLUnilaController@forgotpassword');

Route::get('/get_image/adminuser/isclunila/{name}', 'ISCLUnilaController@getAdminUserPictureProfile')->name('adminuserphotoprofile_isclunila');

Route::get('/get_image/adminuser/isept/{name}', 'ISEPTUnilaController@getAdminUserPictureProfile')->name('adminuserphotoprofile_isept');


Route::group(['middleware' => 'admin-god', 'prefix' => 'isept'], function(){

  Route::group(['prefix' => 'admingod'], function () {

    Route::get('/', 'HomeController@homepageadmingod')->name('admingod.index');
  });

  Route::group(['prefix' => 'changepassword'], function () {
      Route::get('/',             'ISCLUnilaController@changepassword');
      Route::post('/edit/post',   'islcunila\ChangepasswordController@postEdit')->name('islcunila.changepassword.admingod.edit.post');
  });


});


Route::group(['middleware' => 'admin-lc', 'prefix' => 'isclunila'], function(){

  Route::group(['prefix' => 'adminclu'], function () {

    Route::get('/', 'HomeController@homepageadminlcunila')->name('adminlcunila.index');

// EPT CHART BEGIN

    Route::get('/eptchart' , 'islcunila\EptfacultyController@filterdata')->name('isclunila.adminlcu.eptchart');
    Route::get('/eptchart/filterdata' , 'islcunila\EptfacultyController@filterdata')->name('isclunila.adminlcu.eptchart.filterdata');
    Route::get('/eptchart/pdf' , 'islcunila\EptfacultyController@pdf_university')->name('isclunila.adminlcu.eptchart.pdf');
    Route::get('/eptfaculty' , 'islcunila\EptfacultyController@index')->name('isclunila.adminlcu.eptfaculty');
    Route::get('/eptfaculty/filter' , 'islcunila\EptfacultyController@filter')->name('isclunila.adminlcu.eptfaculty.filter');
    Route::get('/eptfaculty/pdf' , 'islcunila\EptfacultyController@pdf')->name('isclunila.adminlcu.eptfaculty.pdf');
    Route::get('/eptdepartment' , 'islcunila\EptdepartmentController@index')->name('isclunila.adminlcu.eptdepartment');
    Route::get('/eptdepartment/selectfaculty' , 'islcunila\EptdepartmentController@selectfaculty')->name('isclunila.adminlcu.eptdepartment.selectfaculty');
    Route::get('/eptdepartment/pdf' , 'islcunila\EptdepartmentController@pdf')->name('isclunila.adminlcu.eptdepartment.pdf');

// EPT CHART ENDED

    Route::group(['prefix' => 'adminaccountlist'], function () {
        Route::get('/',             'islcunila\adminlcu\AdminController@index')->name('adminlcu.adminaccountlist');
        Route::get('/delete/{id}',  'islcunila\adminlcu\AdminController@delete')->name('adminlcu.adminaccountlist.delete');
        Route::get('/edit/{id}',    'islcunila\adminlcu\AdminController@edit')->name('adminlcu.adminaccountlist.edit');
        Route::post('/edit/post',   'islcunila\adminlcu\AdminController@postEdit')->name('adminlcu.adminaccountlist.edit.post');
    });

    Route::get('/addnewadminaccount', 'ISCLUnilaController@addnewadminaccount');

    Route::post('/addnewadmin-post', 'islcunila\adminlcu\AdminController@postAdd')->name('admin.add');

    Route::group(['prefix' => 'lcuannouncementlist'], function () {
        Route::get('/',             'islcunila\adminlcu\AnnouncementController@index')->name('adminlcu.lcuannouncementlist');
        Route::get('/delete/{id}',  'islcunila\adminlcu\AnnouncementController@delete')->name('adminlcu.lcuannouncementlist.delete');
        Route::get('/edit/{id}',    'islcunila\adminlcu\AnnouncementController@edit')->name('adminlcu.lcuannouncement.edit');
        Route::post('/edit/post',   'islcunila\adminlcu\AnnouncementController@postEdit')->name('adminlcu.lcuannouncement.edit.post');
    });

    Route::get('/addnewannouncement', 'ISCLUnilaController@addnewannouncement');

    Route::post('/addnewannouncement-post', 'islcunila\adminlcu\AnnouncementController@postAdd')->name('announcement.add');

    Route::group(['prefix' => 'lcueventlist'], function () {
        Route::get('/',             'islcunila\adminlcu\EventController@index')->name('adminlcu.lcueventlist');
        Route::get('/delete/{id}',  'islcunila\adminlcu\EventController@delete')->name('adminlcu.lcueventlist.delete');
        Route::get('/edit/{id}',    'islcunila\adminlcu\EventController@edit')->name('adminlcu.lcuevent.edit');
        Route::post('/edit/post',   'islcunila\adminlcu\EventController@postEdit')->name('adminlcu.lcuevent.edit.post');
    });

    Route::get('/addnewevent', 'ISCLUnilaController@addnewevent');

    Route::post('/addnewevent-post', 'islcunila\adminlcu\EventController@postAdd')->name('event.add');

    Route::group(['prefix' => 'lcuservice'], function () {
        Route::get('/',                        'islcunila\adminlcu\ServicesController@index')->name('adminlcu.neweptscore');
        Route::get('/delete/{id}',             'islcunila\adminlcu\ServicesController@delete')->name('adminlcu.lcuservice.delete');
        Route::get('/edit/{id}',               'islcunila\adminlcu\ServicesController@edit')->name('adminlcu.lcuservice.edit');
        Route::post('/edit/post',              'islcunila\adminlcu\ServicesController@postEdit')->name('adminlcu.lcuservice.edit.post');
        Route::get('/neweptscore',             'islcunila\adminlcu\ServicesController@neweptscore')->name('adminlcu.neweptscore');
        Route::get('/alleptscore',             'islcunila\adminlcu\ServicesController@alleptscore')->name('adminlcu.alleptscore');
    });

    Route::get('/addnewlcuservice', 'ISCLUnilaController@addnewlcuservice');

    Route::post('/addnewlcuservice-post', 'islcunila\adminlcu\ServicesController@postAdd')->name('lcuservice.add');

    Route::get('/get_image/staff/{name}', 'islcunila\adminlcu\CitizenController@getStaffPicture')->name('image_staff');

    Route::group(['prefix' => 'lcustaff'], function () {
        Route::get('/',             'islcunila\adminlcu\CitizenController@lcustaff')->name('adminlcu.lcustaff');
        Route::get('/delete/{id}',  'islcunila\adminlcu\CitizenController@deleteStaff')->name('adminlcu.lcustaff.delete');
        Route::get('/edit/{id}',    'islcunila\adminlcu\CitizenController@editStaff')->name('adminlcu.lcustaff.edit');
        Route::post('/edit/post',   'islcunila\adminlcu\CitizenController@postEditStaff')->name('adminlcu.lcustaff.edit.post');
    });

    Route::group(['prefix' => 'eptparticipant'], function () {
        Route::get('/',                        'islcunila\adminlcu\CitizenController@eptparticipant')->name('adminlcunila.eptparticipant');
        Route::get('/all',                     'islcunila\adminlcu\CitizenController@alleptparticipant')->name('adminlcunila.eptparticipant.all');
        Route::post('/change-status',          'islcunila\adminlcu\CitizenController@changeStatus')->name('adminlcunila.eptparticipant.change-status');

        Route::group(['prefix' => 'find'], function () {
            Route::get('/',                    'islcunila\adminlcu\CitizenController@findparticipant')->name('adminlcunila.findparticipant.find');
            Route::get('/alluser',             'islcunila\adminlcu\CitizenController@findeptparticipant')->name('adminlcunila.findparticipant.eptparticipant');
            Route::get('/bynpm_name',          'islcunila\adminlcu\CitizenController@findparticipantbynpmname')->name('adminlcunila.findparticipant.bynpmname');
            Route::get('/bycategory',          'islcunila\adminlcu\CitizenController@findparticipantbycategory')->name('adminlcunila.findparticipant.bycategory');
        });
        Route::get('/activate/{id}',           'islcunila\adminlcu\CitizenController@activate')->name('adminlcunila.eptparticipant.activate');
        Route::get('/resetpassword/{id}',      'islcunila\adminlcu\CitizenController@resetpassword')->name('adminlcunila.eptparticipant.resetpassword');
        Route::get('/suspend/{id}',            'islcunila\adminlcu\CitizenController@suspend')->name('adminlcunila.eptparticipant.suspend');
        Route::post('/exportexcel',            'islcunila\adminlcu\CitizenController@exportformatfile')->name('adminlcunila.exportformatfile');
        Route::post('/import',                 'islcunila\adminlcu\CitizenController@import')->name('adminlcunila.importeptparticipant');
        Route::get('/edit/{id}',               'islcunila\adminlcu\CitizenController@editeptparticipant')->name('adminlcunila.eptparticipant.edit');
        Route::post('/edit/post',              'islcunila\adminlcu\CitizenController@postEditeptparticipant')->name('adminlcunila.eptparticipant.edit.post');
        Route::get('/delete/{id}',             'islcunila\adminlcu\CitizenController@deleteeptparticipant')->name('adminlcunila.deleteeptparticipant');
        Route::post('/search-major',           'islcunila\adminlcu\CitizenController@searchMajor')->name('searcheptpart.major');
    });

    Route::get('/addnewlcustaff', 'ISCLUnilaController@addnewlcustaff');

    Route::post('/addnewlcustaff-post', 'islcunila\adminlcu\CitizenController@postAddStaff')->name('lcustaff.add');

    Route::get('/addneweptparticipant', 'ISCLUnilaController@addneweptparticipant');

    Route::post('/addneweptparticipant-post', 'islcunila\adminlcu\CitizenController@postAddEptParticipant')->name('eptparticipant.add');

    Route::group(['prefix' => 'lcumessagelist'], function () {
        Route::get('/',                        'islcunila\adminlcu\MessageController@index')->name('adminlcu.lcumessagelist');
        Route::get('/delete/{id}',             'islcunila\adminlcu\MessageController@delete')->name('adminlcu.lcumessagelist.delete');
        Route::get('/detail/{id}',             'islcunila\adminlcu\MessageController@detail')->name('adminlcu.lcumessage.detail');
    });

    Route::get('/supportcenter', 'ISCLUnilaController@supportcenter');

    Route::group(['prefix' => 'myprofile'], function () {
        Route::get('/',             'ISCLUnilaController@myprofile');
        Route::post('/edit/post',   'islcunila\MyprofileController@postEdit')->name('islcunila.myprofile.adminlcunila.edit.post');
    });

    Route::group(['prefix' => 'changepassword'], function () {
        Route::get('/',             'ISCLUnilaController@changepassword');
        Route::post('/edit/post',   'islcunila\ChangepasswordController@postEdit')->name('islcunila.changepassword.adminlcunila.edit.post');
    });

  });

});

Route::get('isept/signup', 'ISEPTUnilaController@signup');

Route::post('isept/signup-post', 'isept\eptparticipant\SignupController@postAdd')->name('signup_eptparticipant.add');

Route::get('isept/forgotpassword', 'ISEPTUnilaController@forgotpassword');

//EPT PART BEGIN

Route::group(['middleware' => 'admin-ept', 'prefix' => 'isept'], function(){

  Route::group(['prefix' => 'adminept'], function () {

    Route::get('/', 'HomeController@homepageadminept')->name('adminept.index');

    Route::post('/exportexcelselectedadminept',    'isept\adminept\EptscoreController@exportselected')->name('adminept.eptresult.exportexcelselected');

    Route::post('/exportexceladminept',    'isept\adminept\EptscoreController@export')->name('adminept.eptresult.exportexcel');

    Route::group(['prefix' => 'eptcertificate'], function () {
        Route::get('/',                         'isept\adminept\EptcertificateController@index')->name('adminept.eptcertificate');
        Route::get('/edit/{id_reg}',            'isept\adminept\EptcertificateController@edit')->name('adminept.eptcertificate.edit');
        Route::post('/edit/post',                'isept\adminept\EptcertificateController@postEdit')->name('adminept.eptcertificate.edit.post');
        Route::get('/finish/{id}',              'isept\adminept\EptcertificateController@finish')->name('adminept.eptcertificate.finish');
    });

    Route::group(['prefix' => 'neweptparticipant'], function () {
        Route::get('/',                         'isept\adminept\EptparticipantController@index')->name('adminept.eptparticipant');
        Route::get('/edit/{id_reg}',            'isept\adminept\EptparticipantController@edit')->name('adminept.eptparticipant.edit');
        Route::post('/edit/post',               'isept\adminept\EptparticipantController@postEdit')->name('adminept.eptparticipant.edit.post');
        Route::post('/change-status',           'isept\adminept\EptparticipantController@changeStatus')->name('adminept.eptparticipant.change-status');

        Route::get('/abandoned/{id}',           'isept\adminept\EptparticipantController@abandoned')->name('adminept.eptparticipant.abandoned');
        Route::get('/verify/{id}',              'isept\adminept\EptparticipantController@verify')->name('adminept.eptparticipant.verify');
    });

    Route::group(['prefix' => 'findeptparticipant'], function () {
        Route::get('/',                         'isept\adminept\EptparticipantController@findparticipant')->name('adminept.findparticipant');
        Route::get('/selectdate',               'isept\adminept\EptparticipantController@findparticipantselectdate')->name('adminept.findparticipant.selectdate');
        Route::get('/selectcustomdate',         'isept\adminept\EptparticipantController@findparticipantselectcustomdate')->name('adminept.findparticipant.selectcustomdate');
    });

    Route::get('/alleptparticipant', 'isept\adminept\EptparticipantController@allparticipant')->name('adminept.allparticipant');

    Route::group(['prefix' => 'eptschedulelist'], function () {
        Route::get('/',             'isept\adminept\EptscheduleController@index')->name('adminept.eptschedulelist');
        Route::get('/delete/{id}',  'isept\adminept\EptscheduleController@delete')->name('adminept.eptschedulelist.delete');
        Route::get('/edit/{id}',    'isept\adminept\EptscheduleController@edit')->name('adminept.eptschedulelist.edit');
        Route::post('/edit/post',   'isept\adminept\EptscheduleController@postEdit')->name('adminept.eptschedulelist.edit.post');
    });

    Route::group(['prefix' => 'findeptschedule'], function () {
        Route::get('/',                         'isept\adminept\EptscheduleController@findschedule')->name('adminept.findschedule');
        Route::get('/selectdate',               'isept\adminept\EptscheduleController@findscheduleselectdate')->name('adminept.findschedule.selectdate');
        Route::get('/selectcustomdate',         'isept\adminept\EptscheduleController@findscheduleselectcustomdate')->name('adminept.findschedule.selectcustomdate');
    });

    Route::get('/alleptschedule', 'isept\adminept\EptscheduleController@alleptschedule')->name('adminept.alleptschedule');

    Route::get('/addneweptschedule', 'ISEPTUnilaController@addneweptschedule');
    Route::post('/addneweptschedule/getroom', 'isept\adminept\EptscheduleController@getRoom')->name('eptschedule.get-room');

    Route::post('/addeweptschedule-post', 'isept\adminept\EptscheduleController@postAdd')->name('eptschedule.add');

    Route::group(['prefix' => 'eptproperties'], function () {
        Route::get('/',                 'isept\adminept\EptpropertiesController@index')->name('adminept.eptproperties');
        Route::get('/deletetype/{id}',  'isept\adminept\EptpropertiesController@deletetype')->name('adminept.eptproperties.deletetype');
        Route::get('/edittype/{id}',    'isept\adminept\EptpropertiesController@edittype')->name('adminept.eptproperties.edittype');
        Route::post('/edittype/post',   'isept\adminept\EptpropertiesController@postEdittype')->name('adminept.eptproperties.edittype.post');
        Route::get('/deleteroom/{id}',  'isept\adminept\EptpropertiesController@deleteroom')->name('adminept.eptproperties.deleteroom');
        Route::get('/editroom/{id}',    'isept\adminept\EptpropertiesController@editroom')->name('adminept.eptproperties.editroom');
        Route::post('/editroom/post',   'isept\adminept\EptpropertiesController@postEditroom')->name('adminept.eptproperties.editroom.post');
        Route::get('/editcode/{id}',    'isept\adminept\EptpropertiesController@editcode')->name('adminept.eptproperties.editcode');
        Route::post('/editcode/post',   'isept\adminept\EptpropertiesController@postEditcode')->name('adminept.eptproperties.editcode.post');
    });

    Route::get('/addnewepttype', 'ISEPTUnilaController@addnewepttype');

    Route::post('/addnewepttype-post', 'isept\adminept\EptpropertiesController@postAddnewtype')->name('epttype.add');

    Route::get('/addneweptroom', 'ISEPTUnilaController@addneweptroom');

    Route::post('/addneweptroom-post', 'isept\adminept\EptpropertiesController@postAddnewroom')->name('eptroom.add');

    Route::get('/get_image/eptparticipant/{name}', 'isept\adminept\EptparticipantController@getPictureProfile')->name('adminept.eptparticipant.profile_picture');

    Route::get('/neweptscore', 'isept\adminept\EptscoreController@index');

    Route::group(['prefix' => 'findeptscore'], function () {
        Route::get('/',                         'isept\adminept\EptscoreController@findscore')->name('adminept.findscore');
        Route::get('/selectdate',               'isept\adminept\EptscoreController@findscoreselectdate')->name('adminept.findscore.selectdate');
        Route::get('/selectcustomdate',         'isept\adminept\EptscoreController@findscoreselectcustomdate')->name('adminept.findscore.selectcustomdate');
    });

    Route::get('/alleptscore', 'isept\adminept\EptscoreController@alleptscore')->name('adminept.alleptscore');

    //EPT CHART BEGIN
        Route::get('/eptchart' , 'isept\adminept\EptfacultyController@filterdata')->name('adminept.eptchart');
        // Route::get('/eptchart/filter', ['as'=>'filter', 'uses'=>'EptchartController@filter'])->name('adminept.eptchart.filter');
        Route::get('/eptchart/filter' , 'isept\adminept\EptfacultyController@filterdata')->name('adminept.eptchart.filter');
        Route::get('/eptchart/pdf' , 'isept\adminept\EptfacultyController@pdf_university')->name('adminept.eptchart.pdf');
        Route::get('/eptfaculty' , 'isept\adminept\EptfacultyController@index')->name('adminept.eptfaculty');
        Route::get('/eptfaculty/filter' , 'isept\adminept\EptfacultyController@filter')->name('adminept.eptfaculty.filter');
        Route::get('/eptfaculty/pdf' , 'isept\adminept\EptfacultyController@pdf')->name('adminept.eptfaculty.pdf');
        Route::get('/eptdepartment' , 'isept\adminept\EptdepartmentController@index')->name('adminept.eptdepartment');
        Route::get('/eptdepartment/selectfaculty' , 'isept\adminept\EptdepartmentController@selectfaculty')->name('adminept.eptdepartment.selectfaculty');
        Route::get('/eptdepartment/pdf' , 'isept\adminept\EptdepartmentController@pdf')->name('adminept.eptdepartment.pdf');


    //EPT CHART ended

    Route::get('/supportcenter', 'ISEPTUnilaController@supportcenter');

    Route::group(['prefix' => 'myprofile'], function () {
        Route::get('/',             'ISEPTUnilaController@myprofile');
        Route::post('/edit/post',   'isept\MyprofileController@postEdit')->name('isept.myprofile.adminept.edit.post');
    });

    Route::group(['prefix' => 'changepassword'], function () {
        Route::get('/',             'ISEPTUnilaController@changepassword');
        Route::post('/edit/post',   'isept\ChangepasswordController@postEdit')->name('isept.changepassword.adminept.edit.post');
    });

  });

});



Route::group(['middleware' => 'ept-valuemanager', 'prefix' => 'isept'], function(){

  Route::group(['prefix' => 'eptvaluemanager'], function () {

    Route::get('/', 'HomeController@homepageeptvaluemanager')->name('eptvaluemanager.index');

    Route::group(['prefix' => 'eptscorelist'], function () {
        Route::get('/',             'isept\eptvaluemanager\EptscorelistController@index')->name('eptvaluemanager.eptscorelist');
        Route::get('/refresh/{id}', 'isept\eptvaluemanager\EptscorelistController@refresh')->name('eptvaluemanager.eptscorelist.refresh');
        Route::get('/takecourse/{id}', 'isept\eptvaluemanager\EptscorelistController@takecourse')->name('eptvaluemanager.eptscorelist.takecourse');
        Route::get('/edit/{id}',    'isept\eptvaluemanager\EptscorelistController@edit')->name('eptvaluemanager.eptscorelist.edit');
        Route::post('/edit/post',   'isept\eptvaluemanager\EptscorelistController@postEdit')->name('eptvaluemanager.eptscorelist.edit.post');
        Route::post('/export',    'isept\eptvaluemanager\EptscorelistController@export')->name('eptvaluemanager.eptscorelist.export');
        Route::post('/import',    'isept\eptvaluemanager\EptscorelistController@import')->name('eptvaluemanager.eptscorelist.import');
        Route::post('/exportselected',    'isept\eptvaluemanager\EptscorelistController@exportselected')->name('eptvaluemanager.alleptscore.exportselected');

    });

    Route::get('/get_image/eptparticipant/{name}', 'isept\eptvaluemanager\EptscorelistController@getPictureProfile')->name('eptvaluemanager.eptscorelist.profile_picture');

    Route::get('/uploadeptscore', 'ISEPTUnilaController@uploadeptscore');

    Route::get('/supportcenter', 'ISEPTUnilaController@supportcentereptvaluemanager');

    Route::group(['prefix' => 'myprofile'], function () {
        Route::get('/',             'ISEPTUnilaController@myprofile');
        Route::post('/edit/post',   'isept\MyprofileController@postEdit')->name('isept.myprofile.eptvaluemanager.edit.post');
    });

    Route::group(['prefix' => 'changepassword'], function () {
        Route::get('/',             'ISEPTUnilaController@changepassword');
        Route::post('/edit/post',   'isept\ChangepasswordController@postEdit')->name('isept.changepassword.eptvaluemanager.edit.post');
    });

// EPT CHART BEGIN

    Route::get('/eptchart' , 'isept\eptvaluemanager\EptfacultyController@filterdata')->name('eptvaluemanager.eptchart');
    Route::get('/eptchart/filterdata' , 'isept\eptvaluemanager\EptfacultyController@filterdata')->name('eptvaluemanager.eptchart.filterdata');
    Route::get('/eptchart/pdf' , 'isept\eptvaluemanager\EptfacultyController@pdf_university')->name('eptvaluemanager.eptchart.pdf');
    Route::get('/eptfaculty' , 'isept\eptvaluemanager\EptfacultyController@index')->name('eptvaluemanager.eptfaculty');
    Route::get('/eptfaculty/filter' , 'isept\eptvaluemanager\EptfacultyController@filter')->name('eptvaluemanager.eptfaculty.filter');
    Route::get('/eptfaculty/pdf' , 'isept\eptvaluemanager\EptfacultyController@pdf')->name('eptvaluemanager.eptfaculty.pdf');
    Route::get('/eptdepartment' , 'isept\eptvaluemanager\EptdepartmentController@index')->name('eptvaluemanager.eptdepartment');
    Route::get('/eptdepartment/selectfaculty' , 'isept\eptvaluemanager\EptdepartmentController@selectfaculty')->name('eptvaluemanager.eptdepartment.selectfaculty');
    Route::get('/eptdepartment/pdf' , 'isept\eptvaluemanager\EptdepartmentController@pdf')->name('eptvaluemanager.eptdepartment.pdf');
// EPT CHART ENDED
  });

});


Route::group(['middleware' => 'admin-dekanat', 'prefix' => 'isept'], function(){

  Route::group(['prefix' => 'admindekanat'], function () {

    Route::get('/', 'HomeController@homepageadmindekanat')->name('admindekanat.index');

//ept chart begin
    // Route::get('/eptchart' , 'isept\admindekanat\EptchartController@index')->name('admindekanat.eptchart');
    Route::get('/eptchart' , 'isept\admindekanat\EptfacultyController@filterdata')->name('admindekanat.eptchart');
    Route::get('/eptchart/filterdata' , 'isept\admindekanat\EptfacultyController@filterdata')->name('admindekanat.eptchart.filterdata');
    Route::get('/eptchart/pdf' , 'isept\admindekanat\EptfacultyController@pdf_university')->name('admindekanat.eptchart.pdf');

    Route::get('/eptfaculty' , 'isept\admindekanat\EptfacultyController@index')->name('admindekanat.eptfaculty');
    Route::get('/eptfaculty/filter' , 'isept\admindekanat\EptfacultyController@filter')->name('admindekanat.eptfaculty.filter');
    Route::get('/eptfaculty/pdf' , 'isept\admindekanat\EptfacultyController@pdf')->name('admindekanat.eptfaculty.pdf');

    Route::get('/eptdepartment' , 'isept\admindekanat\EptdepartmentController@index')->name('admindekanat.eptdepartment');
    Route::get('/eptdepartment/selectfaculty' , 'isept\admindekanat\EptdepartmentController@selectfaculty')->name('admindekanat.eptdepartment.selectfaculty');
    Route::get('/eptdepartment/pdf' , 'isept\admindekanat\EptdepartmentController@pdf')->name('admindekanat.eptdepartment.pdf');

// EPT CHART ENDED

    Route::get('/neweptscore', 'isept\admindekanat\EptscoreController@index');

    Route::group(['prefix' => 'findeptscore'], function () {
        Route::get('/',                         'isept\admindekanat\EptscoreController@findscore')->name('admindekanat.findscore');
        Route::get('/selectdate',               'isept\admindekanat\EptscoreController@findscoreselectdate')->name('admindekanat.findscore.selectdate');
        Route::get('/selectcustomdate',         'isept\admindekanat\EptscoreController@findscoreselectcustomdate')->name('admindekanat.findscore.selectcustomdate');
    });

    Route::get('/alleptscore', 'isept\admindekanat\EptscoreController@alleptscore');

    Route::get('/supportcenter', 'ISEPTUnilaController@supportcenteradmindekanat');
    // Route::post('/exportselected',    'isept\admindekanat\EptscoreController@exportselected')->name('eptvaluemanager.alleptscore.exportselected');

    Route::group(['prefix' => 'myprofile'], function () {
        Route::get('/',             'ISEPTUnilaController@myprofile');
        Route::post('/edit/post',   'isept\MyprofileController@postEdit')->name('isept.myprofile.admindekanat.edit.post');
    });

    Route::group(['prefix' => 'changepassword'], function () {
        Route::get('/',             'ISEPTUnilaController@changepassword');
        Route::post('/edit/post',   'isept\ChangepasswordController@postEdit')->name('isept.changepassword.admindekanat.edit.post');
    });

  });

});

Route::group(['middleware' => 'chiefofthe-board', 'prefix' => 'islcunila'], function(){

  Route::group(['prefix' => 'chiefoftheboard'], function () {

    Route::get('/', 'HomeController@homepagechiefoftheboard')->name('chiefoftheboard.index');

// EPT CHART BEGIN

    Route::get('/eptchart' , 'islcunila\EptfacultyController@filterdata')->name('islcunila.chiefoftheboard.eptchart');
    Route::get('/eptchart/filterdata' , 'islcunila\EptfacultyController@filterdata')->name('islcunila.chiefoftheboard.eptchart.filterdata');
    Route::get('/eptchart/pdf' , 'islcunila\EptfacultyController@pdf_university')->name('islcunila.chiefoftheboard.eptchart.pdf');
    Route::get('/eptfaculty' , 'islcunila\EptfacultyController@index')->name('islcunila.chiefoftheboard.eptfaculty');
    Route::get('/eptfaculty/filter' , 'islcunila\EptfacultyController@filter')->name('islcunila.chiefoftheboard.eptfaculty.filter');
    Route::get('/eptfaculty/pdf' , 'islcunila\EptfacultyController@pdf')->name('islcunila.chiefoftheboard.eptfaculty.pdf');
    Route::get('/eptdepartment' , 'islcunila\EptdepartmentController@index')->name('islcunila.chiefoftheboard.eptdepartment');
    Route::get('/eptdepartment/selectfaculty' , 'islcunila\EptdepartmentController@selectfaculty')->name('islcunila.chiefoftheboard.eptdepartment.selectfaculty');
    Route::get('/eptdepartment/pdf' , 'islcunila\EptdepartmentController@pdf')->name('islcunila.chiefoftheboard.eptdepartment.pdf');

// EPT CHART ENDED

  Route::get('/neweptscore', 'islcunila\chiefoftheboard\EptscoreController@neweptscore')->name('chiefoftheboard.neweptscore');

  Route::group(['prefix' => 'findeptscore'], function () {
      Route::get('/',                         'islcunila\chiefoftheboard\EptscoreController@findscore')->name('chiefoftheboard.findscore');
      Route::get('/selectdate',               'islcunila\chiefoftheboard\EptscoreController@findscoreselectdate')->name('chiefoftheboard.findscore.selectdate');
      Route::get('/selectcustomdate',         'islcunila\chiefoftheboard\EptscoreController@findscoreselectcustomdate')->name('chiefoftheboard.findscore.selectcustomdate');
  });

  Route::get('/alleptscore', 'islcunila\chiefoftheboard\EptscoreController@alleptscore')->name('chiefoftheboard.alleptscore');

  Route::get('/supportcenter', 'ISCLUnilaController@supportcenterchiefoftheboard');

  Route::group(['prefix' => 'myprofile'], function () {
      Route::get('/',             'ISCLUnilaController@myprofile');
      Route::post('/edit/post',   'islcunila\MyprofileController@postEdit')->name('islcunila.myprofile.chiefoftheboard.edit.post');
  });

  Route::group(['prefix' => 'changepassword'], function () {
      Route::get('/',             'ISCLUnilaController@changepassword');
      Route::post('/edit/post',   'islcunila\ChangepasswordController@postEdit')->name('islcunila.changepassword.chiefoftheboard.edit.post');
  });

  });

});


Route::group(['middleware' => 'ept-participant', 'prefix' => 'isept'], function(){

  Route::group(['prefix' => 'eptparticipant'], function () {

    Route::get('/', 'isept\eptparticipant\HomepageController@index')->name('eptparticipant.index');

    Route::get('/myeptscore', 'isept\eptparticipant\MyeptscoreController@index')->name('eptparticipant.myeptscore');

    Route::get('/supportcenter', 'ISEPTUnilaController@supportcentereptparticipant');

    Route::get('/registerept', 'isept\eptparticipant\RegistereptController@index');

    Route::group(['prefix' => 'myprofile'], function () {
        Route::get('/',                   'isept\eptparticipant\MyprofileController@index')->name('eptparticipant.myprofile');
        Route::post('/edit/post',         'isept\eptparticipant\MyprofileController@postEdit')->name('isept.myprofile.eptparticipant.edit.post');
        Route::get('/viewpic/{id}',	      'isept\eptparticipant\MyprofileController@viewpic')->name('eptparticipant.myprofile.viewpic');
        Route::get('/mypic/{id}',	        'isept\eptparticipant\MyprofileController@streampic')->name('eptparticipant.myprofile.streampic');
    });

    Route::group(['prefix' => 'changepassword'], function () {
        Route::get('/',             'ISEPTUnilaController@changepassword');
        Route::post('/edit/post',   'isept\ChangepasswordController@postEdit')->name('isept.changepassword.eptparticipant.edit.post');
    });

    Route::get('/get_image/{name}', 'isept\eptparticipant\RegistereptController@getPictureProfile')->name('eptparticipant.profile_picture');
    Route::get('/get_image_cetak/{name}', 'isept\eptparticipant\RegistereptController@getPictureProfileCetak')->name('eptparticipant.profile_picture.cetak');

    Route::post('/register-ept', 'isept\eptparticipant\RegistereptController@registerEpt')->name('eptparticipant.register.ept');

    Route::post('/search-major', 'isept\eptparticipant\RegistereptController@searchMajor')->name('search.major');


});

});


Route::group(['middleware' => 'auth'], function(){
  Route::post('/search-ept-type', 'isept\eptparticipant\RegistereptController@searchEptType')->name('search.ept_by_type');

  Route::post('/search-ept-type-universal', 'isept\eptparticipant\RegistereptController@searchEptTypeUniversal')->name('search.ept_by_type_universal');

  Route::post('/search-ept-date', 'isept\eptparticipant\RegistereptController@searchEptDate')->name('search.ept_by_date');

  Route::post('/exportexcel',    'isept\EptresultController@export')->name('eptresult.exportexcel');

  Route::post('/exportpdf',               'isept\EptresultController@export')->name('eptresult.exportpdf');
  Route::post('/vieweptresult',	          'isept\EptresultController@vieweptresult')->name('isept.vieweptresult');
  Route::get('/streameptresult/{name}',	  'isept\EptresultController@streameptresult')->name('isept.streameptresult');
  Route::post('/vieweptresultislc',	          'islcunila\EptresultController@vieweptresult')->name('islcunila.vieweptresult');

  Route::post('/exportexcelselected',    'isept\EptresultController@exportselected')->name('eptresult.exportexcelselected');

  Route::post('/exportexcelfaculty',    'isept\EptresultController@exportfaculty')->name('eptresult.exportexcelfaculty');

  Route::post('/exportpdfselected',               'isept\EptresultController@exportselected')->name('eptresult.exportpdfselected');
  Route::post('/vieweptresultselected',	          'isept\EptresultController@vieweptresultselected')->name('isept.vieweptresultselected');
  Route::get('/streameptresultselected/{name}',	  'isept\EptresultController@streameptresultselected')->name('isept.streameptresultselected');
});

Route::group(['middleware' => 'web'], function(){
  Route::get('isclunila/login', 'ISCLUnilaController@login');
  Route::get('isept/login', 'ISEPTUnilaController@login');
});

// Route::auth();
// Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

// Registration Routes... removed!

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

Route::get('/home', 'HomeController@index')->name('allhome');
