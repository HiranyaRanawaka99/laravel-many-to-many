<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "date",
        "link",
        "type_id",
        "technologies[]",
    ];
        
    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function getCategoryBadge() { 
        return $this->type ? "<span class='badge' style= 'background-color: {$this->type->color}'> {$this->type->tag} </span>": "Non categorizzato" ;
    }
    public function technologies() {
        return $this->belongsToMany(Technology::class);
    }

    public function getTechnologyBadge()
    {
        $tecnology_badges = '';
        foreach ($this->technologies as $technology) {
            if( $this->technologies) {
                $tecnology_badges .= "<span class='badge' style= 'background-color: {$technology->color}'> {$technology->label} </span>";
            } else {
                $tecnology_badges .= "<span> Non ci sono tecnologie associate </span> ";
            }
        }

        return $tecnology_badges;
        }

    
}
