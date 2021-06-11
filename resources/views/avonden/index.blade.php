@extends('layouts.template')

@section('title', 'Evenementen')

@section('main')
@include('shared.summary', ['title'=>'Avonden', 'msg'=>"Op deze pagina ziet u de verschillende avonden die gepland zijn.
U kan op een avond klikken voor meer informatie."])
<div class="container">
    <div class='table-responsive'>
        @if(Auth::user()->verantwoordelijke)
        <p><a href="/avonden/create" class='btn btn-add btn-outline-success text-success'><i
                    class="fas fa-plus"></i>Nieuw evenement voor een opleiding maken</a>
        </p>
        @endif

        <table class='table table-hover'>
            <thead>
                <th scope='col'>Evenement</th>
                <th scope='col'>Beschrijving</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($evenementen as $evenement)
                <tr class='clickable-row' data-href='avonden/{{$evenement->id}}' data-toggle="tooltip"
                    title="Meer informatie over {{$evenement->evenementnaam}}">
                    <td class='clickable-col'>
                        <p>{{$evenement->evenementnaam }}</p>

                    </td>
                    <td class='clickable-col'>
                        <p>{{(strlen($evenement->beschrijving)>30?substr($evenement->beschrijving,0,30).'...':$evenement->beschrijving)}}
                        </p>
                    </td>
                    <td>
                        @if(Auth::user()->admin)
                        <div class="btn-group btn-group-sm">
                            <p><a data-id="{{$evenement->id}}" data-name="{{$evenement->evenementnaam}}"
                                    class="btn btn-danger btn-del">Evenement verwijderen</a></p>
                        </div>
                        @endif
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
        Alumni.footer(0,3)
        Alumni.summary()
        $('.clickable-row .clickable-col').on('click', function(){
            window.location=$(this).closest('tr').data('href');
        });


        $(".btn-del").on('click', function(){
            tryDeleteAvond($(this).data('id'), $(this).data('name'))
        })
        function tryDeleteAvond(id, name){
            let text = `<p>Avond <b>${name}</b> verwijderen?</p>`
            let type = 'warning';
            let btnText = 'Verwijder evenement';
            let btnClass ='btn-success';
            let modal = new Noty({
                timeout: false,
                layout: 'center',
                modal: true,
                type: type,
                text: text,
                buttons: [
                    Noty.button(btnText, `btn ${btnClass}`, function () {
                        deleteAvond(id);
                        modal.close();
                    }),
                    Noty.button('Terug', 'btn btn-secondary ml-2', function () {
                        modal.close();
                    })
                ]
            }).show();
        }

        function deleteAvond(id){
            let pars = {
            '_token': '{{ csrf_token() }}',
            '_method': 'delete'
            };
            $.post(`/avonden/${id}`, pars, 'json').done(
                (data)=>{
                    new Noty({
                    type: data.type,
                    text: data.text
                        }).show();
                    location.reload();
                }
            )
        }

    })

</script>
@endsection
@section('css_after')
<style>
    .clickable-row {
        cursor: pointer;
    }
</style>

@endsection
