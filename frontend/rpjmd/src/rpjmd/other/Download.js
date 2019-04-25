import React, { Component } from 'react';
import { FormText, Alert, FormGroup, Label, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';

import config from '../../config';


class Download extends Component {
  
  constructor(props) {
    super(props);


    this.state = {
      loading:false,
    }


  }

  getTahun = ()=>{
    console.log(this.props);  
    if(this.props.rka){
      
      // return(
      //   <div>
      //     <Input type="hidden" name="tahun" value={this.props.tahun}/>
      //     <Input type="hidden" name="perumusan_program_id" value={this.props.perumusan_program_id}/>
      //   </div>
      // );
    }
    return(
      <div>
        <Input type="hidden" name="tahun" value={this.props.tahun}/>
        <Input type="hidden" name="perumusan_program_id" value={this.props.perumusan_program_id}/>
      </div>
    );
  }


  render() {

    return (
      <div className="animated fadeIn">
        <Row>
            <Col xs="128" md="10">
            <Row>
              <Col xs="18" md="3">
                <Form method="post" action={config.apiRoot+this.props.link+'/save/pdf'}>
                  <Input type="hidden" name="session" value={localStorage.getItem('codexv-session')}/>
                  <Input type="hidden" name="rpjmd" value={localStorage.getItem('codexv-rpjmd')}/>
                  <Input type="hidden" name="search" value={this.state.pencarian}/>
                  {this.getTahun()}
                  <Button color="" style={{backgroundColor: '#d61515', color: '#fff'}}>PDF</Button>
                </Form>
              </Col>
              <Col xs="18" md="3">
                <Form method="post" action={config.apiRoot+this.props.link+'/save/excel'}>
                  <Input type="hidden" name="session" value={localStorage.getItem('codexv-session')}/>
                  <Input type="hidden" name="rpjmd" value={localStorage.getItem('codexv-rpjmd')}/>
                  <Input type="hidden" name="search" value={this.state.pencarian}/>
                  {this.getTahun()}
                  <Button color="" style={{backgroundColor: '#23bc3a', color: '#fff'}} >Excel</Button>
                </Form>
              </Col>
            </Row>
            
            </Col>
          </Row> 
      </div>

    );
    
  }
}

export default Download;
