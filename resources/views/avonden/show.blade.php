@extends('layouts.template')

@section('title', 'Evenementen details')

@section('main')
@include('shared.summary', ['title'=>'Avonden detail', 'msg'=>"Op deze pagina ziet u de details van deze avond."])
@include('shared.alert')
<div class="container">
    <h2><span id='evenementnaam'>{{$evenement->evenementnaam}}</span>
        @if(Auth::user()->verantwoordelijke)

        <a data-toggle="tooltip" title="{{$evenement->evenementnaam}} wijzigen" href="/avonden/{{$evenement->id}}/edit">
            (Wijzigen)</a>
        @endif
    </h2>

    <p>{{$evenement->beschrijving}}<p>
            <div id='info' class='row'>
                <ul class='col'>
                    <li><b>Datum:</b></li>
                    <li><b>Tijdstip:</b></li>
                    <li><b>Richting:</b></li>

                </ul>
                <ul class='col'>
                    <li>{{$evenement->datum}}</li>
                    <li>{{$evenement->tijdstip}}</li>

                    <li>
                        @foreach ($opleidingen as $opleiding)
                        @if($opleiding->id == $evenement->opleiding_id)
                        {{$opleiding->opleidingnaam}}


                        @endif


                        @endforeach
                    </li>

                </ul>
            </div>
