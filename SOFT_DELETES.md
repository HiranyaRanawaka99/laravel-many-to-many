# SOFT DELETES

### Le softDelete aggiunge una colonna in cui è indicato il quando una riga è stata eliminata.

---

1. Abbiamo tabella posts, per aggiungere la soft delete diamo il comando

-   oppure scriviamo direttamente nella tabella posts $table->softDelete()

```
php artisan make:migration add_soft_deletes_to_posts_table
```

---

2. Nella pagina add_soft ...

```php
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');

        $table->dropSoftDelete();
            }
};
```

---

3. Comando per fare il migrate

```
php artisan make:migration
```

---

4. Traits = metodi e propeirtà utilizzata da più classi.

Pagina Model Post

```php
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
   ...
}

```

---

5. Nelle rotte web.php aggiunagiamo tre rotte per gestire il cestinare, perchè nel nostro ProjectController abbiamo usato tutte le nostre 7 rotte

```php

  //Mettere prima l'index di trash e poi ::resources del Project - problema show= laravel cerca le corrispondenze esatte e non va più avanti
  //per vedere una lista dei progetti eliminati
  //pagina trash, metodo trash, nome. project.trash.index
    Route::get('projects/trash' , [ProjectController::class, 'trash'])->name('projects.trash.index');
  //per modificare una riga del database
    Route::patch('projects/trash/{project}/restore' , [ProjectController::class, 'restore'])->name('projects.trash.restore');
    //per eliminare definitivamente
    Route::delete('projects/trash/{project}' , [ProjectController::class, 'forceDestroy'])->name('projects.trash.force-destroy');

    - 'projects/trash/{project}/force-delete'
    - force-destroy non dobbiamo specificarlo nel url perchè laravel non lo usa

```

---

6. Nel projectController creiamo le funzioni

```php
    public function trash() {
        $projects = Project::orderByDesc('id')->onlyTrashed()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

```

-   Fare lo scaffolding che contiene trash/index.blade e scrivere cose

---

7. Eliminazione definitiva:

```php
public function forceDestroy(int $id) {

        $deletedProject = Project::onlyTrashed()->findOrFail($id);
        $deletedProject->technologies()->detach();
        $deletedProject->forceDelete();
        return redirect()->route('admin.projects.trash.index', $deletedProject);

    }
```

---

8. Restore

```php
//Su trash.index creao una modal
          <a href="Javascritpt:void(0)" data-bs-toggle="modal" data-bs-target="#restore-modal-{{$project->id}}" class="mx-1">
            <i class="fa-solid fa-arrow-yurn-up text-danger"></i>
        </a>

  public function restore(int $id) {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('admin.projects.trash.index');

    }

```
