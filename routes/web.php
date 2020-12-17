<?php

Route::view('/', 'landing');

//Auth::routes();
Route::mixin(new \Laravel\Ui\AuthRouteMethods());
Route::auth(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::match(['get', 'post'], '/dashboard', ['uses' => 'DashboardController@index', 'as' => 'dashboard']);

Route::group([
    'prefix'    => 'inoculations',
    'as'        => 'inoculations.',
], function () {
    Route::get('/{id}/report', 'InoculationController@report')->name('report');
    Route::post('/preview', 'InoculationController@preview')->name('preview');
    Route::put('/preview', 'InoculationController@preview')->name('preview');
    Route::group([
        'prefix'    => 'check',
        'as'        => 'check.',
    ], function () {
        Route::get('/assign', 'InoculationController@check_assign')->name('assign');
        Route::get('/noinfos', function() {
            return view('inoculations.check.noinfos');
        })->name('noinfos');
        Route::get('/additionalcontentreminder', function() {
            return view('inoculations.check.additionalcontentreminder');
        })->name('additionalcontentreminder');
    });
});

Route::group([
    'prefix'    => 'visas',
    'as'        => 'visas.',
], function () {
    Route::get('/{id}/report', 'VisaController@report')->name('report');
    Route::post('/preview', 'VisaController@preview')->name('preview');
    Route::put('/preview', 'VisaController@preview')->name('preview');
    Route::group([
        'prefix'    => 'check',
        'as'        => 'check.',
    ], function () {
        Route::get('/natassign/{countrytocode}', 'VisaController@check_natassign')->name('natassign');
        Route::get('/assign', 'VisaController@check_assign')->name('assign');
        Route::get('/noinfos', function() {
            return view('visas.check.noinfos');
        })->name('noinfos');
        Route::get('/require1', 'VisaController@check_require1')->name('require1');
        Route::get('/additionalcontentreminder', function() {
            return view('visas.check.additionalcontentreminder');
        })->name('additionalcontentreminder');
    });
});

Route::group([
    'prefix'    => 'contents',
    'as'        => 'contents.',
], function () {
    Route::group([
        'prefix'    => 'check',
        'as'        => 'check.',
    ], function () {
        Route::get('/langassign/{code1}', 'ContentController@check_langassign')->name('langassign');
        Route::get('/assign', 'ContentController@check_assign')->name('assign');
    });
});

Route::group([
    'prefix'    => 'cruisetuics',
    'as'        => 'cruisetuics.',
], function () {
    Route::get('/sync', 'CruisetuicController@sync')->name('sync');
    Route::get('/{id}/report', 'CruisetuicController@report')->name('report');
    Route::post('/preview', 'CruisetuicController@preview')->name('preview');
    Route::put('/preview', 'CruisetuicController@preview')->name('preview');
    Route::group([
        'prefix'    => 'check',
        'as'        => 'check.',
    ], function () {
        Route::get('/assign', 'CruisetuicController@check_assign')->name('assign');
    });
});

Route::group([
    'prefix'    => 'entries',
    'as'        => 'entries.',
], function () {
    Route::get('/{id}/report', 'EntryController@report')->name('report');
    Route::post('/preview', 'EntryController@preview')->name('preview');
    Route::put('/preview', 'EntryController@preview')->name('preview');
    Route::group([
        'prefix'    => 'check',
        'as'        => 'check.',
    ], function () {
        Route::get('/natassign/{countrytocode}', 'EntryController@check_natassign')->name('natassign');
        Route::get('/assign', 'EntryController@check_assign')->name('assign');
        Route::get('/checktime', 'EntryController@check_countrynat_time')->name('checktime');
        Route::get('/noinfos', function() {
            return view('entries.check.noinfos');
        })->name('noinfos');
        Route::get('/tempstops', function() {
            return view('entries.check.tempstops');
        })->name('tempstops');
        Route::get('/passassign', 'EntryController@check_passassign')->name('passassign');
        Route::get('/additionalcontentreminder', function() {
            return view('entries.check.additionalcontentreminder');
        })->name('additionalcontentreminder');
    });
});

Route::group([
    'prefix'    => 'transitvisas',
    'as'        => 'transitvisas.',
], function () {
    Route::get('/{id}/report', 'TransitvisaController@report')->name('report');
    Route::post('/preview', 'TransitvisaController@preview')->name('preview');
    Route::put('/preview', 'TransitvisaController@preview')->name('preview');
    Route::group([
        'prefix'    => 'check',
        'as'        => 'check.',
    ], function () {
        Route::get('/natassign/{countrytocode}', 'TransitvisaController@check_natassign')->name('natassign');
        Route::get('/assign', 'TransitvisaController@check_assign')->name('assign');
        Route::get('/additionalcontentreminder', function() {
            return view('transitvisas.check.additionalcontentreminder');
        })->name('additionalcontentreminder');
    });
});

Route::group([
    'prefix'    => 'contentadditionals',
    'as'        => 'contentadditionals.',
], function () {
    Route::get('export/{lang}', 'ContentadditionalController@export')->name('export');
});

Route::group([
    'prefix'    => 'requests',
    'as'        => 'requests.',
], function () {
    Route::get('/', function() {
        return view('requestinfos.index');
    })->name('index');
    Route::get('/{id}', 'RequestinfoController@show')->name('show');
    Route::get('/{id}/report', 'RequestinfoController@report')->name('report');
});

Route::resources([
    'infosystems' => 'InfosystemController',
    'infosystems2' => 'Infosystem2Controller',
    'languages' => 'LanguageController',
    'contents' => 'ContentController',
    'corona' => 'CoronaController',
    'useractions' => 'UseractionController',
    'countries' => 'CountryController',
    'nationalities' => 'NationalityController',
    'inoculations' => 'InoculationController',
    'inoculationchildren' => 'InoculationchildController',
    'inooptionchildren' => 'InooptionchildController',
    'inooptionpregnants' => 'InooptionpregnantController',
    'immunisations' => 'ImmunisationController',
    'inoculationspecifics' => 'InoculationspecificController',
    'visas' => 'VisaController',
    'visadocuments' => 'VisadocumentController',
    'entries' => 'EntryController',
    'entryidentitydocuments' => 'EntryidentitydocumentController',
    'translations' => 'TranslationController',
    'entrypassports' => 'EntrypassportController',
    'entryaddinfos' => 'EntryaddinfoController',
    'entryminors' => 'EntryminorController',
    'cruisetuics' => 'CruisetuicController',
    'adrheads' => 'AdrheadController',
    'adrheadkinds' => 'AdrheadkindController',
    'adrheadbranches' => 'AdrheadbranchController',
    'adrheadroles' => 'AdrheadroleController',
    'adrheadpaymentperiodes' => 'AdrheadpaymentperiodController',
    'contentgroups' => 'ContentgroupController',
    'transitvisas' => 'TransitvisaController',
    'transitvisainfos' => 'TransitvisainfoController',
    'contentadditionals' => 'ContentadditionalController',
    'currency' => 'CurrencyController',
    'users' => 'UserController',
    'usersweb' => 'UserswebController',
    'adrheadcooperations' => 'AdrheadcooperationController',
    'adrheadsoftwareproviders' => 'AdrheadsoftwareproviderController',
    'adrheadtags' => 'AdrheadtagController',
]);

Route::get('content/search', 'SearchController@search')->name('search');

Route::group([
    'prefix'    => 'cache',
    'as'        => 'cache.',
], function () {
    Route::group([
        'prefix'    => 'redis',
        'as'        => 'redis.',
    ], function () {
        Route::get('', 'RedisController@sync')->name('sync');
        Route::get('check', 'RedisController@check')->name('check');
    });
});

Route::get('condition/report', 'SearchController@report')->name('condition.report');
