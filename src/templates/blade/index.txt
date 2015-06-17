@extends('{{layout}}')

@section('content')
<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach(${{resource}}s as ${{resource}})
        <tr>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop