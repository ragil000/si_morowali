import React, { Component } from 'react';
import {  Modal, ModalHeader, ModalFooter,  Form, ModalBody, Label, FormText, Button, FormGroup, Input, Alert, Card, CardBody, Col, Row, Table } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';

class ViewKebijakan extends Component {


  constructor(props) {
    super(props);

    this.state = {
      loading:false,
      pencarian:'',
      urusan:'',
      bidang:'',
      visi:'',
      dataAll: [],
      jumlahPage: 1,
      page: 1,
      dataTambah:[],
      dataBidang:[],
      
    }
    this.temp = 0;
    document.title = "Strategi dan Arah Kebijakan";
  }
  


  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <Table1/>
              <Table2/>
              <Table3/>
            </Card>
          </Col>
        </Row>

      </div>

    );
  }
}


class Table1 extends Component {

  constructor(props) {
    super(props);

    this.dataPilihAwal = {
      strategi_id:0,
      tahun1:0,
      tahun2:0,
      tahun3:0,
      tahun4:0,
      tahun5:0,
    };

    this.state = {
      loading:false,
      dataAll: [],
      jumlahPage: 1,
      modalCreate: false,
      modalDelete: false,
      dataPilih: this.dataPilihAwal,
      dataMisi:[],
      pencarian: '',
      page: 1,
      aksi:'Tambah',
    }

    
    this.modalCreateClose = this.modalCreateClose.bind(this);
    this.modalCreate = this.modalCreate.bind(this);
    this.modalDelete = this.modalDelete.bind(this);

    this.handleChange = this.handleChange.bind(this);
    this.handlePencarianChange = this.handlePencarianChange.bind(this);
    this.handleDelete = this.handleDelete.bind(this);
    
  }

  componentWillMount = () => {
    this.getData();
  }

  handlePencarianChange(event){
    this.setState({ pencarian: event.target.value});
  }

  handleChange(event){

    let no = parseInt(event.target.attributes.getNamedItem('data-number').value);
    let setData = this.state.dataPilih;
    if(no===1){
      setData.tahun1 = event.target.value;
    }else if(no===2){
      setData.tahun2 = event.target.value;
    }else if(no===3){
      setData.tahun3 = event.target.value;
    }else if(no===4){
      setData.tahun4 = event.target.value;
    }else if(no===5){
      setData.tahun5 = event.target.value;
    }
    // console.log(event.target.value);
    this.setState({ dataPilih: setData});
  }
//////modal
  modalCreateClose(e = []) {
    this.setState({
      modalCreate: false,
    });
    
  }

  modalCreate(e = []) {
    
    if(e.length === 0){
      this.setState({
        modalCreate: true,
        dataPilih: this.dataPilihAwal
      });
      
    }else{
      this.setState({
        modalCreate: true,
        dataPilih: e
      });
      console.log(e);
    }
    
  }
  modalDelete(e = []) {
    this.setState({
      modalDelete: !this.state.modalDelete,
      dataPilih: e
    });
  }
/////. modal

// pesan
  changePesan = (e = null, status = 'success') =>{
    if(e === null){
      this.setState({pesan: ''});
    }else{
      this.setState({pesan: <Alert color={status}>{e}</Alert>});
    }
    setTimeout(()=>{ this.setState({pesan: ''}); }, 3000);
  }
// .pesan

/// set data

  setData = (dataAll) => {
    if(dataAll.status){
      this.setState({ dataAll: dataAll.data, jumlahPage: dataAll.jumlahPage, jumlahAll: dataAll.jumlahAll, dataKategori:dataAll.kategori, dataMisi:dataAll.misi, });
    }
  }

  getData = (page = 1) => {
    
    this.setState({ loading: true });
    // console.log('response');
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('search', this.state.pencarian);
    axios
    .post(config.apiRoot+'rpjmd/tampil/kebijakan/pagu/page-'+page, data)
    .then(response => {
      this.setData(response.data)
      console.log(response);
      this.setState({ loading: false });
    })
    .catch(error => {
      console.log(error);
      this.setState({ loading: false });
      this.changePesan('Tidak dapat terhubung pada server!', 'danger');
    });
  }



///. set data

// submit
  handleSubmit = event => {
    event.preventDefault();
    this.setState({ loading: true });
    let link = '';
    if(this.state.aksi === 'Edit'){
      link = config.apiRoot+'rpjmd/tampil/kebijakan/pagu/update';
      
    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+'rpjmd/tampil/kebijakan/pagu/update';
    }
    // console.log(this.state.dataPilih.visi_id);
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('id', this.state.dataPilih.strategi_id);
    data.append('tahun1', this.state.dataPilih.tahun1);
    data.append('tahun2', this.state.dataPilih.tahun2);
    data.append('tahun3', this.state.dataPilih.tahun3);
    data.append('tahun4', this.state.dataPilih.tahun4);
    data.append('tahun5', this.state.dataPilih.tahun5);
    axios
    .post(link, data, head)
    .then(response => {
      if(response.data.status){
        this.modalCreateClose();
        this.getData();
        this.changePesan(response.data.pesan);
      }else{
        this.changePesan(response.data.pesan, 'warning');
      }
      this.setState({ loading: false });
      // this.toggleClose();
      
      console.log(response.data);
    })
    .catch(error=> {
      console.log(error);
      this.setState({ loading: false });
      this.changePesan('Tidak dapat terhubung pada server!', 'danger');
    });
  }

  handleDelete = () =>{
    // console.log(this.state.dataPilih);
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('id', this.state.dataPilih.tujuan_id);
    axios
    .post(config.apiRoot+'rpjmd/menyusun/tujuan/delete', data)
    .then(response => {
      if(response.data.status){
        this.modalDelete();
        this.getData();
        this.changePesan(response.data.pesan);
      }else{
        this.changePesan(response.data.pesan, 'warning');
      }
      this.setState({ loading: false });
      // console.log(response);
    })
    .catch(error => {
      console.log(error);
      this.setState({ loading: false });
      this.changePesan('Tidak dapat terhubung pada server!', 'danger');
    });
  }

  handleCariSubmit = event => {
    event.preventDefault();
    this.getData();
  }
//. submit

// isi
  isi(){
    if(this.state.loading){
      return(
        <div>
          <img src={loadingImage} alt="loading"/>
        </div>
      );
    }else{
      return (
        <CardBody>
          <h4 style={{textAlign: 'center',}}>PRAKIRAAN PAGU INDIKATIF PER-URUSAN/ADMINISTRASI/PENUNJANG</h4>
          <Table responsive striped bordered>
            <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
            <tr>
                <th rowSpan="3" colSpan="2">Kode</th>
                <th rowSpan="3">Urusan/Penunjang</th>
                <th colSpan="5">Prakiraan Pagu Indikatif</th>
                <th rowSpan="3">Aksi</th>
              </tr>
              <tr>
                <th>Tahun 1</th>
                <th>Tahun 2</th>
                <th>Tahun 3</th>
                <th>Tahun 4</th>
                <th>Tahun 5</th>
              </tr>
              <tr>
                <th>Rp</th>
                <th>Rp</th>
                <th>Rp</th>
                <th>Rp</th>
                <th>Rp</th>
              </tr>
              <tr>
                <th colSpan="2">(1)</th>
                <th>(2)</th>
                <th>(3)</th>
                <th>(4)</th>
                <th>(5)</th>
                <th>(6)</th>
                <th>(7)</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colSpan="2"></td>
                <td>TOTAL BELANJA PROGRAM & KEGIATAN</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              {this.state.dataAll.map((data, key) => {
                // console.log(data.Kd_Urusan+" => "+data.Kd_Bidang);
                if(this.temp !== data.urusan){
                  this.temp = data.urusan;
                  return data ? (
                    <tr key={key}>
                      <td>{data.urusan}</td>
                      <td></td>
                      <td colSpan="7">{data.Nm_Urusan}</td>
                    </tr>
                    ) : (null);
                }else{
                  return data ? (
                    <tr key={key}>
                      <td>{data.urusan}</td>
                      <td>{data.bidang}</td>
                      <td>{data.Nm_Bidang}</td>
                      <td>{data.tahun1}</td>
                      <td>{data.tahun2}</td>
                      <td>{data.tahun3}</td>
                      <td>{data.tahun4}</td>
                      <td>{data.tahun5}</td>
                      <td><Button color="info" onClick={() => {this.setState({aksi:'Edit'});this.modalCreate(data);}} className="mr-1">Edit</Button></td>
                    </tr>
                    ) : (null);
                }
                
              })}
            </tbody>
          </Table>
        </CardBody>
      );
    }
  }


// .isi

