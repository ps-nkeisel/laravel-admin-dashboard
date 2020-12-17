<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix'    => 'contents',
    'as'        => 'contents.'
], function () {
    Route::post('/search', 'ContentController@search')->name('search');
    Route::post('/compare', 'ContentController@compare')->name('compare');
});

Route::group([
    'prefix'    => 'infosystems',
    'as'        => 'infosystems.',
], function () {
    Route::post('/search', 'InfosystemController@search')->name('search');
});

Route::group([
    'prefix'    => 'infosystems2',
    'as'        => 'infosystems2.',
], function () {
    Route::post('/search', 'Infosystem2Controller@search')->name('search');
});

Route::group([
    'prefix'    => 'useractions',
    'as'        => 'useractions.',
], function () {
    Route::post('/search', 'UseractionController@search')->name('search');
});

Route::group([
    'prefix'    => 'immunisations',
    'as'        => 'immunisations.',
], function () {
    Route::post('/search', 'ImmunisationController@search')->name('search');
});

Route::group([
    'prefix'    => 'inooptionchildren',
    'as'        => 'inooptionchildren.',
], function () {
    Route::post('/search', 'InooptionchildController@search')->name('search');
});

Route::group([
    'prefix'    => 'inooptionpregnants',
    'as'        => 'inooptionpregnants.',
], function () {
    Route::post('/search', 'InooptionpregnantController@search')->name('search');
});

Route::group([
    'prefix'    => 'inoculationspecifics',
    'as'        => 'inoculationspecifics.',
], function () {
    Route::post('/search', 'InoculationspecificController@search')->name('search');
});

Route::group([
    'prefix'    => 'inoculations',
    'as'        => 'inoculations.',
], function () {
    Route::post('/search', 'InoculationController@search')->name('search');
    Route::post('/search_versions', 'InoculationController@search_versions')->name('search_versions');
    Route::post('/report', 'InoculationController@report')->name('report');
    Route::post('/compare', 'InoculationController@compare')->name('compare');
    Route::post('/check', 'InoculationController@check')->name('check');
    Route::post('/get_id', 'InoculationController@get_id')->name('get_id');
    Route::post('/preview', 'InoculationController@preview')->name('preview');
    Route::put('/preview', 'InoculationController@preview')->name('preview');
    Route::group([
        'prefix'    => 'check',
        'as'        => 'check.',
    ], function () {
        Route::post('/noinfos', 'InoculationController@check_noinfos')->name('noinfos');
        Route::post('/reminder', 'InoculationController@check_reminder')->name('reminder');
    });
    Route::post('/add_to_cache', 'InoculationController@add_to_cache')->name('add_to_cache');
});

Route::group([
    'prefix'    => 'languages',
    'as'        => 'languages.',
], function () {
    Route::post('/translate', 'LanguageController@translate')->name('translate');
});

Route::group([
    'prefix'    => 'countries',
    'as'        => 'countries.',
], function () {
    Route::post('/search', 'CountryController@search')->name('search');
    Route::post('/search_by_code', 'CountryController@search_by_code')->name('search_by_code');
    Route::post('/search_currency', 'CountryController@search_currency')->name('search_currency');
});

Route::group([
    'prefix'    => 'nationalities',
    'as'        => 'nationalities.',
], function () {
    Route::post('/search', 'NationalityController@search')->name('search');
});

Route::group([
    'prefix'    => 'corona',
    'as'        => 'corona.',
], function () {
    Route::post('/search', 'CoronaController@search')->name('search');
});

Route::group([
    'prefix'    => 'visas',
    'as'        => 'visas.',
], function () {
    Route::post('/search', 'VisaController@search')->name('search');
    Route::post('/search_versions', 'VisaController@search_versions')->name('search_versions');
    Route::post('/search_nats', 'VisaController@search_nats')->name('search_nats');
    Route::post('/report', 'VisaController@report')->name('report');
    Route::post('/compare', 'VisaController@compare')->name('compare');
    Route::post('/check', 'VisaController@check')->name('check');
    Route::post('/get_id', 'VisaController@get_id')->name('get_id');
    Route::post('/preview', 'VisaController@preview')->name('preview');
    Route::put('/preview', 'VisaController@preview')->name('preview');
    Route::group([
        'prefix'    => 'check',
        'as'        => 'check.',
    ], function () {
        Route::post('/noinfos', 'VisaController@check_noinfos')->name('noinfos');
        Route::post('/require1', 'VisaController@check_require1')->name('require1');
        Route::post('/reminder', 'VisaController@check_reminder')->name('reminder');
    });
    Route::post('/add_to_cache', 'VisaController@add_to_cache')->name('add_to_cache');
});

