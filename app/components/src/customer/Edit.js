import React, { Component } from 'react';
import axios from "axios" 
export default class Edit extends Component {
  
  constructor(){
    super()
    this.state = {
      id:0,
      fieldName:"",
      fieldEmail:"",
      fieldPhone:"",
      fieldAddress:""
    }
  }
  
  componentDidMount()
  {
    let userId = this.props.match.params.id;
    axios.get("http://localhost:8080/api/customer/get/"+userId)
    .then(response=>{
      const res = response.data
      if (res.success) {
        console.log("Customer ");
        console.log(res.data);
        this.setState({
          id: res.data.id,
          fieldName:res.data.name,
          fieldEmail:res.data.email,
          fieldAddress:res.data.address,
          fieldPhone:res.data.phone
        })
      }
    })
    .catch(error=>{
      alert("Error ==>"+error)
    })
  }
  onClickUpdate()
  {
    const id = this.state.id
    const baseUrl = "http://localhost:8080/api/customer/update/"+id

    const datapost = {
      name: this.state.fieldName,
      email: this.state.fieldEmail,
      phone: this.state.fieldPhone,
      address: this.state.fieldAddress
    }
 
    axios.put(baseUrl,datapost)
    .then(response=>{
      alert(response.data.message)
    })
    .catch(error=>{
      alert("Error 500 "+error)
    })
  }
  render() {
    // for get params id from url route
    let userId = this.props.match.params.id;
    return (
      <div>
        <h4>Edit customer {userId} </h4>
      <hr/>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Name customer {this.state.fieldName}</label>
            <input type="text" class="form-control" placeholder="Name"
              value={this.state.fieldName}
              onChange={(value)=>this.setState({fieldName:value.target.value})}/>
          </div>
        </div>

				<div class="row">
          <div class="col-md-6 mb-3">
						<label for="email">Email</label>
	          <input type="email" class="form-control" placeholder="you@example.com"
            value={this.state.fieldEmail}
            onChange={(value)=>this.setState({fieldEmail:value.target.value})}/>
          </div>
        </div>

				<div class="row">
          <div class="col-md-6 mb-3">
						<label for="address">Address</label>
	          <input type="text" class="form-control" placeholder="1234 Main St"
            value={this.state.fieldAddress}
            onChange={(value)=>this.setState({fieldAddress:value.target.value})}/>
          </div>
        </div>

				<div class="row">
          <div class="col-md-6 mb-3">
						<label for="phone">Phone </label>
	          <input type="text" class="form-control" placeholder="123467890"
            value={this.state.fieldPhone}
            onChange={(value)=>this.setState({fieldPhone:value.target.value})}/>
          </div>
        </div>

				<div class="row">
					<div class="col-md-6 mb-3">
		      	<button onClick={()=>this.onClickUpdate()} class="btn btn-primary btn-block" type="submit">Save</button>
            
          </div>
				</div>
      </div>
    )
  }
}