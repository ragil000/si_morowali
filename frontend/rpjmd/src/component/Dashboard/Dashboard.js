import React, { Component } from 'react';
import { FormGroup, Label, Input, Modal, ModalHeader, ModalBody, ModalFooter, Button, Card, CardBody, Col, Row, } from 'reactstrap';
// import { AppSwitch } from '@coreui/react'
// import axios from 'axios';
// import config from '../../config';
// import loadingImage from '../../assets/img/loading.gif';

class Dashboard extends Component {
  constructor(props) {
    super(props);

    this.state = {
      collapse: true,
      fadeIn: true,
      timeout: 300,
      setPeriodeModal: false,
      rpjmd: 0,
    };

    //modal
    this.setPeriodeModal = this.setPeriodeModal.bind(this);
    this.getRpjmd = this.getRpjmd.bind(this);
    
    //.modal

  }

  // handleChange
  handleRpjmdChange(id){
    this.setState({ rpjmd: id});
  }
  // .handleChange

  //MODAL
  setPeriodeModal() {
    this.setState({
      setPeriodeModal: !this.state.setPeriodeModal,
    });
    
  }
  //.MODAL

  // getRpjmd
  getRpjmd = (event) => {
    //page = this.state.page;
    let no = event.target.attributes.getNamedItem('data-number').value;
    localStorage.setItem("codexv-rpjmd", no);
    window.location.reload();
  }

  // .getRpjmd

  render() {
    return (
      <div className="animated fadeIn">
        <Card>
          <CardBody>
            <h5>Selamat Datang Kabupaten Morowali di Sistem Informasi Penyusunan Dokumen RPJMD dan Renstra PD</h5>
            <i>Mohon Pilih Periode Terlebih Dahulu</i>
            <Modal isOpen={this.state.setPeriodeModal} toggle={this.setPeriodeModal} className={this.props.className}>
              <ModalHeader toggle={this.setPeriodeModal}>Periode - Edit Data</ModalHeader>
              <ModalBody>
              <FormGroup row>
                  <Col md="3">
                    <Label htmlFor="select">Periode Dari</Label>
                  </Col>
                  <Col xs="12" md="9">
                    <Input type="text" name="periode_dari" id="periode_dari"/>
                  </Col>
                </FormGroup>
                <hr/>
                <FormGroup row>
                  <Col md="3">
                    <Label htmlFor="select">Periode Sampai</Label>
                  </Col>
                  <Col xs="12" md="9">
                    <Input type="text" name="periode_sampai" id="periode_sampai"/>
                  </Col>
                </FormGroup>
                <hr/>
                <FormGroup row>
                  <Col md="3">
                    <Label htmlFor="select">Status</Label>
                  </Col>
                  <Col xs="12" md="9">
                    <Input type="radio" name="status" value={true} /> Aktif<br/>
                    <Input type="radio" name="status" value={false}/> Tidak Aktif
                  </Col>
                </FormGroup>
                <hr/>
              </ModalBody>
              <ModalFooter>
                <Button color="primary" onClick={this.setPeriodeModal}>Simpan</Button>{' '}
                <Button color="secondary" onClick={this.setPeriodeModal}>Cancel</Button>
              </ModalFooter>
            </Modal>
          </CardBody>
        </Card>
        <Row>
          <Col xs="12" sm="6" md="3">
            <Card className="text-white bg-primary text-center">
              <CardBody>
                <Row>
              <Col xs="10" sm="9" md="8">
                <blockquote className="card-bodyquote">
                  <h1>Periode RPJMD</h1>
                  <footer>2019 S/D 2023 </footer>
                </blockquote>
              </Col>
              <Col xs="2" sm="3" md="4">
              <i className="fa fa-check-square-o font-5xl d-block mt-4"></i>
              <Button style={{padding:'3px'}} color="warning"><i className="fa fa-pencil-square-o font-2xl" onClick={this.setPeriodeModal}></i></Button>
              </Col>
              </Row>
              <Button block color="success" data-number="1" onClick={this.getRpjmd}>Halaman Menyusun RPMJD <i className="fa fa-arrow-right"></i></Button>
              </CardBody>
            </Card>
          </Col>
          <Col xs="12" sm="6" md="3">
            <Card className="text-white bg-danger text-center">
              <CardBody>
                <Row>
              <Col xs="10" sm="9" md="8">
                <blockquote className="card-bodyquote">
                  <h1>Periode RPJMD</h1>
                  <footer>2020 S/D 2024 </footer>
                </blockquote>
              </Col>
              <Col xs="2" sm="3" md="4">
              <i className="cui-ban icons font-5xl d-block mt-4"></i>
              <Button style={{padding:'3px'}} color="warning"><i className="fa fa-pencil-square-o font-2xl" onClick={this.setPeriodeModal}></i></Button>
              </Col>
              </Row>
              </CardBody>
            </Card>
          </Col>
          <Col xs="12" sm="6" md="3">
            <Card className="text-white bg-danger text-center">
              <CardBody>
                <Row>
              <Col xs="10" sm="9" md="8">
                <blockquote className="card-bodyquote">
                  <h1>Periode RPJMD</h1>
                  <footer>2023 S/D 2028 </footer>
                </blockquote>
              </Col>
              <Col xs="2" sm="3" md="4">
              <i className="cui-ban icons font-5xl d-block mt-4"></i>
              <Button style={{padding:'3px'}} color="warning"><i className="fa fa-pencil-square-o font-2xl" onClick={this.setPeriodeModal}></i></Button>
              </Col>
              </Row>
              </CardBody>
            </Card>
          </Col>
        </Row>
      </div>
    );
  }
}

export default Dashboard;