Route::group([
    'prefix'    => 'entries',
    'as'        => 'entries.',
], function () {
    Route::post('/search', 'EntryController@search')->name('search');
    Route::post('/search_versions', 'EntryController@search_versions')->name('search_versions');
    Route::post('/search_nats', 'EntryController@search_nats')->name('search_nats');
    Route::post('/report', 'EntryController@report')->name('report');
    Route::post('/compare', 'EntryController@compare')->name('compare');
    Route::post('/check', 'EntryController@check')->name('check');
    Route::post('/get_id', 'EntryController@get_id')->name('get_id');
    Route::post('/preview', 'EntryController@preview')->name('preview');
    Route::put('/preview', 'EntryController@preview')->name('preview');
    Route::group([
        'prefix'    => 'check',
        'as'        => 'check.',
    ], function () {
        Route::post('/noinfos', 'EntryController@check_noinfos')->name('noinfos');
        Route::post('/tempstops', 'EntryController@check_tempstops')->name('tempstops');
        Route::post('/passassign', 'EntryController@check_passassign')->name('passassign');
        Route::post('/reminder', 'EntryController@check_reminder')->name('reminder');
    });
    Route::post('/add_to_cache', 'EntryController@add_to_cache')->name('add_to_cache');
});

Route::group([
    'prefix'    => 'visadocuments',
    'as'        => 'visadocuments.',
], function () {
    Route::post('/search', 'VisadocumentController@search')->name('search');
});

Route::group([
    'prefix'    => 'entryidentitydocuments',
    'as'        => 'entryidentitydocuments.',
], function () {
    Route::post('/search', 'EntryidentitydocumentController@search')->name('search');
});

Route::group([
    'prefix'    => 'translations',
    'as'        => 'translations.',
], function () {
    Route::post('/search', 'TranslationController@search')->name('search');
});

Route::group([
    'prefix'    => 'entrypassports',
    'as'        => 'entrypassports.',
], function () {
    Route::post('/search', 'EntrypassportController@search')->name('search');
});

Route::group([
    'prefix'    => 'entryaddinfos',
    'as'        => 'entryaddinfos.',
], function () {
    Route::post('/search', 'EntryaddinfoController@search')->name('search');
});

Route::group([
    'prefix'    => 'cruisetuics',
    'as'        => 'cruisetuics.',
], function () {
    Route::post('/search', 'CruisetuicController@search')->name('search');
    Route::post('/search_versions', 'CruisetuicController@search_versions')->name('search_versions');
    Route::post('/search_nats', 'CruisetuicController@search_nats')->name('search_nats');
    Route::post('/report', 'CruisetuicController@report')->name('report');
    Route::post('/compare', 'CruisetuicController@compare')->name('compare');
    Route::post('/check', 'CruisetuicController@check')->name('check');
    Route::post('/get_id', 'CruisetuicController@get_id')->name('get_id');
    Route::post('/preview', 'CruisetuicController@preview')->name('preview');
    Route::put('/preview', 'CruisetuicController@preview')->name('preview');
});

Route::group([
    'prefix'    => 'entryminors',
    'as'        => 'entryminors.',
], function () {
    Route::post('/search', 'EntryminorController@search')->name('search');
});

Route::group([
    'prefix'    => 'adrheads',
    'as'        => 'adrheads.',
], function () {
    Route::post('/search', 'AdrheadController@search')->name('search');
});

Route::group([
    'prefix'    => 'adrheadkinds',
    'as'        => 'adrheadkinds.',
], function () {
    Route::post('/search', 'AdrheadkindController@search')->name('search');
});

Route::group([
    'prefix'    => 'adrheadbranches',
    'as'        => 'adrheadbranches.',
], function () {
    Route::post('/search', 'AdrheadbranchController@search')->name('search');
});

