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

    <div class="modal fade" id="modalTransitvisaCompare" tabindex="-1" role="dialog" aria-labelledby="modalTransitvisaCompare">
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
                        <table id="transitvisaCompTable" class="table table-bordered table-hover text-center text-break">
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
                        <table id="transitvisaNatCompTable" class="table table-bordered table-hover text-center text-break">
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
            $('#modalTransitvisaCompare').on('show.bs.modal', function (e) {
                var modal = $(this);
                modal.find('.block').addClass('block-mode-loading');

                var assigntoold = $(e.relatedTarget).data('assigntoold');
                var assigntonew = $(e.relatedTarget).data('assigntonew');
                if (assigntoold > assigntonew) {
                    assigntoold = $(e.relatedTarget).data('assigntonew');
                    assigntonew = $(e.relatedTarget).data('assigntoold');
                }
                var transitvisa1, transitvisa2;
                var columns = [
                    {
                        label: 'Country',
                        col: 'countrytocode',
                        type: 'text',
                    }, {
                        label: 'Required',
                        col: 'required',
                        type: 'boolean',
                    }, {
                        label: 'Exception',
                        col: 'exception',
                        type: 'boolean',
                    }, {
                        label: 'Checked and ok',
                        col: 'checkedandok',
                        type: 'boolean',
                    }, {
                        label: 'Checked and not ok',
                        col: 'checkedandnotok',
                        type: 'boolean',
                    }, {
                        label: 'Active',
                        col: 'active',
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
                    url: '{{ route("api.transitvisas.compare") }}',
                    data: {
                        id1: assigntoold,
                        id2: assigntonew,
                    },
                    success: function(res){
                        transitvisa1 = res.transitvisa1;
                        transitvisa2 = res.transitvisa2;
                        modal.find('th.col-ver-1').html('Version ' + transitvisa1.version);
                        modal.find('th.col-ver-2').html('Version ' + transitvisa2.version);

                        $('#transitvisaCompTable tbody tr').remove();
                        columns.forEach(function (column) {
                            if (transitvisa1[column.col] == null) {
                                transitvisa1[column.col] = '';
                            }
                            if (transitvisa2[column.col] == null) {
                                transitvisa2[column.col] = '';
                            }
                            if (column.type == 'boolean') {
                                $('#transitvisaCompTable tbody').append(
                                    '<tr>' +
                                        '<td class="text-left">' + column.label + '</td>' +
                                        '<td class="original">' + boolToIcon(transitvisa1[column.col]) + '</td>' +
                                        '<td class="changed">' + boolToIcon(transitvisa2[column.col]) + '</td>' +
                                        '<td></td>' +
                                    '</tr>'
                                );
                            } else {
                                $('#transitvisaCompTable tbody').append(
                                    '<tr>' +
                                        '<td class="text-left">' + column.label + '</td>' +
                                        '<td class="original">' + transitvisa1[column.col] + '</td>' +
                                        '<td class="changed">' + transitvisa2[column.col] + '</td>' +
                                        '<td class="diff"></td>' +
                                    '</tr>'
                                );
                            }
                        });
                        $("#transitvisaCompTable tr").prettyTextDiff();

                        nationalities = res.nationalities;
                        $('#transitvisaNatCompTable tbody tr').remove();
                        $.each( nationalities, function( key, nationality ) {
                            $('#transitvisaNatCompTable tbody').append(
                                '<tr>' +
                                    '<td class="text-left">' + nationality.name_en + '</td>' +
                                    '<td>' + boolToIcon(nationality.active1) + '</td>' +
                                    '<td>' + boolToIcon(nationality.active2) + '</td>' +
                                '</tr>'
                            );
                        });
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
