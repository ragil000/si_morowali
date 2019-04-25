import React, { Component } from 'react';
import { FormText, FormGroup, Label, Input, Badge, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';


class Tables extends Component {
  
  constructor(props) {
    super(props);
    this.state = {
      dataAll: [],
      modal: false,
      modalDelete: false,
      dataPilih: [],
      pencarian: '',
      fileForm: [],
    }

    this.toggle = this.toggle.bind(this);
    this.toggleDelete = this.toggleDelete.bind(this);
  }

  handleFileChange = event => {
    this.setState({ fileForm: event.target.files[0]});
  }

  handlePencarianChange = event => {
    this.setState({ pencarian: event.target.value});
  }

  handleCariSubmit = event => {
    event.preventDefault();
    console.log(this.state.pencarian);
    // const user = {
    //   file: this.state.fileForm,
    // };
    // const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    // let data = new FormData();
    // data.append('file', user.file);
    // axios
    // .post(config.apiRoot+'index.php/welcome/upload', data, head)
    // .then(function (response) {
    //   console.log(response);
    // })
    // .catch(function (error) {
    //   console.log(error);
    // });
  }

  handleSubmit = event => {
    event.preventDefault();
    
    const user = {
      file: this.state.fileForm,
    };
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('file', user.file);
    axios
    .post(config.apiRoot+'index.php/welcome/upload', data, head)
    .then(function (response) {
      console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  toggle(e = []) {
    this.setState({
      modal: !this.state.modal,
      dataPilih: e
    });
  }
  toggleDelete(e = []) {
    this.setState({
      modalDelete: !this.state.modalDelete,
      dataPilih: e
    });
  }

  componentWillMount = () => {
    this.getData();
  }

  setData = (dataAll) => {
    if(dataAll.status){
      this.setState({ dataAll: dataAll.data });
    }
    console.log(this.state.dataAll);
  }

  getData = () => {
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    axios
    .post(config.apiRoot+'index.php/welcome/getData', data)
    .then(response => this.setData(response.data))
    .catch(function (error) {
      console.log(error);
    });
  }

  render() {
    
    return (
      <div className="animated fadeIn">
        <Row>

          <Col xs="12" lg="12">
            <Card>
              <CardHeader>
                <i className="fa fa-align-justify"></i> Striped Table
              </CardHeader>
              <CardBody>
                
                <Modal isOpen={this.state.modal} toggle={this.toggle} className={'modal-lg ' + this.props.className}>
                  <ModalHeader toggle={this.toggle}>Edit Data</ModalHeader>
                  <Form method="post"  onSubmit={this.handleSubmit} className="form-horizontal">
                    <ModalBody>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Text Input</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="text-input" name="text-input" placeholder="Text" />
                          <FormText color="muted">This is a help text</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="date-input">Date Input <Badge>NEW</Badge></Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="date" id="date-input" name="date-input" placeholder="date" />
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="file-input">File input</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="file" onChange={this.handleFileChange} id="file-input" name="file-input" />
                        </Col>
                      </FormGroup>
                    </ModalBody>
                    <ModalFooter>
                      <Button color="primary" >Edit Data</Button>
                      <Button color="secondary" onClick={this.toggle}>Cancel</Button>
                    </ModalFooter>
                  </Form>
                </Modal>
                
                <Modal isOpen={this.state.modalDelete} toggle={this.toggleDelete} className={ this.props.className}>
                  <ModalHeader toggle={this.toggleDelete}>Hapus Data</ModalHeader>
                  <ModalBody>
                    Apakah Anda Yakin Menghapus Data {this.state.dataPilih.nama}?
                  </ModalBody>
                  <ModalFooter>
                    <Button color="danger" onClick={this.toggleDelete}>Ya</Button>{' '}
                    <Button color="secondary" onClick={this.toggleDelete}>Batal</Button>
                  </ModalFooter>
                </Modal>
                <Form method="post" onSubmit={this.handleCariSubmit} className="form-horizontal">
                  <FormGroup row>
                    <Col xs="12" md="3">
                      <Input type="text" onChange={this.handlePencarianChange} id="text-input-pencarian" name="pencarian" placeholder="Pencarian" />
                    </Col>
                    <Button color="primary" >Cari</Button>
                  </FormGroup>
                </Form>
                <Table responsive striped>
                  <thead>
                  <tr>
                    <th>Username</th>
                    <th>Date registered</th>
                    <th>Role</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  {this.state.dataAll.map((data, key) => {
                    return data ? (
                      <tr key={key}>
                        <td>{data.nama}</td>
                        <td>{data.nim}</td>
                        <td>{data.umur}</td>
                        <td>
                          <Button color="info" onClick={() => this.toggle(data)} className="mr-1">Edit</Button>|
                          <Button color="danger" onClick={() => this.toggleDelete(data)} className="mr-1">Delete</Button>
                        </td>
                      </tr>
                    ) : (null);
                  })}
                  </tbody>
                </Table>
                <Pagination>
                  <PaginationItem disabled><PaginationLink previous tag="button">Prev</PaginationLink></PaginationItem>
                  <PaginationItem active>
                    <PaginationLink tag="button">1</PaginationLink>
                  </PaginationItem>
                  <PaginationItem><PaginationLink tag="button">2</PaginationLink></PaginationItem>
                  <PaginationItem><PaginationLink tag="button">3</PaginationLink></PaginationItem>
                  <PaginationItem><PaginationLink tag="button">4</PaginationLink></PaginationItem>
                  <PaginationItem><PaginationLink next tag="button">Next</PaginationLink></PaginationItem>
                </Pagination>
              </CardBody>
            </Card>
          </Col>
        </Row>
      </div>

    );
  }
}

export default Tables;
