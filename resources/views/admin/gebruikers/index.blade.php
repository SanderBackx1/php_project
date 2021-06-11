@extends('layouts.template')

@section('title', 'Gebruikers')


@section('main')

    @include('shared.summary', ['title'=>'Gebruikers', 'msg'=>"Op deze pagina kan u gebruikers bekijken, toevoegen, wijzigen en verwijderen."])
    <h1>Gebruikers</h1>
    <p>
        <a href="gebruikers/create" class="btn btn-outline-success">
            <i class="fas fa-user-plus mr-1"></i>Voeg een nieuwe gebruiker toe
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Naam</th>
                <th>E-mailadres</th>
                <th class="text-center" >Admin</th>
                <th class="text-center">Alumniverantwoordelijke</th>
                <th class="text-center">Edit</th>
            </tr>
            </thead>
            <tbody>

            @foreach($gebruikers as $gebruiker)
                <tr>
                    <td>{{$gebruiker->name}}</td>
                    <td>{{$gebruiker->email}}</td>
                    <td align="center">  @if($gebruiker->admin)
                            <i class="far fa-check-circle fa-2x"></i>
                              @else
                            <i class="fas fa-times-circle fa-2x"></i>
                        @endif</td>

                    <td align="center">  @if($gebruiker->verantwoordelijke)
                            <i class="far fa-check-circle fa-2x text-center"></i>
                              @else
                            <i class="fas fa-times-circle fa-2x"></i>
                        @endif
                    </td>
                    <td align="center">
                        <form action="gebruikers/{{ $gebruiker->id }}" method="post">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="gebruikers/{{$gebruiker->id}}/edit" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Edit {{$gebruiker->name}}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-outline-danger"
                                        data-toggle="tooltip"
                                        title="Delete {{$gebruiker->name}}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
@section('script_after')


    <script>

        $(function(){
            Alumni.footer(3,1)
            Alumni.summary()
        })
    </script>
@endsection
@section('css_after')

@endsection
