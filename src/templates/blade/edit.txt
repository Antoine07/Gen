@extends('{{layout}}')

@section('script')
<script type="text/javascript" src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        {!! Form::open(['url'=>'{{resource}}/'.${{resource}}->id, 'method'=>'PUT']) !!}


        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                create
            </button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop