@extends('layouts.master')

@section("contenu")
<!-- Banner -->
<section id="banner">
    <div class="inner">
        <div class="logo"><span class="icon fa-gem"></span></div>
        <h2>OFFICIAL WEBSITE OF IA</h2>
        <p>Vous en apprendrez plus ici sur l'intelligence artificielle</a></p>
    </div>
</section>

<!-- Wrapper -->
<section id="wrapper">

    <!-- One -->
    <section id="one" class="wrapper spotlight style1">
        <div class="inner">
            <a href="#" class="image"><img src="https://img-0.journaldunet.com/l5h0IJsPPhaGMQWC746oYR8iezU=/1500x/smart/7db1b6a690284d1f88d1aa2a51211653/ccmcms-jdn/19590868.jpg" alt="" /></a>
            <div class="content">
                <h2 class="major">C'est quoi une IA ?</h2>
                <p> L'intelligence artificielle (IA, ou AI en anglais pour Artificial Intelligence) consiste à mettre en œuvre un certain nombre de techniques visant à permettre aux machines d'imiter une forme d'intelligence réelle. L'IA se retrouve implémentée dans un nombre grandissant de domaines d'application.</p>
                
            </div>
        </div>
    </section>

  
    <!-- Four -->
    <section id="four" class="wrapper alt style1">
        <div class="inner">
            <h2 class="major">Les articles en vogue</h2>
            <p>Découvrez tout de suite quels sont les articles qui ont été le plus appréciés par le grand public</p>
            <section class="features">
                @for ($i = 0; $i<count($contenus);$i++)
                    <article>
                        <a href="{{ route('moreInfo', ['idContenu' => $contenus[$i]->id, 'title' => Str::slug($contenus[$i]->titre)]) }}" class="image">

                            @if($contenus[$i]->images)
                                @if (filter_var($contenus[$i]->images, FILTER_VALIDATE_URL))
                                <img src="{{ $contenus[$i]->images }}" alt="" /></a>
                                @else
                                <img src="{{ asset('storage/' . $contenus[$i]->images) }}" alt="" /></a>
                                @endif
                            @endif
                        
                        <h3 class="major">{{ $contenus[$i]->titre }}</h3>
                        <p>{{ $contenus[$i]->description }}</p>
                        <a href="{{ route('moreInfo', ['idContenu' => $contenus[$i]->id, 'title' => Str::slug($contenus[$i]->titre)]) }}" class="special">
                            Learn more</a>
                    </article>
                @endfor
                
            </section>
            <ul class="actions">
                <li><a href="#" class="button">Browse All</a></li>
            </ul>
        </div>
    </section>

</section>
@endsection