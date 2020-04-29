<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket'; 
    public $timestamps = false; // Deshabilitar timestamps
    protected $fillable = [
        'id_user','ticket_pedido'
    ];
}
