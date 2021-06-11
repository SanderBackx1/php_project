@extends('layouts.template')

@section('title', 'Mail')

@section('main')
@include('shared.summary', ['title'=>'Mail', 'msg'=>"Hier kan u een mail opstellen met behulp van filters. Indien u meer vragen hebt kan u onderaan op de knop '?' klikken."])
<h1>Mail versturen</h1>
<div class="filter">
    <div class='row'>
        <label class='col-sm' for='name'>Naam</label>
        <input class='col-sm' name='name' />
    </div>
    <div class='row'>
        <label class='col-sm' for='mail'>E-mailadres</label>
        <input class='col-sm' name='mail' />
    </div>
    <div class='filtersection'>
    </div>
    <div class='row'><a data-toggle="tooltip" title="Alle filters verwijderen" class='btn btn-success' id='deleteAll'>Verwijder alle filters</a></div>
    <div class='row'><a data-toggle="tooltip" title="Venster filters wijzigen openen" class='btn btn-success' id='fltChange'>Wijzig filters</a></div>
</div>
<div class="row">
    <div class="col-sm filterbox filterbox-lg" id='alumniNotSelected'>

    </div>
    <div class='col-sm' id="alumniButtons">
        <p><a data-toggle="tooltip" title="Geselecteerde alumni toevoegen" id='add' class='btn btn-success'>></a></p>
        <p><a data-toggle="tooltip" title="Alle alumni toevoegen" id='addAll' class='btn btn-success'>>></a></p>
        <p><a data-toggle="tooltip" title="Geselecteerde alumni verwijderen" id='removeAll' class='btn btn-danger'><<</a></p>
        <p><a data-toggle="tooltip" title="Alle alumni verwijderen" id='remove' class='btn btn-danger'><</a></p>
    </div>
    <div class=" col-sm filterbox filterbox-lg" id=alumniSelected>

    </div>
</div>
<div class="form-group">
    <label for="email">Alumni</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="emails" required value="">
</div>
<div class="form-group">
    <label for="subject">Onderwerp</label>
    <input name="subject" id="subject" class="form-control" placeholder="onderwerp" required></input>
</div>
<div class="form-group">
    <label for="message">Bericht</label>
    <textarea name="message" id="message" rows="5" class="form-control" placeholder="bericht" required
        minlength="10"></textarea>
</div>
<p><a data-toggle="tooltip" title="Open mailprogramma met ingevulde velden" class="btn btn-success" id='sendMail'>Bericht verzenden</a></p>
<p><a href="/mail/help" data-toggle="tooltip" title="Helpvenster openen" class="btn btn-success">?</a></p>

@include('mail.modal')
@endsection
@section('css_after')
<style>

