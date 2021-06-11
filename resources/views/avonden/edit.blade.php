@extends('layouts.template')

@section('title', 'Evenementen bewerken')

@section('main')
    <div class="container">
        <div class='form-group'>
            <h1>Avond bewerken</h1>
            <form action="/avonden/{{ $evenement->id }}"  method="post">
                @method('put')
                @include('avonden.form')
            </form>
        </div>
    </div>
@endsection
@section('script_after')
    <script>

        $(function(){
            Alumni.footer(3,1)
          // Alumni.summary()
        })
    </script>
@endsection
@section('css_after')


@endsection
