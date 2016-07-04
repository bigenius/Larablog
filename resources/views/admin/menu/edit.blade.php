@extends('admin.layout')

@push('scripts')
<script>
    var exclude = Sortable.create(excludedpages, { group: "menu", handle: ".handle", ghostClass: 'ghost', dataIdAttr: 'data-id' });
    var include = Sortable.create(includedpages, {
        group: "menu",
        handle: ".handle",
        ghostClass: 'ghost',
        dataIdAttr: 'data-id',
        store: {
            /**
             * Get the order of elements. Called once during initialization.
             * @param   {Sortable}  sortable
             * @returns {Array}
             */
            get: function (sortable) {
                return [];
            },

            /**
             * Save the order of elements. Called onEnd (when the item is dropped).
             * @param {Sortable}  sortable
             */
            set: function (sortable) {
                var pages = sortable.toArray();
                $("#pageIds").val(pages);

            }
        }

    });
    include.option("onAdd", function(){include.save()});
    $(document).ready( function(){
        include.save();
    });

</script>
@include('admin.post.slug-script')

@endpush

@section('body-class'){{ 'menu-edit' }}@endsection

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-{{ session('status') }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        {{ session('info') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">New post</div>
                    <div class="panel-body">
                        <form class="form" role="form" method="POST"
                              action="{{route('lb-admin.menu.update', $menu->id)}}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="PUT">

                            <div class="row form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label class="col-md-12 control-label">Title</label>

                                <div class="col-md-12 ">
                                    <input type="text" class="form-control" name="title" value="{{ $menu->title }}">

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Available pages</div>
                                        <div id="excludedpages" class="panel-body list-group">
                                            @foreach( $pages as $page)
                                                <div data-id="{{$page->id}}" class="list-group-item"><i class="fa fa-arrows pull-right clearfix handle"></i>{{$page->title}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Pages in menu</div>
                                        <div id="includedpages" class="panel-body list-group">
                                            @foreach( $menu->pages as $page)

                                                <div data-id="{{$page->id}}" class="list-group-item"><i class="fa fa-arrows pull-right clearfix handle"></i>{{$page->title}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="pages" id="pageIds">




                            <div class="row form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-btn fa-user"></i>Save
                                    </button>



                                </div>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
