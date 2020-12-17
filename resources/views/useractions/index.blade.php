@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="/s/plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/js/plugins/jquery-pagination/pagination.min.css">
@endsection

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Activities</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">More</li>
                        <li class="breadcrumb-item active" aria-current="page">Activities</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end head -->

    @include('shared.success')
    @include('shared.error')

    <!-- filter -->
    <div class="content">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Filter</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                    </div>
                </div>
            </div>
            <div class="block-content">
                <form method="POST" enctype="multipart/form-data" id="form_useraction_search">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="d-block"><h4 class="font-w400">Sections</h4></label>
                                <div class="row">
                                    @foreach($useractionsections as $key => $row)
                                        <div class="col-3">
                                            <div
                                                class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                                <input type="checkbox"
                                                       class="custom-control-input useractionsection_ids"
                                                       id="useractionsections-{{ $row->id }}"
                                                       name="useractionsection_ids[]"
                                                       value="{{ $row->id }}" {{ $row->id==1?'checked':'' }}>
                                                <label class="custom-control-label"
                                                       for="useractionsections-{{ $row->id }}">{{ $row->content }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-groupx">
                                <label class="d-block"><h4 class="font-w400">Period</h4></label>
                                <div class="row">
                                <div class="col-3">
                                    <div
                                        class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="time-today"
                                               name="time_containment" checked="" value="today">
                                        <label class="custom-control-label" for="time-today">today</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div
                                        class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="time-yesterday"
                                               name="time_containment" value="yesterday">
                                        <label class="custom-control-label" for="time-yesterday">yesterday</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div
                                        class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="time-thisweek"
                                               name="time_containment" value="this_week">
                                        <label class="custom-control-label" for="time-thisweek">this week</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div
                                        class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="time-lastweek"
                                               name="time_containment" value="last_week">
                                        <label class="custom-control-label" for="time-lastweek">last week</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div
                                        class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="time-thismonth"
                                               name="time_containment" value="this_month">
                                        <label class="custom-control-label" for="time-thismonth">this month</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div
                                        class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="time-lastmonth"
                                               name="time_containment" value="last_month">
                                        <label class="custom-control-label" for="time-lastmonth">last month</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div
                                        class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="time-thisyear"
                                               name="time_containment" value="this_year">
                                        <label class="custom-control-label" for="time-thisyear">this year</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div
                                        class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="time-lastyear"
                                               name="time_containment" value="last_year">
                                        <label class="custom-control-label" for="time-lastyear">last year</label>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-6">
                            <label for="user_ids"><h4 class="font-w400">User</h4></label>
                            <div class="form-group">
                                <select class="js-select2 form-control" id="user_ids"
                                        name="user_ids[]"
                                        data-placeholder="Choose many.." multiple>
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="per_page"><h4 class="font-w400">Per Page</h4></label>
                            <div class="form-group">
                                <select id="per_page" name="per_page" class="form-control">
                                    <option value=5>5</option>
                                    <option value=10 selected>10</option>
                                    <option value=20>20</option>
                                    <option value=50>50</option>
                                    <option value=100>100</option>
                                    <option value=500>500</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success my-4">search</button>
                    <button type="reset" class="btn btn-secondary">reset</button>
                </form>
            </div>
        </div>
    </div>
    <!-- end filter -->

    <!-- Timeline -->
    <div class="content content-full">
        <div class="block block-rounded block-bordered dynamic_container">
            <div class="block-header block-header-default">
                <h3 class="block-title">Timeline</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <a href="{{ route('infosystems.create') }}" class="btn-block-option">
                            <span class="si si-plus" aria-hidden="true"></span>
                        </a>
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="fullscreen_toggle">
                            <i class="si si-size-fullscreen"></i>
                        </button>
                        <button type="button" class="btn-block-option btn-refresh-list" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="text-center" id="total-records">x</div>
                <!-- List -->
                <ul class="timeline timeline-centered timeline-alt" id="timeline_list">
                </ul>
                <!-- END List -->
                <!-- Pagination -->
                <ul id="timeline_pagination" class="pagination"></ul>
                <!-- END Pagination -->
            </div>
        </div>
    </div>
    <!-- END Timeline -->

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.print.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>
    <script src="/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/js/plugins/select2/js/select2.full.min.js"></script>
    <script src="/js/plugins/jquery-pagination/pagination.min.js"></script>

    @include('contents.modals.compare')
    @include('inoculations.modals.compare')

    <!-- Page JS Helpers (BS Datepicker + Select2) -->
    <script>jQuery(function () {
            Dashmix.helpers(['datepicker', 'select2']);
        });</script>

    <script>
        $(document).ready(function () {
            search();

            function generateTimeline(data) {
                $('#timeline_list li').remove();
                $.each(data, function (key, useraction) {
                    var newTimeline = `
                        <li class="timeline-event">
                            <div class="timeline-event-icon bg-xsmooth">
                                <i class="far fa-file-alt"></i>
                            </div>
                            <div class="timeline-event-block block block-rounded block-fx-pop" data-toggle="appear">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">${useraction.section_name}</h3>
                                    <small>${useraction.id}</small>
                                    <div class="block-options">
                                        <div class="timeline-event-time block-options-item font-size-sm font-w600">
                                            <div class="">${useraction.created_at}</div>
                                            <br>
                                            ${useraction.type_name} by ${useraction.created_username}
                                        </div>
                                    </div>
                                </div>
                            <div class="block-content">
                                <p>${useraction.comment}</p>
                            <div class="row">
                    `;
                    if (useraction.version) {
                        newTimeline += `<div class="col-sm-6"><p>Version: ${useraction.version}</p></div>`;
                    }
                    if (useraction.code) {
                        newTimeline += `<div class="col-sm-6"><p>Code: ${useraction.code}</p></div>`;
                    }
                    if (useraction.destination) {
                        newTimeline += `<div class="col-sm-6"><p>Destination: ${useraction.destination}</p></div>`;
                    }
                    if (useraction.language_content) {
                        newTimeline += `<div class="col-sm-6"><p>Language: ${useraction.language_content}</p></div>`;
                    }
                    newTimeline += `</div>`;

                    if (useraction.assigntype === 9) {              // Standard Text
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("contents.index") }}/${useraction.assigntonew}">Open this</a>`;
                        if (useraction.assigntoold > 0) {
                            newTimeline += `
                                <a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("contents.index") }}/${useraction.assigntoold}">Open version before</a>
                                <a class="btn btn-sm btn-light push" href="#modalContentCompare" data-toggle="modal" data-assigntoold=${useraction.assigntoold} data-assigntonew=${useraction.assigntonew}>Compare with version before</a>
                            `;
                        }
                    } else if (useraction.assigntype === 7) {       // Infosystem
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("infosystems.index") }}/${useraction.assigntonew}">Open this</a>`;
                    } else if (useraction.assigntype === 2) {       // Entry Condition
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("entries.index") }}/${useraction.assigntonew}">Open this</a>`;
                    } else if (useraction.assigntype === 12) {      // Visa Condition
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("visas.index") }}/${useraction.assigntonew}">Open this</a>`;
                    } else if (useraction.assigntype === 4) {       // Transitvisa
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("transitvisas.index") }}/${useraction.assigntonew}">Open this</a>`;
                    } else if (useraction.assigntype === 6) {       // Cruise Visa
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("cruisetuics.index") }}/${useraction.assigntonew}">Open this</a>`;
                    } else if (useraction.assigntype === 13) {      // Immunisation
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("immunisations.index") }}/${useraction.assigntonew}">Open this</a>`;
                    } else if (useraction.assigntype === 14) {      // Inooption Child
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("inooptionchildren.index") }}/${useraction.assigntonew}">Open this</a>`;
                    } else if (useraction.assigntype === 15) {      // Inooption Pregnant
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("inooptionpregnants.index") }}/${useraction.assigntonew}">Open this</a>`;
                    } else if (useraction.assigntype === 16) {      // Inoculation Specific
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("inoculationspecifics.index") }}/${useraction.assigntonew}">Open this</a>`;
                    } else if (useraction.assigntype === 17) {              // Inoculation
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("inoculations.index") }}/${useraction.assigntonew}">Open this</a>`;
                        if (useraction.assigntoold > 0) {
                            newTimeline += `
                                <a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("inoculations.index") }}/${useraction.assigntoold}">Open version before</a>
                                <a class="btn btn-sm btn-light push" href="#modalInoculationCompare" data-toggle="modal" data-assigntoold=${useraction.assigntoold} data-assigntonew=${useraction.assigntonew}>Compare with version before</a>
                            `;
                        }
                    } else if (useraction.assigntype === 18) {      // Visadocument
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("visadocuments.index") }}/${useraction.assigntonew}">Open this</a>`;
                    } else if (useraction.assigntype === 31) {      // Usersweb
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("usersweb.index") }}/${useraction.assigntonew}">Open this</a>`;
                    } else if (useraction.assigntype === 35) {      // Infosystem2
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("infosystems2.index") }}/${useraction.assigntonew}">Open this</a>`;
                    } else if (useraction.assigntype === 36) {      // Corona
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="{{ route("corona.index") }}/${useraction.assigntonew}">Open this</a>`;
                    } else {
                        newTimeline += `<a class="btn btn-sm btn-light push" style="margin-right:5px;" href="javascript:void(0)">Open this</a>`;
                    }
                    newTimeline += `
                                </div>
                            </div>
                        </li>
                    `;
                    $('#timeline_list').append(newTimeline);
                });
            }

            function search(page = 0) {
                $('.dynamic_container').addClass('block-mode-loading');
                $.ajax({
                    type: 'POST',
                    url: '{{ route("api.useractions.search") }}',
                    data: $('#form_useraction_search').serialize() + '&page=' + page
                })
                    .done(function (res) {
                        var totalRecords = res.total;
                        if (page === 0) {
                            $('#timeline_pagination').pagination({
                                total: res.total,
                                current: res.page,
                                length: res.per_page,
                                size: 2,
                                click: function (options, $target) {
                                    search(options.current);
                                }
                            });
                        }
                        if (res.total > 0) {
                            document.getElementById("total-records").innerHTML = 'Total records: ' + totalRecords;
                            $('#timeline_pagination').show();
                        } else {
                            $('#timeline_pagination').hide();
                        }
                        generateTimeline(res.data);
                        $('.dynamic_container').removeClass('block-mode-loading');
                    });
            }

            $('form #useractionsections-1').change(function () {
                if ($(this).prop('checked')) {
                    $('form input.useractionsection_ids:checked').each(function () {
                        if ($(this).val() !== 1) {
                            $(this).prop('checked', false);
                        }
                    });
                }
            });
            $('form input.useractionsection_ids').change(function () {
                if ($(this).val() !== 1) {
                    if ($(this).prop('checked')) {
                        $('form #useractionsections-1').prop('checked', false);
                    }
                }
            });

            $('#form_useraction_search').submit(function () {
                search();
                return false;
            });
            $('#form_useraction_search').on('reset', function () {
                $('#user_ids').val('').trigger('change');
            });
        });
    </script>
@endsection
