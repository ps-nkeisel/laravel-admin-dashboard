<!-- RequestReport Modal Start -->

    <div class="modal fade" id="modalRequestinfoReport" tabindex="-1" role="dialog" aria-labelledby="modalRequestinfoReport">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Request Info</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body block m-0">
                    <input type="hidden" name="request_id">
                    <div class="block-content report-content">
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn-create-pdf btn btn-success">Create PDF</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


<style>
    ol.list-number-bracket {
        counter-reset: list;
        padding: 0;
    }
    ol.list-number-bracket > li {
        list-style: none;
    }
    ol.list-number-bracket > li:before {
        content: counter(list) ") ";
        counter-increment: list;
    }
    .modal-xl {
        max-width: 90%;
    }
</style>

<script>
    $(document).ready(function() {
        $('#modalRequestinfoReport').on('shown.bs.modal', function (event) {
            var modal = $(this);

            const request_id = $(event.relatedTarget).data('request-id');
            const mode = $(event.relatedTarget).data('mode');
            modal.find('input[name=request_id]').val(request_id);

            modal.find('.block').addClass('block-mode-loading');
            $.ajax({
                type: 'GET',
                url: "{{ route('api.requestinfo.report') }}",
                headers: {
                    'CSRFToken': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    request_id,
                },
                success: function (res) {
                    if (mode == 'html') {
                        let responseHtml = '';
                        if (!res.importantchanges) {
                            if (!res.response.additionalContent) {
                                res.response.forEach(function(valueResponse) {
                                    if (valueResponse.additionalContent) {
                                        responseHtml += `
                                            <div class="row" style="margin-top:10px;white-space: pre-line;">
                                                <div class="col-sm-12">
                                                    <h2>${valueResponse.additionalContent}</h2>
                                                </div>
                                            </div>
                                        `
                                    }
                                    if(valueResponse.visa.headline) {
                                        responseHtml += `
                                            <div class="row" style="margin-top:23px;">
                                                <div class="col-sm-12">
                                                    <h4>${valueResponse.visa.headline}</h4>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top:0px;">
                                                <div class="col-sm-12" style="white-space: pre-line;">
                                                    ${valueResponse.visa.content}
                                                </div>
                                            </div>
                                        `
                                    }
                                    if(valueResponse.transitvisa.content) {
                                        responseHtml += `
                                            <div class="row" style="margin-top:43px;">
                                                <div class="col-sm-12">
                                                    <h4>${valueResponse.transitvisa.headline}</h4>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top:0px;">
                                                <div class="col-sm-12" style="white-space: pre-line;">
                                                    ${valueResponse.transitvisa.content}
                                                </div>
                                            </div>
                                        `
                                    }
                                    if(valueResponse.entry.headline) {
                                        responseHtml += `
                                            <div class="row" style="margin-top:43px;">
                                                <div class="col-sm-12">
                                                    <h4>${valueResponse.entry.headline}</h4>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top:0px;">
                                                <div class="col-sm-12" style="white-space: pre-line;">
                                                    ${valueResponse.entry.content}
                                                </div>
                                            </div>
                                        `
                                    }
                                    if(valueResponse.inoculation.headline) {
                                        responseHtml += `
                                            <div class="row" style="margin-top:43px;">
                                                <div class="col-sm-12">
                                                    <h4>${valueResponse.inoculation.headline}</h4>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top:0px;">
                                                <div class="col-sm-12" style="white-space: pre-line;">
                                                    ${valueResponse.inoculation.content}
                                                </div>
                                            </div>
                                        `
                                    }
                                    if(valueResponse.inoculation.additionalContentBehind && valueResponse.inoculation.additionalContentBehind.length>0) {
                                        responseHtml += `
                                            <div class="row" style="margin-top:0px;">
                                                <div class="col-sm-12" style="white-space: pre-line;">
                                                    ${valueResponse.inoculation.additionalContentBehind[0]}
                                                </div>
                                            </div>
                                        `
                                    }
                                })
                            } else {
                                if (res.response.additionalContent) {
                                    responseHtml += `
                                        <div class="row" style="margin-top:10px;white-space: pre-line;">
                                            <div class="col-sm-12">
                                                <h2>${res.response.additionalContent}</h2>
                                            </div>
                                        </div>
                                    `
                                }
                                if (res.response.visa && res.response.visa.status != "noResult") {
                                    responseHtml += `
                                        <div class="row" style="margin-top:23px;">
                                            <div class="col-sm-12">
                                                <h4>${res.response.visa.headline}</h4>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:0px;">
                                            <div class="col-sm-12" style="white-space: pre-line;">
                                                ${res.response.visa.content}
                                            </div>
                                        </div>
                                    `
                                }
                                if(res.response.transitvisa.content) {
                                    responseHtml += `
                                        <div class="row" style="margin-top:43px;">
                                            <div class="col-sm-12">
                                                <h4>${res.response.transitvisa.headline}</h4>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:0px;">
                                            <div class="col-sm-12" style="white-space: pre-line;">
                                                ${res.response.transitvisa.content}
                                            </div>
                                        </div>
                                    `
                                }
                                if(res.response.entry.content && res.response.entry.status != "noResult") {
                                    responseHtml += `
                                        <div class="row" style="margin-top:43px;">
                                            <div class="col-sm-12">
                                                <h4>${res.response.entry.headline}</h4>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:0px;">
                                            <div class="col-sm-12" style="white-space: pre-line;">
                                                ${res.response.entry.content}
                                            </div>
                                        </div>
                                    `
                                }
                                if(res.response.inoculation && res.response.inoculation.status != "noResult") {
                                    responseHtml += `
                                        <div class="row" style="margin-top:43px;">
                                            <div class="col-sm-12">
                                                <h4>${res.response.inoculation.headline}</h4>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:0px;">
                                            <div class="col-sm-12" style="white-space: pre-line;">
                                                ${res.response.inoculation.content}
                                            </div>
                                        </div>
                                    `
                                }
                                if(res.response.inoculation.additionalContentBehind && res.response.inoculation.additionalContentBehind.length>0) {
                                    responseHtml += `
                                        <div class="row" style="margin-top:0px;">
                                            <div class="col-sm-12" style="white-space: pre-line;">
                                                ${res.response.inoculation.additionalContentBehind[0]}
                                            </div>
                                        </div>
                                    `
                                }
                            }
                            responseHtml += `<br>Request ID: ${res.requestid}`
                        } else {
                            if(res.response.additionalContent) {
                                responseHtml += `
                                    <div class="row" style="margin-top:10px;white-space: pre-line;">
                                        <div class="col-sm-12">
                                            ${res.response.additionalContent}
                                        </div>
                                    </div>
                                `
                            }
                            if(res.response.visa) {
                                responseHtml += `
                                    <div class="row" style="margin-top:43px;">
                                        <div class="col-sm-4">
                                            <h4>${res.response.visa.headline} (aktuell)</h4>
                                        </div>
                                        <div class="col-sm-4">
                                            <h4>${res.response.visa.headline} (alte Version)</h4>
                                        </div>
                                        <div class="col-sm-4">
                                            <h4>Versionsvergleich</h4>
                                        </div>
                                    </div>

                                    <div class="row diff-wrapper" style="margin-top:0px;">
                                        <div class="col-sm-4" style="white-space: pre-line;">
                                            <div class="changed">${res.response.visa.content}</div>
                                        </div>
                                        <div class="col-sm-4" style="white-space: pre-line;">
                                            <div class="original">${res.importantchanges.visa.response.content}</div>
                                        </div>
                                        <div class="col-sm-4" style="white-space: pre-line;">
                                    `
                                    if(res.importantchanges.visa.response.content && res.importantchanges.visa.response.content != "") {
                                        responseHtml += `
                                            <div class="diff1"></div>
                                        `
                                    } else {
                                        responseHtml += `
                                            Es liegen keine Änderung vor.
                                        `
                                    }
                                responseHtml += `
                                        </div>
                                    </div>
                                `
                            }
                            if(res.response.transitvisa.content) {
                                responseHtml += `
                                    <div class="row" style="margin-top:43px;">
                                        <div class="col-sm-4">
                                            <h4>${res.response.transitvisa.headline} (aktuell)</h4>
                                        </div>
                                        <div class="col-sm-4">
                                            <h4>${res.response.transitvisa.headline} (alte Version)</h4>
                                        </div>
                                        <div class="col-sm-4">
                                            <h4>Versionsvergleich</h4>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:0px;">
                                        <div class="col-sm-4" style="white-space: pre-line;">
                                            ${res.response.transitvisa.content}
                                        </div>
                                        <div class="col-sm-4" style="white-space: pre-line;">
                                            ${res.response.transitvisa.content}
                                        </div>
                                        <div class="col-sm-4" style="white-space: pre-line;">

                                        </div>
                                    </div>
                                `
                            }
                            if(res.response.entry.content) {
                                responseHtml += `
                                    <div class="row" style="margin-top:43px;">
                                        <div class="col-sm-4">
                                            <h4>${res.response.entry.headline} (aktuell)</h4>
                                        </div>
                                        <div class="col-sm-4">
                                            <h4>${res.response.entry.headline} (alte Version)</h4>
                                        </div>
                                        <div class="col-sm-4">
                                            <h4>Versionsvergleich</h4>
                                        </div>
                                    </div>
                                    <div class="row diff-wrapper3" style="margin-top:0px;">
                                        <div class="col-sm-4" style="white-space: pre-line;">
                                            <div class="changed">${res.response.entry.content}</div>
                                        </div>
                                        <div class="col-sm-4" style="white-space: pre-line;">
                                            <div class="original">${res.importantchanges.condition.response.content}</div>
                                        </div>
                                        <div class="col-sm-4" style="white-space: pre-line;">
                                    `
                                    if(res.importantchanges.condition.response.content && res.importantchanges.condition.response.content != "") {
                                        responseHtml += `
                                            <div class="diff3"></div>
                                        `
                                    } else {
                                        responseHtml += `
                                            Es liegen keine Änderung vor.
                                        `
                                    }
                                    responseHtml += `
                                        </div>
                                    </div>
                                `
                            }
                            if(res.response.inoculation) {
                                responseHtml += `
                                    <div class="row" style="margin-top:43px;">
                                        <div class="col-sm-4">
                                            <h4>${res.response.inoculation.headline} (aktuell)</h4>
                                        </div>
                                        <div class="col-sm-4">
                                            <h4>${res.response.inoculation.headline} (alte Version)</h4>
                                        </div>
                                        <div class="col-sm-4">
                                            <h4>Versionsvergleich</h4>
                                        </div>
                                    </div>
                                    <div class="row diff-wrapper4" style="margin-top:0px;">
                                        <div class="col-sm-4" style="white-space: pre-line;">
                                            <div class="changed">${res.response.inoculation.content}</div>
                                        </div>
                                        <div class="col-sm-4" style="white-space: pre-line;">
                                            <div class="original">${res.importantchanges.inoculation.response.content}</div>
                                        </div>
                                        <div class="col-sm-4" style="white-space: pre-line;">
                                    `
                                    if(res.importantchanges.inoculation.response.content && res.importantchanges.inoculation.response.content != "") {
                                        responseHtml += `
                                            <div class="diff4"></div>
                                        `
                                    } else {
                                        responseHtml += `
                                            Es liegen keine Änderung vor.
                                        `
                                    }
                                    responseHtml += `
                                        </div>
                                    </div>
                                `
                            }
                            if(res.response.inoculation.additionalContentBehind && res.response.inoculation.additionalContentBehind.length>0) {
                                responseHtml += `
                                    <div class="row" style="margin-top:0px;">
                                        <div class="col-sm-12" style="white-space: pre-line;">
                                            ${res.response.inoculation.additionalContentBehind[0]}
                                        </div>
                                    </div>
                                `
                            }
                            responseHtml += `<br>Request ID: ${res.requestid}`;
                        }
                        modal.find('.report-content').html(responseHtml);
                    } else if (mode == 'json') {
                        let responseJson = JSON.stringify(res);
                        modal.find('.report-content').html(responseJson);
                    }
                },
                error: function (err) {
                    modal.find('.close').click();

                    $.notify({
                        title: 'Request',
                        message: `Request Data Not Found`,
                    },{
                        type: 'danger'
                    });
                },
                complete: function () {
                    modal.find('.block').removeClass('block-mode-loading');
                }
            });
        });

        $('.btn-create-pdf').click(function() {
            var modal = $('#modalRequestinfoReport');
            const request_id = modal.find('input[name=request_id]').val();

            window.open(`requests/${request_id}/report`);
        })
    })
</script>

<!-- RequestReport Modal Start -->
