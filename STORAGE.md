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

2.
