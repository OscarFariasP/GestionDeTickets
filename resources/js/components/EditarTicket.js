import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { browserHistory } from 'react-router';


export default class EditarTicket extends Component {

    constructor(props){
        super(props)

        this.state = {
            id:0,
            ticket_pedido:'',
            redirect:false,
        
        }
        this.handleOnChange = this.handleOnChange.bind(this);
        this.editar = this.editar.bind(this);
    }
    

    handleOnChange(event)
    {
        this.setState({ticket_pedido:event.target.value});
    }

    async editar(e){
        e.preventDefault();
        // EDIT TICKET
        try {
            let config = {
                method:'PUT',
                headers:{
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body:JSON.stringify({id:this.state.id,ticket_pedido:this.state.ticket_pedido})
            }
                let response = await fetch('http://127.0.0.1:8000/api/editarTicket',config)
                document.getElementById('goBack').click();
        } catch (error) {
                console.log("ErrorEdit",error)
            
        }


    }


    async componentDidMount(){
     
        let id = document.getElementById('Ticketid').value;
       
        // GET TICKET DATA
        try {
            let config = {
                method:'POST',
                headers:{
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body:JSON.stringify({id:id})
            }            
            let response = await fetch('http://127.0.0.1:8000/api/getTicket',config)
            let data = await response.json()        
            this.setState({id:data.id,ticket_pedido:data.ticket_pedido})

        } catch (error) {
            console.log("Error GET TICKET",error)
            
        }

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
                                <label  className="col-form-label text-md-right">Editar:</label>
                                <div className="col-md-5">
                                    <input id="ticketName" type="text" className="form-control"
                                        value={this.state.ticket_pedido}
                                        onChange = {this.handleOnChange}
                                        name="ticketName"/>                                    
                                </div>
                                <button className="btn btn-primary" onClick={this.editar} >Editar</button>                        
                                <a id="goBack" type="hidden" href="/home"></a>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
    }
}   



if (document.getElementById('EditarTicket')) {
    ReactDOM.render(<EditarTicket />, document.getElementById('EditarTicket'));
}
