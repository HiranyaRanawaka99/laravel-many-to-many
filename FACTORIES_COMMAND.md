# FACTORIES COMMAND

La factories ci da a disposizione dei metodi per essere invocate da codice.
Tutti i modelli hanno HasFactory di default.

---

1. comando:

```
php artisan make:factory ProjectFactory

```

---

2. Insegnamo al projetto come dev'essere , quali elementi deve contenere

```php
public function definition()

    {
        $type_ids = Type::all()->pluck('id');
        $type_ids[] = null;

        $title = fake()->catchPhares();
        $type_id = fake()->randomElement($type_ids);
        $description = fake()->paragraph(2, true);
        $link =fake()->url();
        $date= fake()->dateTime();

        return [
            'title'=> $title,
            'type_id'  => $type_id,
            'description' => $description,
            'link' => $link,
            'date' => $date,
        ];
    }

```

Facciamo questa operazione per tutti i seeder

---

3. Sul seeder invece di scrivere elementi uno alla volta per generare una motitudine di progetti scriveremo;

```php
 $projects = Project::factory()->count(100)->create();

```

-   questo codice è disponibile in tutti i file purchè importiamo il modello Project