Route::group([
    'prefix'    => 'adrheadroles',
    'as'        => 'adrheadroles.',
], function () {
    Route::post('/search', 'AdrheadroleController@search')->name('search');
});

Route::group([
    'prefix'    => 'adrheadpaymentperiodes',
    'as'        => 'adrheadpaymentperiodes.',
], function () {
    Route::post('/search', 'AdrheadpaymentperiodController@search')->name('search');
});

Route::group([
    'prefix'    => 'adrheadcooperations',
    'as'        => 'adrheadcooperations.',
], function () {
    Route::post('/search', 'AdrheadcooperationController@search')->name('search');
});

Route::group([
    'prefix'    => 'adrheadtags',
    'as'        => 'adrheadtags.',
], function () {
    Route::post('/search', 'AdrheadtagController@search')->name('search');
});

Route::group([
    'prefix'    => 'adrheadsoftwareproviders',
    'as'        => 'adrheadsoftwareproviders.',
], function () {
    Route::post('/search', 'AdrheadsoftwareproviderController@search')->name('search');
});

Route::group([
    'prefix'    => 'contentgroups',
    'as'        => 'contentgroups.',
], function () {
    Route::post('/search', 'ContentgroupController@search')->name('search');
});

Route::group([
    'prefix'    => 'notifications',
    'as'        => 'notifications.',
], function () {
    Route::get('/global', 'NotificationController@getGlobalNotifications')->name('global');
    Route::post('/user', 'NotificationController@getUserNotifications')->name('user');
});

Route::group([
    'prefix'    => 'transitvisas',
    'as'        => 'transitvisas.',
], function () {
    Route::post('/search', 'TransitvisaController@search')->name('search');
    Route::post('/search_versions', 'TransitvisaController@search_versions')->name('search_versions');
    Route::post('/search_nats', 'TransitvisaController@search_nats')->name('search_nats');
    Route::post('/report', 'TransitvisaController@report')->name('report');
    Route::post('/compare', 'TransitvisaController@compare')->name('compare');
    Route::post('/check', 'TransitvisaController@check')->name('check');
    Route::post('/get_id', 'TransitvisaController@get_id')->name('get_id');
    Route::post('/preview', 'TransitvisaController@preview')->name('preview');
    Route::put('/preview', 'TransitvisaController@preview')->name('preview');
    Route::group([
        'prefix'    => 'check',
        'as'        => 'check.',
    ], function () {
        Route::post('/reminder', 'TransitvisaController@check_reminder')->name('reminder');
    });
    Route::post('/add_to_cache', 'TransitvisaController@add_to_cache')->name('add_to_cache');
});

Route::group([
    'prefix'    => 'transitvisainfos',
    'as'        => 'transitvisainfos.',
], function () {
    Route::post('/search', 'TransitvisainfoController@search')->name('search');
});

Route::group([
    'prefix'    => 'contentadditionals',
    'as'        => 'contentadditionals.',
], function () {
    Route::post('/search', 'ContentadditionalController@search')->name('search');
});

Route::group([
    'prefix'    => 'currency',
    'as'        => 'currency.',
], function () {
    Route::post('/search', 'CurrencyController@search')->name('search');
});

Route::group([
    'prefix'    => 'users',
    'as'        => 'users.',
], function () {
    Route::post('/search', 'UserController@search')->name('search');
});

Route::group([
    'prefix'    => 'usersweb',
    'as'        => 'usersweb.',
], function () {
    Route::post('/search', 'UserswebController@search')->name('search');
    Route::post('/search_assignto', 'UserswebController@search_assignto')->name('search_assignto');
});

Route::group([
    'prefix'    => 'requestinfo',
    'as'        => 'requestinfo.',
], function () {
    Route::post('/search', 'RequestinfoController@search')->name('search');
    Route::get('/report', 'RequestinfoController@getReport')->name('report');
});

Route::get('/condition/search', 'SearchController@searchCondition')->name('searchCondition');

Route::group([
    'prefix'    => 'cache',
    'as'        => 'cache.',
], function () {
    Route::group([
        'prefix'    => 'redis',
        'as'        => 'redis.',
    ], function () {
        Route::post('check', 'RedisController@check')->name('check');
        Route::post('store', 'RedisController@store')->name('store');
        Route::post('sync', 'RedisController@sync_store')->name('sync');
    });
});