</style>
@endsection
@section('script_after')
<script defer>
    $(async function(){
        Alumni.footer(0,1);
        Alumni.summary();
        // (function(){
        //     //Sander: 0
        //     //Brent: 1
        //     //Jens: 2
        //     //Brecht: 3
        //     $('.footerItem')[0].append(' (O) ')
        //     $('.footerItem')[1].append(' (T) ')
        // }())

        //Init variables
        let selectedFilters = [];
        let notSelectedFilters = [];
        let toSelectFilters = [];
        let toRemoveFilters = [];
        const evenementen = await $.getJSON('/mail/qryFilters')

        let filteredEvenementen = evenementen;
        let filters = []
        let questions = []
        let answers = []
        let  alumni = getAlumni();
        let selectedAlumni = [];
        let notSelectedAlumni = alumni.map(a => {
            return `${a.voornaam} ${a.achternaam}; ${a.mail}`
        });
        let filteredAlumni = [];
        let toSelectAlumni = [];
        let toRemoveAlumni = [];
        initFilters();
        alumniHTML();

        //FILTERS
        $('#eventSelect').on('change', function(){
            if($(this).val() == -1){
                filteredEvenementen = evenementen;
            }else{
                filteredEvenementen = evenementen.filter( e => e.opleiding_id == $(this).val());
            }
            updateSelectbox();
        })

        $('#filterButtons .btn').click(function(){
            switch($(this).attr('id')){
                case 'add':
                    updateFilters('add');
                    break;
                case 'addAll':
                    updateFilters('add', true);
                break;
                case 'remove':
                        updateFilters('remove');
                    break;
                default:
                        updateFilters('remove', true);
                break;
            }

        })

        $('#fltChange').on('click', showFilter)

        $('#deleteAll').on('click', ()=>{
            updateFilters('remove', true)
            })

        function selectComponent(){
            let html = `<option value='-1'>Allen</option>`;
            evenementen.forEach(e =>{
                html+=`<option value='${e.opleiding_id}'>${e.evenementnaam}</option>`
            })
            return html;
        }

        function filterComponent(element){
            let html = `<div><p class='filterItem'>${element}</p></div>`
            return html;
        }

        function loadEventListeners(){
            $('.filterItem').click(function(){
                if($(this).hasClass('selected')){
                    $(this).removeClass('selected')
                    if($(this).parents('#filtersNotSelectedForm').length>0){
                        toSelectFilters = toSelectFilters.filter( f => f!=$(this).text());
                    }else{
                        toRemoveFilters = toRemoveFilters.filter( f => f!=$(this).text());
                    }
                }else{
                    $(this).addClass('selected')
                    if($(this).parents('#filtersNotSelectedForm').length>0){
                        toSelectFilters.push($(this).text());
                    }else{
                        toRemoveFilters.push($(this).text());
                    }
                }
            })
            $('.filter input').on('input', function(){
                let temp = alumni;
                $('.filter input').each((i,filter)=>{
                    const patt = new RegExp($(filter).val())
                    if($(filter).attr('name') == 'name'){
                        temp = temp.filter(alumnus => {
                            const naam = `${alumnus.voornaam} ${alumnus.achternaam}`;
                            return patt.test(naam);
                        });
                    }else if($(filter).attr('name') == 'mail'){
                        temp = temp.filter(alumnus => {
                        const mail = `${alumnus.mail}`;

                        return patt.test(mail);})
                    }else{
                        const question = questions.find(q => q.inhoud==$(filter).attr('name'));
                        let answers = question.antwoorden;
                        let alumniIQ = [];
                        answers = answers.filter(answer =>patt.test(answer.inhoud))
                        answers.forEach(answer => answer.alumnusantwoord.forEach( aa => alumniIQ = alumniIQ.concat(aa.alumnusaanwezigheid)
                        ))
                        temp = temp.filter(alumni => alumniIQ.find(a => a.id == alumni.id))
                    }
                });
                notSelectedAlumni = temp.map(alumni => `${alumni.voornaam} ${alumni.achternaam}; ${alumni.mail}`)
                notSelectedAlumni = notSelectedAlumni.filter(nsa  => selectedAlumni.indexOf(nsa)<0);
                updateAlumniHTML();
            })
        }

        function initFilters(){
            filteredEvenementen.forEach(element => {
                filters = filters.concat(element.vragen);
            });
            let html = '';
            filters.forEach(filter => {
                notSelectedFilters.push(filter.inhoud);
                html += filterComponent(filter.inhoud);
            })
            $('#eventSelect').append(selectComponent());
            $('#filtersNotSelectedForm').append(html);
            loadEventListeners();
        }

        function updateFilters(direction,moveAll=false){
            if(direction == 'add'){
                if(moveAll){
                    let allQuestions = [];
                    filteredEvenementen.forEach(evenement =>{
                        allQuestions = allQuestions.concat(evenement.vragen.map(v=>v.inhoud))
                    })
                    selectedFilters = allQuestions;
                    notSelectedFilters = [];
                }else{
                    notSelectedFilters = notSelectedFilters.filter( f => toSelectFilters.indexOf(f)<0)
                    selectedFilters = selectedFilters.concat(toSelectFilters);
                }
            }
            else{
                if(moveAll){
                    let allQuestions = [];
                    filteredEvenementen.forEach(evenement =>{
                        allQuestions = allQuestions.concat(evenement.vragen.map(v=>v.inhoud))
                    })
                    selectedFilters = [];
                    notSelectedFilters = allQuestions;
                }else{
                    selectedFilters = selectedFilters.filter( f => toRemoveFilters.indexOf(f)<0)
                    notSelectedFilters = notSelectedFilters.concat(toRemoveFilters);
                }
            }
            toSelectFilters = [];
            toRemoveAlumni =[];
            alumni = getAlumni();
            updateFilterHTML();
            updateAlumniFiltered();
            updateAlumniHTML();
        }

        function updateSelectbox(){
            let allQuestions = [];
            filteredEvenementen.forEach(evenement =>{
                allQuestions = allQuestions.concat(evenement.vragen.map(v=>v.inhoud))
            })
            toSelectFilters = [];
            toRemoveFilters = [];
            selectedFilters = [];
            notSelectedFilters = allQuestions;
            updateFilterHTML();
        }

        function updateFilterHTML(){
            let selectHtml = '';
            let notSelectHtml = '';
            let sectionHtml = '';
            selectedFilters.forEach( f => selectHtml += filterComponent(f))
            selectedFilters.forEach( f => sectionHtml += filterInputComponent(f))
            notSelectedFilters.forEach( f => notSelectHtml += filterComponent(f))


            $('.filtersection').empty();
            $('.filtersection').append(sectionHtml);
            $('#filtersSelectedForm').empty();
            $('#filtersNotSelectedForm').empty();
            $('#filtersSelectedForm').append(selectHtml);
            $('#filtersNotSelectedForm').append(notSelectHtml);
            loadEventListeners();
        }

        function showFilter(){
            $('#modal-mail').modal('show')

        }

        function filterInputComponent(filter){
            return `<div class='row'><label class='col-sm' for='${filter}'>${filter}</label><input class='col-sm' name='${filter}'/></div>`
        }


        //ALUMNI
        $('#alumniButtons .btn').click(function(){
            switch($(this).attr('id')){
                case 'add':
                    updateAlumni('add');
                    break;
                case 'addAll':
                    updateAlumni('add', true);
                    break;
                case 'remove':
                    updateAlumni('remove');
                    break;
                default:
                    updateAlumni('remove', true);
                break;
            }

        })
        function updateAlumni(direction,moveAll=false){
            if(direction == 'add'){
                if(moveAll){
                    selectedAlumni = selectedAlumni.concat(notSelectedAlumni);
                    notSelectedAlumni = [];
                }else{
                    notSelectedAlumni = notSelectedAlumni.filter( f => toSelectAlumni.indexOf(f)<0)
                    selectedAlumni = selectedAlumni.concat(toSelectAlumni);
                }
            }
            else{
                if(moveAll){
                    notSelectedAlumni = notSelectedAlumni.concat(selectedAlumni);
                    selectedAlumni = [];

                }else{
                    selectedAlumni = selectedAlumni.filter( f => toRemoveAlumni.indexOf(f)<0)
                    notSelectedAlumni = notSelectedAlumni.concat(toRemoveAlumni);
                }
            }
            toSelectAlumni = [];
            toRemoveAlumni = [];
            updateAlumniHTML()
        }
        function updateAlumniFiltered(){
            notSelectedAlumni =alumni.map(a => {
                 return `${a.voornaam} ${a.achternaam}; ${a.mail}`
                });;
            selectedAlumni = [];
            toSelectAlumni = [];
            toRemoveAlumni = [];
        }
        function getAlumni(){
            questions = [];
            filteredEvenementen.forEach(evenement => {
                    questions = questions.concat(evenement.vragen);
            })

            if(selectedFilters.length>0){
                questions = questions.filter(q => selectedFilters.indexOf(q.inhoud )>=0);
            }

            answers = [];
            questions.forEach(q => {
                    answers = answers.concat(q.antwoorden)
            })
            let temp = []
            answers.forEach(a => {
                a.alumnusantwoord.forEach(aa=>{
                    temp = temp.concat(aa.alumnusaanwezigheid)
                })
            })
            temp = temp.filter((alumni, index, self)=> self.findIndex(t => t.id == alumni.id) == index)
            return temp;
        }

        function loadAlumniEvenetListeners(){
            $('.alumnusItem').click(function(){
                if($(this).hasClass('selected')){
                    $(this).removeClass('selected')
                    if($(this).parents('#alumniNotSelected').length>0){
                        toSelectAlumni = toSelectAlumni.filter( f => f!=$(this).text());
                    }else{
                        toRemoveAlumni = toRemoveAlumni.filter( f => f!=$(this).text());
                    }
                }else{
                    $(this).addClass('selected')
                    if($(this).parents('#alumniNotSelected').length>0){
                        toSelectAlumni.push($(this).text());
                    }else{
                        toRemoveAlumni.push($(this).text());
                    }
                }
            })
        }

        function alumnusComponent(alumnus){
            let html = `<p class='alumnusItem'>${alumnus}</p>`
            return html;
        }

        function alumniHTML(){
            let html = '';
            notSelectedAlumni.forEach(alumnus => {
                html+=alumnusComponent(alumnus);
            })
            $('#alumniNotSelected').append(html);
            loadAlumniEvenetListeners();
        }
        function fillMailadresses(){
            const mailadresses = selectedAlumni.map(alumni => alumni.split(';')[1]);
            $('#email').val(mailadresses.join('; '));
        }
        function updateAlumniHTML(){
            let selectHtml = '';
            let notSelectHtml = '';

            selectedAlumni.forEach( f => selectHtml += alumnusComponent(f))
            notSelectedAlumni.forEach( f => notSelectHtml += alumnusComponent(f))

            $('#alumniSelected').empty();
            $('#alumniNotSelected').empty();
            $('#alumniSelected').append(selectHtml);
            $('#alumniNotSelected').append(notSelectHtml);
            fillMailadresses();
            loadAlumniEvenetListeners();
        }
        $('#sendMail').on('click', function(){
            let emails = $('#email').val().split(';');
            emails = emails.map(mail => mail.trim());
            emails = emails.join(',')
            const body = $('#message').val();
            const subject = $('#subject').val();
            $(this).attr('href', `mailto:${emails}?subject=${subject}&body=${body}`)
        })
    }())
</script>
@endsection
