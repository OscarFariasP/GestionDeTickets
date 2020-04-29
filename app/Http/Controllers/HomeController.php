<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use Auth;
use UserController;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
      //  return view('adminIndex');    
      Auth::user()->authorizeRoles(['Administrador', 'Usuario']);

        if (auth()->user()->getRol->nombre==="Administrador")
        {
            return view('adminIndex');    
        }
        else {
            $id = auth()->user()->id;
            return view('userIndex',compact('id'));
        }

      

    }
    public function editarTicket($id)
    {
        Auth::user()->authorizeRoles(['Administrador']);
        return view('editarTicket',compact('id'));
    }
    public function test(){
        
        $id= request()->user()->id;
        dd($id);
    }
    public function adquirirTicket(){
        Auth::user()->authorizeRoles(['Administrador']);
        $t = Ticket::find(request()->id);
        $t->id_user =request()->user()->id;
        $t->save();
        return UserController::fetchTickets();
    }

}
