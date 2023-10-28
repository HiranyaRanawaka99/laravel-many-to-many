<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpadateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * return array<string, mixed>
     */
        public function rules()
        {
            //il titolo dev'essere unico però escludimi id per saltarmi la stessa riga di modifica altrimenti se volessi tenermi lo stesso titolo non riesce a salvarmelo - lo faccio tramite incatenazione della stringa oppure attraverso importazione di rule
            return [
                'title' => ['required','string'],

                //METODO 2 - importare rule - scrivere ciò per fare in modo che ignori l'id
                // Rule::unique('projects')->ignore($this->project->id),

                'description' => ['required','string'],
                'date' => ['required','date'],
                'link' => ['required','url'],
                'type_id' => [ 'nullable', 'exists:types,id'],
        
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

                'type_id.exists' => 'Fai una scelta'
            ];

        }
    }