  render() {
    return (
      <div>
        <Modal isOpen={this.state.modalCreate} toggle={this.modalCreateClose} className={'modal-lg ' + this.props.className}>
          <ModalHeader toggle={this.modalCreateClose}>{this.state.aksi} Data</ModalHeader>
          <Form method="post"  onSubmit={this.handleSubmit} className="form-horizontal" id="form-data">
            <ModalBody>
            <FormGroup row>
                <Col md="3">
                  <Label htmlFor="text-input">Tahun 1 *</Label>
                </Col>
                <Col xs="12" md="9">
                  <Input type="text" data-number="1" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun1} required autoFocus/>
                  <FormText color="muted">Isi Tahun 1</FormText>
                </Col>
              </FormGroup>
              <FormGroup row>
                <Col md="3">
                  <Label htmlFor="text-input">Tahun 2 *</Label>
                </Col>
                <Col xs="12" md="9">
                  <Input type="text" data-number="2" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun2} required autoFocus/>
                  <FormText color="muted">Isi Tahun 2</FormText>
                </Col>
              </FormGroup>
              <FormGroup row>
                <Col md="3">
                  <Label htmlFor="text-input">Tahun 3 *</Label>
                </Col>
                <Col xs="12" md="9">
                  <Input type="text" data-number="3" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun3} required autoFocus/>
                  <FormText color="muted">Isi Tahun 3</FormText>
                </Col>
              </FormGroup>
              <FormGroup row>
                <Col md="3">
                  <Label htmlFor="text-input">Tahun 4 *</Label>
                </Col>
                <Col xs="12" md="9">
                  <Input type="text" data-number="4" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun4} required autoFocus/>
                  <FormText color="muted">Isi Tahun 4</FormText>
                </Col>
              </FormGroup>
              <FormGroup row>
                <Col md="3">
                  <Label htmlFor="text-input">Tahun 5 *</Label>
                </Col>
                <Col xs="12" md="9">
                  <Input type="text" data-number="5" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun5} required autoFocus/>
                  <FormText color="muted">Isi Tahun 5</FormText>
                </Col>
              </FormGroup>
            </ModalBody>
            <ModalFooter>
              <Button color="primary" type="submit" form="form-data" value="Submit">{this.state.aksi} Data</Button>
              <Button color="secondary" onClick={this.modalCreateClose}>Cancel</Button>
            </ModalFooter>
          </Form>
        </Modal>
        {this.isi()}
      </div>

    );
  }
}

class Table2 extends Component {
  constructor(props) {
    super(props);

    this.dataPilihAwal = {
      strategi_id:0,
      tahun1:0,
      tahun2:0,
      tahun3:0,
      tahun4:0,
      tahun5:0,
    };

    this.state = {
      loading:false,
      dataAll: [],
      jumlahPage: 1,
      modalCreate: false,
      modalDelete: false,
      dataPilih: this.dataPilihAwal,
      dataMisi:[],
      pencarian: '',
      page: 1,
      aksi:'Tambah',
    }

    
    this.modalCreateClose = this.modalCreateClose.bind(this);
    this.modalCreate = this.modalCreate.bind(this);
    this.modalDelete = this.modalDelete.bind(this);

    this.handleChange = this.handleChange.bind(this);
    this.handlePencarianChange = this.handlePencarianChange.bind(this);
    this.handleDelete = this.handleDelete.bind(this);
    
  }

  componentWillMount = () => {
    this.getData();
  }

  handlePencarianChange(event){
    this.setState({ pencarian: event.target.value});
  }

  handleChange(event){

    let no = parseInt(event.target.attributes.getNamedItem('data-number').value);
    let setData = this.state.dataPilih;
    if(no===1){
      setData.tahun1 = event.target.value;
    }else if(no===2){
      setData.tahun2 = event.target.value;
    }else if(no===3){
      setData.tahun3 = event.target.value;
    }else if(no===4){
      setData.tahun4 = event.target.value;
    }else if(no===5){
      setData.tahun5 = event.target.value;
    }
    // console.log(event.target.value);
    this.setState({ dataPilih: setData});
  }
//////modal
  modalCreateClose(e = []) {
    this.setState({
      modalCreate: false,
    });
    
  }

  modalCreate(e = []) {
    
    if(e.length === 0){
      this.setState({
        modalCreate: true,
        dataPilih: this.dataPilihAwal
      });
      
    }else{
      this.setState({
        modalCreate: true,
        dataPilih: e
      });
      console.log(e);
    }
    
  }
  modalDelete(e = []) {
    this.setState({
      modalDelete: !this.state.modalDelete,
      dataPilih: e
    });
  }
/////. modal

// pesan
  changePesan = (e = null, status = 'success') =>{
    if(e === null){
      this.setState({pesan: ''});
    }else{
      this.setState({pesan: <Alert color={status}>{e}</Alert>});
    }
    setTimeout(()=>{ this.setState({pesan: ''}); }, 3000);
  }
// .pesan

/// set data

