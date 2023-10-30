@extends('layouts.app')

@section('content')


<div class="container mt-5">
    <a class="btn btn-primary my-3" href="{{ route('admin.projects.index') }}">Torna alla lista progetti</a>
    <a class="btn btn-primary my-3" href="{{ route('admin.projects.show', $project) }}">Torna al progetto</a>

    <h1> Titolo </h1>

    @if($errors->any())
    <div class="alert alert-danger">
        Correggi i seguenti errori:
        <ul>
            @foreach($errors->all() as $error)
            <li> {{ $error}} </li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="row"> 
        @method("PATCH")
        @csrf

        <div class="col-12"> 
            <label for="title" class="form-label"></label>
            <input type="text" name="title" id="title" class="form-control @error('title')is-invalid @enderror" value=" {{  old('title') ?? $project->title}} ">
            @error('title')
            <div class="invalid-feedback">
                {{$message }}
            </div>
            @enderror
        </div> 
        <div class="col-12"> 
            <label for="description" class="form-label">Descrizione</label>
            <textarea name="description" id="description"  class="form-control" rows="5" > {{ old('description') ?? $project->description }}</textarea>
        </div>
        <div class="col-12 my-3">
            <label for="type_id" class="form-label"> Categoria</label>
            <select class="form-select @error('type_id')is-invalid @enderror" name="type_id" id="type_id" >
                <option value="" >Non valido</option>
                <option value="">Non categorizzato</option>
                @foreach($types as $type)
                <option value=" {{ $type->id }}" @if (old('type_id') ?? $project->type_id == $type->id ) selected @endif> {{ $type->tag }} </option>
                @endforeach
            </select>
            @error('type_id')
            <div class="invalid-feedback">
                {{$message }}
            </div>
            @enderror
        </div>

        <div 
        class="col-12 my-3 form-check 
        @error('technologies')is-invalid @enderror">
        <p>Scegli le tecnologie usate nel tuo progetto</p>
            @foreach($technologies as $technology)
            <input 
            type="checkbox" 
            name="technologies[]" 
            id="technology-{{ $technology->id}}"
            value ="{{ $technology->id}}"
            class="form-check-control" 
            {{-- controlla se id è nell'old oppure nell'array dei tag a cui il progetto è già associato --}}
            @if (in_array($technology->id, old('technologies', $technology_ids)))checked @endif>
            <label for="technology-{{$technology->id}}" class="me-3"> 
                {{$technology->label }}
            </label>
            @endforeach
        </div>
        @error('technologies')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror




        <div class="col-12"> 
            <label for="link" class="form-label " value= "{{ old('link') ?? $project->link }}">Link</label>
            <input type="url" name="link" id="link" class="form-control @error('link')is-invalid @enderror">
            @error('link')
            <div class="invalid-feedback">
                {{$message }}
            </div>
            @enderror
        </div> 
        <div class="col-12"> 
            <label for="date" class="form-label " value="{{ old('date') ?? $project->date }}"> Data di pubblicazione</label>
            <input type="date" name="date" id="date" class="form-control @error('date')is-invalid @enderror">
            @error('date')
            <div class="invalid-feedback">
                {{$message }}
            </div>
            @enderror
        </div> 

        <div class="col-12 my-2">
            <button class="btn btn-success">Salva</button>
        </div>
        

    </form>



</div>
@endsection