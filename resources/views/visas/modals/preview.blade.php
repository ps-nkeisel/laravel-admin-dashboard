<!-- VisaPreview Modal Start -->

    <div class="modal fade" id="modalVisaPreview" tabindex="-1" role="dialog" aria-labelledby="modalVisaPreview">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title preview-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body block m-0">
                    <div class="block-content">
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
        $('#modalVisaPreview').on('show.bs.modal', function (e) {
            var modal = $(this);
            modal.find('.block').addClass('block-mode-loading');

            $.ajax({
                type: 'POST',
                url: '{{ route("api.visas.preview") }}',
                data: $('.visa-form').serialize()
            })
                .done(function (res) {
                    modal.find('.modal-title').html(res.title);
                    modal.find('.block-content').html(res.content);
                    modal.find('.block').removeClass('block-mode-loading');
                });
        });
        $('.btn-create-pdf').click(function() {
            var formAction = $('.visa-form').attr('action');

            $('.visa-form').attr('action', '{{ route("visas.preview") }}');
            $('.visa-form').attr('target', '_blank');

            $('.visa-form').submit();

            $('.visa-form').attr('action', formAction);
            $('.visa-form').removeAttr('target');
        })
    })
</script>

<!-- VisaPreview Modal Start -->
