import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Example extends Component {

    constructor(props){
        super(props)

        this.state = {
            nombre:'',
            email:''
        }

    }



    async componentDidMount(){

        try {
            let response = await fetch('http://127.0.0.1:8000/api/fetchUser')
            let data = await response.json()
            this.setState({nombre:data.nombre})
        } catch (error) {
            console.log("Error",error)
            
        }

    }

    render(){
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>
                            
                        <div className="card-body">Nombre: {this.state.nombre} </div>
                    </div>
                </div>
            </div>
        </div>
    );
    }
}   



if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
