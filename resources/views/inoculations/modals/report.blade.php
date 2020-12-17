<!-- HRReport Modal Start -->

    <div class="modal fade" id="modalHRReport" tabindex="-1" role="dialog" aria-labelledby="modalHRReport">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title report-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body block m-0">
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
    .modal-xl {
        max-width: 90%;
    }
</style>

<script>
    $(document).ready(function() {
        var lang = 'en';

        $('#modalHRReport').on('show.bs.modal', function (e) {
            var modal = $(this);
            modal.find('.block').addClass('block-mode-loading');

            lang = $(e.relatedTarget).data('lang');

            $.ajax({
                type: 'POST',
                url: '{{ route("api.inoculations.report") }}',
                data: {
                    id: "{{ $inoculation->id }}",
                    lang
                }
            })
                .done(function (res) {
                    modal.find('.modal-title').html(res.title);
                    modal.find('.report-content').html(res.content);
                    modal.find('.block').removeClass('block-mode-loading');
                });
        });

        $('.btn-create-pdf').click(function() {
            window.open('{{ route("inoculations.report", $inoculation->id) }}' + '?lang=' + lang);
        })
    })
</script>

<!-- HRReport Modal Start -->
