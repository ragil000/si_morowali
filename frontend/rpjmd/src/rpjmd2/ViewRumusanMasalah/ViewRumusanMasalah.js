import React, { Component } from 'react';
import { FormText, Alert, FormGroup, Label, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';


class ViewRumusanMasalah extends Component {
  
  constructor(props) {
    super(props);

    this.dataPilihAwal = {
      rumusan_masalah_id:'',
      rumusan_masalah_nama:'',
      rumusan_masalah_akar:'',
      rumusan_masalah_bukti:'',
      rumusan_masalah_asumsi:'',
      rumusan_masalah_lokasi:'',
      opd:'',
    };

    this.state = {
      loading:false,
      dataAll: [],
      jumlahPage: 1,
      modalCreate: false,
      modalDelete: false,
      dataPilih: this.dataPilihAwal,
      dataTambah:[],
      dataMisi:[],
      pencarian: '',
      page: 1,
      aksi:'Tambah',
    }

    document.title = "Menyusun Tujuan";
    
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
      setData.opd = event.target.value;
    }else if(no===2){
      setData.rumusan_masalah_nama = event.target.value;
    }else if(no===3){
      setData.rumusan_masalah_akar = event.target.value;
    }else if(no===4){
      setData.rumusan_masalah_bukti = event.target.value;
    }else if(no===5){
      setData.rumusan_masalah_asumsi = event.target.value;
    }else if(no===6){
      setData.rumusan_masalah_lokasi = event.target.value;
    }

    console.log(event.target.value);
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
        // dataPilih: e
      });
      let setData = e;
      setData.opd = e.Kd_Urusan+"-"+e.Kd_Bidang+"-"+e.Kd_Sub+"-"+e.Kd_Unit;
      this.setState({ dataPilih: setData});
      // console.log(e);

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
      // setTimeout(this.setState({pesan:''}), 5000);
    }
    setTimeout(()=>{ this.setState({pesan: ''}); }, 3000);
  }
// .pesan

/// set data

  setData = (dataAll) => {
    if(dataAll.status){
      this.setState({ 
        dataAll: dataAll.data, 
        jumlahPage: dataAll.jumlahPage, 
        jumlahAll: dataAll.jumlahAll, 
        dataTambah:dataAll.dataTambah, 
      });
    }
  }

  getData = (page = 1) => {
    
    this.setState({ loading: true });
    // console.log('response');
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('search', this.state.pencarian);
    axios
    .post(config.apiRoot+'rpjmd/menyusun/rumusan-masalah/page-'+page, data)
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
      link = config.apiRoot+'rpjmd/menyusun/rumusan-masalah/update';
      
    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+'rpjmd/menyusun/rumusan-masalah/create';
    }
    // console.log(this.state.dataPilih.visi_id);
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('rumusan_masalah_id', this.state.dataPilih.rumusan_masalah_id);
    data.append('rumusan_masalah_nama', this.state.dataPilih.rumusan_masalah_nama);
    data.append('rumusan_masalah_akar', this.state.dataPilih.rumusan_masalah_akar);
    data.append('rumusan_masalah_bukti', this.state.dataPilih.rumusan_masalah_bukti);
    data.append('rumusan_masalah_asumsi', this.state.dataPilih.rumusan_masalah_asumsi);
    data.append('rumusan_masalah_lokasi', this.state.dataPilih.rumusan_masalah_lokasi);
    data.append('opd', this.state.dataPilih.opd);

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
      
      // console.log(response.data);
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
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('rumusan_masalah_id', this.state.dataPilih.rumusan_masalah_id);
    axios
    .post(config.apiRoot+'rpjmd/menyusun/rumusan-masalah/delete', data)
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


/// pagenation

  changePage = (page) =>{
    this.setState({page: page});
    this.getData(page);
  }
  pageNation = () => {

    const page = [];
    if(this.state.page>1){
      page.push(<PaginationItem onClick={()=> this.changePage(this.state.page-1)} key={0}><PaginationLink previous tag="button">Prev</PaginationLink></PaginationItem>);
    }else{
      page.push(<PaginationItem disabled key={0}><PaginationLink previous tag="button">Prev</PaginationLink></PaginationItem>);
    }

    let tulis = false;
    let tempTulis = false;
    for(let i=1;i<=this.state.jumlahPage;i++){
      tempTulis = tulis;
      tulis = false;
      if(i + 2 >= this.state.page && i - 2 <= this.state.page){
        tulis = true;
      }

      if(i === 1 || i === this.state.jumlahPage){
        tulis = true;
      }

      if(tulis){
        if(i===this.state.page)
          page.push(<PaginationItem active key={i}><PaginationLink tag="button">{i}</PaginationLink></PaginationItem>);
        else
          page.push(<PaginationItem key={i} onClick={()=> this.changePage(i)}><PaginationLink tag="button">{i}</PaginationLink></PaginationItem>);
      }else{
        if(tempTulis !== tulis){
          page.push(<PaginationItem key={i} disabled><PaginationLink tag="button">...</PaginationLink></PaginationItem>);
        }
      }
      
    }

    if(this.state.page < this.state.jumlahPage){
      page.push(<PaginationItem onClick={()=> this.changePage(this.state.page+1)} key={this.state.jumlahPage+2}><PaginationLink next tag="button">Next</PaginationLink></PaginationItem>);
    }else{
      page.push(<PaginationItem disabled key={this.state.jumlahPage+2}><PaginationLink next tag="button">Next</PaginationLink></PaginationItem>);
    }
    // disabled
    return (
      <Pagination>
        {page}
      </Pagination>
    );
  }
////. pagenation

// isi
  isi(){
    if(this.state.loading){
      return(
        <div>
          <img src={loadingImage} alt="logo"/>
        </div>
      );
    }else{
      return(
        <div>
          {this.state.pesan}
          <Row>
            <Col xs="128" md="10">
            <Form method="post" onSubmit={this.handleCariSubmit} className="form-horizontal">
              <FormGroup row>
                <Col xs="9" md="5">
                  <Input type="text" onChange={this.handlePencarianChange} value={this.state.pencarian} placeholder="Pencarian" />
                </Col>
                <Col xs="3" md="2">
                  <Button color="primary" >Cari</Button>
                </Col>
              </FormGroup>
            </Form>
            </Col>
            <Col xs="12" md="2">
              <Button color="info" onClick={() => {this.setState({aksi:'Tambah'});this.modalCreate();}} className="mr-1">Tambah</Button>
            </Col> 
          </Row> 
          <Table responsive striped>
            <thead>
            <tr>
              <th>No2</th>
              <th>Rumusan Masalah</th>
              <th>Akar Permasalahan</th>
              <th>Bukti</th>
              <th>Asumsi</th>
              <th>OPD</th>
              <th>Lokasi</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataAll.map((data, key) => {
              return data ? (
                <tr key={key}>
                  <td>{((this.state.page-1)*20)+key+1}</td>
                  <td>{data.rumusan_masalah_nama}</td>
                  <td>{data.rumusan_masalah_akar}</td>
                  <td>{data.rumusan_masalah_bukti}</td>
                  <td>{data.rumusan_masalah_asumsi}</td>
                  <td>{data.Nm_Sub_Unit}</td>
                  <td>{data.rumusan_masalah_lokasi}</td>
                  <td>
                    <Button color="info" onClick={() => {this.setState({aksi:'Edit'});this.modalCreate(data);}} className="mr-1">Edit</Button>|
                    <Button color="danger" onClick={() => this.modalDelete(data)} className="mr-1">Delete</Button>
                  </td>
                </tr>
              ) : (null);
            })}
            </tbody>
          </Table>
          {this.pageNation()}
        </div>
      );
    }
  }

//. isi

  render() {

    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardHeader>
                <i className="fa fa-align-justify"></i> {document.title}
              </CardHeader>
              <CardBody>
                <Modal isOpen={this.state.modalCreate} toggle={this.modalCreateClose} className={'modal-lg ' + this.props.className}>
                  <ModalHeader toggle={this.modalCreateClose}>{this.state.aksi} Data</ModalHeader>
                  <Form method="post"  onSubmit={this.handleSubmit} className="form-horizontal" id="form-data">
                    <ModalBody>
                    <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">OPD *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" data-number="1" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.opd} required autoFocus>
                          <option key="-1" value="">-= Pilih OPD =-</option>
                          {this.state.dataTambah.map((data, key) => {
                            return data ? (
                              <option key={key} value={data.Kd_Urusan+"-"+data.Kd_Bidang+"-"+data.Kd_Sub+"-"+data.Kd_Unit}>{data.Nm_Sub_Unit}</option>
                            ) : (null);
                          })}
                          </Input>
                          <FormText color="muted">Pilih OPD</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Rumusan Masalah *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="2" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.rumusan_masalah_nama} required autoFocus/>
                          <FormText color="muted">Isi Rumusan Masalah</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Akar Permasalahan *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="3" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.rumusan_masalah_akar} required autoFocus/>
                          <FormText color="muted">Isi Akar Permasalahan</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Bukti *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="4" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.rumusan_masalah_bukti} required autoFocus/>
                          <FormText color="muted">Isi BUkti</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Asumsi *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="5" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.rumusan_masalah_asumsi} required autoFocus/>
                          <FormText color="muted">Isi Asumsi</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Lokasi *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="6" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.rumusan_masalah_lokasi} required autoFocus/>
                          <FormText color="muted">Isi Lokasi</FormText>
                        </Col>
                      </FormGroup>
                    </ModalBody>
                    <ModalFooter>
                      <Button color="primary" type="submit" form="form-data" value="Submit">{this.state.aksi} Data</Button>
                      <Button color="secondary" onClick={this.modalCreateClose}>Cancel</Button>
                    </ModalFooter>
                  </Form>
                </Modal>
                
                <Modal isOpen={this.state.modalDelete} toggle={this.modalDelete} className={ this.props.className}>
                  <ModalHeader toggle={this.modalDelete}>Hapus Data</ModalHeader>
                  <ModalBody>
                    Apakah Anda Yakin Menghapus Data?
                  </ModalBody>
                  <ModalFooter>
                    <Button color="danger" onClick={this.handleDelete}>Ya</Button>{' '}
                    <Button color="secondary" onClick={this.modalDelete}>Batal</Button>
                  </ModalFooter>
                </Modal>
                     
                {this.isi()}
              </CardBody>
            </Card>
          </Col>
        </Row>
      </div>

    );
    
  }
}

export default ViewRumusanMasalah;
