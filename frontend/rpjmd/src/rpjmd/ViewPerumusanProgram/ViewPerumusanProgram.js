import React, { Component } from 'react';
import { FormText, Alert, FormGroup, Label, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';
import Download from '../other/Download';


class ViewPerumusanProgram extends Component {
  
  constructor(props) {
    super(props);

    this.dataPilihAwal = {
      perumusan_program_id:'',
      misi_id:'',
      tujuan_id:'',
      sasaran_id:'',
      indikator_id:'',
      isu_strategi_id:'',
      tujuan_sasaran_id:'',
      strategi_kebijakan_id:'',
      Kd_Program:'',
      outcome:'',
      kondisi_awal:'',
      kondisi_akhir:'',
      lokasi:'',
    };

    this.state = {
      loading:false,
      dataAll: [],
      jumlahPage: 1,
      modalCreate: false,
      modalDelete: false,
      dataPilih: this.dataPilihAwal,
      dataTambah:[],
      dataUrusan:[],
      dataBidang:[],
      dataSatuan:[],
      dataTujuan:[],
      dataStrategiKebijakan:[],
      dataTujuanSasaran:[],
      dataIsuStrategi:[],
      dataIndikator:[],
      dataSasaran:[],
      dataProgram:[],
      dataMisi:[],
      pencarian: '',
      page: 1,
      aksi:'Tambah',
    }

    document.title = "Menyusun Perumusan Program";
    
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
      setData.misi_id = event.target.value;
      setData.tujuan_id = '';
      this.getTujuan(event.target.value);
    }else if(no===2){
      setData.sasaran_id = event.target.value;
      setData.indikator_id = '';
      this.getIndikator(event.target.value);
    }else if(no===3){
      setData.indikator_id = event.target.value;
      setData.tujuan_sasaran_id = '';
      this.getTujuanSasaran(event.target.value);
    }else if(no===4){
      setData.Kd_Program = event.target.value;
    }else if(no===5){
      setData.outcome = event.target.value;
    }else if(no===6){
      setData.kondisi_awal = event.target.value;
    }else if(no===7){
      setData.kondisi_akhir = event.target.value;
    }else if(no===8){
      setData.lokasi  = event.target.value;
    }else if(no===9){
      setData.tujuan_id  = event.target.value;
      this.getSasaran(event.target.value);
    }else if(no===10){
      setData.tujuan_sasaran_id  = event.target.value;
      this.getStategiKebijakan(event.target.value);
    }else if(no===11){
      setData.strategi_kebijakan_id  = event.target.value;
    }
    
    //console.log(event.target.value);
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
      e.Kd_Program = e.Kd_Urusan+"-"+e.Kd_Bidang+"-"+e.Kd_Prog;
      this.setState({
        modalCreate: true,
        dataPilih: e
      });
      this.getTujuan(e.misi_id);
      this.getSasaran(e.tujuan_id);
      this.getIndikator(e.sasaran_id);
      this.getTujuanSasaran(e.indikator_id);
      this.getStategiKebijakan(e.tujuan_sasaran_id);
      this.getProgram(e.Kd_Urusan, e.Kd_Bidang);
      // console.log(e.misi_id);
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
        dataUrusan:dataAll.dataUrusan, 
        dataSatuan:dataAll.dataSatuan,
        dataMisi:dataAll.dataMisi,
        // dataProgram:dataAll.dataProgram,
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
    .post(config.apiRoot+'rpjmd/menyusun/perumusan-program/page-'+page, data)
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

  getBidang = (urusan) => {
    
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('urusan', urusan);
    axios
    .post(config.apiRoot+'rpjmd/get-data/bidang', data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataBidang: response.data.data});
      }
      this.setState({ loading: false });
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
    });
  }

  getProgram = (urusan, bidang) => {
    
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('urusan', urusan);
    data.append('bidang', bidang);
    axios
    .post(config.apiRoot+'rpjmd/get-data/program', data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataProgram: response.data.data});
      }
      this.setState({ loading: false });
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
    });
  }

  getTujuan = (id) => {
    
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('id', id);
    axios
    .post(config.apiRoot+'rpjmd/get-data/tujuan', data)
    .then(response => {
      if(response.data.status){
        
        this.setState({ dataTujuan: response.data.data});
        
      }
      this.setState({ loading: false });
      console.log(response.data);
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
    });
  }

  getSasaran = (id) => {
    
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('id', id);
    axios
    .post(config.apiRoot+'rpjmd/get-data/sasaran', data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataSasaran: response.data.data});
        
      }
      this.setState({ loading: false });
      console.log(response.data);
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
    });
  }

  getIndikator = (id) => {
    
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('id', id);
    axios
    .post(config.apiRoot+'rpjmd/get-data/indikator', data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataIndikator: response.data.data});
        
      }
      this.setState({ loading: false });
      console.log(response.data);
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
    });
  }

  getIsuStrategi = (id) => {
    
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('id', id);
    axios
    .post(config.apiRoot+'rpjmd/get-data/isu-strategi', data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataIsuStrategi: response.data.data});
        
      }
      this.setState({ loading: false });
      console.log(response.data);
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
    });
  }

  getTujuanSasaran = (id) =>{
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('id', id);
    axios
    .post(config.apiRoot+'rpjmd/get-data/tujuan-sasaran', data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataTujuanSasaran: response.data.data});
        
      }
      this.setState({ loading: false });
      console.log(response.data);
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
    });
  }

  getStategiKebijakan = (id) =>{
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('id', id);
    axios
    .post(config.apiRoot+'rpjmd/get-data/strategi-kebijakan', data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataStrategiKebijakan: response.data.data, dataProgram: response.data.dataProgram});
        
      }
      this.setState({ loading: false });
      console.log(response.data);
      console.log(response.data);
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
    });
  }

