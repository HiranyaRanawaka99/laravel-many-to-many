@extends('layouts.app')

@section('content')


<div class="container mt-5">
    <a class="btn btn-primary my-3" href="{{ route('admin.projects.index') }}">Torna ai progetti</a>

    <h1> {{ $project->title }} </h1>

    <div class="row g-5 mt-4">
        <div class="col-4">
            <img src="{{ asset('/storage/' . $project->cover_image) }}" class="img-fluid" alt="" width= "100%">
        </div>

        <div class="col-8">  
            <div class="row">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> 
                        <b> Categoria: </b> {!! $project->getCategoryBadge() !!} 
                    </li>
                    <li class="list-group-item">
                        <b> Tecnologie : </b>  
                        {!! $project->getTechnologyBadge() !!} 
                        </li>
                    {{-- <li class="list-group-item">
                        <b> Tecnologie: </b> 
                        @forelse ($project->technologies as $technology)
                        {{ $technology->label }} @unless($loop->last) , @else . @endunless
                    @empty
                        Nessun technology associato
                        @endforelse
                    </li> --}}
                    <li class="list-group-item">
                        <b> Descrizione: </b>  {{ $project->description }}
                    </li>
                    <li class="list-group-item">
                        <b> Link: </b> {{ $project->link}}
                    </li>
                    <li class="list-group-item">
                        <b> Data di pubblicazione: </b>  {{ $project->date }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection