<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>
@if(!isset($data->importantchanges))
    @if(!isset($data['response']->additionalContent))
        @foreach($data['response'] as $keyResponse => $valueResponse)
            @if(isset($valueResponse->additionalContent))
                <div class="row" style="margin-top:10px;white-space: pre-line;">
                    <div class="col-sm-12">
                        <h2>{{ $valueResponse->additionalContent }}</h2>
                    </div>
                </div>
            @endif

            @if(isset($valueResponse->visa->headline))
                <div class="row" style="margin-top:23px;">
                    <div class="col-sm-12">
                        <h4>{{ $valueResponse->visa->headline }}</h4>
                    </div>
                </div>
                <div class="row" style="margin-top:0px;">
                    <div class="col-sm-12" style="white-space: pre-line;">
                        {{ $valueResponse->visa->content }}
                    </div>
                </div>
            @endif

            @if(isset($valueResponse->transitvisa->content))
                <div class="row" style="margin-top:43px;">
                    <div class="col-sm-12">
                        <h4>{{ $valueResponse->transitvisa->headline }}</h4>
                    </div>
                </div>
                <div class="row" style="margin-top:0px;">
                    <div class="col-sm-12" style="white-space: pre-line;">
                        {{ $valueResponse->transitvisa->content }}
                    </div>
                </div>
            @endif

            @if(isset($valueResponse->entry->headline))
                <div class="row" style="margin-top:43px;">
                    <div class="col-sm-12">
                        <h4>{{ $valueResponse->entry->headline }}</h4>
                    </div>
                </div>
                <div class="row" style="margin-top:0px;">
                    <div class="col-sm-12" style="white-space: pre-line;">
                        {{ $valueResponse->entry->content }}
                    </div>
                </div>
            @endif

            @if(isset($valueResponse->inoculation->headline))
                <div class="row" style="margin-top:43px;">
                    <div class="col-sm-12">
                        <h4>{{ $valueResponse->inoculation->headline }}</h4>
                    </div>
                </div>
                <div class="row" style="margin-top:0px;">
                    <div class="col-sm-12" style="white-space: pre-line;">
                        {{ $valueResponse->inoculation->content }}
                    </div>
                </div>
            @endif

            @if(isset($valueResponse->inoculation->additionalContentBehind[0]))
                <div class="row" style="margin-top:0px;">
                    <div class="col-sm-12" style="white-space: pre-line;">
                        {{ $valueResponse->inoculation->additionalContentBehind[0] }}
                    </div>
                </div>
            @endif
        @endforeach

    @else
        @if(isset($data['response']->additionalContent))
            <div class="row" style="margin-top:10px;white-space: pre-line;">
                <div class="col-sm-12">
                    <h2>{{ $data['response']->additionalContent }}</h2>
                </div>
            </div>
        @endif

        @if(isset($data['response']->visa) && $data['response']->visa->status != "noResult")
            <div class="row" style="margin-top:23px;">
                <div class="col-sm-12">
                    <h4>{{ $data['response']->visa->headline }}</h4>
                </div>
            </div>
            <div class="row" style="margin-top:0px;">
                <div class="col-sm-12" style="white-space: pre-line;">
                    {{ $data['response']->visa->content }}
                </div>
            </div>
        @endif

        @if(isset($data['response']->transitvisa->content))
            <div class="row" style="margin-top:43px;">
                <div class="col-sm-12">
                    <h4>{{ $data['response']->transitvisa->headline }}</h4>
                </div>
            </div>
            <div class="row" style="margin-top:0px;">
                <div class="col-sm-12" style="white-space: pre-line;">
                    {{ $data['response']->transitvisa->content }}
                </div>
            </div>
        @endif

        @if(isset($data['response']->entry->content)  && $data['response']->entry->status != "noResult")
            <div class="row" style="margin-top:43px;">
                <div class="col-sm-12">
                    <h4>{{ $data['response']->entry->headline }}</h4>
                </div>
            </div>
            <div class="row" style="margin-top:0px;">
                <div class="col-sm-12" style="white-space: pre-line;">
                    {{ $data['response']->entry->content }}
                </div>
            </div>
        @endif

        @if(isset($data['response']->inoculation)  && $data['response']->inoculation->status != "noResult")
            <div class="row" style="margin-top:43px;">
                <div class="col-sm-12">
                    <h4>{{ $data['response']->inoculation->headline }}</h4>
                </div>
            </div>
            <div class="row" style="margin-top:0px;">
                <div class="col-sm-12" style="white-space: pre-line;">
                    {{ $data['response']->inoculation->content }}
                </div>
            </div>
        @endif

        @if(isset($data['response']->inoculation->additionalContentBehind[0]))
            <div class="row" style="margin-top:0px;">
                <div class="col-sm-12" style="white-space: pre-line;">
                    {{ $data['response']->inoculation->additionalContentBehind[0] }}
                </div>
            </div>
        @endif
    @endif

    <br>Request ID: {{ $data['requestid'] }}