///. set data

// submit
  handleSubmit = event => {
    event.preventDefault();
    this.setState({ loading: true });
    let link = '';
    if(this.state.aksi === 'Edit'){
      link = config.apiRoot+'rpjmd/menyusun/perumusan-program/update';

    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+'rpjmd/menyusun/perumusan-program/create';
    }
    // console.log(this.state.dataPilih.visi_id);
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('perumusan_program_id', this.state.dataPilih.perumusan_program_id);
    data.append('misi_id', this.state.dataPilih.misi_id);
    data.append('tujuan_id', this.state.dataPilih.tujuan_id);
    data.append('sasaran_id', this.state.dataPilih.sasaran_id);
    data.append('indikator_id', this.state.dataPilih.indikator_id);
    data.append('tujuan_sasaran_id', this.state.dataPilih.tujuan_sasaran_id);
    data.append('lokasi', this.state.dataPilih.lokasi);
    data.append('kondisi_akhir', this.state.dataPilih.kondisi_akhir);
    data.append('kondisi_awal', this.state.dataPilih.kondisi_awal);
    data.append('outcome', this.state.dataPilih.outcome);
    data.append('Kd_Program', this.state.dataPilih.Kd_Program);
    data.append('strategi_kebijakan_id', this.state.dataPilih.strategi_kebijakan_id);


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
    data.append('perumusan_program_id', this.state.dataPilih.perumusan_program_id);
    axios
    .post(config.apiRoot+'rpjmd/menyusun/perumusan-program/delete', data)
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
            <Download link="rpjmd/menyusun/perumusan-program"/>
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
          <Table responsive striped bordered>
          <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
            <tr>
              <th rowSpan="2">No</th>
              <th rowSpan="2">Sasaran</th>
              <th rowSpan="2">Strategi Pembangunan</th>
              <th rowSpan="2">Arah Kebijakan</th>
              <th rowSpan="2">Indikator</th>
              <th rowSpan="2">Program</th>
              <th rowSpan="2">Indikator Kinerja (Outcome)</th>
              <th colSpan="2">Capaian Kinerja</th>
              <th rowSpan="2">Lokasi</th>
              <th rowSpan="2">Aksi</th>
            </tr>
            <tr>
              <th>Kondisi Awal</th>
              <th>Kondisi Akhir</th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataAll.map((data, key) => {
              return data ? (
                <tr key={key}>
                  <td>{((this.state.page-1)*20)+key+1}</td>
                  <td>{data.sasaran_nama}</td>
                  <td>{data.strategi_pembangunan}</td>
                  <td>{data.arah_kebijakan}</td>
                  <td>{data.indikator_nama}</td>
                  <td>{data.Ket_Program}</td>
                  <td>{data.outcome}</td>
                  <td>{data.kondisi_awal}</td>
                  <td>{data.kondisi_akhir}</td>
                  <td>{data.lokasi}</td>
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
                          <Label htmlFor="text-input">Misi *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" data-number="1" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.misi_id} required autoFocus>
                          <option key="-1" value="">-= Pilih Misi =-</option>
                          {this.state.dataMisi.map((data, key) => {
                            return data ? (
                              <option key={key} value={data.misi_id}>{data.misi_nama}</option>
                            ) : (null);
                          })}
                          </Input>
                          <FormText color="muted">Pilih Misi</FormText>
                        </Col>
                      </FormGroup> 
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tujuan *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" data-number="9" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tujuan_id} required autoFocus>
                          <option key="-1" value="">-= Pilih Tujuan =-</option>
                          {this.state.dataTujuan.map((data, key) => {
                            return data ? (
                              <option key={key} value={data.tujuan_id}>{data.tujuan_nama}</option>
                            ) : (null);
                          })}
                          </Input>
                          <FormText color="muted">Pilih Tujuan</FormText>
                        </Col>
                      </FormGroup> 
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Sasaran *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" data-number="2" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.sasaran_id} required autoFocus>
                          <option key="-1" value="">-= Pilih Sasaran =-</option>
                          {this.state.dataSasaran.map((data, key) => {
                            return data ? (
                              <option key={key} value={data.sasaran_id}>{data.sasaran_nama}</option>
                            ) : (null);
                          })}
                          </Input>
                          <FormText color="muted">Pilih Sasaran</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Indikator *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" data-number="3" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.indikator_id} required autoFocus>
                          <option key="-1" value="">-= Pilih Indikator =-</option>
                          {this.state.dataIndikator.map((data, key) => {
                            return data ? (
                              <option key={key} value={data.indikator_id}>{data.indikator_nama}</option>
                            ) : (null);
                          })}
                          </Input>
                          <FormText color="muted">Pilih Indikator</FormText>
                        </Col>
                      </FormGroup>
                      
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tujuan Sasaran *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" data-number="10" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tujuan_sasaran_id} required autoFocus>
                          <option key="-1" value="">-= Pilih Tujuan Sasaran =-</option>
                          {this.state.dataTujuanSasaran.map((data, key) => {
                            return data ? (
                              <option key={key} value={data.tujuan_sasaran_id}>{data.tujuan_sasaran_kondisi_awal}</option>
                            ) : (null);
                          })}
                          </Input>
                          <FormText color="muted">Pilih Tujuan Sasaran</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Strategi Kebijakan *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" data-number="11" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.strategi_kebijakan_id} required autoFocus>
                          <option key="-1" value="">-= Pilih Strategi Kebijakan =-</option>
                          {this.state.dataStrategiKebijakan.map((data, key) => {
                            return data ? (
                              <option key={key} value={data.strategi_kebijakan_id}>{data.strategi_pembangunan}</option>
                            ) : (null);
                          })}
                          </Input>
                          <FormText color="muted">Pilih Strategi Kebijakan</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Program *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" data-number="4" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.Kd_Program} required autoFocus>
                          <option key="-1" value="">-= Pilih Program =-</option>
                          {this.state.dataProgram.map((data, key) => {
                            return data ? (
                              <option key={key} value={data.Kd_Urusan+"-"+data.Kd_Bidang+"-"+data.Kd_Prog}>{data.Ket_Program}</option>
                            ) : (null);
                          })}
                          </Input>
                          <FormText color="muted">Pilih Program</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Indikator Kinerja *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="visi" data-number="5" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.outcome} required autoFocus/>
                          <FormText color="muted">Isi Indikator Kinerja</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Kondisi Awal *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="visi" data-number="6" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.kondisi_awal} required autoFocus/>
                          <FormText color="muted">Isi Kondisi Awal</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Kondisi Akhir *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="visi" data-number="7" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.kondisi_akhir} required autoFocus/>
                          <FormText color="muted">Isi Kondisi Akhir</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Lokasi *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="visi" data-number="8" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.lokasi} required autoFocus/>
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

export default ViewPerumusanProgram;
