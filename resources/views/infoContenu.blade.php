@extends('layouts.master')

@section('contenu')
    <!-- Wrapper -->
    <section id="wrapper">
        <header>
            <div class="inner">
                <h2>{{ $contenu->titre }}</h2>
                <p>ECRIT PAR {{$contenu->nom}} {{$contenu->prenom}}</p>
            </div>
        </header>

        <!-- Content -->
        <div class="wrapper">
            <div class="inner">

                <h6 class="major grand-titre" style="font-size: 14px;">{{ $contenu->description }}</h6>
                <p> {!! $contenu->texte !!} </p>
                
                <section class="features">
                    <article>
                        <a href="#" class="image"><img src="images/pic04.jpg" alt="" /></a>
                        <h3 class="major">Date de parution de l'article</h3>
                        <p>{{ \Carbon\Carbon::parse($contenu->dateparution)->isoFormat('DD MMMM YYYY') }}</p>

                        
                    </article>
                   
                </section>
             
               
            </div>
        </div>

    </section>
@endsection
