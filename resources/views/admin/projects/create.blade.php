@extends('layouts.app')

@section('content')


<div class="container mt-5">

    <h1> Crea il tuo progetto </h1>

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

    <form method="POST" action="{{ route('admin.projects.store') }}" class="row"> 
        @csrf

        <div class="col-12 my-3"> 
            <label for="title" class="form-label " value={{ old('title') }}>Titolo</label>
            <input type="text" name="title" id="title" class="form-control @error('title')is-invalid @enderror">
            @error('title')
            <div class="invalid-feedback">
                {{$message }}
            </div>
            @enderror
        </div> 
        <div class="col-12 my-3">
            <label for="type_id" class="form-label"> Categoria</label>
            <select class="form-select @error('type_id')is-invalid @enderror" name="type_id" id="type_id" >
                <option value="">Non categorizzato</option>
                @foreach($types as $type)
                <option value=" {{ $type->id }}"> {{ $type->tag }} </option>
                @endforeach
            </select>
            @error('type_id')
            <div class="invalid-feedback">
                {{$message }}
            </div>
            @enderror
        </div>

        <div class="col-12 my-3">
            <div class="row">
                <div class="col-2">

                    @foreach($technologies as $tecnology)
                    <input type="checkbox" name="technologies[]" id="technologies" id="technologies-{{ $technology->id}}"value="{{ $technology>id}}"  >
                    <label for="technologies">HTML</label>
                    @endforeach
                    
                </div>
            </div>
        </div>




        <div class="col-12 my-3"> 
            <label for="description" class="form-label">Descrizione</label>
            <textarea name="description" id="description" rows="5"  class="form-control @error('title')is-invalid @enderror"> {{ old('description') }} </textarea>
            @error('description')
            <div class="invalid-feedback">
                {{$message }}
            </div>
            @enderror
        </div> 
        <div class="col-12 my-3"> 
            <label for="link" class="form-label " value= "{{ old('link')}}" >Link</label>
            <input type="url" name="link" id="link" class="form-control @error('link')is-invalid @enderror">
            @error('link')
            <div class="invalid-feedback">
                {{$message }}
            </div>
            @enderror
        </div> 
        <div class="col-12 my-3"> 
            <label for="date" class="form-label " value="{{ old('date') }}"> Data di pubblicazione</label>
            <input type="date" name="date" id="date" class="form-control @error('date')is-invalid @enderror">
            @error('date')
            <div class="invalid-feedback">
                {{$message }}
            </div>
            @enderror
        </div> 

        <div class="col-12 my-4">
            <button class="btn btn-success">Salva</button>
            <a class="btn btn-primary my-3" href="{{ route('admin.projects.index') }}">Torna alla lista progetti</a>
        </div>
        

    </form>



</div>
@endsection