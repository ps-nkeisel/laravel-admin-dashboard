<!-- Compare Modal Start -->

    <style>
        ins {
            background-color: #c6ffc6;
            text-decoration: none;
        }

        del {
            background-color: #ffc6c6;
        }
    </style>

    <div class="modal fade" id="modalInoculationCompare" tabindex="-1" role="dialog" aria-labelledby="modalInoculationCompare">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Compare with version before</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body block m-0">
                    <div class="block-content">
                        <div class="alert alert-primary">Details</div>
                        <table id="inoCompTable" class="table table-bordered table-hover text-center text-break">
                            <thead>
                                <tr>
                                    <th width="200px"></th>
                                    <th class="col-ver-1" width="20%"></th>
                                    <th class="col-ver-2" width="20%"></th>
                                    <th>Compare</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="alert alert-primary">Health requirements</div>
                        <table id="inoReqCompTable" class="table table-bordered table-hover text-center text-break">
                            <thead>
                                <tr>
                                    <th width="300px" rowspan=2></th>
                                    <th class="col-ver-1" colspan=3></th>
                                    <th class="col-ver-2" colspan=3></th>
                                </tr>
                                <tr>
                                    <th>active</th>
                                    <th>lts</th>
                                    <th>se</th>
                                    <th>active</th>
                                    <th>lts</th>
                                    <th>se</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="alert alert-primary">Health recommendations</div>
                        <table id="inoRecCompTable" class="table table-bordered table-hover text-center text-break">
                            <thead>
                                <tr>
                                    <th width="300px" rowspan=2></th>
                                    <th class="col-ver-1" colspan=3></th>
                                    <th class="col-ver-2" colspan=3></th>
                                </tr>
                                <tr>
                                    <th>active</th>
                                    <th>lts</th>
                                    <th>se</th>
                                    <th>active</th>
                                    <th>lts</th>
                                    <th>se</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="alert alert-primary">Pregnant Options</div>
                        <table id="inoOptPregCompTable" class="table table-bordered table-hover text-center text-break">
                            <thead>
                                <tr>
                                    <th width="300px"></th>
                                    <th class="col-ver-1" width="20%"></th>
                                    <th class="col-ver-2" width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="alert alert-primary">Child Options</div>
                        <table id="inoOptChildCompTable" class="table table-bordered table-hover text-center text-break">
                            <thead>
                                <tr>
                                    <th width="300px"></th>
                                    <th class="col-ver-1" width="20%"></th>
                                    <th class="col-ver-2" width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="alert alert-primary">Specifics</div>
                        <table id="inoSpecCompTable" class="table table-bordered table-hover text-center text-break">
                            <thead>
                                <tr>
                                    <th width="300px"></th>
                                    <th class="col-ver-1" width="20%"></th>
                                    <th class="col-ver-2" width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="alert alert-primary">Additional Contents</div>
                        <table id="contentAdditionalsCompTable" class="table table-bordered table-hover text-center text-break">
                            <thead>
                                <tr>
                                    <th colspan=2 width="300px"></th>
                                    <th class="col-ver-1" width="20%"></th>
                                    <th class="col-ver-2" width="20%"></th>
                                    <th>Compare</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    <script src="/js/plugins/arnab-jQuery.PrettyTextDiff-13d0985/diff_match_patch.js"></script>
    <script src="/js/plugins/arnab-jQuery.PrettyTextDiff-13d0985/jquery.pretty-text-diff.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#modalInoculationCompare').on('show.bs.modal', function (e) {
                var modal = $(this);
                modal.find('.block').addClass('block-mode-loading');

                var assigntoold = $(e.relatedTarget).data('assigntoold');
                var assigntonew = $(e.relatedTarget).data('assigntonew');
                if (assigntoold > assigntonew) {
                    assigntoold = $(e.relatedTarget).data('assigntonew');
                    assigntonew = $(e.relatedTarget).data('assigntoold');
                }
                var inoculation1, inoculation2, requirement_immunisations;
                var columns = [
                    {
                        label: 'Country',
                        col: 'countrytocode',
                        type: 'text',
                    }, {
                        label: 'Important Change',
                        col: 'importantchange',
                        type: 'boolean',
                    }, {
                        label: 'Link to resource',
                        col: 'linkresource',
                        type: 'text',
                    }, {
                        label: 'Text from resource',
                        col: 'textresource',
                        type: 'text',
                    },
                ]
                $.ajax({
                    type: 'POST',
                    url: '{{ route("api.inoculations.compare") }}',
                    data: {
                        id1: assigntoold,
                        id2: assigntonew,
                    },
                    success: function(res){
                        inoculation1 = res.inoculation1;
                        inoculation2 = res.inoculation2;
                        modal.find('th.col-ver-1').html('Version ' + inoculation1.version);
                        modal.find('th.col-ver-2').html('Version ' + inoculation2.version);

                        $('#inoCompTable tbody tr').remove();
                        columns.forEach(function (column) {
                            if (inoculation1[column.col] == null) {
                                inoculation1[column.col] = '';
                            }
                            if (inoculation2[column.col] == null) {
                                inoculation2[column.col] = '';
                            }
                            if (column.type == 'boolean') {
                                $('#inoCompTable tbody').append(
                                    '<tr>' +
                                        '<td class="text-left">' + column.label + '</td>' +
                                        '<td>' + boolToIcon(inoculation1[column.col]) + '</td>' +
                                        '<td>' + boolToIcon(inoculation2[column.col]) + '</td>' +
                                        '<td></td>' +
                                    '</tr>'
                                );
                            } else {
                                $('#inoCompTable tbody').append(
                                    '<tr>' +
                                        '<td class="text-left">' + column.label + '</td>' +
                                        '<td class="original">' + inoculation1[column.col] + '</td>' +
                                        '<td class="changed">' + inoculation2[column.col] + '</td>' +
                                        '<td class="diff"></td>' +
                                    '</tr>'
                                );
                            }
                        });
                        $("#inoCompTable tr").prettyTextDiff();

                        requirement_immunisations = res.requirement_immunisations;
                        $('#inoReqCompTable tbody tr').remove();
                        $.each( requirement_immunisations, function( key, requirement_immunisation ) {
                            $('#inoReqCompTable tbody').append(
                                '<tr>' +
                                    '<td class="text-left">' + requirement_immunisation.content + '</td>' +
                                    '<td>' + boolToIcon(requirement_immunisation.active1) + '</td>' +
                                    '<td>' + boolToIcon(requirement_immunisation.lts1) + '</td>' +
                                    '<td>' + boolToIcon(requirement_immunisation.se1) + '</td>' +
                                    '<td>' + boolToIcon(requirement_immunisation.active2) + '</td>' +
                                    '<td>' + boolToIcon(requirement_immunisation.lts2) + '</td>' +
                                    '<td>' + boolToIcon(requirement_immunisation.se2) + '</td>' +
                                '</tr>'
                            );
                        });

                        recommendation_immunisations = res.recommendation_immunisations;
                        $('#inoRecCompTable tbody tr').remove();
                        $.each( recommendation_immunisations, function( key, recommendation_immunisation ) {
                            $('#inoRecCompTable tbody').append(
                                '<tr>' +
                                    '<td class="text-left">' + recommendation_immunisation.content + '</td>' +
                                    '<td>' + boolToIcon(recommendation_immunisation.active1) + '</td>' +
                                    '<td>' + boolToIcon(recommendation_immunisation.lts1) + '</td>' +
                                    '<td>' + boolToIcon(recommendation_immunisation.se1) + '</td>' +
                                    '<td>' + boolToIcon(recommendation_immunisation.active2) + '</td>' +
                                    '<td>' + boolToIcon(recommendation_immunisation.lts2) + '</td>' +
                                    '<td>' + boolToIcon(recommendation_immunisation.se2) + '</td>' +
                                '</tr>'
                            );
                        });

                        optionpregnants = res.optionpregnants;
                        $('#inoOptPregCompTable tbody tr').remove();
                        $.each( optionpregnants, function( key, optionpregnant ) {
                            $('#inoOptPregCompTable tbody').append(
                                '<tr>' +
                                    '<td class="text-left">' + optionpregnant.content + '</td>' +
                                    '<td>' + boolToIcon(optionpregnant.active1) + '</td>' +
                                    '<td>' + boolToIcon(optionpregnant.active2) + '</td>' +
                                '</tr>'
                            );
                        });

                        optionchildren = res.optionchildren;
                        $('#inoOptChildCompTable tbody tr').remove();
                        $.each( optionchildren, function( key, optionchild ) {
                            $('#inoOptChildCompTable tbody').append(
                                '<tr>' +
                                    '<td class="text-left">' + optionchild.content + '</td>' +
                                    '<td>' + boolToIcon(optionchild.active1) + '</td>' +
                                    '<td>' + boolToIcon(optionchild.active2) + '</td>' +
                                '</tr>'
                            );
                        });

                        inoculationspecifics = res.inoculationspecifics;
                        $('#inoSpecCompTable tbody tr').remove();
                        $.each( inoculationspecifics, function( key, inoculationspecific ) {
                            $('#inoSpecCompTable tbody').append(
                                '<tr>' +
                                    '<td class="text-left">' + inoculationspecific.content + '</td>' +
                                    '<td>' + boolToIcon(inoculationspecific.active1) + '</td>' +
                                    '<td>' + boolToIcon(inoculationspecific.active2) + '</td>' +
                                '</tr>'
                            );
                        });

                        contentadditionals = res.contentadditionals;
                        languages = res.languages;
                        $('#contentAdditionalsCompTable tbody tr').remove();
                        $.each( contentadditionals, function( position, contentadditional ) {
                            headline1 = contentadditional[1] ? contentadditional[1].headline : '';
                            headline2 = contentadditional[2] ? contentadditional[2].headline : '';
                            $('#contentAdditionalsCompTable tbody').append(
                                '<tr style="background-color: #ffeeff;">' +
                                    '<th colspan=2 class="text-center">' + (position+1) + '. ' + '</td>' +
                                    '<td class="text-left original">' + headline1 + '</td>' +
                                    '<td class="text-left changed">' + headline2 + '</td>' +
                                    '<td class="text-left diff"></td>' +
                                '</tr>'
                            );
                            $.each( languages, function( langIndex, language ) {
                                langContent1 = {
                                    'headline': '',
                                    'content': '',
                                }
                                langContent2 = {
                                    'headline': '',
                                    'content': '',
                                }
                                if(contentadditional[1] != null && typeof contentadditional[1].languages[langIndex] !== 'undefined') {
                                    lang1 = contentadditional[1].languages[langIndex].pivot;
                                    langContent1.headline = lang1.headline || '';
                                    langContent1.content = lang1.content || '';
                                }
                                if(contentadditional[2] != null && typeof contentadditional[2].languages[langIndex] !== 'undefined') {
                                    lang2 = contentadditional[2].languages[langIndex].pivot;
                                    langContent2.headline = lang2.headline || '';
                                    langContent2.content = lang2.content || '';
                                }
                                $('#contentAdditionalsCompTable tbody').append(
                                    '<tr>' +
                                        '<td rowspan=2 class="align-middle text-nowrap">' + language.content + '</td>' +
                                        '<td class="align-middle text-nowrap">Headline</td>' +
                                        '<td class="text-left original">' + langContent1.headline + '</td>' +
                                        '<td class="text-left changed">' + langContent2.headline + '</td>' +
                                        '<td class="text-left diff"></td>' +
                                    '</tr>'
                                );
                                $('#contentAdditionalsCompTable tbody').append(
                                    '<tr>' +
                                        '<td class="align-middle text-nowrap">Content</td>' +
                                        '<td class="text-left original">' + langContent1.content + '</td>' +
                                        '<td class="text-left changed">' + langContent2.content + '</td>' +
                                        '<td class="text-left diff"></td>' +
                                    '</tr>'
                                );
                            })
                        });
                        $("#contentAdditionalsCompTable tr").prettyTextDiff();
                    },
                    complete: function() {
                        modal.find('.block').removeClass('block-mode-loading');
                    },
                    error: function() {
                        alert('version invalid');
                        modal.modal('hide');
                    }
                });
            });
            function boolToIcon(value) {
                return value ? '<i class="fa fa-check-circle text-success"></i>' : '<i class="fa fa-circle text-danger"></i>';
            }
        });
    </script>

<!-- Compare Modal Start -->
