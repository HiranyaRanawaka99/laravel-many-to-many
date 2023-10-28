<?php

//PER FARE VALIDAZIONE
// php artisan make:request StoreNomeRequest

//ogni form va validato con una richiesta 


namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //METODO 1
        // solo l'utente loggato che può fare la richiesta per creare un nuovo progetto = true = AUTORIZZIAMO LA RICHIESTA
        return true;

        //METODO 2
        //ci torna un booleano: true se l'utente è loggato altrimenti false
        // return Auth::check();

        //METODO 3
        // Se l'id dell'utente è = 1 può fare questa richiesta
        // return Auth::id() == 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required','string'],
            'description' => ['required','string'],
            'date' => ['required','date'],
            'link' => ['required','url'],
            'type_id' => ['nullable', 'exists:types,id'],
        ];
    }

    public function messages() {
        return [
            'title.required'=> 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.unique' => 'Esiste un progetto con lo stesso titolo',

            'description.required' => 'La descrizione è obbligatoria',
            'description.string' => 'La descrizione dev\'essere una stringa',

            'date.required' => 'La data di pubblicazione è obbligatoria',
            'date.date' => 'La data dev\'essere in formato giorno/mese/anno',

            'link.required' => 'Il link del progetto è obbligatorio',
            'link.url' => 'Inserire un formato url',

            'type_id.exists' => 'Fai una scelta tra le opzioni date'
        ];
    }
}