  setData = (dataAll) => {
    if(dataAll.status){
      this.setState({ dataAll: dataAll.data, jumlahPage: dataAll.jumlahPage, jumlahAll: dataAll.jumlahAll, dataKategori:dataAll.kategori, dataMisi:dataAll.misi, });
    }
  }

  getData = (page = 1) => {
    
    this.setState({ loading: true });
    // console.log('response');
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('search', this.state.pencarian);
    axios
    .post(config.apiRoot+'rpjmd/tampil/kebijakan/pagu/page-'+page, data)
    .then(response => {
      this.setData(response.data)
      console.log(response);
      this.setState({ loading: false });
    })
    .catch(error => {
      console.log(error);
      this.setState({ loading: false });
      this.changePesan('Tidak dapat terhubung pada server!', 'danger');
    });
  }



///. set data

// submit
  handleSubmit = event => {
    event.preventDefault();
    this.setState({ loading: true });
    let link = '';
    if(this.state.aksi === 'Edit'){
      link = config.apiRoot+'rpjmd/tampil/kebijakan/pagu/update';
      
    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+'rpjmd/tampil/kebijakan/pagu/update';
    }
    // console.log(this.state.dataPilih.visi_id);
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('id', this.state.dataPilih.strategi_id);
    data.append('tahun1', this.state.dataPilih.tahun1);
    data.append('tahun2', this.state.dataPilih.tahun2);
    data.append('tahun3', this.state.dataPilih.tahun3);
    data.append('tahun4', this.state.dataPilih.tahun4);
    data.append('tahun5', this.state.dataPilih.tahun5);
    axios
    .post(link, data, head)
    .then(response => {
      if(response.data.status){
        this.modalCreateClose();
        this.getData();
        this.changePesan(response.data.pesan);
      }else{
        this.changePesan(response.data.pesan, 'warning');
      }
      this.setState({ loading: false });
      // this.toggleClose();
      
      console.log(response.data);
    })
    .catch(error=> {
      console.log(error);
      this.setState({ loading: false });
      this.changePesan('Tidak dapat terhubung pada server!', 'danger');
    });
  }

  handleDelete = () =>{
    // console.log(this.state.dataPilih);
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('id', this.state.dataPilih.tujuan_id);
    axios
    .post(config.apiRoot+'rpjmd/menyusun/tujuan/delete', data)
    .then(response => {
      if(response.data.status){
        this.modalDelete();
        this.getData();
        this.changePesan(response.data.pesan);
      }else{
        this.changePesan(response.data.pesan, 'warning');
      }
      this.setState({ loading: false });
      // console.log(response);
    })
    .catch(error => {
      console.log(error);
      this.setState({ loading: false });
      this.changePesan('Tidak dapat terhubung pada server!', 'danger');
    });
  }

  handleCariSubmit = event => {
    event.preventDefault();
    this.getData();
  }
//. submit

// isi
  isi(){
    if(this.state.loading){
      return(
        <div>
          <img src={loadingImage} alt="loading"/>
        </div>
      );
    }else{
      return (
        <CardBody>
        <h4 style={{textAlign: 'center',}}>ANALISIS KEUANGAN DAERAH PROVINSI/KABUPATEN/KOTA</h4>
        <Table responsive striped bordered>
          <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
          <tr>
              <th rowSpan="3">Kode</th>
              <th rowSpan="3">Jenis Belanja/Program Pembangunan</th>
              <th rowSpan="3">Data Tahun Dasar (Rp)</th>
              <th rowSpan="3">Tingkat Pertumbuhan (%)</th>
              <th colSpan="5">Prakiraan Pagu Indikatif</th>
              <th rowSpan="3">Aksi</th>
            </tr>
            <tr>
              <th>Tahun 1</th>
              <th>Tahun 2</th>
              <th>Tahun 3</th>
              <th>Tahun 4</th>
              <th>Tahun 5</th>
            </tr>
            <tr>
              <th>Rp</th>
              <th>Rp</th>
              <th>Rp</th>
              <th>Rp</th>
              <th>Rp</th>
            </tr>
            <tr>
              <th>(1)</th>
              <th>(2)</th>
              <th>(3)</th>
              <th>(4)</th>
              <th>(5)</th>
              <th>(6)</th>
              <th>(7)</th>
              <th>(8)</th>
              <th>(9)</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          {this.state.dataAll.map((data, key) => {
                // console.log(data.Kd_Urusan+" => "+data.Kd_Bidang);
                if(this.temp !== data.urusan){
                  this.temp = data.urusan;
                  return (null);
                }else{
                  return data ? (
                    <tr key={key}>
                      <td>{data.Kd_Program}</td>
                      <td>{data.Nm_Program}</td>
                      <td></td>
                      <td></td>
                      <td>{data.tahun1}</td>
                      <td>{data.tahun2}</td>
                      <td>{data.tahun3}</td>
                      <td>{data.tahun4}</td>
                      <td>{data.tahun5}</td>
                      <td><Button color="info" onClick={() => {this.setState({aksi:'Edit'});this.modalCreate(data);}} className="mr-1">Edit</Button></td>
                    </tr>
                    ) : (null);
                }
                
              })}
          </tbody>
        </Table>
      </CardBody>
      );
    }
  }


// .isi

