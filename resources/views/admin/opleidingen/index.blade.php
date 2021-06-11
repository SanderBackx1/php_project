@extends('layouts.template')

@section('title', 'Opleidingen')


@section('main')
    @include('shared.summary', ['title'=>'Opleidingen', 'msg'=>"Op deze pagina ziet u de verschillende opleidingen van de school. U kan een opleiding bewerken."])
    <div class="container">
        <p>
            <a href="/admin/opleidingen/create" class="btn btn-outline-success">
                <i class="fas fa-plus-circle mr-1"></i>Voeg een nieuwe opleiding toe
            </a>
        </p>
        @include('shared.alert')
        <div class='table-responsive'>
            <table class='table table-hover'>
                <thead>
                <th scope='col'>Opleiding</th>
                <th scope='col' class="text-center">Actief</th>
                <th scope='col' class="text-center">Acties</th>
                </thead>
                <tbody>
                @foreach ($opleidingen as $opleiding)
                    <tr >
                        <td>
                            <p>{{$opleiding->opleidingnaam }}</p>
                        </td>
                        <td align="center">
                            @if($opleiding->actief)
                                <i class="far fa-check-circle fa-2x"></i>
                            @else
                                <i class="fas fa-times-circle fa-2x"></i>
                            @endif
                        </td>
                        <td align="center">
                            <form action="/admin/opleidingen/{{ $opleiding->id }}" method="post">
                                @method('delete')
                                @csrf
                                <div class="btn-group btn-group-sm">
                                    <a href="/admin/opleidingen/{{ $opleiding->id }}/edit" class="btn btn-outline-success"
                                       data-toggle="tooltip"
                                       title="Bewerk {{ $opleiding->opleidingnaam }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="submit" class="btn btn-outline-danger"
                                            data-toggle="tooltip"
                                            title="Verwijder {{ $opleiding->opleidingnaam }}">
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
    </div>
@endsection
@section('script_after')
    <script>
        $(function(){
        Alumni.footer(1,0)
        Alumni.summary()
    })
    </script>
@endsection
