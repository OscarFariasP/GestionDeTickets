import React, { Component } from 'react';
import ReactDOM from 'react-dom';


export default class UserComponent extends Component {

    constructor(props){
        super(props)

        this.state = {
            nombre:'',
            tickets:[],
            ticket_pedido:'',
        }
        
        this.adquirir = this.adquirir.bind(this);
        
    }
    
    async componentDidMount(){


        try {
            let response = await fetch('http://127.0.0.1:8000/api/fetchTickets')
            let data = await response.json()
            this.setState({tickets:data})
            console.log(data);
        } catch (error) {
            console.log("Error get ticket info",error)
            
        }
        

 
 

    }

    async adquirir(id)
    {

                // ADQUIRIR TICKET
                let userid = document.getElementById('user').value;
                try {

                    //let token = document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value;
                    let config = {
                        method:'PUT',
                        headers:{
                            //'X-CSRF-TOKEN': token,
                            //'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body:JSON.stringify({id:id,userid:userid})
                    }
                    console.log(config)
                     let response = await fetch('http://127.0.0.1:8000/api/adquirirTicket',config)
                     let data = await response.json()                     
                     this.setState({tickets:data})          
             } catch (error) {
                     console.log("ErrorAdquirir",error)
                  
             }
    }



    render(){
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-5">
                    <div className="card">
                        <div className="card-header"> User Panel</div>
                        <div className="card-body">                                                                                                                                  
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
                                        this.state.tickets && this.state.tickets.map(value =>{
                                            
                                            if (value.nombre==="no asignado")
                                            {
                                                return (<tr key={value.id}>                                            
                                                    <td>{value.ticket_pedido}</td>   
                                                    <td>{value.nombre}</td>                                                                         
                                                    <td>
                                                    <div className="input-group-prepend">
                                                    <button type="button" className="btn btn-primary btn-sm"
                                                    onClick={()=>this.adquirir(value.id)}>  
                                                      Adquirir                                              
                                                    </button>                                            
                                                    </div>
                                                    </td> 
                                                </tr>)
                                            }
                                            else
                                            {
                                                return (<tr key={value.id}>                                            
                                                    <td>{value.ticket_pedido}</td>   
                                                    <td>{value.nombre}</td>                                                                         
                                                    <td>
                                                    <div className="input-group-prepend">
                                                    <p>No disponible</p>                                          
                                                    </div>
                                                    </td> 
                                                </tr>)
                                            }



                                       })
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



if (document.getElementById('UserComponent')) {
    ReactDOM.render(<UserComponent />, document.getElementById('UserComponent'));
}
