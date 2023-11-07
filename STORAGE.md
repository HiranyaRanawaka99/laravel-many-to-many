# STORAGE

1. Caricheremo i nostri file nella cartella storage/app/public

---

2.  Laravel si occuperà di tutto, ciò che dobbiamo fare è impostare il filesystem disk di default a "public".

        - Controlliamo se nel nostro file .env è presente la chiave

    FILESYSTEM_DISK: se è così, impostiamo il valore public.

---

3. Abbiamo due cartelle: app/public e storage/app/public
    - Entrambe hanno un'uscita web perchè ci sarà un collegamento: un simlink per stampare e leggere correttamente il file system. Si fa con il comando

```
        php artisan storage:link

```

-   Il file è un collegamento alla cartella public/storage/public

---

#### Cover image

1. Aggiungiamo una copertina ai nostri progetti

    - php artisan make:migration add_cover_image_to_projects_table
    - scrivere dentro le funzioni up e down e fare la migration

```php
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
        $table->string('cover_image')
        ->nullable()
        ->after('date');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('cover_image');
        });
    }

```

---

2. Sulla pagina admin/projects/create scriviamo:

    - sul form: enctype="multipart/form-data"

```html
<form
    method="POST"
    action="{{ route('admin.projects.store') }}"
    class="row"
    enctype="multipart/form-data"
>
    @csrf
    <div class="col-12 my-3">
        <label for="cover_image" class="form-label "
            >Inserisci l'immagine di copertina
        </label>
        <input
            type="file"
            name="cover_image"
            id=""
            class="form-control value={{ old('cover_image') }} @error('cover_image')is-invalid @enderror"
        />
        @error('cover_image')
        <div class="invalid-feedback">{{$message }}</div>
        @enderror
    </div>
</form>
```

---

3. Validiamo l'immagine su Request/StoreProhectRequest

```php

  public function rules()
    {
        return [
        'cover_image' => 'image',
        ]


    }

```

---

4. Nel nostro controller usiamo la funzione Storge::put() per caricare un file nella cartella storage/app/pubblic
    - Storage = la funzione mi restituisce a un return che mi da il path dell'immagine che posso salvare nel db
    - put = metto l'immagine nel..
    - img_path = il percorso per pescare l'immagine
    - Per salvare l'immagine in un disco diverso da quello di default usiamo il metodo Storage::disk('nome')

```php
 public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $project = new Project();
        $project->fill($data);

        //gestisco l'immagine
        Storage::put('cartella_in_cui_caricare', $data['cover-image']);
        $project->cover_image = $cover_image_path;

        //oppure
         $project->cover_image = Storage::put('cartella_in_cui_caricare', $data['cover-image']);

         $project->save();
    }

```

Nel Projects:

-   Se nell'array $data esiste cover_image, carica nellla cartella cover_image
-   Salva l'immagine nella varibile
-   Salva nello store.

```php

 //gestisco l'immagine
    if(Arr::exists($data, 'cover_image')) {
    $cover_img_path = Storage::put("uploads/projects/{$project->id}/cover_image", $data['cover_image']);
    $project->cover_image = $cover_img_path;
    $project->save();
    }
```

---

5. Mostriamo l'immagine a schermo su show

```html
<div class="col-4">
    <img
        src="{{ asset('/storage/' .   $project->cover_image) }}"
        class="imag-fluid"
        alt=""
        width="100%"
    />
</div>
```

---

6. Cancelliamo la foto prima di eliminare il progetto in toto

```php
 public function forceDestroy(int $id) {

        $project = Project::onlyTrashed()->findOrFail($id);
        $project->technologies()->detach();
        if($project->cover_image) {
            Storage::delete($project->cover_image);
        }
        $project->forceDelete();

        return redirect()->route('admin.projects.trash.index', $project);

    }
```

---

7. Modifichiamo edit

-   Aggiungere l'input file all'edit
-   Aggiornare UpdateRequest con i dati per l'immagine
-   Nella funzione update: se c'è un'immagine cancellala e aggiungi la nuova che l'utente sceglie

```php

 if (Arr::exists($data, 'cover_image')) {
    if($project->cover_image) {
        Storage::delete(''. $project->cover_image);
    }
    $cover_image_path = Storage::put("uploads/projects/{$project->id}/cover_image", $data['cover_image']);
    $project->cover_image = $cover_image_path;
}
```

opure uso hasFile al posto di Arr::exists

```php

 if($request->hasFile('cover_image')) {
    $cover_img_path = Storage::put("uploads/projects/{$project->id}/cover_image", $data['cover_image']);
    $project->cover_image = $cover_img_path;
    }
```
