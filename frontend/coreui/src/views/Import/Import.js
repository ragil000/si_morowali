import React, { Component } from 'react';
import { FormText, Alert, FormGroup, Label, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';


class Import extends Component {
  
  constructor(props) {
    super(props);

    this.dataPilihAwal = {
      id:0,
      no_hp_ktp:'',
      username:'',
      level_id:0,
      password:'',
      aktif:0,
      kecamatan:'',
      kelurahan:'',
      dewan:'',
      dapil:'',
      admin:0,
      file:'',
    };

    this.state = {
      dataAll: [],
      jumlahPage: 1,
      modal: false,
      modalDelete: false,
      dataPilih: this.dataPilihAwal,
      pencarian: '',
      page: 1,
      aksi:'Tambah',
      fileForm: [],
      pesan:'',
      formGroupLevel:[],
      kecamatan:[],
      kelurahan:[],
      dapil:[],
    }
    
    this.toggleClose = this.toggleClose.bind(this);
    this.toggle = this.toggle.bind(this);
    this.toggleDelete = this.toggleDelete.bind(this);

    this.changePesan = this.changePesan.bind(this);
    this.setData = this.setData.bind(this);
    this.getData = this.getData.bind(this);

    this.handleDelete = this.handleDelete.bind(this);

    
    this.handleKecamatanChange = this.handleKecamatanChange.bind(this);
    this.handleKelurahanChange = this.handleKelurahanChange.bind(this);
    
    this.handlePencarianChange = this.handlePencarianChange.bind(this);
    this.handleUsernameChange = this.handleUsernameChange.bind(this);
    this.handleEmailChange = this.handleEmailChange.bind(this);
    this.handleLevelChange = this.handleLevelChange.bind(this);
    this.handlePasswordChange = this.handlePasswordChange.bind(this);
  }

  // handleFileChange = event => {
  //   this.setState({ fileForm: event.target.files[0]});
  // }

  handleDelete = () =>{
    // console.log(this.state.dataPilih);
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('id', this.state.dataPilih.id);
    axios
    .post(config.apiRoot+'akun/delete', data)
    .then(response => {
      if(response.data.status){
        this.toggleDelete();
        // this.getData();
      }
      this.changePesan(response.data.pesan);
      // console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  changePesan = (e = null, status = 'success') =>{
    if(e === null){
      this.setState({pesan: ''});
    }else{
      this.setState({pesan: <Alert color={status}>{e}</Alert>});
      // setTimeout(this.setState({pesan:''}), 5000);
    }
    setTimeout(()=>{ this.setState({pesan: ''}); }, 3000);
  }

  handleUsernameChange = event => {
    let setData = this.state.dataPilih;
    setData.username = event.target.value;
    this.setState({ dataPilih: setData});
  }

  

  handleEmailChange = event => {
    let setData = this.state.dataPilih;
    setData.no_hp_ktp = event.target.value;
    this.setState({ dataPilih: setData});
  }

  handleKecamatanChange = event =>{
    let setData = this.state.dataPilih;
    setData.kecamatan = event.target.value;
    this.setState({ dataPilih: setData});
    this.getKelurahan();
    
  }

  handleKelurahanChange = event =>{
    let setData = this.state.dataPilih;
    setData.kelurahan = event.target.value;
    this.setState({ dataPilih: setData});
    this.formGroupLevel();
  }


  handleLevelChange = event => {
    let setData = this.state.dataPilih;
    setData.level_id = event.target.value;
    this.setState({ dataPilih: setData});
    this.formGroupLevel();
  }

  handleDewanChange = event => {
    let setData = this.state.dataPilih;
    setData.dewan = event.target.value;
    this.setState({ dataPilih: setData});
    this.formGroupLevel();
  }

  handleDapilChange = event => {
    let setData = this.state.dataPilih;
    setData.dapil = event.target.value;
    this.setState({ dataPilih: setData});
    this.formGroupLevel();
  }

  formGroupLevel = () => {
    var kosong ='';
    var kelurahan = (
      <div>
        <FormGroup row>
          <Col md="3">
            <Label htmlFor="text-input">Pilih Kecamatan *</Label>
          </Col>
          <Col xs="12" md="9">
            <Input type="select" id="kecamatan" placeholder="" onChange={this.handleKecamatanChange} value={this.state.dataPilih.kecamatan} required autoFocus>
            <option key={-1} value="">-= Pilih Kecamatan =-</option>
              {this.state.kecamatan.map((data, key) => {
                return data ? (
                  <option key={key} value={data.Kd_Kec}>{data.Nm_Kec}</option>
                ) : (null);
              })}
            </Input>
            <FormText color="muted">Isi Kecamatan</FormText>
          </Col>
        </FormGroup>
        <FormGroup row>
          <Col md="3">
            <Label htmlFor="text-input">Pilih Kelurahan *</Label>
          </Col>
          <Col xs="12" md="9">
            <Input type="select" id="kelurahan" placeholder="" onChange={this.handleKelurahanChange} value={this.state.dataPilih.kelurahan} required autoFocus>
            <option value="">-= Pilih Kelurahan =-</option>
              {this.state.kelurahan.map((data, key) => {
                return data ? (
                  <option key={key} value={data.Kd_Kel+'-'+data.Kd_Urut}>{data.Nm_Kel}</option>
                ) : (null);
              })}
            </Input>
            <FormText color="muted">Isi Kecamatan</FormText>
          </Col>
        </FormGroup>
      </div>
    );

    var kecamatan =(
      <FormGroup row>
        <Col md="3">
          <Label htmlFor="text-input">Pilih Kecamatan *</Label>
        </Col>
        <Col xs="12" md="9">
          <Input type="select" id="kecamatan" placeholder="" onChange={this.handleKecamatanChange} value={this.state.dataPilih.kecamatan} required autoFocus>
          <option key={-1} value="">-= Pilih Kecamatan =-</option>
            {this.state.kecamatan.map((data, key) => {
              return data ? (
                <option key={key} value={data.Kd_Kec}>{data.Nm_Kec}</option>
              ) : (null);
            })}
          </Input>
          <FormText color="muted">Isi Kecamatan</FormText>
        </Col>
      </FormGroup>
    );

    var pokir =(
      <div>
        <FormGroup row>
          <Col md="3">
            <Label htmlFor="text-input">Nama Dewan *</Label>
          </Col>
          <Col xs="12" md="9">
            <Input type="text" id="dewan" placeholder="" onChange={this.handleDewanChange} value={this.state.dataPilih.dewan} required autoFocus/>
            <FormText color="muted">Isi Dewan</FormText>
          </Col>
        </FormGroup>
        <FormGroup row>
          <Col md="3">
            <Label htmlFor="text-input">Pilih Dapil *</Label>
          </Col>
          <Col xs="12" md="9">
            <Input type="select" id="dapil" placeholder="" onChange={this.handleDapilChange} value={this.state.dataPilih.dapil} required autoFocus>
            <option key={-1} value="">-= Pilih Kecamatan =-</option>
              {this.state.dapil.map((data, key) => {
                return data ? (
                  <option key={key} value={data.Kd_Dapil}>{data.Nm_Dapil}</option>
                ) : (null);
              })}
            </Input>
            <FormText color="muted">Isi Kecamatan</FormText>
          </Col>
        </FormGroup>
      </div>
    );



    // console.log(this.state.dataPilih.level_id);
    if(parseInt(this.state.dataPilih.level_id) === 1){
      this.setState({formGroupLevel: kelurahan});
    }else if(parseInt(this.state.dataPilih.level_id) === 2){
      this.setState({formGroupLevel: kecamatan});
    }else if(parseInt(this.state.dataPilih.level_id) === 3){
      this.setState({formGroupLevel: pokir});
    }else{
      this.setState({formGroupLevel: kosong});
    }
  }

  handlePasswordChange = event => {
    let setData = this.state.dataPilih;
    setData.password = event.target.value;
    this.setState({ dataPilih: setData});
  }

  handlePencarianChange = event => {
    this.setState({ pencarian: event.target.value});
  }

  handleCariSubmit = event => {
    event.preventDefault();
    this.getData();
  }

  handleFileChange = event => {
    let setData = this.state.dataPilih;
    setData.file = event.target.files[0];
    this.setState({ dataPilih: setData});
    // console.log(event.target.files);
  }

  handleSubmit = event => {
    event.preventDefault();
    let link = '';
    if(this.state.aksi === 'Edit'){
      link = config.apiRoot+'akun/update';
      
    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+'akun/create';
    }
    // console.log(this.state.dataPilih);
    
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('username', this.state.dataPilih.username);
    data.append('email', this.state.dataPilih.no_hp_ktp);
    data.append('level', this.state.dataPilih.level_id);
    data.append('password', this.state.dataPilih.password);
    data.append('kecamatan', this.state.dataPilih.kecamatan);
    data.append('kelurahan', this.state.dataPilih.kelurahan);
    data.append('dapil', this.state.dataPilih.dapil);
    data.append('dewan', this.state.dataPilih.dewan);
    data.append('id', this.state.dataPilih.id);
    axios
    .post(link, data, head)
    .then(response => {
      if(response.data.status){
        this.toggleClose();
        // this.getData();
      }
      this.changePesan(response.data.pesan);
      // console.log(response);
    })
    .catch(error=>{
      this.changePesan('Gagal melakukan aksi');
    });
  }

  toggleClose(e = []) {
    this.setState({
      modal: false,
    });
    
  }

  toggle(e = []) {
    
    if(e.length === 0){
      this.setState({
        modal: true,
        dataPilih: this.dataPilihAwal
      });
      
    }else{
      this.setState({
        modal: true,
        dataPilih: e
      });
      // console.log(e);
    }
    
  }
  toggleDelete(e = []) {
    this.setState({
      modalDelete: !this.state.modalDelete,
      dataPilih: e
    });
  }

  componentWillMount = () => {
    // this.getData();
    this.getKecamatan();
    this.getDapil();
  }

  setData = (dataAll) => {
    if(dataAll.status){
      this.setState({ dataAll: dataAll.data, jumlahPage: dataAll.jumlahPage});
    }
    // console.log(dataAll);
  }

  getData = (page = 1) => {
    //page = this.state.page;
    let data = new FormData();
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('file', this.state.dataPilih.file );
    axios
    .post(config.apiRoot+'data/import', data, head)
    .then(response => {
      // this.setData(response.data)
      console.log(response);
      this.changePesan(response.data.pesan);
    })
    .catch(function (error) {
      console.log(error);
      
    });
  }

  getKecamatan = () => {
    //page = this.state.page;
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    axios
    .post(config.apiRoot+'getData/kecamatan', data)
    .then(response => {
      if(response.data.status){
        this.setState({kecamatan: response.data.data,});
      }
      // console.log(this.state.kecamatan);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  getKelurahan = () => {
    //page = this.state.page;
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('kecamatan', this.state.dataPilih.kecamatan);
    axios
    .post(config.apiRoot+'getData/kelurahan', data)
    .then(response => {
      if(response.data.status){
        this.setState({kelurahan: response.data.data});
        this.formGroupLevel();
        // console.log(this.state.dataPilih);
      }
      // console.log(this.state.kelurahan);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  getDapil = () => {
    //page = this.state.page;
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    axios
    .post(config.apiRoot+'getData/dapil', data)
    .then(response => {
      if(response.data.status){
        this.setState({dapil: response.data.data});
        this.formGroupLevel();
        // console.log(this.state.dataPilih);
      }
      // console.log(this.state.kelurahan);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

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
                {this.state.pesan}
                <Modal isOpen={this.state.modal} toggle={this.toggleClose} className={'modal-lg ' + this.props.className}>
                  <ModalHeader toggle={this.toggleClose}>{this.state.aksi} Data</ModalHeader>
                  <Form method="post"  onSubmit={this.handleSubmit} className="form-horizontal" id="form-data">
                    <ModalBody>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Username *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="username" placeholder="" onChange={this.handleUsernameChange} value={this.state.dataPilih.username} required autoFocus/>
                          <FormText color="muted">Isi Username</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Nomor Hp / KTP *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="number" id="email" placeholder="" onChange={this.handleEmailChange} value={this.state.dataPilih.no_hp_ktp} required autoFocus/>
                          <FormText color="muted">Isi Nomor Hp / KTP</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Level *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" id="level" placeholder="" onChange={this.handleLevelChange} value={this.state.dataPilih.level_id} required autoFocus>
                          <option value="">Pilih Level</option>
                          <option value="1">Kelurahan</option>
                          <option value="2">Kecamatan</option>
                          <option value="3">Pokir</option>
                          {/* <option value="4">OPD</option> */}
                          <option value="5">Admin</option>
                          {/* <option value="6">Super Admin</option> */}
                          </Input>

                          <FormText color="muted">Isi Level</FormText>
                        </Col>
                      </FormGroup>
                      {this.state.formGroupLevel}
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Password *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="password" id="password" onChange={this.handlePasswordChange} placeholder=""  required autoFocus/>
                          <FormText color="muted">Isi Password</FormText>
                        </Col>
                      </FormGroup>
                    </ModalBody>
                    <ModalFooter>
                      <Button color="primary" type="submit" form="form-data" value="Submit">{this.state.aksi} Data</Button>
                      <Button color="secondary" onClick={this.toggleClose}>Cancel</Button>
                    </ModalFooter>
                  </Form>
                </Modal>
                
                <Modal isOpen={this.state.modalDelete} toggle={this.toggleDelete} className={ this.props.className}>
                  <ModalHeader toggle={this.toggleDelete}>Hapus Data</ModalHeader>
                  <ModalBody>
                    Apakah Anda Yakin Menghapus Data {this.state.dataPilih.nama}?
                  </ModalBody>
                  <ModalFooter>
                    <Button color="danger" onClick={this.handleDelete}>Ya</Button>{' '}
                    <Button color="secondary" onClick={this.toggleDelete}>Batal</Button>
                  </ModalFooter>
                </Modal>
                <Row>
                <Col xs="128" md="10">
                
                <Form method="post" onSubmit={this.handleCariSubmit} className="form-horizontal">
                  <FormGroup row>
                    <Col xs="9" md="5">
                    <Input type="file" onChange={this.handleFileChange} name="file" />
                    </Col>
                    <Col xs="3" md="2">
                      <Button color="primary" >Cari</Button>
                    </Col>
                  </FormGroup>
                </Form>
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

export default Import;
