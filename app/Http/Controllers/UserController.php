<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use Auth;
class UserController extends Controller
{
    

    public function __construct()
    {
    
    }

    public function fetchUser(){
        $user = User::find(1);
        return response()->json([
            'nombre' => $user->nombre,
            'email' =>$user->email
        ]);    
    }
    public function fetchTickets(){
        $tickets = Ticket::all();

    
        $TicketsArray = $tickets->toArray();
        $newTickets = [];
        foreach ($TicketsArray as $t)
        {
            $AssignedName = 'no asignado';
            if ($t['id_user']!==null)
            {
                $user = User::find($t['id_user']);
                $AssignedName = $user->nombre;
            }
            
            array_push($newTickets,[
                "id" => $t['id'],
                "nombre" => $AssignedName,
                "ticket_pedido" => $t['ticket_pedido']
            ]);

        }

        return response()->json($newTickets);    
    }
    public function postTicket()
    {
       $t = Ticket::create([
            'id_user'  => null,
            'ticket_pedido' => request()->ticket_pedido
        ]);

        $ticket = [
            'id' => $t->id,
            'nombre' => 'no asignado',
            'ticket_pedido' => $t->ticket_pedido,
        ];
    
       return response()->json($ticket);  

    }
    public function eliminarTicket()
    {        
       $t = Ticket::find(request()->id);
       $t->delete();
       return self::fetchTickets();
    }
    public function getTicket()
    {
        $t = Ticket::find(request()->id);

        $AssignedName = 'no asignado';
        if ($t->id_user!==null)
        {
            $user = User::find($t->id_user);
            $AssignedName = $user->nombre;
        }
        $ticket = [
            'id' => $t->id,
            'nombre' => $AssignedName,
            'ticket_pedido' => $t->ticket_pedido,
        ];
        return response()->json($ticket);  
    }
    public function editarTicket()
    {
        $t = Ticket::find(request()->id);
        $t->ticket_pedido = request()->ticket_pedido;
        $t->save();
        return response()->json($t);  
    }
    public function adquirirTicket(){
        
        $t = Ticket::find(request()->id);
        $t->id_user =request()->userid;
        $t->save();
        return self::fetchTickets();
    }
}