</div>
<div class="container">
    @if(Auth::user()->verantwoordelijke)
    <div id='verantwoordelijke ' class="table-wrapper">
        <h3 class="collapse-custom" data-toggle="collapse" data-target="#activiteiten"><a href="#activiteiten"
                class="linkopmaak">Activiteiten</a></h3>
        <div class='table-responsive collapse show collapse-table' id="activiteiten">
            <table class="table">
                <thead>
                    <tr>
                        <th scope='col'>Activiteit</th>
                        <th scope='col'>Tijdstip</th>
                        <th scope='col'>Lokaal</th>
                        <th scope='col'><a data-toggle="tooltip" title="Nieuwe activiteit toevoegen"
                                class='btn btn-add btn-outline-success text-success'><i class="fas fa-plus"></i> Nieuwe
                                activiteit</a></th>
                    </tr>
                </thead>
                <tbody id="activiteiten-verantwoordelijke">
                    <td colspan="5">
                        <div class="spinner-border text-success" role="status">
                        </div>
                    <td>
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div id='docenten' class="table-wrapper">
        <h3 data-toggle="collapse" data-target="#activiteiten2"><a class="linkopmaak collapse-custom">Activiteiten</a>
        </h3>
        <div class='table-responsive collapse show collapse-table' id="activiteiten2">
            <table class='table'>
                <thead>
                    <tr>
                        <th scope='col'>Activiteit</th>
                        <th scope='col'>Tijdstip</th>
                        <th scope='col'>Lokaal</th>
                    </tr>
                </thead>
                <tbody id="activiteiten-docenten">
                    <td colspan="5">
                        <div class="spinner-border text-success" role="status">
                        </div>
                    <td>
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <div id='docenten ' class="table-wrapper">
        <h3 class="collapse-custom" data-toggle="collapse" data-target="#taken"> <a class="linkopmaak">Taken</a></h3>
        <div class='table-responsive collapse show collapse-table' id="taken">
            <table class='table'>
                <thead>
                    <th>Taak</th>
                    <th>Beschrijving</th>
                    <th>Docenten met voorkeur</th>
                    <th>Aangewezen docenten</th>
                    <th>aantal</th>
                    <th></th>
                    <?php use App\User;$ar = []; ?>

                    @if(Auth::user()->verantwoordelijke)

                    <th></th>

                    @endif

                </thead>
                <tbody>
                    @foreach ($evenement->taken as $taak)
                    <tr>
                        <td>{{$taak->naam}}</td>
                        <td>{{$taak->beschrijving}}</td>

                        <td>
                            @foreach ($taak->docenttaak as $docenttaak)
                            @if($docenttaak->voorkeur)
                            <p> {{$docenttaak->docent->name}}</p>

                            <?php
                                            $ar = [];
                                            array_push($ar,$docenttaak->docent->id);
                                            ?>
                            @endif
                            @endforeach

                        </td>

                        <td>

                            <?php
                                    $teller =0
                                    ?>
                            @foreach ($taak->docenttaak as $docenttaak)

                            @if($docenttaak->aangewezen)
                            <?php
                                            $teller +=1
                                            ?>
                            <p>
                                {{$docenttaak->docent->name}}<a href="/docenttaken2/{{$docenttaak->id}}"> <i
                                        class="fas fa-minus-circle"></i></a></p>
                            @endif
                            @endforeach
                            @if(Auth::user()->verantwoordelijke)
                            @if($teller < $taak->aantal or $taak->aantal == null)
                                <?php
                                            $usrs = User::get();
                                            $cont = 0;
                                            foreach($usrs as $usr){
                                                if($usr->actief){
                                                    $cont +=1;
                                                }
                                            }
                                            ?>
                                @if($teller == $cont )
                                @else
                                <a href="/docenttaken2/{{$taak->id}}/edit"><i class="fas fa-plus"></i></a>
                                @endif
                                @endif
                                @endif
                        </td>
                        @if($taak->aantal == null)
                        <td>Geen maximum</td>
                        @else
                        <td>{{$teller}}/{{$taak->aantal}}</td>
                        @endif


                        @if(in_array(auth::user()->id,$ar) )
                        <td>


                            <form action="/docenttaken/{{ $taak->id }}" method="post">
                                @method('delete')
                                @csrf
                                <div class="btn-group btn-group-sm">
                                    <input type="submit" Value="Voorkeur verwijderen">




                                </div>

                            </form>
                        </td>
                        <?php $ar = array();?>
                        @else
                        <td><a href="/docenttaken/{{$taak->id}}"><button>Voorkeur opgeven</button></a></td>
                        @endif



                        @if(Auth::user()->verantwoordelijke)

                        <td>
                            <form action="/taken/{{ $taak->id }}"
                                onsubmit="return confirm('Taak {{$taak->naam}} verwijderen?');" method="post">
                                @method('delete')
                                @csrf
                                <div class="btn-group btn-group-sm">
                                    <a href="/taken/{{$taak->id}}/edit" class="btn btn-outline-success"
                                        data-toggle="tooltip" title="Wijzig {{$taak->naam}}"><i
                                            class="fas fa-edit"></i></a>

                                    <button type="submit" class="btn btn-outline-danger" data-toggle="tooltip"
                                        title="Verwijder {{$taak->naam}}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </div>

                            </form>
                        </td>
                        @endif

                    </tr>



                    @endforeach
                    @if(Auth::user()->verantwoordelijke)
                    <tr>
                        <td><a href="/taken/{{$evenement->id}}"><i class="fas fa-plus"> </i> Nieuwe taak </a></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>

    @if($evenement->formulier == true)
    <div id='alumni' class="table-wrapper">
        <h3 class="collapse-custom" id="#alumniCollapse" data-toggle="collapse" data-target="#alumniTable"><a
                class="linkopmaak">Alumni</a></h3>
        <div class='table-responsive collapse show collapse-table' id="alumniTable">
            <table class='table'>
                <thead>
                    <th>Naam</th>
                    <th>E-mailadres</th>
                    @foreach ($evenement->vragen as $vraag)
                    <th>{{$vraag->inhoud}}</th>
                    @endforeach
                    @if(Auth::user()->verantwoordelijke)

                    <th>
                        <a href="/alumnusantwoorden/create?avond={{$evenement->id}}"
                            class='btn btn-outline-success text-success'><i class="fas fa-plus"></i> Alumnus
                            toevoegen</a>
                    </th>

                    @endif

                </thead>
                <tbody>
                    <?php
                            //EXTRACT DATA JSON
                            $vragen = json_decode($evenement->vragen);
                            if($vragen){
                                $antwoorden = array();
                                foreach ($vragen as $vraag) {
                                    foreach($vraag->antwoorden as $antwoord){
                                        $antwoorden[] = $antwoord;
                                    }
                                }
                                $alumnusantwoorden = array();
                                foreach($antwoorden as $antwoord){
                                    foreach($antwoord->alumnusantwoord as $alumnusantwoord){
                                        $alumnusantwoorden[]=$alumnusantwoord;
                                    }
                                }
                                $alumnusaanwezigheden = array();
                                foreach ($alumnusantwoorden as $alumnusantwoord) {
                                        if(!in_array($alumnusantwoord->alumnusaanwezigheid, $alumnusaanwezigheden)){
                                            $alumnusaanwezigheden[] = $alumnusantwoord->alumnusaanwezigheid;
                                        }
                                }
                            }
                        ?>

                    @if(isset($alumnusaanwezigheden))
                    @foreach ($alumnusaanwezigheden as $alumnusaanwezigheid)
                    <tr>
                        <td>{{$alumnusaanwezigheid->voornaam . ' ' . $alumnusaanwezigheid->achternaam}}</td>
                        <td>{{$alumnusaanwezigheid->mail}}</td>
                        @foreach($antwoorden as $key=>$antwoord)
                        @if($antwoord->alumnusantwoord)
                        @foreach ($antwoord->alumnusantwoord as $alumnusantwoord)
                        @if($alumnusantwoord->alumnusaanwezigheid_id == $alumnusaanwezigheid->id )
                        <td>{{$antwoord->inhoud}}</td>
                        @endif
                        @endforeach
                        @endif
                        @endforeach

                        @if(Auth::user()->verantwoordelijke)
                        <td>

                            <form action="/alumnusantwoorden/{{ $alumnusaanwezigheid->id }}"
                                onsubmit="return confirm('De gehele inschrijving van {{$alumnusaanwezigheid->voornaam}} {{$alumnusaanwezigheid->achternaam}} verwijderen?');"
                                method="post">
                                @method('delete')
                                @csrf
                                <div class="btn-group btn-group-sm">
                                    <a href="/alumnusantwoorden/{{$alumnusaanwezigheid->id}}/edit"
                                        class="btn btn-outline-success" data-toggle="tooltip"
                                        title="Bewerk {{$alumnusaanwezigheid->voornaam}} {{$alumnusaanwezigheid->achternaam}}"><i
                                            class="fas fa-edit"></i></a>

                                    <button type="submit" class="btn btn-outline-danger" data-toggle="tooltip"
                                        title="Verwijder {{$alumnusaanwezigheid->voornaam}} {{$alumnusaanwezigheid->achternaam}}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </div>

                            </form>


                        </td>
                        @endif


                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @else
    @if(Auth::user()->verantwoordelijke)
    <h3>Inschrijvingsformulier maken</h3>
    <a href="/vragen/create?avond={{$evenement->id}}" class='btn btn-add btn-outline-success text-success'><i
            class="fas fa-plus"></i>Vragen opstellen voor inschrijving</a>
    @else
    <h3>De alumniverantwoordelijke hebben nog geen inschrijvingsformulier gemaakt.</h3>
    @endif


    @endif

