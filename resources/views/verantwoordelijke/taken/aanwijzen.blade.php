@extends('layouts.template')

@section('title', 'Docent aanwijzen')

@section('main')
    <div class="container">
        <div class='form-group'>
            <h1>Docent aanwijzen voor de taak {{$taak->naam}} </h1>
            <form action="/docenttaken2" method="post" id="taakform">
                @csrf
                <div class="row">
                    <?php
                    use App\Docenttaak;use App\User;
                    $ar = [];
                    $non = [];
                    $ids = [];
                    $docenten = User::get();
                    $docenttaken = Docenttaak::get();
                    foreach($docenttaken as $docenttaak){
                        if($docenttaak->taak_id == $taak->id){
                            if($docenttaak->aangewezen){
                                array_push($ar,$docenttaak->docent->name);
                                array_push($ids,$docenttaak->docent->id);
                            }

                        }
                    }
                    foreach($docenten as $docent){

                        if(in_array($docent->id,$ids)){

                        }
                        else{
                            if($docent->actief){
                                array_push($non,$docent->id);
                            }

                        }
                    }

                    ?>
                    <div class="col col-sm-12 ">
                        <h2>huidige aangewezen docent(en):</h2>
                        <?php

                        if(count($ids) == 0){
                            echo "<p>Er zijn momenteel geen docenten aangewezen</p>";

                        }else{
                            foreach($ids as $iq){
                                $doc = User::find($iq);
                                echo"<p>$doc->name</p>";
                            };
                        }

                        ?>
                    </div>



                </div>
                <div class="row">
                    <div class="col col-sm-12 ">
                        <label for="Docentnaam">Selecteer een docent </label>
                        <select name="docentnaam" id="docentnaam" class="form-control @error('docentnaam') is-invalid @enderror" >
                            <?php
                            foreach($non as $docid){
                                $docnaam = User::find($docid);
                                echo "<option value='$docid'>$docnaam->name</option>";
                            }

                            ?>
                                @error('docentnaam')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-sm-12">
                        <input type="text" name="taakid" id="taakid"

                                 value="{{ old('taakid', $taak->id) }}" hidden>
                        <br>
                        <button type="submit" class="btn btn-success">Docent aanwijzen</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
@section('script_after')
<script>
    $(function(){
        Alumni.footer(3,0);
        // Alumni.summary()
    });
</script>
@endsection
@section('css_after')

@endsection
