@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="/js/plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
@endsection

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Client details</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Client</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end head -->

    <!-- card -->
    <div class="content content-full">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Details</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <a href="{{ route('usersweb.index') }}" class="btn-block-option" title="Show All Userswebs">
                            <i class="si si-list"></i>
                        </a>

                        <a href="{{ route('usersweb.create') }}" class="btn-block-option" title="Create New Usersweb">
                            <span class="si si-plus" aria-hidden="true"></span>
                        </a>

                        <a href="{{ route('usersweb.edit', $usersweb->id) }}" class="btn-block-option" title="Edit Usersweb">
                            <span class="si si-pencil" aria-hidden="true"></span>
                        </a>

                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="fullscreen_toggle">
                            <i class="si si-size-fullscreen"></i>
                        </button>
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>

            </div>
            <div class="block-content">
                <div class="card-body">
                    <div class="row justify-content-left py-sm-3 py-md-5" style="padding-top: 1rem !important;">
                        <div class="col-sm-10 col-md-3">
                            <div class="custom-control custom-block custom-control-success">
                                <input type="checkbox" class="custom-control-input" id="active"
                                       name="active" @if($usersweb->active)checked=""@endif disabled>
                                <label class="custom-control-label" for="active">
                                <span class="d-block text-center">
                                    <i class="fa fa-check fa-2x mb-2 text-black-50"></i><br>
                                    Active
                                </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-10 col-md-3">
                            <div class="custom-control custom-block custom-control-warning">
                                <input type="checkbox" class="custom-control-input" id="revised"
                                       name="revised" @if($usersweb->revised)checked=""@endif disabled>
                                <label class="custom-control-label" for="revised">
                                <span class="d-block text-center">
                                    <i class="fa fa-exclamation fa-2x mb-2 text-black-50"></i><br>
                                    revised
                                </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-10 col-md-3">

                        </div>

                        <div class="col-sm-10 col-md-3">

                        </div>
                    </div>

                    <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                        <h2 class="content-heading">Zoho<span class="client-details"></span></h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>CRM ID</dt>
                        <dd>{{ $usersweb->zohoAccountID }}</dd>
                        <a href="{!! env('ZOHO_CRM_USER_URL') !!}/{{ $usersweb->zohoAccountID }}" target="_blank" type="button" class="btn btn-sm btn-info" style="margin-top:15px;">open into CRM</a>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">

                    </div>
                </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Address<span class="client-details"></span></h2>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Company / Longname</dt>
                        <dd>{{ $usersweb->realname }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Assign to</dt>
                        <dd>{{ $usersweb->assignto }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Forename</dt>
                        <dd>{{ $usersweb->forename }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Payment Client</dt>
                        <dd>{{ $usersweb->idpaymentuser }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Surname</dt>
                        <dd>{{ $usersweb->surname }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Account type</dt>
                        <dd>{{ $usersweb->accounttype }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dd>{{ $usersweb->mailable ? 'Mailable' : 'Not mailable' }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Use report</dt>
                        <dd>{{ $usersweb->usereport }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Address</dt>
                        <dd>{{ $usersweb->address1 }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Client type</dt>
                        <dd>{{ $usersweb->clienttype }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Zip / City</dt>
                        <dd>{{ $usersweb->zip }} {{ $usersweb->city }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Number of Offices</dt>
                        <dd>{{ $usersweb->officeNum }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Phone</dt>
                        <dd>{{ $usersweb->phone }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Technical access</dt>
                        <dd>{{ $usersweb->techaccess }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Email</dt>
                        <dd>{{ $usersweb->email }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Cooperation / Chain</dt>
                        <dd>
                        @if($usersweb->adrheadcooperations)
                            {!! implode(", ", $usersweb->adrheadcooperations->pluck('content_en')->toArray()) !!}
                        @endif
                        </dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Tags</dt>
                        <dd>
                        @if($usersweb->adrheadtags)
                            {!! implode(", ", $usersweb->adrheadtags->pluck('content_en')->toArray()) !!}
                        @endif
                        </dd>
                    </div>
                </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Additional Infos<span class="client-details"></span></h2>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Info 1</dt>
                        <dd>{{ $usersweb->info1 }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Info 4</dt>
                        <dd>{{ $usersweb->info4 }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Info 2</dt>
                        <dd>{{ $usersweb->info2 }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Info 5</dt>
                        <dd>{{ $usersweb->info5 }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Info 3</dt>
                        <dd>{{ $usersweb->info3 }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Info 6</dt>
                        <dd>{{ $usersweb->info6 }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-12" style="padding-left:30px;">
                        <dt>Note</dt>
                        <dd>{{ $usersweb->note }}</dd>
                    </div>
                </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Access Infos<span class="client-details"></span></h2>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Username</dt>
                        <dd>{{ $usersweb->username }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Test validity</dt>
                        <dd>{{ $usersweb->testvalidity }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Password</dt>
                        <dd>******</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Test renewals</dt>
                        <dd>{{ $usersweb->testrenewals }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Password text</dt>
                        <dd>{{ $usersweb->secureanswer }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Cancel type</dt>
                        <dd>{{ $usersweb->canceltype }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Live from</dt>
                        <dd>{{ $usersweb->livefrom }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Cancel date</dt>
                        <dd>{{ $usersweb->canceldate }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>End of use</dt>
                        <dd>{{ $usersweb->endofuse }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Level</dt>
                        <dd>{{ $usersweb->level }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-2" style="padding-left:30px;">
                        <dt>Role</dt>
                        <dd>{{ $usersweb->role }}</dd>
                    </div>
                </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Access to Providers<span class="client-details"></span></h2>
                </div>

                @if($usersweb->adrheadsoftwareproviders)
                    <div class="col-sm-10 col-md-12" style="padding-left:30px;">
                        {!! implode("&nbsp;&nbsp;&nbsp;&nbsp;", $usersweb->adrheadsoftwareproviders->pluck('content_en')->toArray()) !!}
                    </div>
                @endif

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;padding-top:20px;">
                        <dt>myJACK Unit ID</dt>
                        <dd>{{ $usersweb->agency }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">

                    </div>
                </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Visa settings<span class="client-details"></span></h2>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Show visa service</dt>
                        <dd>{{ $usersweb->showvisaservice }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Visa places</dt>
                        <dd>{{ $usersweb->visaplaces }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Show visa service link</dt>
                        <dd>{{ $usersweb->showvisaservicelink }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Show visa service text</dt>
                        <dd>{{ $usersweb->showvisaservicetext }}</dd>
                    </div>
                </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Direct Link Settings<span class="client-details"></span></h2>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Link max open</dt>
                        <dd>{{ $usersweb->linkmaxopen }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Link max to departure</dt>
                        <dd>{{ $usersweb->linkmaxtodeparture }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Link max from create</dt>
                        <dd>{{ $usersweb->linkmaxfromcreate }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">

                    </div>
                </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Settings web.passolution.eu<span class="client-details"></span></h2>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Favorites destination</dt>
                        <dd>
                        @if($usersweb->countries)
                            {{ implode(", ", $usersweb->countries->pluck('name_en')->toArray()) }}
                        @endif
                        </dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Favorite language</dt>
                        <dd>{{ $usersweb->favlanguage }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Favorites nationality</dt>
                        <dd>
                        @if($usersweb->nationalities)
                            {{ implode(", ", $usersweb->nationalities->pluck('name_en')->toArray()) }}
                        @endif
                        </dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Site language</dt>
                        <dd>{{ $usersweb->sitelanguage }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Logo</dt>
                        <dd>{{ $usersweb->logo }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">

                    </div>
                </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Fees<span class="client-details"></span></h2>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Fee install</dt>
                        <dd>{{ $usersweb->feeinstall }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Fee interval</dt>
                        <dd>{{ $usersweb->feeinterval }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Fee</dt>
                        <dd>{{ $usersweb->feemonth }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">

                    </div>
                </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Requests<span class="client-details"></span></h2>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>2018</dt>
                        <dd>{{ $usersweb->access2018 }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>2019</dt>
                        <dd>{{ $usersweb->access2019 }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>2020</dt>
                        <dd>{{ $usersweb->access2020 }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>2021</dt>
                        <dd>{{ $usersweb->access2021 }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>2022</dt>
                        <dd>{{ $usersweb->access2022 }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">

                    </div>
                </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Other settings<span class="client-details"></span></h2>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">

                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">

                    </div>
                </div>

                    <div class="row">
                        <div class="col-sm-10 col-md-6">

                            <dt>Idcontact</dt>
                            <dd>{{ $usersweb->idcontact }}</dd>
                            <dt>Idsec</dt>
                            <dd>{{ $usersweb->idsec }}</dd>



                            <dt>Activationpassword</dt>
                            <dd>{{ $usersweb->activationpassword }}</dd>
                            <dt>Securequestion</dt>
                            <dd>{{ $usersweb->securequestion }}</dd>
                            <dt>Secureanswer</dt>

                            <dt>Birthday</dt>
                            <dd>{{ $usersweb->birthday }}</dd>

                            <dt>Accessmaxyear</dt>
                            <dd>{{ $usersweb->accessmaxyear }}</dd>

                        </div>
                        <div class="col-sm-10 col-md-6">



                            <dt>Remember Token</dt>
                            <dd>{{ $usersweb->remember_token }}</dd>






                            <dt>Street</dt>
                            <dd>{{ $usersweb->street }}</dd>
                            <dt>Land</dt>
                            <dd>{{ $usersweb->land }}</dd>
                            <dt>Handy</dt>
                            <dd>{{ $usersweb->handy }}</dd>
                            <dt>Fax</dt>
                            <dd>{{ $usersweb->fax }}</dd>
                            <dt>Website</dt>
                            <dd>{{ $usersweb->website }}</dd>
                            <dt>Name Account</dt>
                            <dd>{{ $usersweb->nameAccount }}</dd>
                            <dt>Bank</dt>
                            <dd>{{ $usersweb->bank }}</dd>
                            <dt>Theywere</dt>
                            <dd>{{ $usersweb->theywere }}</dd>
                            <dt>Bic</dt>
                            <dd>{{ $usersweb->bic }}</dd>
                            <dt>Ust</dt>
                            <dd>{{ $usersweb->ust }}</dd>
                            <dt>Comment</dt>
                            <dd>{{ $usersweb->comment }}</dd>

                            <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                                <h2 class="content-heading">Access to Providers1<span class="client-details"></span></h2>
                            </div>

                            @if($usersweb->adrheadsoftwareproviders1)
                                <div class="col-sm-10 col-md-12" style="padding-left:30px;">
                                    {!! implode("&nbsp;&nbsp;&nbsp;&nbsp;", $usersweb->adrheadsoftwareproviders1->pluck('content_en')->toArray()) !!}
                                </div>
                            @endif
                        </div>
                    </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Created / Updated<span class="client-details"></span></h2>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Created At</dt>
                        <dd class="mb-3">{{ $usersweb->created_at }}</dd>
                        <dt>Created User</dt>
                        <dd class="mb-3">{{ $usersweb->createdUser->name ?? '' }}</dd>
                        <dt>Created Ip</dt>
                        <dd class="mb-3">{{ $usersweb->created_ip }}</dd>
                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">
                        <dt>Updated At</dt>
                        <dd class="mb-3">{{ $usersweb->updated_at }}</dd>
                        <dt>Updated User</dt>
                        <dd class="mb-3">{{ $usersweb->updatedUser->name ?? '' }}</dd>
                        <dt>Updated Ip</dt>
                        <dd class="mb-3">{{ $usersweb->updated_ip }}</dd>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">

                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">

                    </div>
                    <div class="col-sm-10 col-md-6" style="padding-left:30px;">

                    </div>
                </div>


                </div>
            </div>
        </div>

    <!-- end card -->

    <!-- show assigned clients -->
    <div class="content content-full">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Assigned clients</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">

                </div>
            </div>
            <div class="block-content block-content-full">
                <table id="assignto_userswebs_datatable" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Real Name</th>
                            <th>Address1</th>
                            <th>Zip</th>
                            <th>City</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- end assigned clients -->

    <!-- show requests -->
    <div class="content content-full">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Show Requests</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">

                </div>
            </div>
            <div class="block-content block-content-full">
                <form method="POST" enctype="multipart/form-data" id="form_requestinfo_search">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="datefrom">Date from</label>
                                <input class="js-datepicker form-control form-control-alt"
                                        name="datefrom" type="text" id="datefrom" data-week-start="1" data-autoclose="true"
                                        data-today-highlight="true" data-date-format="yyyy-mm-dd"
                                        placeholder="Enter start date (YYYY-MM-DD) here..." required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="dateto">Date to</label>
                                <input class="js-datepicker form-control form-control-alt"
                                        name="dateto" type="text" id="dateto" data-week-start="1" data-autoclose="true"
                                        data-today-highlight="true" data-date-format="yyyy-mm-dd"
                                        placeholder="Enter stop date (YYYY-MM-DD) here..." required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="dest">Destination</label>
                                <input class="form-control form-control-alt" name="dest"
                                    type="text" id="dest" maxlength="2"
                                    placeholder="Enter destination here...">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="nat">Nationality</label>
                                <input class="form-control form-control-alt" name="nat"
                                    type="text" id="nat" maxlength="2"
                                    placeholder="Enter nationality here...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="lang">Language</label>
                                <input class="form-control form-control-alt" name="lang"
                                    type="text" id="lang" maxlength="2"
                                    placeholder="Enter language here...">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="bookingnr">Booking number</label>
                                <input class="form-control form-control-alt" name="bookingnr"
                                    type="number" id="bookingnr" maxlength="40"
                                    placeholder="Enter booking number here...">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="traveldate">Travel Date</label>
                                <input class="js-datepicker form-control form-control-alt"
                                        name="traveldate" type="text" id="traveldate" data-week-start="1" data-autoclose="true"
                                        data-today-highlight="true" data-date-format="yyyy-mm-dd"
                                        placeholder="Enter travel date (YYYY-MM-DD) here...">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="requestid">Request Id</label>
                                <input class="form-control form-control-alt" name="requestid"
                                    type="text" id="requestid"
                                    placeholder="Enter request id here...">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success my-4">
                        <i class="fa fa-check"></i> show
                    </button>
                </form>
            </div>

            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table id="requestinfos_datatable" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th style="width:400px">Request Id</th>
                            <th>Created At</th>
                            <th>Dest</th>
                            <th>Nat</th>
                            <th>Lang</th>
                            <th>B.Nr.</th>
                            <th>Travel Date</th>
                            <th>CI</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- end show requests -->

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.print.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>
    <script src="/js/plugins/select2/js/select2.full.min.js"></script>
    <script src="/js/plugins/moment/moment.min.js"></script>

    @include('requestinfos.modals.report')

    <!-- Page JS Helpers (Summernote + SimpleMDE + CKEditor plugins) -->
    <!-- <script src="/js/pages/be_tables_datatables.min.js"></script> -->
    <script>jQuery(function(){ Dashmix.helpers(['datepicker']); });</script>

    <script>
        $(document).ready(function() {
            var assignto_userswebs_datatable = $('#assignto_userswebs_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: true,
                ajax: {
                    url: "{{ route('api.usersweb.search_assignto') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('#assignto_userswebs_datatable').closest('.block').addClass('block-mode-loading');
                        d.assignto = "{{ $usersweb->id }}";
                    }
                },
                drawCallback: function( settings ) {
                    $('#assignto_userswebs_datatable').closest('.block').removeClass('block-mode-loading');
                },
                lengthMenu: [
                    [ 20, 50, 100 ],
                    [ '20', '50', '100' ]
                ],
                columns: [
                    { data: 'id', className: "text-center", width: "80px",
                        render: function(data, type, full, meta) {
                            return '<a href="{{ route("usersweb.index") }}/' + data + '">' + data + '</a>';
                        }
                    },
                    { data: 'realname' },
                    { data: 'address1' },
                    { data: 'zip' },
                    { data: 'city' },
                    { data: 'id', className: "text-right", width: "15%", orderable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="{{ route("usersweb.index") }}/' + data + '/edit" class="btn btn-sm btn-info mr-1" title="Edit Inoculation"><i class="si si-pencil"></i></a>' +
                                '<a href="{{ route("usersweb.index") }}/' + data + '" class="btn btn-sm btn-primary" title="Show Inoculation"><i class="si si-doc"></i></a>';
                        }
                    },
                ],
            });

            var requestinfos_datatable = $('#requestinfos_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: false,
                deferLoading: 0,
                ajax: {
                    url: "{{ route('api.requestinfo.search') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('#requestinfos_datatable').closest('.block').addClass('block-mode-loading');
                        d.filters = {
                            userid: {{ $usersweb->id }},
                        };
                        var formData = $('#form_requestinfo_search').serializeArray();
                        formData.forEach(function(element) {
                            if (element.name == 'datefrom') {
                                d.filters.datefrom = element.value;
                            } else if (element.name == 'dateto') {
                                d.filters.dateto = element.value;
                            } else if (element.name == 'dest') {
                                d.filters.dest = element.value;
                            } else if (element.name == 'nat') {
                                d.filters.nat = element.value;
                            } else if (element.name == 'lang') {
                                d.filters.lang = element.value;
                            } else if (element.name == 'bookingnr') {
                                d.filters.bookingnr = element.value;
                            } else if (element.name == 'traveldate') {
                                d.filters.traveldate = element.value;
                            } else if (element.name == 'requestid') {
                                d.filters.requestid = element.value;
                            }
                        })
                    }
                },
                drawCallback: function( settings ) {
                    $('#requestinfos_datatable').closest('.block').removeClass('block-mode-loading');
                },
                lengthMenu: [
                    [ 20, 50, 100 ],
                    [ '20', '50', '100' ]
                ],
                columns: [
                    { data: 'id' },
                    { data: 'requestid' },
                    { data: 'created_at',
                        render: function(data, type, full, meta) {
                            return moment(data, 'D/M/YYYY h:mm A').format('YYYY-MM-DD hh:mm a');
                        }
                    },
                    { data: 'dest' },
                    { data: 'nat' },
                    { data: 'lang' },
                    { data: 'bookingnr' },
                    { data: 'traveldate' },
                    { data: 'checkimportant' },
                    { data: 'created_at', width: '150px', orderable: false,
                        render: function(data, type, full, meta) {
                            return `
                                <button class="btn btn-sm btn-info mr-1" data-request-id="${ full.requestid }" data-mode="json" title="Open Request Link" data-toggle="modal" data-target="#modalRequestinfoReport"><i class="si si-eye"></i></button>
                                <button class="btn btn-sm btn-info mr-1" data-request-id="${ full.requestid }" data-mode="html" title="Show Request Report" data-toggle="modal" data-target="#modalRequestinfoReport"><i class="si si-doc"></i></button>
                            `;
                        }
                    },
                ],
                order: [[ 2, "desc" ]],     // order by created_at by default
            });

            $('#form_requestinfo_search').submit(function() {
                requestinfos_datatable.ajax.reload();
                return false;
            });

        });
    </script>
@endsection
