<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use App\TipoUser;
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
    public function fetchAllUsers(){


        $rolToList = 'Usuario'; // listar por el tipo de usuario
        $rol_id = TipoUser::where('nombre',$rolToList)->first()->id;
        $users = User::where('id_tipouser',$rol_id)->get();
        $allUsers = $users->toArray();
        return response()->json($allUsers);
        //dd();
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
        $id_assigned = null;
        $name = 'no asignado';
       if (request()->id_user>0)
       {
            $id_assigned = request()->id_user;
            $name = User::find(request()->id_user)->nombre;
       }
           




       $t = Ticket::create([
            'id_user'  => $id_assigned,
            'ticket_pedido' => request()->ticket_pedido
        ]);

        $ticket = [
            'id' => $t->id,
            'nombre' => $name,
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
