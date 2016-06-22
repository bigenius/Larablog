@push('scripts')
<script>
    $(function () {
        $('#publishPicker').datetimepicker({
            locale: 'sv',
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    $("#cancelDate").on('click', function() {
        $("#collapsePublish").collapse('hide');
    });
    $("#confirmDate").on('click', function() {
        var pDate = $("#publishDate").val();

        $("#publishDateShow").html( (pDate?pDate:'now'));
        $("#collapsePublish").collapse('hide');
    });

    });
</script>
@endpush

<div class="form-group">
    Publish: <a class="" role="button" data-toggle="collapse" href="#collapsePublish" aria-expanded="false" aria-controls="collapseExample">
        <span id="publishDateShow">{{$post->published_at or 'now'}}</span>
    </a>
    <div class="collapse" id="collapsePublish">
        <div class='input-group date' id='publishPicker'>
            <input id="publishDate" name="published_at" type='text' class="form-control" value="{{$post->published_at or ''}}"/>
            <span class="input-group-addon">
                <span class="fa fa-calendar-check-o"></span>
            </span>

        </div>
        <div class="input-group input-group-below">
            <a role="button" id="cancelDate" class="pointer">Cancel</a>
            <button type="button" id="confirmDate" class="btn btn-default pull-right"><span class="fa fa-check"></span></button>
        </div>
    </div>
</div>
