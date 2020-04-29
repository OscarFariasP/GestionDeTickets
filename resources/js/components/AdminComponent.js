import React, { Component } from 'react';
import ReactDOM from 'react-dom';


export default class AdminComponent extends Component {

    constructor(props){
        super(props)

        this.state = {
            nombre:'',
            tickets:[],
            ticket_pedido:'',
            selectedUser:0,
            users:[],
            


        }
        this.createTicket = this.createTicket.bind(this);
        this.handleOnChange = this.handleOnChange.bind(this);
        this.eliminarTicket = this.eliminarTicket.bind(this);
        this.handleSelectOnChange = this.handleSelectOnChange.bind(this);
    }
    async createTicket(e)
    {
        e.preventDefault();
        // POST TICKET
         try {
               let config = {
                   method:'POST',
                   headers:{
                       'Accept': 'application/json',
                       'Content-Type': 'application/json'
                   },
                   body:JSON.stringify({ticket_pedido:this.state.ticket_pedido,
                                        id_user:this.state.selectedUser })
               }
               //console.log(config)
                let response = await fetch('http://127.0.0.1:8000/api/postTicket',config)
                let data = await response.json()
                this.setState({tickets:this.state.tickets.concat(data)})
        } catch (error) {
                console.log("ErrorPost",error)    
        }
    }

    async eliminarTicket(id)
    {
        
        
        // DELETE TICKET
         try {
               let config = {
                   method:'DELETE',
                   headers:{
                       'Accept': 'application/json',
                       'Content-Type': 'application/json'
                   },
                   body:JSON.stringify({id:id})
               }
               console.log(config)
                let response = await fetch('http://127.0.0.1:8000/api/eliminarTicket',config)
                let data = await response.json()
                console.log("aftert delete")
                console.log(data)
                this.setState({tickets:data})          
        } catch (error) {
                console.log("ErrorDelete",error)
             
        }
    }

    async componentDidMount(){

        // GET MY USER DATA
        try {
            let response = await fetch('http://127.0.0.1:8000/api/fetchUser')
            let data = await response.json()
            this.setState({nombre:data.nombre})
        } catch (error) {
            console.log("Error",error)
            
        }
        // GET TICKETS INFO,

        try {
            let response = await fetch('http://127.0.0.1:8000/api/fetchTickets')
            let data = await response.json()
            this.setState({tickets:data})
         //   console.log(data);
        } catch (error) {
            console.log("Error get ticket info",error)
            
        }
        // GET ALL USERS

        try {
            let response = await fetch('http://127.0.0.1:8000/api/fetchAllUsers')
            let data = await response.json()
            this.setState({users:data})
            //console.log(data);
        } catch (error) {
            console.log("Error get all users info",error)
            
        }        
        

    }

    handleOnChange(event)
    {
        this.setState({ticket_pedido:event.target.value});
    }
    handleSelectOnChange(event)
    {
        this.setState({selectedUser:event.target.value});
        //console.log(event.target.value);
    }


    render(){
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-5">
                    <div className="card">
                        <div className="card-header">Bienvenido {this.state.nombre} - Admin Panel</div>
                        <div className="card-body">                                                                                                                                  
                            <div className="form-group row">
                                <label  className="col-form-label text-md-right">Crear un Ticket:</label>
                                <div className="col-md-5">
                                    <input id="ticketName" type="text" className="form-control"
                                        value={this.state.ticket_pedido}
                                        onChange = {this.handleOnChange}
                                        name="ticketName"/>                                 
                                </div>                               
                            </div>     
                            <div className="form-group row">
                                <label  className="col-form-label text-md-right">Lista Usuarios:</label>
                                <div className="col-md-5">
                                    <select name="userList" onChange={this.handleSelectOnChange} className="form-control">
                                        <option value="0">no asignado</option>
                                        {
                                            this.state.users && this.state.users.map(item=>(
                                            <option value={item.id} key={item.id} >{item.nombre}</option>
                                            ))
                                        }
                                    </select>                                  
                                </div>
                                <button className="btn btn-primary" onClick={this.createTicket} >Crear</button>                        
                            </div>  

                            <div className="form-group">
                                <label>Lista de tickets</label>
                                 <table className ="form-group table">                                 
                                    <tbody>
                                        <tr>
                                            <td><b>Ticket Pedido</b></td>
                                            <td><b>Usuario</b></td>
                                            <td><b>Accion</b></td>
                                        </tr>    
                                        {
                                        this.state.tickets && this.state.tickets.map(value => 
                                        (<tr key={value.id}>                                            
                                            <td>{value.ticket_pedido}</td>   
                                            <td>{value.nombre}</td>                                                                         
                                            <td>
                                            <div className="input-group-prepend">
                                            <button type="button" className="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown">                                                
                                            </button>
                                            <ul className="dropdown-menu">
                                                <li className="dropdown-item"><a href={"/editarTicket/"+value.id} >Editar</a></li>
                                                <li className="dropdown-item"><a href="#" onClick={()=>this.eliminarTicket(value.id)} >Eliminar</a></li>                                                                                             
                                            </ul>
                                            </div>
                                            </td> 
                                        </tr>))
                                        }                                                                    
                                     
                                    </tbody>                                    
                                 </table> 
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
    }
}   



if (document.getElementById('AdminComponent')) {
    ReactDOM.render(<AdminComponent />, document.getElementById('AdminComponent'));
}
