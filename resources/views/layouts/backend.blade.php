<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Passolution Backend</title>

    <meta name="description" content="Passolution Backend">
    <meta name="author" content="Daniel Henninger">
    <meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

    <!-- Fonts and Styles -->
    @yield('css_before')
    <link rel="stylesheet" id="css-main" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" id="css-theme" href="{{ mix('css/dashmix.css') }}">

    <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
    @if (request()->getSchemeAndHttpHost() == 'https://pds-devel-backend.appspot.com')
        <link rel="stylesheet" href="{{ mix('css/themes/xwork.css') }}">
    @endif

@yield('css_after')

<!-- Scripts -->
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
</head>
<body>
<!-- Page Container -->
<!--
    Available classes for #page-container:

GENERIC

    'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

SIDEBAR & SIDE OVERLAY

    'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
    'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
    'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
    'sidebar-dark'                              Dark themed sidebar

    'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
    'side-overlay-o'                            Visible Side Overlay by default

    'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

    'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

HEADER

    ''                                          Static Header if no class is added
    'page-header-fixed'                         Fixed Header


Footer

    ''                                          Static Footer if no class is added
    'page-footer-fixed'                         Fixed Footer (please have in mind that the footer has a specific height when is fixed)

HEADER STYLE

    ''                                          Classic Header style if no class is added
    'page-header-dark'                          Dark themed Header
    'page-header-glass'                         Light themed Header with transparency by default
                                                (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
    'page-header-glass page-header-dark'         Dark themed Header with transparency by default
                                                (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

MAIN CONTENT LAYOUT

    ''                                          Full width Main Content if no class is added
    'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
    'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
-->

<div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-dark main-content-narrow sidebar-dark">
    <!-- Side Overlay-->
    <aside id="side-overlay">
        <!-- Side Header -->
        <div class="bg-image" style="background-image: url('{{ asset('media/various/bg_side_overlay_header.jpg') }}');">
            <div class="bg-primary-op">
                <div class="content-header">
                    <!-- User Avatar -->
                    <a class="img-link mr-1" href="javascript:void(0)">
                        <img class="img-avatar img-avatar48" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
                    </a>
                    <!-- END User Avatar -->

                    <!-- User Info -->
                    <div class="ml-2">
                        @auth
                            <a class="text-white font-w600" href="javascript:void(0)">{{ Auth::user()->name }}</a>
                            <div class="text-white-75 font-size-sm font-italic">CEO, Full Stack Developer</div>
                        @endauth
                    </div>
                    <!-- END User Info -->

                    <!-- Close Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="ml-auto text-white" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
                        <i class="fa fa-times-circle"></i>
                    </a>
                    <!-- END Close Side Overlay -->
                </div>
            </div>
        </div>
        <!-- END Side Header -->

        <!-- Side Content -->
        <div class="content-side">
            <p>
                .
            </p>
        </div>
        <!-- END Side Content -->
    </aside>
    <!-- END Side Overlay -->

    <!-- Sidebar -->
    <!--
        Sidebar Mini Mode - Display Helper classes

        Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
        Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
            If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

        Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
        Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
        Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
    -->
    <nav id="sidebar" aria-label="Main Navigation">
        <!-- Side Header -->
        <div class="bg-header-dark">
            <div class="content-header bg-white-10">
                <!-- Logo -->
                <a class="link-fx font-w600 font-size-lg text-white" href="/">
                    <span class="smini-visible">
                        <span class="text-white-75">D</span><span class="text-white">x</span>
                    </span>
                    <span class="smini-hidden">
                        <span class="text-white-75">Pas</span><span class="text-white">solution</span>
                    </span>
                </a>
                <!-- END Logo -->

                <!-- Options -->
                <div>
                    <!-- Toggle Sidebar Style -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
                    <a class="js-class-toggle text-white-75" data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on" data-toggle="layout" data-action="sidebar_style_toggle" href="javascript:void(0)">
                        <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                    </a>
                    <!-- END Toggle Sidebar Style -->

                    <!-- Close Sidebar, Visible only on mobile screens -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                        <i class="fa fa-times-circle"></i>
                    </a>
                    <!-- END Close Sidebar -->
                </div>
                <!-- END Options -->
            </div>
        </div>
        <!-- END Side Header -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                        <i class="nav-main-link-icon si si-cursor"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                        <span class="nav-main-link-badge badge badge-pill badge-success">4</span>
                    </a>
                    <a class="nav-main-link{{ request()->is('timetracking') ? ' active' : '' }}" href="/timetracking">
                        <i class="nav-main-link-icon si si-cursor"></i>
                        <span class="nav-main-link-name">Time tracking</span>
                        <span class="nav-main-link-badge badge badge-pill badge-success">1</span>
                    </a>
                </li>

                <li class="nav-main-heading">Cache</li>

                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu{{ request()->is('cache.redis') ? ' active' : '' }}" data-toggle="submenu" aria-haspopup="true" aria-expanded="true">
                        <i class="nav-main-link-icon fa fa-server"></i>
                        <span class="nav-main-link-name">Redis Store</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('cache/redis/sync') ? ' active' : '' }}" href="{{ route('cache.redis.sync') }}">
                                <span class="nav-main-link-name">Sync Redis Store</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('cache/redis/check') ? ' active' : '' }}" href="{{ route('cache.redis.check') }}">
                                <span class="nav-main-link-name">Check Redis Store</span>
                            </a>
                        </li>
                    </ul>

                <li class="nav-main-heading">Conditions</li>

                <a class="nav-main-link{{ request()->is('corona') ? ' active' : '' }}" href="{{ route('corona.index') }}">
                    <i class="nav-main-link-icon fa fa-globe-americas"></i>
                    <span class="nav-main-link-name">Corona</span>
                </a>

                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu{{ request()->is('entries') ? ' active' : '' }}" data-toggle="submenu" aria-haspopup="true" aria-expanded="true">
                        <i class="nav-main-link-icon fa fa-globe"></i>
                        <span class="nav-main-link-name">Entry</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('entries') ? ' active' : '' }}" href="{{ route('entries.index') }}">
                                <span class="nav-main-link-name">List all Entry</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('entries/check/noinfos') ? ' active' : '' }}" href="{{ route('entries.check.noinfos') }}">
                                <span class="nav-main-link-name">Checklist<br> "no info available"</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('entries/check/tempstops') ? ' active' : '' }}" href="{{ route('entries.check.tempstops') }}">
                                <span class="nav-main-link-name">Checklist<br> "temporary stops"</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('entries/check/passassign') ? ' active' : '' }}" href="{{ route('entries.check.passassign') }}">
                                <span class="nav-main-link-name">Check entry settings</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('entries/check/assign') ? ' active' : '' }}" href="{{ route('entries.check.assign') }}">
                                <span class="nav-main-link-name">Check assigned nationalities</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('entries/check/additionalcontentreminder') ? ' active' : '' }}" href="{{ route('entries.check.additionalcontentreminder') }}">
                                <span class="nav-main-link-name">Additional Content reminders</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu{{ request()->is('visas') ? ' active' : '' }}" data-toggle="submenu" aria-haspopup="true" aria-expanded="true">
                        <i class="nav-main-link-icon fa fa-globe"></i>
                        <span class="nav-main-link-name">Visa</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('visas') ? ' active' : '' }}" href="{{ route('visas.index') }}">
                                <span class="nav-main-link-name">List all Visa</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('visas/check/noinfos') ? ' active' : '' }}" href="{{ route('visas.check.noinfos') }}">
                                <span class="nav-main-link-name">Checklist<br> "no info available"</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('visas/check/require1') ? ' active' : '' }}" href="{{ route('visas.check.require1') }}">
                                <span class="nav-main-link-name">Check Visa Requirement</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('visas/check/assign') ? ' active' : '' }}" href="{{ route('visas.check.assign') }}">
                                <span class="nav-main-link-name">Check assigned nationalities</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('visas/check/additionalcontentreminder') ? ' active' : '' }}" href="{{ route('visas.check.additionalcontentreminder') }}">
                                <span class="nav-main-link-name">Additional Content reminders</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu{{ request()->is('transitvisas') ? ' active' : '' }}" data-toggle="submenu" aria-haspopup="true" aria-expanded="true">
                        <i class="nav-main-link-icon fa fa-globe"></i>
                        <span class="nav-main-link-name">Transitvisa</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('transitvisas') ? ' active' : '' }}" href="{{ route('transitvisas.index') }}">
                                <span class="nav-main-link-name">List all Transitvisa</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('transitvisas/check/assign') ? ' active' : '' }}" href="{{ route('transitvisas.check.assign') }}">
                                <span class="nav-main-link-name">Check assigned nationalities</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('transitvisas/check/additionalcontentreminder') ? ' active' : '' }}" href="{{ route('transitvisas.check.additionalcontentreminder') }}">
                                <span class="nav-main-link-name">Additional Content reminders</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu{{ request()->is('cruisevisa') ? ' active' : '' }}" data-toggle="submenu" aria-haspopup="true" aria-expanded="true">
                        <i class="nav-main-link-icon fa fa-globe"></i>
                        <span class="nav-main-link-name">Health Information</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('inoculations') ? ' active' : '' }}" href="{{ route('inoculations.index') }}">
                                <span class="nav-main-link-name">List all Health Information</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('inoculations/noinfos') ? ' active' : '' }}" href="{{ route('inoculations.check.noinfos') }}">
                                <span class="nav-main-link-name">Checklist<br> "no info available"</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('inoculations/check/additionalcontentreminder') ? ' active' : '' }}" href="{{ route('inoculations.check.additionalcontentreminder') }}">
                                <span class="nav-main-link-name">Additional Content reminders</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-heading">Cruise</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu{{ request()->is('cruisevisa') ? ' active' : '' }}" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="/cruisevisa">
                        <i class="nav-main-link-icon fa fa-ship"></i>
                        <span class="nav-main-link-name">TUI Cruises</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <!--
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('cruisetuics/sync') ? ' active' : '' }}" href="{{ route('cruisetuics.sync') }}">
                                <span class="nav-main-link-name">Sync</span>
                            </a>
                        </li>-->
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('cruisetuics') ? ' active' : '' }}" href="{{ route('cruisetuics.index') }}">
                                <span class="nav-main-link-name">Liste alle</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-heading">Clients</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('usersweb') ? ' active' : '' }}" href="{{ route('usersweb.index') }}">
                            <i class="nav-main-link-icon si si-user"></i>
                            <span class="nav-main-link-name">List</span>
                        </a>
                    </li>
                <!--
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('adrheads') ? ' active' : '' }}" href="{{ route('adrheads.index') }}">
                        <i class="nav-main-link-icon si si-users"></i>
                        <span class="nav-main-link-name">List</span>
                    </a>
                    </li>-->

                <li class="nav-main-heading">Settings</li>
                <a class="nav-main-link{{ request()->is('countries') ? ' active' : '' }}" href="{{ route('countries.index') }}">
                    <i class="nav-main-link-icon fa fa-globe-americas"></i>
                    <span class="nav-main-link-name">Country</span>
                </a>
                <a class="nav-main-link{{ request()->is('nationalities') ? ' active' : '' }}" href="{{ route('nationalities.index') }}">
                    <i class="nav-main-link-icon fa fa-globe-americas"></i>
                    <span class="nav-main-link-name">Nationality</span>
                </a>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon si si-bulb"></i>
                        <span class="nav-main-link-name">Currency</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('currency') ? ' active' : '' }}" href="{{ route('currency.index') }}">
                                <span class="nav-main-link-name">List</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="">
                                <span class="nav-main-link-name">Translation</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon si si-bulb"></i>
                        <span class="nav-main-link-name">Client</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('adrheadbranches') ? ' active' : '' }}" href="{{ route('adrheadbranches.index') }}">
                                <span class="nav-main-link-name">Branch</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('adrheadroles') ? ' active' : '' }}" href="{{ route('adrheadroles.index') }}">
                                <span class="nav-main-link-name">Role</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('adrheadkinds') ? ' active' : '' }}" href="{{ route('adrheadkinds.index') }}">
                                <span class="nav-main-link-name">Kind</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('adrheadcooperations') ? ' active' : '' }}" href="{{ route('adrheadcooperations.index') }}">
                                <span class="nav-main-link-name">Cooperation / Chain</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('adrheadsoftwareproviders') ? ' active' : '' }}" href="{{ route('adrheadsoftwareproviders.index') }}">
                                <span class="nav-main-link-name">Software provider</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('adrheadtags') ? ' active' : '' }}" href="{{ route('adrheadtags.index') }}">
                                <span class="nav-main-link-name">Tags</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <a class="nav-main-link{{ request()->is('infosystems') ? ' active' : '' }}" href="{{ route('infosystems.index') }}">
                    <i class="nav-main-link-icon si si-info"></i>
                    <span class="nav-main-link-name">Infosystem</span>
                </a>
                <a class="nav-main-link{{ request()->is('infosystems2') ? ' active' : '' }}" href="{{ route('infosystems2.index') }}">
                    <i class="nav-main-link-icon si si-info"></i>
                    <span class="nav-main-link-name">Corona Infos</span>
                </a>
                <a class="nav-main-link{{ request()->is('contents') ? ' active' : '' }}" href="{{ route('contents.index') }}">
                    <i class="nav-main-link-icon si si-docs"></i>
                    <span class="nav-main-link-name">Standard Content</span>
                </a>
                <a class="nav-main-link{{ request()->is('contents') ? ' active' : '' }}" href="{{ route('contentgroups.index') }}">
                    <i class="nav-main-link-icon si si-docs"></i>
                    <span class="nav-main-link-name">Content Group</span>
                </a>
                <a class="nav-main-link{{ request()->is('translations') ? ' active' : '' }}" href="{{ route('translations.index') }}">
                    <i class="nav-main-link-icon fa fa-globe-americas"></i>
                    <span class="nav-main-link-name">Translation</span>
                </a>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon si si-bulb"></i>
                        <span class="nav-main-link-name">Entry</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('entryidentitydocuments') ? ' active' : '' }}" href="{{ route('entryidentitydocuments.index') }}">
                                <span class="nav-main-link-name">Identity document</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('entrypassports') ? ' active' : '' }}" href="{{ route('entrypassports.index') }}">
                                <span class="nav-main-link-name">Passport</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('entryaddinfos') ? ' active' : '' }}" href="{{ route('entryaddinfos.index') }}">
                                <span class="nav-main-link-name">Additional settings</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('entryminors') ? ' active' : '' }}" href="{{ route('entryminors.index') }}">
                                <span class="nav-main-link-name">Entry Minor</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon si si-bulb"></i>
                        <span class="nav-main-link-name">Visa</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('visadocuments') ? ' active' : '' }}" href="{{ route('visadocuments.index') }}">
                                <span class="nav-main-link-name">Document</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon si si-bulb"></i>
                        <span class="nav-main-link-name">Transitvisa</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('transitvisainfos') ? ' active' : '' }}" href="{{ route('transitvisainfos.index') }}">
                                <span class="nav-main-link-name">Options</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon si si-bulb"></i>
                        <span class="nav-main-link-name">TUI Cruises</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                                <span class="nav-main-link-name">xxx</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                                <span class="nav-main-link-name">yyy</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">

                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon si si-bulb"></i>
                        <span class="nav-main-link-name">Health Information</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('immunisations') ? ' active' : '' }}" href="{{ route('immunisations.index') }}">
                                <span class="nav-main-link-name">Immunisations</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('inooptionchildren') ? ' active' : '' }}" href="{{ route('inooptionchildren.index') }}">
                                <span class="nav-main-link-name">Immunisation options children</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('inooptionpregnants') ? ' active' : '' }}" href="{{ route('inooptionpregnants.index') }}">
                                <span class="nav-main-link-name">Immunisation options pregnants</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('inoculationspecifics') ? ' active' : '' }}" href="{{ route('inoculationspecifics.index') }}">
                                <span class="nav-main-link-name">Immunisation specifics</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-heading">More</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('requests') ? ' active' : '' }}" href="{{ route('requests.index') }}">
                        <i class="nav-main-link-icon si si-globe"></i>
                        <span class="nav-main-link-name">Requests</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('users') ? ' active' : '' }}" href="{{ route('users.index') }}">
                        <i class="nav-main-link-icon si si-user"></i>
                        <span class="nav-main-link-name">Users</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('useractions') ? ' active' : '' }}" href="{{ route('useractions.index') }}">
                        <i class="nav-main-link-icon si si-globe"></i>
                        <span class="nav-main-link-name">Activities</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="/">
                        <i class="nav-main-link-icon si si-globe"></i>
                        <span class="nav-main-link-name">Landing</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div>
                <!-- Toggle Sidebar -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                <button type="button" class="btn btn-dual mr-1" data-toggle="layout" data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <!-- END Toggle Sidebar -->

                <!-- Open Search Section -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-dual" data-toggle="layout" data-action="header_search_on">
                    <i class="fa fa-fw fa-search"></i> <span class="ml-1 d-none d-sm-inline-block">Search</span>
                </button>
                <!-- END Open Search Section -->
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div>
                <!-- User Dropdown -->
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-user d-sm-none"></i>
                        <span class="d-none d-sm-inline-block">Admin</span>
                        <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                        <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
                            User Options
                        </div>
                        <div class="p-2">
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="far fa-fw fa-user mr-1"></i> Profile
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                <span><i class="far fa-fw fa-envelope mr-1"></i> Inbox</span>
                                <span class="badge badge-primary">3</span>
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="far fa-fw fa-file-alt mr-1"></i> Invoices
                            </a>
                            <div role="separator" class="dropdown-divider"></div>

                            <!-- Toggle Side Overlay -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_toggle">
                                <i class="far fa-fw fa-building mr-1"></i> Settings
                            </a>
                            <!-- END Side Overlay -->
                            @auth
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Abmelden
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
                <!-- END User Dropdown -->

                <!-- Notifications Dropdown -->
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i>
                        <span class="badge badge-secondary badge-pill">5</span>
                    </button>
                    <notification-area :user="{{ auth()->user() }}"></notification-area>
                    <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown">
                        <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
                            Notifications
                        </div>
                        <ul class="nav-items my-2">
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mx-3">
                                        <i class="fa fa-fw fa-check-circle text-success"></i>
                                    </div>
                                    <div class="media-body font-size-sm pr-2">
                                        <div class="font-w600">App was updated to v5.6!</div>
                                        <div class="text-muted font-italic">3 min ago</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mx-3">
                                        <i class="fa fa-fw fa-user-plus text-info"></i>
                                    </div>
                                    <div class="media-body font-size-sm pr-2">
                                        <div class="font-w600">New Subscriber was added! You now have 2580!</div>
                                        <div class="text-muted font-italic">10 min ago</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mx-3">
                                        <i class="fa fa-fw fa-times-circle text-danger"></i>
                                    </div>
                                    <div class="media-body font-size-sm pr-2">
                                        <div class="font-w600">Server backup failed to complete!</div>
                                        <div class="text-muted font-italic">30 min ago</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mx-3">
                                        <i class="fa fa-fw fa-exclamation-circle text-warning"></i>
                                    </div>
                                    <div class="media-body font-size-sm pr-2">
                                        <div class="font-w600">You are running out of space. Please consider upgrading your plan.</div>
                                        <div class="text-muted font-italic">1 hour ago</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mx-3">
                                        <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                    </div>
                                    <div class="media-body font-size-sm pr-2">
                                        <div class="font-w600">New Sale! + $30</div>
                                        <div class="text-muted font-italic">2 hours ago</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="p-2 border-top">
                            <a class="btn btn-light btn-block text-center" href="javascript:void(0)">
                                <i class="fa fa-fw fa-eye mr-1"></i> View All
                            </a>
                        </div>
                    </div> -->
                </div>
                <!-- END Notifications Dropdown -->

                <!-- Toggle Side Overlay -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-dual" data-toggle="layout" data-action="side_overlay_toggle">
                    <i class="far fa-fw fa-list-alt"></i>
                </button>
                <!-- END Toggle Side Overlay -->
            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Search -->
        <div id="page-header-search" class="overlay-header bg-primary">
            <div class="content-header">
                <form id="form_searchcondition" class="w-100" target="_blank">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-primary" data-toggle="layout" data-action="header_search_off">
                                <i class="fa fa-fw fa-times-circle"></i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <input type="text" name="nat" class="form-control border-0" placeholder="Search Nationality" required>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <input type="text" name="destco" class="form-control border-0" placeholder="Search Destination" required>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <input type="text" name="lang" class="form-control border-0" placeholder="Search Language" required>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <select name="mode" class="form-control form-control-alt" required>
                                    <option value="">choose</option>
                                    <option value="html">HTML</option>
                                    <option value="pdf">PDF</option>
                                    <option value="json">JSON</option>
                                </select>
                            </div>
                            <div class="col-lg-1 col-md-6 col-sm-12">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Header Search -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-primary-darker">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
                </div>
            </div>
        </div>
        <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        @yield('content')
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
        <div class="content py-0">
            <div class="row font-size-sm">
                <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-right">
                    Crafted with <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="https://passolution.de" target="_blank">Passolution GmbH</a>
                </div>
                <div class="col-sm-6 order-sm-1 text-center text-sm-left">
                    <a class="font-w600" href="https://passolution.de" target="_blank">Passolution</a> &copy; <span data-toggle="year-copy">2017</span>
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->
</div>
<!-- END Page Container -->

@yield('js_before')

<!-- Dashmix Core JS -->
<script src="{{ mix('js/dashmix.app.js') }}"></script>

<!-- Laravel Scaffolding JS -->
<script src="{{ mix('js/laravel.app.js') }}"></script>

<script src="/js/plugins/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>

@include('layouts.modals.condition')

@yield('js_form')

@yield('js_after')

</body>
</html>
