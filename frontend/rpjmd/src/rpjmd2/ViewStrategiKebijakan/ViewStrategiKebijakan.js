import React, { Component } from 'react';
import { FormText, Alert, FormGroup, Label, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';


class ViewStrategiKebijakan extends Component {
  
  constructor(props) {
    super(props);

    this.dataPilihAwal = {
      strategi_kebijakan_id:'',
      misi_id:'',
      tujuan_id:'',
      sasaran_id:'',
      indikator_id:'',
      tujuan_sasaran_id:'',
      strategi_pembangunan:'',
      arah_kebijakan:'',
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
      dataTujuanSasaran:[],
      dataIsuStrategi:[],
      dataIndikator:[],
      dataSasaran:[],
      dataMisi:[],
      pencarian: '',
      page: 1,
      aksi:'Tambah',
    }

    document.title = "Menyusun Perumusan Isu Strategis";
    
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
      setData.tujuan_id = event.target.value;
      setData.sasaran_id = '';
      this.getSasaran(event.target.value);
    }else if(no===3){
      setData.sasaran_id = event.target.value;
      setData.indikator_id = '';
      this.getIndikator(event.target.value);
    }else if(no===4){
      setData.indikator_id = event.target.value;
      setData.tujuan_sasaran_id = '';
      this.getTujuanSasaran(event.target.value);      
    }else if(no===5){
      setData.tujuan_sasaran_id = event.target.value;
    }else if(no===6){
      setData.Kd_Urusan = event.target.value;
    }else if(no===7){
      setData.Kd_Bidang = event.target.value;
    }else if(no===8){
      setData.strategi_pembangunan  = event.target.value;
    }else if(no===9){
      setData.arah_kebijakan = event.target.value;
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
      this.setState({
        modalCreate: true,
        dataPilih: e
      });
      
      this.getTujuan(e.misi_id);
      this.getSasaran(e.tujuan_id);
      this.getIndikator(e.sasaran_id);
      this.getTujuanSasaran(e.indikator_id);
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
        dataMisi:dataAll.dataMisi,
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
    .post(config.apiRoot+'rpjmd/menyusun/strategi-kebijakan/page-'+page, data)
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

  getTujuanSasaran = (id) => {
    
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
  getTujuanSasaran

///. set data

// submit
  handleSubmit = event => {
    event.preventDefault();
    this.setState({ loading: true });
    let link = '';
    if(this.state.aksi === 'Edit'){
      link = config.apiRoot+'rpjmd/menyusun/strategi-kebijakan/update';

    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+'rpjmd/menyusun/strategi-kebijakan/create';
    }
    // console.log(this.state.dataPilih.visi_id);
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('strategi_kebijakan_id', this.state.dataPilih.strategi_kebijakan_id);
    data.append('misi_id', this.state.dataPilih.misi_id);
    data.append('tujuan_id', this.state.dataPilih.tujuan_id);
    data.append('sasaran_id', this.state.dataPilih.sasaran_id);
    data.append('indikator_id', this.state.dataPilih.indikator_id);
    data.append('tujuan_sasaran_id', this.state.dataPilih.tujuan_sasaran_id);
    data.append('strategi_pembangunan', this.state.dataPilih.strategi_pembangunan);
    data.append('arah_kebijakan', this.state.dataPilih.arah_kebijakan);
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
    data.append('strategi_kebijakan_id', this.state.dataPilih.strategi_kebijakan_id);
    axios
    .post(config.apiRoot+'rpjmd/menyusun/strategi-kebijakan/delete', data)
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
          <Table responsive striped bordered>
          <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
            <tr>
              <th>No</th>
              <th>Misi</th>
              <th>Tujuan</th>
              <th>Bidang</th>
              <th>Urusan</th>
              <th>Sasaran</th>
              <th>Indikator</th>
              <th>Strategi Pembangunan</th>
              <th>Arah Kebijakan</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataAll.map((data, key) => {
              return data ? (
                <tr key={key}>
                  <td>{((this.state.page-1)*20)+key+1}</td>
                  <td>{data.misi_nama}</td>
                  <td>{data.tujuan_nama}</td>
                  <td>{data.Nm_Bidang}</td>
                  <td>{data.Nm_Urusan}</td>
                  <td>{data.sasaran_nama}</td>
                  <td>{data.indikator_nama}</td>
                  <td>{data.strategi_pembangunan}</td>
                  <td>{data.arah_kebijakan}</td>
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
                          <Input type="select" data-number="2" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tujuan_id} required autoFocus>
                          <option key="-1" value="">-= Pilih Tujuan RPJMD =-</option>
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
                          <Input type="select" data-number="3" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.sasaran_id} required autoFocus>
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
                          <Input type="select" data-number="4" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.indikator_id} required autoFocus>
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
                          <Label htmlFor="text-input">Isu Strategi *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" data-number="5" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tujuan_sasaran_id} required autoFocus>
                          <option key="-1" value="">-= Pilih Kondisi Awal =-</option>
                          {this.state.dataTujuanSasaran.map((data, key) => {
                            return data ? (
                              <option key={key} value={data.tujuan_sasaran_id}>{data.tujuan_sasaran_kondisi_awal}</option>
                            ) : (null);
                          })}
                          </Input>
                          <FormText color="muted">Pilih Isu Strategi </FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Bidang *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="6" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.Nm_Bidang} disabled required autoFocus/>
                          <FormText color="muted">Isi Bidang</FormText>
                        </Col>
                      </FormGroup>      
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Urusan *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="7" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.Nm_Urusan} disabled required autoFocus/>
                          <FormText color="muted">Isi Urusan</FormText>
                        </Col>
                      </FormGroup>    
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Strategi Pembangunan *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="8" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.strategi_pembangunan} required autoFocus/>
                          <FormText color="muted">Isi Strategi Pembangunan</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Arah Kebijakan *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="9" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.arah_kebijakan} required autoFocus/>
                          <FormText color="muted">Isi Arah Kebijakan</FormText>
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

export default ViewStrategiKebijakan;
