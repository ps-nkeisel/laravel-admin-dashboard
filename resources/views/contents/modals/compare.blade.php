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


    <div class="modal fade" id="modalContentCompare" tabindex="-1" role="dialog" aria-labelledby="modalContentCompare">
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
                        <table id="contentCompareTable" class="table table-bordered table-responsive table-hover text-break">
                            <thead>
                            <tr>
                                <th width="200px">Column</th>
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
            $('#modalContentCompare').on('show.bs.modal', function (e) {
                var modal = $(this);
                modal.find('.block').addClass('block-mode-loading');

                var assigntoold = $(e.relatedTarget).data('assigntoold');
                var assigntonew = $(e.relatedTarget).data('assigntonew');
                if (assigntoold > assigntonew) {
                    assigntoold = $(e.relatedTarget).data('assigntonew');
                    assigntonew = $(e.relatedTarget).data('assigntoold');
                }
                var columns = [
                    {
                        label: 'Code 1',
                        col: 'code1',
                        type: 'text',
                    }, {
                        label: 'Code 2',
                        col: 'code2',
                        type: 'text',
                    }, {
                        label: 'Headline',
                        col: 'text1',
                        type: 'text',
                    }, {
                        label: 'Content',
                        col: 'content1',
                        type: 'text',
                    }, {
                        label: 'Position',
                        col: 'position',
                        type: 'text',
                    }, {
                        label: 'Language',
                        col: 'language_content',
                        type: 'text',
                    }, {
                        label: 'Active from',
                        col: 'validityfrom',
                        type: 'text',
                    }, {
                        label: 'Active to',
                        col: 'validityto',
                        type: 'text',
                    }, {
                        label: 'Status',
                        col: 'active',
                        type: 'boolean',
                    },
                ]
                $.ajax({
                    type: 'POST',
                    url: '{{ route("api.contents.compare") }}',
                    data: {
                        id1: assigntoold,
                        id2: assigntonew,
                    },
                    success: function(res){
                        content1 = res.content1;
                        content2 = res.content2;

                        $('#contentCompareTable th.col-ver-1').html('Version ' + content1.version);
                        $('#contentCompareTable th.col-ver-2').html('Version ' + content2.version);

                        $('#contentCompareTable tbody tr').remove();
                        columns.forEach(function (column) {
                            if (content1[column.col] == null) {
                                content1[column.col] = '';
                            }
                            if (content2[column.col] == null) {
                                content2[column.col] = '';
                            }
                            if (column.type == 'boolean') {
                                $('#contentCompareTable tbody').append(
                                    '<tr>' +
                                        '<td>' + column.label + '</td>' +
                                        '<td>' + boolToIcon(content1[column.col]) + '</td>' +
                                        '<td>' + boolToIcon(content2[column.col]) + '</td>' +
                                        '<td></td>' +
                                    '</tr>'
                                );
                            } else {
                                $('#contentCompareTable tbody').append(
                                    '<tr>' +
                                        '<td>' + column.label + '</td>' +
                                        '<td class="original">' + content1[column.col] + '</td>' +
                                        '<td class="changed">' + content2[column.col] + '</td>' +
                                        '<td class="diff"></td>' +
                                    '</tr>'
                                );
                            }
                        });
                        $("#contentCompareTable tr").prettyTextDiff();
                    },
                    complete: function() {
                        modal.find('.block').removeClass('block-mode-loading');
                    }
                });
            });
            function boolToIcon(value) {
                return value ? '<i class="fa fa-check-circle text-success"></i>' : '<i class="fa fa-circle text-danger"></i>';
            }
        });
    </script>

<!-- Compare Modal Start -->
