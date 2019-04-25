import React, { Component } from 'react';
import { TabPane, TabContent, Badge, Nav, NavItem, NavLink, FormText, Alert, FormGroup, Label, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';


class Kelurahan extends Component {
  
  constructor(props) {
    super(props);

    this.dataPilihAwal = {
      token:'',
      id:0,
      nama:'',
      alasan:'',
      lokasi:'',
      volume:0,
      satuan:0,
      pagu:'0',
      manfaat:'',
      pengusul:'',
      file:{foto:''},
      kategori:0,
    };

    this.state = {
      dataAll: [],
      dataSatuan: [],
      dataKiriman:[],
      dataKategori:[],
      jumlahPage: 1,
      jumlahAll: 0,
      modal: false,
      modalDelete: false,
      modalUsulan: false,
      dataPilih: this.dataPilihAwal,
      pencarian: '',
      page: 1,
      aksi:'Tambah',
      fileForm: [],
      pesan:'',
      activeTab: new Array(4).fill('1'),
      berkasBA:'',
      berkasUsulan:'',
    }
    
    this.toggleTab = this.toggleTab.bind(this);

    this.toggleClose = this.toggleClose.bind(this);
    this.toggle = this.toggle.bind(this);
    this.toggleDelete = this.toggleDelete.bind(this);

    this.modalUsulan = this.modalUsulan.bind(this);

    

    this.changePesan = this.changePesan.bind(this);
    this.setData = this.setData.bind(this);
    this.getData = this.getData.bind(this);
    this.getKiriman = this.getKiriman.bind(this);
    
    this.handleKategoriChange = this.handleKategoriChange.bind(this);

    this.getSatuan = this.getSatuan.bind(this);

    this.getGrup = this.getGrup.bind(this);

    this.handleDelete = this.handleDelete.bind(this);

    this.handlePencarianChange = this.handlePencarianChange.bind(this);

    this.handleNamaChange = this.handleNamaChange.bind(this);
    this.handleAlasanChange = this.handleAlasanChange.bind(this);
    this.handleLokasiChange = this.handleLokasiChange.bind(this);
    this.handleVolumeChange = this.handleVolumeChange.bind(this);
    this.handleSatuanChange = this.handleSatuanChange.bind(this);
    this.handlePaguChange = this.handlePaguChange.bind(this);
    this.handleManfaatChange = this.handleManfaatChange.bind(this);
    this.handlePengusulChange = this.handlePengusulChange.bind(this);
    this.handleFileChange = this.handleFileChange.bind(this);

    this.handleBAChange = this.handleBAChange.bind(this);
    this.handleUsulanChange = this.handleUsulanChange.bind(this);
    this.handleBerkasSubmit = this.handleBerkasSubmit.bind(this);
    this.submitKirimBerkas = this.submitKirimBerkas.bind(this);
    
    this.cekGrup = this.cekGrup.bind(this);
    
    
  }

  

  cekGrup = () => {
    if(!localStorage.getItem('codexv-token-kelurahan')){
      localStorage.setItem("codexv-token-kelurahan", '');

    }
  }

  ///tab
  lorem() {
    return 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.'
  }

  setPosisi(id){
    var posisi = '';

    if(parseInt(id) === 1){
      posisi = 'Menunggu Mendownload Berita Acara';
    }else if(parseInt(id) === 2){
      posisi = 'Menunggu Input Usulan';
    }else if(parseInt(id) === 3){
      posisi = 'Menunggu Upload Berkas';
    }else if(parseInt(id) === 4){
      posisi = 'Siap Untuk Dikirim ke Kecamatan';
    }else if(parseInt(id) === 5){
      posisi = 'Usulan Telah Terkirim';
    }

    return (<div>{posisi}</div>);
  }

  getAsal(set, kiriman = false){
    var asal='';
    if(!kiriman){
      if(parseInt(set) === 1){
        asal = 'Kelurahan';
      }else if(parseInt(set) === 2){
        asal = 'Kecamatan';
      }
    }else{
      if(parseInt(set) === 0){
        asal = 'Kecamatan';
      }else{
        asal = 'Kelurahan';
      }
    }
    
    // console.log(asal);
    return (<p>{asal}</p>);
  }

  mulaiUsulanBaru(){
    return (
      <div>
        <Button color="secondary"onClick={() => this.modalUsulan()} >Memulai Usulan</Button>
          <Table responsive striped>
            <thead>
            <tr>
              <th>Grup ID</th>
              <th>Tanggal Pembuatan</th>
              <th>Asal Pembuatan</th>
              <th>Posisi</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataKiriman.map((data, key) => {
              return data ? (
                <tr key={key}>
                  <td>{data.id}</td>
                  <td>{data.tgl}</td>
                  <td>{this.getAsal(data.user_kel, true)}</td>
                  <td>{this.setPosisi(data.posisi)}</td>
                  <td>
                    <Button color="info" onClick={() => {this.getGrupKiriman(data);}} className="mr-1">Periksa</Button>
                    {/* <Button color="danger" onClick={() => this.toggleDelete(data)} className="mr-1">Abaikan</Button> */}
                  
                    <Form method="post" action={config.apiRoot+'data/export/kelurahan'} target="_blank">
                      <Input  type="hidden" name="session" value={localStorage.getItem('codexv-session')}/>
                      <Input  type="hidden" name="id" value={data.id}/>
                      <Input  type="hidden" name="jenis" value="kelurahan"/>
                      <Button color="secondary">Export</Button>
                    </Form>
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

  downloadBA(){
    return (
      <Form method="post" action={config.apiRoot+'kelurahan/get-pdf/berita-acara-kelurahan'} target="_blank">
        <Input  type="hidden" name="session" value={localStorage.getItem('codexv-session')}/>
        <Input  type="hidden" name="token" value={localStorage.getItem('codexv-token-kelurahan')}/>
        <Input  type="hidden" name="jenis" value="ba"/>
        <FormGroup row>
          <Col md="2">
            <Label htmlFor="text-input">Masukkan Jumlah Peserta</Label>
          </Col>
          <Col xs="12" md="3">
          <Input  type="number" name="orang"/>
          </Col>
        </FormGroup>
        
        <Button color="secondary" >Download Berita Acara</Button>
      </Form>
    )
  }

  downloadUsulan(){
    return (
      <Form method="post" action={config.apiRoot+'kelurahan/get-pdf/usulan-kelurahan'} target="_blank">
        <Input  type="hidden" name="session" value={localStorage.getItem('codexv-session')}/>
        <Input  type="hidden" name="token" value={localStorage.getItem('codexv-token-kelurahan')}/>
        <Input  type="hidden" name="jenis" value="usulan"/>
        <Button color="secondary">Download Usulan</Button>
      </Form>
    )
  }

  inputUsulan(){
    return (
      <div className="animated fadeIn">
      <Row>
        <Col xs="128" md="10">
        <Form method="post" onSubmit={this.handleCariSubmit} className="form-horizontal">
          <FormGroup row>
            <Col xs="9" md="5">
              <Input type="text" onChange={this.handlePencarianChange} id="text-input-pencarian" name="pencarian" placeholder="Pencarian" />
            </Col>
            <Col xs="3" md="2">
              <Button color="primary" >Cari</Button>
            </Col>
          </FormGroup>
        </Form>
        </Col>
        <Col xs="12" md="2">
          <Button color="primary" onClick={() => {this.setState({aksi:'Tambah'});this.toggle();}} className="mr-1">Tambah Usulan</Button>
        </Col>   
        </Row>      
        <Table responsive striped>
          <thead>
          <tr>
            <th>Nama Usulan</th>
            <th>Alasan Usulan</th>
            <th>Lokasi Detail</th>
            <th>Volume Usulan</th>
            <th>Satuan Usulan</th>
            <th>Pagu Anggaran</th>
            <th>Penerima Manfaat</th>
            <th>Nama Pengusul</th>
            <th>Kategori</th>
            <th>File</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
          {this.state.dataAll.map((data, key) => {
            return data ? (
              <tr key={key}>
                <td>{data.nama}</td>
                <td>{data.alasan}</td>
                <td>{data.lokasi}</td>
                <td>{data.volume}</td>
                <td>{data.nama_satuan}</td>
                <td>{data.pagu}</td>
                <td>{data.manfaat}</td>
                <td>{data.pengusul}</td>
                <td>{data.kategori}</td>
                <td>
                {this.downloadGambar(data.file)}
                {this.downloadFileBA(data.berkas_ba)}
                {this.downloadFileUsulan(data.berkas_usulan)}
                </td>
                <td>
                  <Button color="info" onClick={() => {this.setState({aksi:'Edit'});this.toggle(data);}} className="mr-1">Edit</Button>|
                  <Button color="danger" onClick={() => this.toggleDelete(data)} className="mr-1">Delete</Button>
                </td>
              </tr>
            ) : (null);
          })}
          </tbody>
        </Table>
        {this.pageNation()}
        </div>
    )
  }
  

  uploadBerkas(){
    return (
      <Form method="post" onSubmit={this.handleBerkasSubmit} id="form-upload-berkas">
        <FormGroup row>
          <Col md="2">
            <Label htmlFor="file-multiple-input">Upload Berita Acara dan Absen</Label>
          </Col>
          <Col xs="12" md="10">
            <Input type="file" id="berita" onChange={this.handleBAChange} />
          </Col>
        </FormGroup>
        <FormGroup row>
          <Col md="2">
            <Label htmlFor="file-multiple-input">Upload Lampiran Usulan</Label>
          </Col>
          <Col xs="12" md="10">
            <Input type="file" id="usulan" onChange={this.handleUsulanChange} />
          </Col>
        </FormGroup>
        <Button color="primary" type="submit" form="form-upload-berkas" value="Submit">Upload Berkas</Button>
        
      </Form>
    )
  }

  kirimUsulan(){
    return (
      <Form method="post" onSubmit={this.submitKirimBerkas} id="form-kirim-berkas">
        <Button color="secondary">Kirim Berkas Ke Kecamatan</Button>
      </Form>
    )
  }

  toggleTab(tabPane, tab) {
    const newArray = this.state.activeTab.slice()
    newArray[tabPane] = tab
    this.setState({
      activeTab: newArray,
    });
  }

  tabPane() {
    return (
      <>
        <TabPane tabId="1">
          {this.mulaiUsulanBaru()}
        </TabPane>
        <TabPane tabId="2">
          {this.downloadBA()}
        </TabPane>
        <TabPane tabId="3">
          {this.inputUsulan()}
        </TabPane>
        <TabPane tabId="4">
          {this.downloadUsulan()}
        </TabPane>
        <TabPane tabId="5">
          {this.uploadBerkas()}
        </TabPane>
        <TabPane tabId="6">
          {this.kirimUsulan()}
        </TabPane>
      </>
    );
  }

  //. tab

  // handleFileChange = event => {
  //   this.setState({ fileForm: event.target.files[0]});
  // }

  downloadGambar = (foto) =>{
    return (
      <Form method="post" action={config.apiRoot+'attachments/foto-kelurahan/'+foto} target="_blank">
        <Input  type="hidden" name="session" value={localStorage.getItem('codexv-session')}/>
        <Button color="success"><i className="fa fa-file-photo-o"> Foto</i></Button>
      </Form>
    );
  }

  downloadFileUsulan = (file) =>{
    if(file !== ''){
      return (
        <Form method="post" action={config.apiRoot+'attachments/usulan-kelurahan/'+file} target="_blank">
          <Input  type="hidden" name="session" value={localStorage.getItem('codexv-session')}/>
          <Button color="info"><i className="fa fa-file-pdf-o"> Usulan</i></Button>
        </Form>
      );
    }
  }

  downloadFileBA = (file) =>{
    if(file !== ''){
      return (
        <Form method="post" action={config.apiRoot+'attachments/berita-acara-kelurahan/'+file} target="_blank">
          <Input  type="hidden" name="session" value={localStorage.getItem('codexv-session')}/>
          <Button color="primary"><i className="fa fa-file-pdf-o"> Berita Acara</i></Button>
        </Form>
      );
    }
    
  }

  handleDelete = () =>{
    // console.log(this.state.dataPilih);
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('token', localStorage.getItem('codexv-token-kelurahan'));
    data.append('id', this.state.dataPilih.id);
    axios
    .post(config.apiRoot+'kelurahan/delete', data)
    .then(response => {
      if(response.data.status){
        this.toggleDelete();
        this.getData();
        
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
      // setTimeout(this.setState({pesan:''}), 2000);
      
    }
    setTimeout(()=>{ this.setState({pesan: ''}); }, 3000);
  }

  handleNamaChange = event => {
    let setData = this.state.dataPilih;
    setData.nama = event.target.value;
    this.setState({ dataPilih: setData});
  }

  handleAlasanChange = event => {
    let setData = this.state.dataPilih;
    setData.alasan = event.target.value;
    this.setState({ dataPilih: setData});
  } 

  handleLokasiChange = event => {
    let setData = this.state.dataPilih;
    setData.lokasi = event.target.value;
    this.setState({ dataPilih: setData});
  }

  handleVolumeChange = event => {
    let setData = this.state.dataPilih;
    setData.volume = event.target.value;
    this.setState({ dataPilih: setData});
  }

  handleSatuanChange = event => {
    let setData = this.state.dataPilih;
    setData.satuan = event.target.value;
    this.setState({ dataPilih: setData});
  }

  handlePaguChange = event => {
    let setData = this.state.dataPilih;
    setData.pagu = event.target.value;
    this.setState({ dataPilih: setData});
  }

  handleManfaatChange = event => {
    let setData = this.state.dataPilih;
    setData.manfaat = event.target.value;
    this.setState({ dataPilih: setData});
  }

  handlePengusulChange = event => {
    let setData = this.state.dataPilih;
    setData.pengusul = event.target.value;
    this.setState({ dataPilih: setData});
  }

  handleFileChange = event => {
    let setData = this.state.dataPilih;
    setData.file = {foto: event.target.files[0]};
    this.setState({ dataPilih: setData});
    console.log(event.target.files);
  }

  handleKategoriChange = event => {
    let setData = this.state.dataPilih;
    setData.kategori = event.target.value;
    this.setState({ dataPilih: setData});
  }

  handlePencarianChange = event => {
    this.setState({ pencarian: event.target.value});
  }

  handleUsulanChange = event => {
    this.setState({ berkasUsulan: event.target.files[0]});
  }

  handleBAChange = event => {
    this.setState({ berkasBA: event.target.files[0]});
  }

  handleBerkasSubmit = (event) => {
    // console.log('upload berkas');
    event.preventDefault();
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('token', localStorage.getItem('codexv-token-kelurahan'));
    data.append('ba', this.state.berkasBA);
    data.append('usulan', this.state.berkasUsulan);
    
    axios
    .post(config.apiRoot+'kelurahan/upload-berkas', data, head)
    .then(response => {
      if(response.data.status){
        this.getData();
      }

      // this.toggleClose();
      this.changePesan(response.data.pesan);
      console.log(response.data);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  handleCariSubmit = event => {
    event.preventDefault();
    this.getData();
  }

  submitKirimBerkas = event => {
    event.preventDefault();

    let link = config.apiRoot+'kelurahan/kirim-berkas';
      
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('token', localStorage.getItem('codexv-token-kelurahan'));
    
    axios
    .post(link, data, head)
    .then(response => {
      if(response.data.status){
        // this.toggleClose();
        this.getData();
      }

      // this.toggleClose();
      this.changePesan(response.data.pesan);
      console.log(response.data);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  handleSubmit = event => {
    event.preventDefault();
    let link = '';
    if(this.state.aksi === 'Edit'){
      link = config.apiRoot+'kelurahan/update';
      
    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+'kelurahan/create';
    }
    // console.log(this.state.dataPilih);
    
    
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('id', this.state.dataPilih.id);
    data.append('token', localStorage.getItem('codexv-token-kelurahan'));
    data.append('nama', this.state.dataPilih.nama);
    data.append('alasan', this.state.dataPilih.alasan);
    data.append('lokasi', this.state.dataPilih.lokasi);
    data.append('volume', this.state.dataPilih.volume);
    data.append('satuan', this.state.dataPilih.satuan);
    data.append('pagu', this.state.dataPilih.pagu);
    data.append('manfaat', this.state.dataPilih.manfaat);
    data.append('pengusul', this.state.dataPilih.pengusul);
    data.append('file', this.state.dataPilih.file.foto );
    data.append('kategori', this.state.dataPilih.kategori );
    // console.log(this.state.dataPilih.file[0].foto);
    axios
    .post(link, data, head)
    .then(response => {
      if(response.data.status){
        this.toggleClose();
        this.getData();
      }

      // this.toggleClose();
      this.changePesan(response.data.pesan);
      console.log(response.data);
    })
    .catch(function (error) {
      console.log(error);
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

  modalUsulan() {
    this.setState({
      modalUsulan: !this.state.modalUsulan  ,
    });
  }

  componentWillMount = () => {
    this.cekGrup();
    this.getData();
    this.getSatuan();
    this.getKiriman();
  }

  setData = (dataAll) => {
    if(dataAll.status){
      this.setState({ dataAll: dataAll.data, jumlahPage: dataAll.jumlahPage, jumlahAll: dataAll.jumlahAll, dataKategori:dataAll.kategori});
    }
    // console.log(dataAll);
  }

  getData = (page = 1) => {
    //page = this.state.page;
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('token', localStorage.getItem('codexv-token-kelurahan'));
    data.append('search', this.state.pencarian);
    axios
    .post(config.apiRoot+'kelurahan/page-'+page, data)
    .then(response => {
      this.setData(response.data)
      console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  getKiriman = (page = 1) => {
    //page = this.state.page;
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('token', localStorage.getItem('codexv-token-kelurahan'));
    data.append('search', this.state.pencarian);
    axios
    .post(config.apiRoot+'kelurahan/kiriman/page-'+page, data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataKiriman: response.data.data, jumlahPageKiriman: response.data.jumlahPage, jumlahAllKiriman: response.data.jumlahAll});
      }
      console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  getGrup = () => {
    //page = this.state.page;
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    axios
    .post(config.apiRoot+'kelurahan/createGrup', data)
    .then(response => {
      if(response.data.status){
        localStorage.setItem("codexv-token-kelurahan", response.data.token);
        let setData = this.state.dataPilih;
        setData.token = response.data.token;
        this.setState({ dataPilih: setData});
        // console.log(this.state.dataPilih);
        this.getData();
        this.modalUsulan();
        this.toggleTab(3, '2');
      }
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  getSatuan = () => {
    //page = this.state.page;
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    axios
    .post(config.apiRoot+'getData/satuan', data)
    .then(response => {
      //this.setData(response.data)
      if(response.data.status){
        this.setState({ dataSatuan: response.data.data});
      }
      // console.log(response.data.status)
      // console.log(this.state.dataSatuan);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  getGrupKiriman = (e) => {
    //page = this.state.page;
    
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('id', e.id);
    axios
    .post(config.apiRoot+'kelurahan/get-grup', data)
    .then(response => {
      if(response.data.status){
        localStorage.setItem("codexv-token-kelurahan", response.data.token);
        let setData = this.state.dataPilih;
        setData.token = response.data.token;
        this.setState({ dataPilih: setData});
        // console.log(this.state.dataPilih);
        this.getData();
        // this.modalUsulan();
        this.toggleTab(3, '2');
        
      }
      console.log(response);
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
                      {this.state.pesan}
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Nama Usulan *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="nama" placeholder="" onChange={this.handleNamaChange} value={this.state.dataPilih.nama} required autoFocus/>
                          <FormText color="muted">Isi Nama Usulan</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Alasan Usulan *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="alasan" placeholder="" onChange={this.handleAlasanChange} value={this.state.dataPilih.alasan} required autoFocus/>
                          <FormText color="muted">Isi Alasan Usulan</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Lokasi Detail *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="lokasi" placeholder="" onChange={this.handleLokasiChange} value={this.state.dataPilih.lokasi} required autoFocus/>
                          <FormText color="muted">Isi Lokasi Usulan</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Volume Usulan *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="volume" placeholder="" onChange={this.handleVolumeChange} value={this.state.dataPilih.volume} required autoFocus/>
                          <FormText color="muted">Isi Volume Usulan</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="selectLg">Satuan Usulan *</Label>
                        </Col>
                        <Col xs="12" md="9" size="lg">
                          <Input type="select" name="satuan" bsSize="lg" onChange={this.handleSatuanChange} required autoFocus> 
                          <option key={0} value="">-= Pilh Satuan =-</option>
                            {this.state.dataSatuan.map((data, key) => {
                              return data ? (
                                <option key={key} value={data.Kd_Satuan}>{data.Uraian}</option>
                              ) : (null);
                            })}
                          </Input>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="selectLg">Kategori *</Label>
                        </Col>
                        <Col xs="12" md="9" size="lg">
                          <Input type="select" name="satuan" bsSize="lg" onChange={this.handleKategoriChange} required autoFocus> 
                          <option key={0} value="">-= Pilh Kategori =-</option>
                            {this.state.dataKategori.map((data, key) => {
                              return data ? (
                                <option key={key} value={data.id}>{data.kategori}</option>
                              ) : (null);
                            })}
                          </Input>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Pagu Anggaran *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="pagu" placeholder="" onChange={this.handlePaguChange} value={this.state.dataPilih.pagu} required autoFocus/>
                          <FormText color="muted">Isi Pagu Anggaran</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Penerima Manfaat *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="manfaat" placeholder="" onChange={this.handleManfaatChange} value={this.state.dataPilih.manfaat} required autoFocus/>
                          <FormText color="muted">Isi Penerima Manfaat</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Nama Pengusul *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="pengusul" placeholder="" onChange={this.handlePengusulChange} value={this.state.dataPilih.pengusul} required autoFocus/>
                          <FormText color="muted">Isi Nama Pengusul</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="file-multiple-input">Upload Foto</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="file" id="foto" onChange={this.handleFileChange} />
                        </Col>
                      </FormGroup>
                    </ModalBody>
                    <ModalFooter>
                      <Button color="primary" type="submit" form="form-data" value="Submit">{this.state.aksi} Data</Button>
                      <Button color="secondary" onClick={this.toggleClose}>Cancel</Button>
                    </ModalFooter>
                  </Form>
                </Modal>

                <Modal isOpen={this.state.modalUsulan} toggle={this.modalUsulan} className={ this.props.className}>
                  <ModalHeader toggle={this.modalUsulan}>Memulai Usulan Kelurahan</ModalHeader>
                  <ModalBody>
                    <div>
                      <Col md="12">
                        Apakah Yakin Memulai Usulan Baru?
                      </Col>
                    </div>
                  </ModalBody>
                  <ModalFooter>
                    <Button color="danger" onClick={this.getGrup}>Ya</Button>{' '}
                    <Button color="secondary" onClick={this.modalUsulan}>Batal</Button>
                  </ModalFooter>
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
                <Col xs="12" md="12" className="mb-12">
                  <Nav tabs>
                    <NavItem>
                      <NavLink
                        active={this.state.activeTab[3] === '1'}
                        onClick={() => { this.toggleTab(3, '1'); }}
                      >
                        <i className="cui-laptop icons font-2xl"></i>
                        <span className={this.state.activeTab[3] === '1' ? '' : 'd-none'}> Membuat Usulan Baru</span>
                        {'\u00A0'}<Badge color="success">New</Badge>
                      </NavLink>
                    </NavItem>
                    <NavItem>
                      <NavLink
                        active={this.state.activeTab[3] === '2'}
                        onClick={() => { this.toggleTab(3, '2'); }}
                      >
                        <i className="cui-cloud-download icons font-2xl"></i>
                        <span className={this.state.activeTab[3] === '2' ? '' : 'd-none'}> Download Berita Acara</span>
                        
                      </NavLink>
                    </NavItem>
                    <NavItem>
                      <NavLink
                        active={this.state.activeTab[3] === '3'}
                        onClick={() => { this.toggleTab(3, '3'); }} >
                          <i className="cui-layers icons font-2xl "></i>
                          <span className={this.state.activeTab[3] === '3' ? '' : 'd-none'}> Masukkan Usulan</span>
                          {'\u00A0'}<Badge pill color="danger">{this.state.jumlahAll}</Badge>
                      </NavLink>
                    </NavItem>
                    <NavItem>
                      <NavLink
                        active={this.state.activeTab[3] === '4'}
                        onClick={() => { this.toggleTab(3, '4'); }} >
                          <i className="fa fa-cloud-download icons font-2xl"></i>
                          <span className={this.state.activeTab[3] === '4' ? '' : 'd-none'}> Download Lampiran Usulan</span>
                      </NavLink>
                    </NavItem>
                    <NavItem>
                      <NavLink
                        active={this.state.activeTab[3] === '5'}
                        onClick={() => { this.toggleTab(3, '5'); }} >
                          <i className="fa fa-cloud-upload icons font-2xl"></i>
                          <span className={this.state.activeTab[3] === '5' ? '' : 'd-none'}> Upload Berkas</span>
                      </NavLink>
                    </NavItem>
                    <NavItem>
                      <NavLink
                        active={this.state.activeTab[3] === '6'}
                        onClick={() => { this.toggleTab(3, '6'); }} >
                          <i className="fa fa-send icons font-2xl"></i>
                          <span className={this.state.activeTab[3] === '6' ? '' : 'd-none'}> Kirim Ke Kecamatan</span>
                      </NavLink>
                    </NavItem>
                  </Nav>
                  <TabContent activeTab={this.state.activeTab[3]}>
                    {this.tabPane()}
                  </TabContent>
                </Col>
              </CardBody>
            </Card>
          </Col>
        </Row>
      </div>

    );
  }
}

export default Kelurahan;