  render() {
    return (
      <div>
        <Modal isOpen={this.state.modalCreate} toggle={this.modalCreateClose} className={'modal-lg ' + this.props.className}>
          <ModalHeader toggle={this.modalCreateClose}>{this.state.aksi} Data</ModalHeader>
          <Form method="post"  onSubmit={this.handleSubmit} className="form-horizontal" id="form-data">
            <ModalBody>
            <FormGroup row>
                <Col md="3">
                  <Label htmlFor="text-input">Tahun 1 *</Label>
                </Col>
                <Col xs="12" md="9">
                  <Input type="text" data-number="1" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun1} required autoFocus/>
                  <FormText color="muted">Isi Tahun 1</FormText>
                </Col>
              </FormGroup>
              <FormGroup row>
                <Col md="3">
                  <Label htmlFor="text-input">Tahun 2 *</Label>
                </Col>
                <Col xs="12" md="9">
                  <Input type="text" data-number="2" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun2} required autoFocus/>
                  <FormText color="muted">Isi Tahun 2</FormText>
                </Col>
              </FormGroup>
              <FormGroup row>
                <Col md="3">
                  <Label htmlFor="text-input">Tahun 3 *</Label>
                </Col>
                <Col xs="12" md="9">
                  <Input type="text" data-number="3" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun3} required autoFocus/>
                  <FormText color="muted">Isi Tahun 3</FormText>
                </Col>
              </FormGroup>
              <FormGroup row>
                <Col md="3">
                  <Label htmlFor="text-input">Tahun 4 *</Label>
                </Col>
                <Col xs="12" md="9">
                  <Input type="text" data-number="4" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun4} required autoFocus/>
                  <FormText color="muted">Isi Tahun 4</FormText>
                </Col>
              </FormGroup>
              <FormGroup row>
                <Col md="3">
                  <Label htmlFor="text-input">Tahun 5 *</Label>
                </Col>
                <Col xs="12" md="9">
                  <Input type="text" data-number="5" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun5} required autoFocus/>
                  <FormText color="muted">Isi Tahun 5</FormText>
                </Col>
              </FormGroup>
            </ModalBody>
            <ModalFooter>
              <Button color="primary" type="submit" form="form-data" value="Submit">{this.state.aksi} Data</Button>
              <Button color="secondary" onClick={this.modalCreateClose}>Cancel</Button>
            </ModalFooter>
          </Form>
        </Modal>
        {this.isi()}
      </div>
      
    );
  }
}

class Table3 extends Component {
  render() {
    return (
      <CardBody>
        <h4 style={{textAlign: 'center',}}>PROYEKSI KEMAMPUAN KEUANGAN DAERAH</h4>
        <Table responsive striped bordered>
          <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
            <tr>
              <th rowSpan="3">Kode</th>
              <th rowSpan="3">Jenis Belanja / Program Pembangunan</th>
              <th colSpan="5">Proyeksi</th>
            </tr>
            <tr>
              <th>Tahun 1</th>
              <th>Tahun 2</th>
              <th>Tahun 3</th>
              <th>Tahun 4</th>
              <th>Tahun 5</th>
            </tr>
            <tr>
              <th>Rp</th>
              <th>Rp</th>
              <th>Rp</th>
              <th>Rp</th>
              <th>Rp</th>
            </tr>
            <tr>
              <th>(1)</th>
              <th>(2)</th>
              <th>(3)</th>
              <th>(4)</th>
              <th>(5)</th>
              <th>(6)</th>
              <th>(7)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </Table>
      </CardBody>

    );
  }
}

export default ViewKebijakan;
