@extends('layouts.template')

@section('title', 'Activiteiten')

@section('main')
@include('shared.summary', ['title'=>'Activiteiten', 'msg'=>"Op deze pagina kan u activiteiten bekijken, toevoegen, wijzigen en verwijderen."])
<div class="container">
    <h2>Activiteiten</h2>
    <div class='table-responsive'>
        <div>
            <form>
                <select id='evenementselect'>
                    <option>Allen</option>
                </select>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope='col'><a class='btn btn-add btn-outline-success text-success'><i class="fas fa-plus"></i> Nieuwe activiteit</a></th>
                    <th scope='col'>Evenement</th>
                    <th scope='col'>Activiteit</th>
                    <th scope='col'>Tijdstip</th>
                    <th scope='col'>Lokaal</th>
                </tr>
            </thead>
            <tbody>
                <td colspan="5">
                    <div class="spinner-border text-success" role="status">
                    </div>
                <td>
            </tbody>
        </table>
    </div>
</div>
@include('admin.activiteiten.modal')
@endsection
@section('script_after')
<script>


    $(function(){
        loadSelectBox();
        loadTable();

        Alumni.footer(0,3)
        Alumni.summary()


        $('tbody').on('click', '.btn-delete', function(){
            let id = $(this).closest('td').data('id');
            let activiteitnaam = $(this).closest('td').data('activiteitnaam');
            let startuur = $(this).closest('td').data('startuur');
            let einduur = $(this).closest('td').data('einduur');
            let lokaal = $(this).closest('td').data('lokaal');

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

        $('tbody').on('click', '.btn-edit', function () {
            let id = $(this).closest('td').data('id');
            let activiteitnaam = $(this).closest('td').data('activiteitnaam');
            let startuur = $(this).closest('td').data('startuur');
            let einduur = $(this).closest('td').data('einduur');
            let lokaal = $(this).closest('td').data('lokaal');
            let evenement = $(this).closest('td').data('evenement');
            let evnementId = $(this.closes('td').data('evenementid');

            $('.modal-title').text(`${activiteitnaam} wijzigen`)
            $('#modal-activiteit').modal('show')
            $('form').attr('action', `/admin/activiteiten/${id}`)
            $('input[name="_method"]').val('put')
            $('#naam').val(activiteitnaam)
            $('#startuur').val(startuur)
            $('#einduur').val(einduur)
            $('#lokaal').val(lokaal)
            $('#evenselect').append(
                    `<option value='${evenement}'>${evenement}</option>`)

        });
        $('#modal-activiteit form').submit(function (e) {
            // Don't submit the form
                    e.preventDefault();
            // Get the action property (the URL to submit)
            let action = $(this).attr('action');
            // Serialize the form and send it as a parameter with the post
            let pars = $(this).serialize();

            // Post the data to the URL
            $.post(action, pars, 'json')
                .done((data)=> {
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

            $.getJSON('activiteiten/qryActiviteiten').done(
            function(data){
                $('#evenselect').empty()
                $.each(data, (key,evenement)=>{
                    $('#evenselect').append(
                    `<option value='${evenement.id}'>${evenement.evenementnaam}</option>`)
                })
            }).done( ()=>{
                $('.modal-title').text(`Activiteit toevoegen`)
                $('#modal-activiteit').modal('show')
                $('form').attr('action', `/admin/activiteiten`)
                $('input[name="_method"]').val('post')
            })
        })

        $('#evenementselect').change(()=>loadTable())
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
    function loadSelectBox(){
        $.getJSON('/admin/activiteiten/qryActiviteiten').done(
            function(data){
                $('#evenementselect').empty()
                $('#evenementselect').append(`<option value='-1'>Allen</option>`)
                $.each(data, (key,evenement)=>{
                    $('#evenementselect').append(
                    `<option value='${evenement.id}'>${evenement.evenementnaam}</option>`)
                })
            })
    }
    function loadTable(){
        $.getJSON('/admin/activiteiten/qryActiviteiten').done(
            function(data){
                $('tbody').empty()
                $.each(data, (key,evenement)=>{
                    let selected = $("#evenementselect option").filter(":selected").val();
                    if(selected == -1 || selected == evenement.id){
                        evenement.activiteiten.forEach(value => {
                            let tr = `
                            <tr>
                                <td data-id="${value.id}"
                                data-activiteitnaam="${value.activiteitnaam}"
                                data-startuur="${value.startuur}"
                                data-einduur="${value.einduur}"
                                data-lokaal="${value.lokaal}"
                                data-evenement="${evenement.evenementnaam}"
                                data-evenementid="${evenement.id}"
                                ">
                                    <div class="btn-grou btn-group-sm">
                                        <a href="#!" class="btn btn-edit text-success">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#!" class="btn btn-delete text-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>${evenement.evenementnaam}</td>
                                <td>${value.activiteitnaam}</td>
                                <td>${value.startuur} - ${value.einduur}</td>
                                <td>${value.lokaal}</td>
                            </tr>
                        `
                        $('tbody').append(tr);
                        });
                    }
               })
            }).fail((error)=>console.error(error));
    }
</script>
@endsection
