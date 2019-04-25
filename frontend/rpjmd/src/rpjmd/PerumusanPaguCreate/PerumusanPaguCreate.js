import React, { Component } from 'react';
import { FormText, Alert, FormGroup, Label, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';
import Download from '../other/Download';


class PerumusanPaguCreate extends Component {
  
  constructor(props) {
    super(props);

    this.dataPilihAwal = {
      perumusan_program_id:'',
      target1_harga:0,
      target1_lokasi:'',
      target2_harga:0,
      target2_lokasi:'',
      target3_harga:0,
      target3_lokasi:'',
      target4_harga:0,
      target4_lokasi:'',
      target5_harga:0,
      target5_lokasi:'',
      akhir_target:0,
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
      pencarian: '',
      page: 1,
      aksi:'Tambah',
    }

    document.title = "Menyusun Pagu Indikatif Pertahun";
    
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
      setData.target1_harga = event.target.value;
    }else if(no===3){
      setData.target1_lokasi = event.target.value;
    }else if(no===4){
      setData.target2_harga = event.target.value;
    }else if(no===5){
      setData.target2_lokasi = event.target.value;
    }else if(no===6){
      setData.target3_harga = event.target.value;
    }else if(no===7){
      setData.target3_lokasi = event.target.value;
    }else if(no===8){
      setData.target4_harga = event.target.value;
    }else if(no===9){
      setData.target4_lokasi = event.target.value;
    }else if(no===10){
      setData.target5_harga = event.target.value;
    }else if(no===11){
      setData.target5_lokasi = event.target.value;
    }else if(no===12){
      setData.akhir_target = event.target.value;
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
      this.getOpd(e.Kd_Urusan, e.Kd_Bidang);
      console.log(e.Kd_Sub);
      if(e.Kd_Sub !== "0" && e.Kd_Unit !== 0){
        e.opd = e.Kd_Urusan+"-"+e.Kd_Bidang+"-"+e.Kd_Sub+"-"+e.Kd_Unit;

      }else{
        e.opd = '';
      }
      this.setState({
        modalCreate: true,
        dataPilih: e
      });
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
      this.setState({ dataAll: dataAll.data, jumlahPage: dataAll.jumlahPage, jumlahAll: dataAll.jumlahAll, dataKategori:dataAll.kategori, dataMisi:dataAll.misi});
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
    .post(config.apiRoot+'rpjmd/menyusun/perumusan-pagu/page-'+page, data)
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

  getOpd = (urusan, bidang) => {
      
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('urusan', urusan);
    data.append('bidang', bidang);
    axios
    .post(config.apiRoot+'rpjmd/get-data/opd', data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataTambah: response.data.data});
      }
      this.setState({ loading: false });
      console.log(response.data);
      console.log("-------------"+urusan+bidang);
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
      link = config.apiRoot+'rpjmd/menyusun/perumusan-pagu/update';
      
    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+'rpjmd/menyusun/perumusan-pagu/create';
    }
    // console.log(this.state.dataPilih.visi_id);
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('perumusan_program_id', this.state.dataPilih.perumusan_program_id);
    data.append('target1_harga', this.state.dataPilih.target1_harga);
    data.append('target1_lokasi', this.state.dataPilih.target1_lokasi);
    data.append('target2_harga', this.state.dataPilih.target2_harga);
    data.append('target2_lokasi', this.state.dataPilih.target2_lokasi);
    data.append('target3_harga', this.state.dataPilih.target3_harga);
    data.append('target3_lokasi', this.state.dataPilih.target3_lokasi);
    data.append('target4_harga', this.state.dataPilih.target4_harga);
    data.append('target4_lokasi', this.state.dataPilih.target4_lokasi);
    data.append('target5_harga', this.state.dataPilih.target5_harga);
    data.append('target5_lokasi', this.state.dataPilih.target5_lokasi);
    data.append('akhir_target', this.state.dataPilih.akhir_target);
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
    data.append('id', this.state.dataPilih.tujuan_id);
    axios
    .post(config.apiRoot+'rpjmd/menyusun/perumusan-pagu/delete', data)
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
            <Download link="rpjmd/menyusun/perumusan-pagu"/>
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
              {/* <Button color="info" onClick={() => {this.setState({aksi:'Tambah'});this.modalCreate();}} className="mr-1">Tambah</Button> */}
            </Col> 
          </Row> 
          <Table responsive striped bordered>
            <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
            <tr>
            <th rowSpan="3">Kode</th>
            <th rowSpan="3">Program</th>
            <th rowSpan="3">Indikator Kinerka (Outcome)</th>
            <th rowSpan="3">Kondisi Kinerja pada Awal RPJMD (Tahun 0)</th>
              <th colSpan="22">Capaian Kerja</th>
              <th rowSpan="3">Penanggung Jawab</th>
              <th rowSpan="3">Aksi</th>
            </tr>
            <tr>
              <th colSpan="4">Tahun 1</th>
              <th colSpan="4">Tahun 2</th>
              <th colSpan="4">Tahun 3</th>
              <th colSpan="4">Tahun 4</th>
              <th colSpan="4">Tahun 5</th>
              <th colSpan="2">Kondisi Kinerja Akhir Periode</th>
            </tr>
            <tr>
            <th colSpan="2">Target</th>
              <th>Rp</th>
              <th>Lokasi</th>
              <th colSpan="2">Target</th>
              <th>Rp</th>
              <th>Lokasi</th>
              <th colSpan="2">Target</th>
              <th>Rp</th>
              <th>Lokasi</th>
              <th colSpan="2">Target</th>
              <th>Rp</th>
              <th>Lokasi</th>
              <th colSpan="2">Target</th>
              <th>Rp</th>
              <th>Lokasi</th>
              <th>Target</th>
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
            <th>(10)</th>
            <th>(11)</th>
            <th>(12)</th>
            <th>(13)</th>
            <th>(14)</th>
            <th>(15)</th>
            <th>(16)</th>
            <th>(17)</th>
            <th>(18)</th>
            <th>(19)</th>
            <th>(20)</th>
            <th>(21)</th>
            <th>(22)</th>
            <th>(23)</th>
            <th>(24)</th>
            <th>(25)</th>
            <th>(26)</th>
            <th>(27)</th>
            <th></th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataAll.map((data, key) => {
              return data ? (
                <tr key={key}>
                  <td>{data.Kd_Urusan+"."+data.Kd_Bidang+"."+data.Kd_Prog}</td>
                  <td>{data.Ket_Program}</td>
                  <td>{data.outcome}</td>
                  <td>{data.kondisi_awal}</td>
                  <td>{data.target1_tahun}</td>
                  <td>{data.target1_satuan_nama}</td>
                  <td>{data.target1_harga}</td>
                  <td>{data.target1_lokasi}</td>
                  <td>{data.target2_tahun}</td>
                  <td>{data.target2_satuan_nama}</td>
                  <td>{data.target2_harga}</td>
                  <td>{data.target2_lokasi}</td>
                  <td>{data.target3_tahun}</td>
                  <td>{data.target3_satuan_nama}</td>
                  <td>{data.target3_harga}</td>
                  <td>{data.target3_lokasi}</td>
                  <td>{data.target4_tahun}</td>
                  <td>{data.target4_satuan_nama}</td>
                  <td>{data.target4_harga}</td>
                  <td>{data.target4_lokasi}</td>
                  <td>{data.target5_tahun}</td>
                  <td>{data.target5_satuan_nama}</td>
                  <td>{data.target5_harga}</td>
                  <td>{data.target5_lokasi}</td>
                  
                  <td>{data.akhir_target}</td>
                  <td>{(parseInt(data.target1_harga)+parseInt(data.target2_harga)+parseInt(data.target3_harga)+parseInt(data.target4_harga)+parseInt(data.target5_harga))}</td>
                  <td>{data.Nm_Sub_Unit}</td>
                  <td>
                    <Button color="info" onClick={() => {this.setState({aksi:'Edit'});this.modalCreate(data);}} className="mr-1">Edit</Button>
                    
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
                          <Label htmlFor="text-input">Program</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" value={this.state.dataPilih.Nm_Program} disabled/>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Indikator Kinerka (Outcome)</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" value={this.state.dataPilih.outcome} disabled/>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Kondisi Kinerja pada Awal RPJMD (Tahun 0)</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" value={this.state.dataPilih.kondisi_awal} disabled/>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 1 Target</Label>
                        </Col>
                        <Col xs="12" md="4">
                          <Input type="text" value={this.state.dataPilih.target1_tahun} disabled/>
                        </Col>
                        <Col xs="12" md="3">
                          <Input type="text" value={this.state.dataPilih.target1_satuan_nama} disabled/>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 1 Harga *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="2" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.target1_harga} required autoFocus/>
                          <FormText color="muted">Isi Tahun 1 Harga</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 1 Lokasi *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="3" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.target1_lokasi} required autoFocus/>
                          <FormText color="muted">Isi Tahun 1 Lokasi</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 2 Target</Label>
                        </Col>
                        <Col xs="12" md="4">
                          <Input type="text" value={this.state.dataPilih.target2_tahun} disabled/>
                        </Col>
                        <Col xs="12" md="3">
                          <Input type="text" value={this.state.dataPilih.target2_satuan_nama} disabled/>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 2 Harga *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="4" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.target2_harga} required autoFocus/>
                          <FormText color="muted">Isi Tahun 2 Harga</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 2 Lokasi *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="5" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.target2_lokasi} required autoFocus/>
                          <FormText color="muted">Isi Tahun 2 Lokasi</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 3 Target</Label>
                        </Col>
                        <Col xs="12" md="4">
                          <Input type="text" value={this.state.dataPilih.target3_tahun} disabled/>
                        </Col>
                        <Col xs="12" md="3">
                          <Input type="text" value={this.state.dataPilih.target3_satuan_nama} disabled/>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 3 Harga *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="6" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.target3_harga} required autoFocus/>
                          <FormText color="muted">Isi Tahun 3 Harga</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 3 Lokasi *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="7" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.target3_lokasi} required autoFocus/>
                          <FormText color="muted">Isi Tahun 3 Lokasi</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 4 Target</Label>
                        </Col>
                        <Col xs="12" md="4">
                          <Input type="text" value={this.state.dataPilih.target4_tahun} disabled/>
                        </Col>
                        <Col xs="12" md="3">
                          <Input type="text" value={this.state.dataPilih.target4_satuan_nama} disabled/>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 4 Harga *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="8" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.target4_harga} required autoFocus/>
                          <FormText color="muted">Isi Tahun 4 Harga</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 4 Lokasi *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="9" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.target4_lokasi} required autoFocus/>
                          <FormText color="muted">Isi Tahun 4 Lokasi</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 5 Target</Label>
                        </Col>
                        <Col xs="12" md="4">
                          <Input type="text" value={this.state.dataPilih.target5_tahun} disabled/>
                        </Col>
                        <Col xs="12" md="3">
                          <Input type="text" value={this.state.dataPilih.target5_satuan_nama} disabled/>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 5 Harga *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="10" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.target5_harga} required autoFocus/>
                          <FormText color="muted">Isi Tahun 5 Harga</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tahun 5 Lokasi *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="11" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.target5_lokasi} required autoFocus/>
                          <FormText color="muted">Isi Tahun 5 Lokasi</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Akhir Target *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="12" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.akhir_target} required autoFocus/>
                          <FormText color="muted">Isi Akhir Target</FormText>
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

export default PerumusanPaguCreate;
