@extends('layouts.template')

@section('title', 'Alumni')
@section('main')
    <div>
        <!-- Message -->
        @if(Session::has('message'))
            <p >{{ Session::get('message') }}</p>
    @endif

    <!-- Form -->
        <form method='post' action='/uploadFile' enctype='multipart/form-data' >
            {{ csrf_field() }}
            <input type='file' name='file' >
            <input type='submit' name='submit' value='Import'>
        </form>
        <br>
    </div>


<div class="table-wrapper">
    <div class="search">
        <form method="get" action="/alumni" id="searchForm">
            <div class="row">
                <div class="col-sm-6 mb-2">
                <input type="text" class="form-control" name="alumnus" id="alumnus" value="{{request()->alumnus}}"
                        placeholder="Zoek alumnus">
                </div>
                <div class="col-sm-2 mb-2">
                    <button type="submit" class="btn btn-success btn-block">Search</button>
                </div>
                <div class="col-sm-1 mb1">
                <input type="number" value="{{request()->size?request()->size:25}}" name="size">
                </div>
            </div>

        </form>
    </div>
    <table class="table">
        <thead class="table-head">
            <tr>
                <th>Naam</th>
                <th>Voornaam</th>
                <th>E-mailadres</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alumni as $alumnus)
            <tr>
                <td class="table-capitalize">{{$alumnus->achternaam}}</td>
                <td class="table-capitalize">{{$alumnus->voornaam}}</td>
                <td>{{$alumnus->mail}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$alumni->links()}}
</div>
@endsection