</div>
@include('admin.activiteiten.modal')
@endsection
@section('script_after')
<script>
    $(function(){

            Alumni.footer(0,0)
            Alumni.footer(3,3)
            Alumni.summary()

            loadTable();
            $('#activiteiten-verantwoordelijke').on('click', '.btn-delete', function(){
                let id = $(this).closest('td').data('id');
                let activiteitnaam = $(this).closest('td').data('activiteitnaam');
                let startuur = $(this).closest('td').data('startuur');
                let einduur = $(this).closest('td').data('einduur');
                let lokaal = $(this).closest('td').data('lokaal');
                let evenement = $(this).closest('td').data('evenement');
                let text = `<p>Activiteit <b>${activiteitnaam}</b> verwijderen?</p>`
                let type = 'warning';
                let btnText = 'Verwijder activiteit';
                let btnClass ='btn-success';
                let modal = new Noty({
                    timeout: false,
                    layout: 'center',
                    modal: true,
                    type: type,
                    text: text,
                    buttons: [
                        Noty.button(btnText, `btn ${btnClass}`, function () {
                            // Delete genre and close modal
                            deleteActiviteit(id);
                            modal.close();
                        }),
                        Noty.button('Terug', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        })
                    ]
                }).show();
            })

            $('#activiteiten-verantwoordelijke').on('click', '.btn-edit', function () {
                let id = $(this).closest('td').data('id');
                let activiteitnaam = $(this).closest('td').data('activiteitnaam');
                let startuur = $(this).closest('td').data('startuur');
                let einduur = $(this).closest('td').data('einduur');
                let lokaal = $(this).closest('td').data('lokaal');
                let evenement = $(this).closest('td').data('evenement');

                $('.modal-title').text(`${activiteitnaam} wijzigen`)
                $('#modal-activiteit').modal('show')
                $('form').attr('action', `/admin/activiteiten/${id}`)
                $('input[name="_method"]').val('put')
                $('#naam').val(activiteitnaam)
                $('#startuur').val(startuur)
                $('#einduur').val(einduur)
                $('#lokaal').val(lokaal)
                $('#evenement').val(evenement);

            });
            $('#modal-activiteit form').submit(function(e){
                // Don't submit the form
                e.preventDefault();
                // Get the action property (the URL to submit)
                let action = $(this).attr('action');
                // Serialize the form and send it as a parameter with the post
                let pars = $(this).serialize();
                // Post the data to the URL
                $.post(action, pars, 'json')
                    .done((data)=> {
                        console.log(data);
                        // Noty success message
                        new Noty({
                            type: data.type,
                            text: data.text
                        }).show();
                        // Hide the modal
                        $('#modal-activiteit').modal('hide');
                        // Rebuild the table
                        loadTable();
                    })
                    .fail(function (e) {
                        let msg = '<ul>';
                        $.each(e.responseJSON.errors, function (key, value) {
                            msg += `<li>${value}</li>`;
                        });
                        msg += '</ul>';
                        // Noty the errors
                        new Noty({
                            type: 'error',
                            text: msg
                        }).show();
                    })
            })

            $('thead').on('click', '.btn-add', function(){
                $.getJSON('/activiteiten/qryActiviteiten').done( ()=>{
                    let evenement = g_data.filter( d => d.evenementnaam == $('#evenementnaam').text())
                    $('#evenement').val(evenement[0].id);
                    $('.modal-title').text(`Activiteit toevoegen`)
                    $('#modal-activiteit').modal('show')
                    $('form').attr('action', `/admin/activiteiten`)
                    $('input[name="_method"]').val('post')
                })
            })
        })

        function deleteActiviteit(id){
            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete'
            };
            $.post(`/admin/activiteiten/${id}`, pars, 'json').done(
                (data)=>{
                    new Noty({
                        type: data.type,
                        text: data.text
                    }).show();
                    loadTable();
                }
            )
        }
        let g_data;
        function loadTable(){
            $.getJSON('/activiteiten/qryActiviteiten').done(
                function(data){

                    let evenement = data.filter( d => d.evenementnaam == $('#evenementnaam').text())
                    g_data = data
                    $('#activiteiten-verantwoordelijke').empty()
                    $('#activiteiten-docenten').empty()
                            evenement[0].activiteiten.forEach(value => {
                                let tr = `
                            <tr>
                                <td>${value.activiteitnaam}</td>
                                <td>${value.startuur} - ${value.einduur}</td>
                                <td>${value.lokaal}</td>
                                <td data-id="${value.id}"
                                data-activiteitnaam="${value.activiteitnaam}"
                                data-startuur="${value.startuur}"
                                data-einduur="${value.einduur}"
                                data-lokaal="${value.lokaal}"
                                data-evenement="${evenement[0].id}"
                                ">
                                    <div class="btn-group btn-group-sm">
                                        <a data-toggle="tooltip" title="${value.activiteitnaam} wijzigen" href="#!" class="btn btn-edit text-success  btn-outline-success">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a data-toggle="tooltip" title="${value.activiteitnaam} verwijderen" href="#!" class="btn btn-delete text-danger  btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        `
                                $('#activiteiten-verantwoordelijke').append(tr);

                                tr = `
                            <tr>
                                <td>${value.activiteitnaam}</td>
                                <td>${value.startuur} - ${value.einduur}</td>
                                <td>${value.lokaal}</td>
                            </tr>
                        `
                                $('#activiteiten-docenten').append(tr);

                            });
                        }).fail((error)=>console.error(error));
        }

</script>
<style>
    .textinput {
        background: none;
        color: inherit;
        border: none;
        padding: 0;
        font: inherit;

        outline: inherit;
    }
</style>

@endsection
