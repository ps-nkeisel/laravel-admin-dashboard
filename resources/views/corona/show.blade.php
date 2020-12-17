@extends('layouts.backend')

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Corona details</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Corona</li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
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
                        <a href="{{ route('corona.index') }}" class="btn-block-option" title="Show All Corona Infos">
                            <i class="si si-list"></i>
                        </a>

                        <a href="{{ route('corona.create') }}" class="btn-block-option" title="Create New Corona Info">
                            <span class="si si-plus" aria-hidden="true"></span>
                        </a>

                        <a href="{{ route('corona.edit', $corona->id ) }}" class="btn-block-option" title="Edit Corona Info">
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
                    @if($corona->active == 1)
                        <button type="button" class="btn btn-sm btn-success mr-1 mb-3">
                            active
                        </button>
                    @else
                        <button type="button" class="btn btn-sm btn-warning mr-1 mb-3">
                            inactive
                        </button>
                    @endif

                        <div class="row" style="margin-bottom:40px;">
                            <div class="col-sm-10 col-md-12">
                                <dt style="margin-top:15px;">Country Code</dt>
                                <dd>{{ $corona->countrycode }}</dd>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:40px;">
                            <div class="col-sm-10 col-md-6">
                                <dt style="margin-top:15px;">Quarantänemaßnahmen für bestimmte Reisende - DE</dt>
                                <dd>{{ $corona->kbr_de }}</dd>
                                <dt style="margin-top:15px;">Quarantänemaßnahmen für alle Reisende - DE</dt>
                                <dd>{{ $corona->kar_de }}</dd>
                                <dt style="margin-top:15px;">Einreisebeschränkung bei Voraufenthalten in bzw. Einreisen aus Risikogebieten - DE</dt>
                                <dd>{{ $corona->ever_de }}</dd>
                                <dt style="margin-top:15px;">Einreisebeschränkung für bestimmte Nationalitäten - DE</dt>
                                <dd>{{ $corona->ebn_de }}</dd>
                                <dt style="margin-top:15px;">Gesundheitsnachweis/Untersuchung erforderlich - DE</dt>
                                <dd>{{ $corona->ge_de }}</dd>
                                <dt style="margin-top:15px;">Komplette Einreisesperre - DE</dt>
                                <dd>{{ $corona->kes_de }}</dd>
                                <dt style="margin-top:15px;">Sperre Luftweg - DE</dt>
                                <dd>{{ $corona->slu_de }}</dd>
                                <dt style="margin-top:15px;">Sperre Landweg - DE</dt>
                                <dd>{{ $corona->sla_de }}</dd>
                                <dt style="margin-top:15px;">Sperre Seeweg/Kreuzfahrt - DE</dt>
                                <dd>{{ $corona->sse_de }}</dd>
                                <dt style="margin-top:15px;">Grenzübergänge auf dem Landweg geschlossen - DE</dt>
                                <dd>{{ $corona->gla_de }}</dd>
                                <dt style="margin-top:15px;">Flugausfälle - DE</dt>
                                <dd>{{ $corona->fla_de }}</dd>
                                <dt style="margin-top:15px;">Notstand ausgerufen - DE</dt>
                                <dd>{{ $corona->not_de }}</dd>
                                <dt style="margin-top:15px;">Einschränkungen des öffentlichen Lebens/Inlandsverkehrs; Ausgangssperre - DE</dt>
                                <dd>{{ $corona->eol_de }}</dd>
                                <dt style="margin-top:15px;">Visaregime verändert - DE</dt>
                                <dd>{{ $corona->vre_de }}</dd>
                                <dt style="margin-top:15px;">Letztes Update</dt>
                                <dd>{{ $corona->updated_at }}</dd>
                                <dt style="margin-top:15px;">Update von</dt>
                                <dd>{{ $corona->updated_id }}</dd>
                            </div>
                            <div class="col-sm-10 col-md-6">
                                <dt style="margin-top:15px;">Quarantänemaßnahmen für bestimmte Reisende - EN</dt>
                                <dd>{{ $corona->kbr_en }}</dd>
                                <dt style="margin-top:15px;">Quarantänemaßnahmen für alle Reisende - EN</dt>
                                <dd>{{ $corona->kar_en }}</dd>
                                <dt style="margin-top:15px;">Einreisebeschränkung bei Voraufenthalten in bzw. Einreisen aus Risikogebieten - EN</dt>
                                <dd>{{ $corona->ever_en }}</dd>
                                <dt style="margin-top:15px;">Einreisebeschränkung für bestimmte Nationalitäten - EN</dt>
                                <dd>{{ $corona->ebn_en }}</dd>
                                <dt style="margin-top:15px;">Gesundheitsnachweis/Untersuchung erforderlich - EN</dt>
                                <dd>{{ $corona->ge_en }}</dd>
                                <dt style="margin-top:15px;">Komplette Einreisesperre - EN</dt>
                                <dd>{{ $corona->kes_en }}</dd>
                                <dt style="margin-top:15px;">Sperre Luftweg - EN</dt>
                                <dd>{{ $corona->slu_en }}</dd>
                                <dt style="margin-top:15px;">Sperre Landweg - EN</dt>
                                <dd>{{ $corona->sla_en }}</dd>
                                <dt style="margin-top:15px;">Sperre Seeweg/Kreuzfahrt - EN</dt>
                                <dd>{{ $corona->sse_en }}</dd>
                                <dt style="margin-top:15px;">Grenzübergänge auf dem Landweg geschlossen - EN</dt>
                                <dd>{{ $corona->gla_en }}</dd>
                                <dt style="margin-top:15px;">Flugausfälle - DE</dt>
                                <dd>{{ $corona->fla_en }}</dd>
                                <dt style="margin-top:15px;">Notstand ausgerufen - EN</dt>
                                <dd>{{ $corona->not_en }}</dd>
                                <dt style="margin-top:15px;">Einschränkungen des öffentlichen Lebens/Inlandsverkehrs; Ausgangssperre - EN</dt>
                                <dd>{{ $corona->eol_en }}</dd>
                                <dt style="margin-top:15px;">Visaregime verändert - DE</dt>
                                <dd>{{ $corona->vre_en }}</dd>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card -->

@endsection
