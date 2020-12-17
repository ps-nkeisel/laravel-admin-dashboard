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

    <div class="modal fade" id="modalCruisetuicCompare" tabindex="-1" role="dialog" aria-labelledby="modalCruisetuicCompare">
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
                        <table id="cruisetuicCompTable" class="table table-bordered table-hover text-center text-break">
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
                        <div class="alert alert-primary">Nationalities</div>
                        <table id="cruisetuicNatCompTable" class="table table-bordered table-hover text-center text-break">
                            <thead>
                                <tr>
                                    <th width="150px">Name</th>
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
            $('#modalCruisetuicCompare').on('show.bs.modal', function (e) {
                var modal = $(this);
                modal.find('.block').addClass('block-mode-loading');

                var assigntoold = $(e.relatedTarget).data('assigntoold');
                var assigntonew = $(e.relatedTarget).data('assigntonew');
                if (assigntoold > assigntonew) {
                    assigntoold = $(e.relatedTarget).data('assigntonew');
                    assigntonew = $(e.relatedTarget).data('assigntoold');
                }
                var cruisetuic1, cruisetuic2, requirement_immunisations;
                var columns = [
                    {
                        label: 'Sccode',
                        col: 'sccode',
                        type: 'text',
                    }, {
                        label: 'Scname',
                        col: 'scname',
                        type: 'text',
                    }, {
                        label: 'Scrcode',
                        col: 'scrcode',
                        type: 'text',
                    }, {
                        label: 'Scrcodeext',
                        col: 'scrcodeext',
                        type: 'text',
                    }, {
                        label: 'Scrname',
                        col: 'scrname',
                        type: 'text',
                    }, {
                        label: 'Countrypassport',
                        col: 'countrypassport',
                        type: 'text',
                    },
                ]
                $.ajax({
                    type: 'POST',
                    url: '{{ route("api.cruisetuics.compare") }}',
                    data: {
                        id1: assigntoold,
                        id2: assigntonew,
                    },
                    success: function(res){
                        cruisetuic1 = res.cruisetuic1;
                        cruisetuic2 = res.cruisetuic2;
                        modal.find('th.col-ver-1').html('Version ' + cruisetuic1.version);
                        modal.find('th.col-ver-2').html('Version ' + cruisetuic2.version);

                        $('#cruisetuicCompTable tbody tr').remove();
                        columns.forEach(function (column) {
                            if (cruisetuic1[column.col] == null) {
                                cruisetuic1[column.col] = '';
                            }
                            if (cruisetuic2[column.col] == null) {
                                cruisetuic2[column.col] = '';
                            }
                            if (column.type == 'boolean') {
                                $('#cruisetuicCompTable tbody').append(
                                    '<tr>' +
                                        '<td class="text-left">' + column.label + '</td>' +
                                        '<td class="original">' + boolToIcon(cruisetuic1[column.col]) + '</td>' +
                                        '<td class="changed">' + boolToIcon(cruisetuic2[column.col]) + '</td>' +
                                        '<td></td>' +
                                    '</tr>'
                                );
                            } else {
                                $('#cruisetuicCompTable tbody').append(
                                    '<tr>' +
                                        '<td class="text-left">' + column.label + '</td>' +
                                        '<td class="original">' + cruisetuic1[column.col] + '</td>' +
                                        '<td class="changed">' + cruisetuic2[column.col] + '</td>' +
                                        '<td class="diff"></td>' +
                                    '</tr>'
                                );
                            }
                        });
                        $("#cruisetuicCompTable tr").prettyTextDiff();

                        nationalities = res.nationalities;
                        $('#cruisetuicNatCompTable tbody tr').remove();
                        $.each( nationalities, function( key, nationality ) {
                            $('#cruisetuicNatCompTable tbody').append(
                                '<tr>' +
                                    '<td class="text-left">' + nationality.name_en + '</td>' +
                                    '<td>' + boolToIcon(nationality.active1) + '</td>' +
                                    '<td>' + boolToIcon(nationality.active2) + '</td>' +
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