@else
    @if(isset($data['response']->additionalContent))
        <div class="row" style="margin-top:10px;white-space: pre-line;">
            <div class="col-sm-12">
                {{ $data['response']->additionalContent }}
            </div>
        </div>
    @endif

    @if(isset($data['response']->visa))
        <div class="row" style="margin-top:43px;">
            <div class="col-sm-4">
                <h4>{{ $data['response']->visa->headline }} (aktuell)</h4>
            </div>
            <div class="col-sm-4">
                <h4>{{ $data['response']->visa->headline }} (alte Version)</h4>
            </div>
            <div class="col-sm-4">
                <h4>Versionsvergleich</h4>
            </div>
        </div>

        <div class="row diff-wrapper" style="margin-top:0px;">
            <div class="col-sm-4" style="white-space: pre-line;">
                <div class="changed">{{ $data['response']->visa->content }}</div>
            </div>
            <div class="col-sm-4" style="white-space: pre-line;">
                <div class="original">{{ $data->importantchanges->visa->response->content }}</div>
            </div>
            <div class="col-sm-4" style="white-space: pre-line;">
                @if(isset($data->importantchanges->visa->response->content) && $data->importantchanges->visa->response->content != "")
                    <div class="diff1"></div>
                @else
                    Es liegen keine Änderung vor.
                @endif
            </div>
        </div>
    @endif

    @if(isset($data['response']->transitvisa->content))
        <div class="row" style="margin-top:43px;">
            <div class="col-sm-4">
                <h4>{{ $data['response']->transitvisa->headline }} (aktuell)</h4>
            </div>
            <div class="col-sm-4">
                <h4>{{ $data['response']->transitvisa->headline }} (alte Version)</h4>
            </div>
            <div class="col-sm-4">
                <h4>Versionsvergleich</h4>
            </div>
        </div>
        <div class="row" style="margin-top:0px;">
            <div class="col-sm-4" style="white-space: pre-line;">
                {{ $data['response']->transitvisa->content }}
            </div>
            <div class="col-sm-4" style="white-space: pre-line;">
                {{ $data['response']->transitvisa->content }}
            </div>
            <div class="col-sm-4" style="white-space: pre-line;">

            </div>
        </div>
    @endif

    @if(isset($data['response']->entry->content))
        <div class="row" style="margin-top:43px;">
            <div class="col-sm-4">
                <h4>{{ $data['response']->entry->headline }} (aktuell)</h4>
            </div>
            <div class="col-sm-4">
                <h4>{{ $data['response']->entry->headline }} (alte Version)</h4>
            </div>
            <div class="col-sm-4">
                <h4>Versionsvergleich</h4>
            </div>
        </div>
        <div class="row diff-wrapper3" style="margin-top:0px;">
            <div class="col-sm-4" style="white-space: pre-line;">
                <div class="changed">{{ $data['response']->entry->content }}</div>
            </div>
            <div class="col-sm-4" style="white-space: pre-line;">
                <div class="original">{{ $data->importantchanges->condition->response->content }}</div>
            </div>
            <div class="col-sm-4" style="white-space: pre-line;">
                @if(isset($data->importantchanges->condition->response->content) && $data->importantchanges->condition->response->content != "")
                    <div class="diff3"></div>
                @else
                    Es liegen keine Änderung vor.
                @endif
            </div>
        </div>
    @endif

    @if(isset($data['response']->inoculation))
        <div class="row" style="margin-top:43px;">
            <div class="col-sm-4">
                <h4>{{ $data['response']->inoculation->headline }} (aktuell)</h4>
            </div>
            <div class="col-sm-4">
                <h4>{{ $data['response']->inoculation->headline }} (alte Version)</h4>
            </div>
            <div class="col-sm-4">
                <h4>Versionsvergleich</h4>
            </div>
        </div>
        <div class="row diff-wrapper4" style="margin-top:0px;">
            <div class="col-sm-4" style="white-space: pre-line;">
                <div class="changed">{{ $data['response']->inoculation->content }}</div>
            </div>
            <div class="col-sm-4" style="white-space: pre-line;">
                <div class="original">{{ $data->importantchanges->inoculation->response->content }}</div>
            </div>
            <div class="col-sm-4" style="white-space: pre-line;">
                @if(isset($data->importantchanges->inoculation->response->content) && $data->importantchanges->inoculation->response->content != "")
                    <div class="diff4"></div>
                @else
                    Es liegen keine Änderung vor.
                @endif
            </div>
        </div>
    @endif

    @if(isset($data['response']->inoculation->additionalContentBehind[0]))
        <div class="row" style="margin-top:0px;">
            <div class="col-sm-12" style="white-space: pre-line;">
                {{ $data['response']->inoculation->additionalContentBehind[0] }}
            </div>
        </div>
    @endif

    <br>Request ID: {{ $data['requestid'] }}

@endif
</body>
</html>
