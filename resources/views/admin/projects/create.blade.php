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

    <form method="POST" action="{{ route('admin.projects.store') }}" class="row" enctype="multipart/form-data"> 
        @csrf

        <div class="col-12 my-3"> 
            <label for="cover_image" class="form-label ">Immagine di copertina </label>
            <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image')is-invalid @enderror" value="{{ old('cover_image') }}">
            @error('cover_image')
            <div class="invalid-feedback">
                {{$message }}
            </div>
            @enderror
        </div> 
        <div class="col-4">
            <img src="" class="img-fluid" id="cover_image_preview">
          </div>



        <div class="col-12 my-3"> 
            <label for="title" class="form-label ">Titolo</label>
            <input type="text" name="title" id="title" class="form-control @error('title')is-invalid @enderror" value="{{ old('title') }}">
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

        <div 
        class="col-12 my-3 form-check 
        @error('technologies')is-invalid @enderror">
            <p> Scegli le tecnologie usate nel tuo progetto</p>

            @foreach($technologies as $technology)

            <input 
            type="checkbox" 
            name="technologies[]" 
            id="technology-{{ $technology->id}}"
            value ="{{ $technology->id}}"
            class="form-check-control" 
            @if (in_array($technology->id, old('technologies') ?? [] )) checked @endif>
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
            <label for="link" class="form-label ">Link</label>
            <input type="url" name="link" id="link" value= "{{ old('link')}}"  class="form-control @error('link')is-invalid @enderror">
            @error('link')
            <div class="invalid-feedback">
                {{$message }}
            </div>
            @enderror
        </div> 
        <div class="col-12 my-3"> 
            <label for="date" class="form-label"> Data di pubblicazione</label>
            <input type="date" name="date" id="date" value="{{ old('date') }}" class="form-control @error('date')is-invalid @enderror">
            @error('date')
            <div class="invalid-feedback">
                {{$message }}
            </div>
            @enderror
        </div> 

        <div class="col-12 my-4">
            <button type="submit" class="btn btn-success">Salva</button>
            <a class="btn btn-primary my-3" href="{{ route('admin.projects.index') }}">Torna alla lista progetti</a>
        </div>
        

    </form>



</div>
@endsection

@section('scripts')
<script type="text/javascript">
const inputFileElement = document.getElementById('cover_image');
const coverImagePreview = document.getElementById('cover_image_preview');

if (!coverImagePreview.getAttribute('src')) {
      coverImagePreview.src = "https://placehold.co/400";
    }

    inputFileElement.addEventListener('change', function() {
      const [file] = this.files;
      coverImagePreview.src = URL.createObjectURL(file);
    })