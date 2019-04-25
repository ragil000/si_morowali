import React, { Component } from 'react';
import { TabPane, TabContent, Badge, Nav, NavItem, NavLink, FormText, Alert, FormGroup, Label, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';


class AdminTambah extends Component {
  
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
      skor_keterdesakan:0,
      skor_pertumbuhan:0,
      skor_potensi:0,
      skor_kemiskinan:0,
      skor_manfaat:0,
      skor_partisipasi:0,
      skor_pelaksanaan:0,
      skor_dokumen:0,
      skor_total:0,
      opd:0,
      kecamatan:'',
      kategori:'',
    };

    this.state = {
      dataAll: [],
      dataKiriman: [],
      dataSatuan: [],
      dataSkor:[],
      dataOpd:[],
      dataKecamatan:[],
      dataKategori:[],
      jumlahPage: 1,
      jumlahAll: 0,
      jumlahPageKiriman: 1,
      jumlahAllKiriman: 0,
      modal: false,
      modalDelete: false,
      modalUsulan: false,
      modalSkor: false,
      dataPilih: this.dataPilihAwal,
      pencarian: '',
      page: 1,
      aksi:'Tambah',
      fileForm: [],
      pesan:'',
      activeTab: new Array(4).fill('1'),
      berkasBA:'',
      berkasUsulan:'',
      download:false,
    }
    
    this.toggleTab = this.toggleTab.bind(this);

    this.toggleClose = this.toggleClose.bind(this);
    this.toggle = this.toggle.bind(this);
    this.toggleDelete = this.toggleDelete.bind(this);

    this.modalUsulan = this.modalUsulan.bind(this);
    this.modalSkor = this.modalSkor.bind(this);

    this.changePesan = this.changePesan.bind(this);
    this.setData = this.setData.bind(this);
    this.getData = this.getData.bind(this);

    this.getSatuan = this.getSatuan.bind(this);

    this.getGrup = this.getGrup.bind(this);

    this.handleDelete = this.handleDelete.bind(this);

    this.handlePencarianChange = this.handlePencarianChange.bind(this);

    this.handleNamaChange = this.handleNamaChange.bind(this);
    this.handleLokasiChange = this.handleLokasiChange.bind(this);
    this.handleVolumeChange = this.handleVolumeChange.bind(this);
    this.handleSatuanChange = this.handleSatuanChange.bind(this);
    this.handlePaguChange = this.handlePaguChange.bind(this);
    this.handleManfaatChange = this.handleManfaatChange.bind(this);
    this.handlePengusulChange = this.handlePengusulChange.bind(this);
    this.handleFileChange = this.handleFileChange.bind(this);
    
    this.handleSkorChange = this.handleSkorChange.bind(this);
    this.handleOpdChange = this.handleOpdChange.bind(this);
    
    this.handleBAChange = this.handleBAChange.bind(this);
    this.handleUsulanChange = this.handleUsulanChange.bind(this);
    this.handleBerkasSubmit = this.handleBerkasSubmit.bind(this);
    this.submitKirimBerkas = this.submitKirimBerkas.bind(this);

    this.getGrupKiriman = this.getGrupKiriman.bind(this);

    this.cekGrup = this.cekGrup.bind(this);
    
  }

  cekGrup = () => {
    if(!localStorage.getItem('codexv-token-pokir')){
      localStorage.setItem("codexv-token-pokir", '');

    }
  }

  ///tab
  lorem() {
    return 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.'
  }

  setPosisi(id){
    var posisi = '';

    if(parseInt(id) === 3){
      posisi = 'Melakukan inputan usulan';
    }else if(parseInt(id) === 4){
      posisi = 'Sudah Melakukan Upload Berkas';
    }else if(parseInt(id) === 5){
      posisi = 'Usulan Telah Terkirim';
    }

    return (<div>{posisi}</div>);
  }

  getNamaAsal(data){
    var kel = 'Kelurahan ';
    if(data.Kd_Kel === 2){
      kel = 'Desa ';
    }
    var asal = data.Nm_Kel;
    if(asal === null){
      asal = "Kecamatan "+data.Nm_Kec;
    }else{
      asal = kel+data.Nm_Kel+", Kecamatan "+data.Nm_Kec;
    }
    return asal;
  }

  mulaiUsulanBaru(){
    return (
        <div>
          <Row>
            <Col xs="128" md="10">
            <Form method="post" onSubmit={this.handleKecamatanSubmit} className="form-horizontal">
            <FormGroup row>
                <Col xs="9" md="5">
                  <Input type="select" onChange={this.handleKecamatanChange} id="text-input-pencarian" name="pencarian" placeholder="Pencarian" >
                  <option key={0} value="">-= Pilh Kecamatan =-</option>
                    {this.state.dataKecamatan.map((data, key) => {
                      return data ? (
                        <option key={key} value={data.Kd_Kec}>{data.Nm_Kec}</option>
                      ) : (null);
                    })}
                  </Input>
                </Col>
                <Col xs="3" md="2">
                  <Button color="primary" >Cari</Button>
                </Col>
              </FormGroup>
              <FormGroup row>
                <Col xs="9" md="5">
                  <Input type="select" onChange={this.handleKategoriChange} id="text-input-pencarian" name="pencarian" placeholder="Pencarian" >
                  <option key={-1} value="">-= Pilh Kategori =-</option>
                  <option key={0} value="0">Semua</option>
                    {this.state.dataKategori.map((data, key) => {
                      return data ? (
                        <option key={key} value={data.id}>{data.kategori}</option>
                      ) : (null);
                    })}
                  </Input>
                </Col>
                <Col xs="3" md="2">
                  <Button color="warning" form="form-download-usulan">Download</Button>
                </Col>
              </FormGroup>
            </Form>
            {this.downloadUsulan()}
            </Col>  
          </Row>  
          <Table responsive striped>
            <thead>
            <tr>
              <th>Asal Usulan</th>
              <th>Nama Usulan</th>
              <th>Alasan Usulan</th>
              <th>Lokasi Detail</th>
              <th>Volume Usulan</th>
              <th>Satuan Usulan</th>
              <th>Pagu Anggaran</th>
              <th>Penerima Manfaat</th>
              <th>Nama Pengusul</th>
              <th>Kategori</th>
              <th>OPD</th>
              <th>Foto</th>
              <th>File</th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataKiriman.map((data, key) => {
              return data ? (
                <tr key={key}>
                <td>{this.getNamaAsal(data)}</td>
                <td>{data.nama_usulan}</td>
                <td>{data.alasan}</td>
                <td>{data.lokasi}</td>
                <td>{data.volume}</td>
                <td>{data.Uraian}</td>
                <td>{data.pagu}</td>
                <td>{data.manfaat}</td>
                <td>{data.pengusul}</td>
                <td>{data.kategori}</td>
                <td>{data.Nm_Sub_Unit}</td>
                <td>{this.downloadGambar(data)}</td>
                <td>                
                {this.downloadFileBA(data)}
                {this.downloadFileUsulan(data)}
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
      <Form method="post" action={config.apiRoot+'pokir/get-pdf/berita-acara-pokir'} target="_blank">
        <Input  type="hidden" name="session" value={localStorage.getItem('codexv-session')}/>
        <Input  type="hidden" name="token" value={localStorage.getItem('codexv-token-pokir')}/>
        <Input  type="hidden" name="jenis" value="ba"/>
        <FormGroup row>
          <Col md="2">
            <Label htmlFor="text-input">Masukkan Jumlah Peserta</Label>
          </Col>
          <Col xs="12" md="3">
          <Input  type="number" name="orang"/>
          </Col>
        </FormGroup>
        
        <Button color="secondary">Download Berita Acara</Button>
      </Form>
    )
  }

  downloadUsulan(){
    return (
      <Form method="post" action={config.apiRoot+'admin/get-pdf/usulan-pokir'} target="_blank" id="form-download-usulan">
        <Input  type="hidden" name="session" value={localStorage.getItem('codexv-session')}/>
        <Input  type="hidden" name="jenis" value="usulan"/>
        <Input  type="hidden" name="kecamatan" value={this.state.dataPilih.kecamatan}/>
        <Input  type="hidden" name="kategori" value={this.state.dataPilih.kategori}/>
        
        {/* <Input  type="hidden" name="pokir" value={true}/> */}
      </Form>
    )
  }

  getAsal(set, kiriman = false){
    var asal='Pokir';
    
    if(!kiriman){
      if(parseInt(set.asal) === 1){
        asal = 'Kelurahan';
      }else if(parseInt(set.asal) === 2){
        asal = 'Kecamatan';
      }
    }else{
      if(parseInt(set.asal) === 1){
        asal = 'Kelurahan';
      }else if(parseInt(set.asal) === 2){
        asal = 'Kecamatan';
      }
      // console.log(set.asal);
    }

    
    // console.log(asal);
    return (<p>{asal}</p>);
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
        </Row>      
        <Table responsive striped>
          <thead>
          <tr>
            <th>Asal Usulan</th>
            <th>Nama Usulan</th>
            <th>Lokasi Detail</th>
            <th>Volume Usulan</th>
            <th>Satuan Usulan</th>
            <th>Pagu Anggaran</th>
            <th>Penerima Manfaat</th>
            <th>Nama Pengusul</th>
            <th>Kategori</th>
            <th>OPD</th>
            <th>File</th>
          </tr>
          </thead>
          <tbody>
          {this.state.dataAll.map((data, key) => {
            return data ? (
              <tr key={key}>
                <td>{this.getNamaAsal(data)}</td>
                <td>{data.nama}</td>
                <td>{data.alasan}</td>
                <td>{data.lokasi}</td>
                <td>{data.volume}</td>
                <td>{data.nama_satuan}</td>
                <td>{data.pagu}</td>
                <td>{data.manfaat}</td>
                <td>{data.pengusul}</td>
                <td>{data.kategori}</td>
                <td>{data.Nm_Sub_Unit}</td>
                <td>
                {this.downloadGambar(data)}
                {this.downloadFileBA(data)}
                {this.downloadFileUsulan(data)}
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
        <Button color="secondary">Kirim Berkas Ke OPD</Button>
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
        {/* <TabPane tabId="2">
          {this.downloadBA()}
        </TabPane> */}
        {/* <TabPane tabId="3">
          {this.inputUsulan()}
        </TabPane> */}
        {/* <TabPane tabId="4">
          {this.downloadUsulan()}
        </TabPane>
        <TabPane tabId="5">
          {this.uploadBerkas()}
        </TabPane>
        <TabPane tabId="6">
          {this.kirimUsulan()}
        </TabPane> */}
      </>
    );
  }

  //. tab

  // handleFileChange = event => {
  //   this.setState({ fileForm: event.target.files[0]});
  // }

  downloadGambar = (data) =>{
    var asal = 'pokir';

    if(data.asal === '1'){
      asal = 'kelurahan'; 
    }else if(data.asal === '2'){
      asal = 'kecamatan';
    }
    // console.log(data.asal);
    return (
      <Form method="post" action={config.apiRoot+'attachments/foto-'+asal+'/'+data.file} target="_blank">
        <img src={config.apiRoot+'attachments/foto-'+asal+'/'+data.file} style={{height:'100px'}} /><br/>
        <Input  type="hidden" name="session" value={localStorage.getItem('codexv-session')}/>
        <Button color="success"><i className="fa fa-file-photo-o"> Foto</i></Button>
      </Form>
    );
  }

  downloadFileUsulan = (data) =>{
    if(data.berkas_usulan !== ''){
      var asal = 'pokir';
      if(data.asal === '1'){
        asal = 'kelurahan'; 
      }else if(data.asal === '2'){
        asal = 'kecamatan';
      }
      
      // console.log(data);

      return (
        <Form method="post" action={config.apiRoot+'attachments/usulan-'+asal+'/'+data.berkas_usulan} target="_blank">
          <Input  type="hidden" name="session" value={localStorage.getItem('codexv-session')}/>
          <Button color="info"><i className="fa fa-file-pdf-o"> Usulan</i></Button>
        </Form>
      );
    }
  }

  downloadFileBA = (data) =>{
    if(data.berkas_ba !== ''){
      var asal = 'pokir';
      if(data.asal === '1'){
        asal = 'kelurahan'; 
      }else if(data.asal === '2'){
        asal = 'kecamatan';
      }
      return (
        <Form method="post" action={config.apiRoot+'attachments/berita-acara-'+asal+'/'+data.berkas_ba} target="_blank">
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
    data.append('token', localStorage.getItem('codexv-token-pokir'));
    data.append('id', this.state.dataPilih.id);
    axios
    .post(config.apiRoot+'pokir/delete', data)
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
    // console.log(event.target.files);
  }

  handleSkorSubmit = (event) => {
    event.preventDefault();

    // skor_keterdesakan:0,
    //   skor_pertumbuhan:0,
    //   skor_potensi:0,
    //   skor_kemiskinan:0,
    //   skor_manfaat:0,
    //   skor_partisipasi:0,
    //   skor_pelaksanaan:0,
    //   skor_dokumen:0,
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('token', localStorage.getItem('codexv-token-pokir'));
    data.append('id', this.state.dataPilih.id);
    data.append('opd', this.state.dataPilih.opd);
    
    axios
    .post(config.apiRoot+'pokir/create-skor', data)
    .then(response => {
      if(response.data.status){
        this.getData();
        this.modalSkor();
      }

      // this.toggleClose();
      this.changePesan(response.data.pesan);
      // console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  handleSkorChange = (event) => {
    const setData = this.state.dataPilih;

    const no = event.target.attributes.getNamedItem('data-skor').value;
    if(parseInt(no) === 0){
      setData.skor_keterdesakan = event.target.value;
    }else if(parseInt(no) === 1){
      setData.skor_pertumbuhan = event.target.value;
    }else if(parseInt(no) === 2){
      setData.skor_potensi = event.target.value;
    }else if(parseInt(no) === 3){
      setData.skor_kemiskinan = event.target.value;
    }else if(parseInt(no) === 4){
      setData.skor_manfaat = event.target.value;
    }else if(parseInt(no) === 5){
      setData.skor_partisipasi = event.target.value;
    }else if(parseInt(no) === 6){
      setData.skor_pelaksanaan = event.target.value;
    }else if(parseInt(no) === 7){
      setData.skor_dokumen = event.target.value;
    }

    // console.log(setData);
    this.setState({ dataPilih: setData});
    // console.log(no);
    // console.log(this.state.dataPilih);
  }

  handleKecamatanChange = event => {
    let setData = this.state.dataPilih;
    setData.kecamatan = event.target.value;
    this.setState({ dataPilih: setData});
    
  }

  handleKategoriChange = event => {
    let setData = this.state.dataPilih;
    setData.kategori = event.target.value;
    this.setState({ dataPilih: setData});
    
  }

  handleOpdChange = event =>{
    let setData = this.state.dataPilih;
    setData.opd = event.target.value;
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
    data.append('token', localStorage.getItem('codexv-token-pokir'));
    data.append('usulan', this.state.berkasUsulan);
    
    axios
    .post(config.apiRoot+'pokir/upload-berkas', data, head)
    .then(response => {
      if(response.data.status){
        this.getData();
      }

      // this.toggleClose();
      this.changePesan(response.data.pesan);
      // console.log(response.data);
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

    let link = config.apiRoot+'pokir/kirim-berkas';
      
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('token', localStorage.getItem('codexv-token-pokir'));
    
    axios
    .post(link, data, head)
    .then(response => {
      if(response.data.status){
        // this.toggleClose();
        this.getData();
      }

      // this.toggleClose();
      this.changePesan(response.data.pesan);
      // console.log(response.data);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  handleSubmit = event => {
    event.preventDefault();
    let link = '';
    if(this.state.aksi === 'Edit'){
      link = config.apiRoot+'pokir/update';
      
    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+'pokir/create';
    }
    // console.log(this.state.dataPilih);
    
    
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('id', this.state.dataPilih.id);
    data.append('token', localStorage.getItem('codexv-token-pokir'));
    data.append('nama', this.state.dataPilih.nama);
    data.append('lokasi', this.state.dataPilih.lokasi);
    data.append('volume', this.state.dataPilih.volume);
    data.append('satuan', this.state.dataPilih.satuan);
    data.append('pagu', this.state.dataPilih.pagu);
    data.append('manfaat', this.state.dataPilih.manfaat);
    data.append('pengusul', this.state.dataPilih.pengusul);
    data.append('file', this.state.dataPilih.file.foto );
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
      // console.log(response.data);
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

  modalSkor(){
    this.setState({
      modalSkor: !this.state.modalSkor  ,
    });
  }

  componentWillMount = () => {
    this.cekGrup();
    this.getData();
    this.getKiriman();
    this.getSatuan();
    this.getSkor();
    this.getOpd();

  }

  setData = (dataAll) => {
    if(dataAll.status){
      this.setState({ dataAll: dataAll.data, jumlahPage: dataAll.jumlahPage, jumlahAll: dataAll.jumlahAll});
    }
    // console.log(dataAll);
  }

  getData = (page = 1) => {
    //page = this.state.page;
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('token', localStorage.getItem('codexv-token-pokir'));
    data.append('search', this.state.pencarian);
    axios
    .post(config.apiRoot+'musrenbang/page-'+page, data)
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
    data.append('token', localStorage.getItem('codexv-token-pokir'));
    data.append('search', this.state.pencarian);
    axios
    .post(config.apiRoot+'musrenbang/kiriman/page-'+page, data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataKiriman: response.data.data, jumlahPageKiriman: response.data.jumlahPage, jumlahAllKiriman: response.data.jumlahAll, dataKecamatan: response.data.kecamatan, dataKategori: response.data.kategori});
        
      }
      console.log(response.data);
    })
    .catch(function (error) {
      console.log(error);
    });
  }
  getGrupKiriman = (e) => {
    //page = this.state.page;
    
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('id', e.grup_id);
    axios
    .post(config.apiRoot+'admin/get-grup', data)
    .then(response => {
      if(response.data.status){
        localStorage.setItem("codexv-token-pokir", response.data.token);
        let setData = this.state.dataPilih;
        setData.token = response.data.token;
        this.setState({ dataPilih: setData});
        // console.log(this.state.dataPilih);
        this.getData();
        // this.modalUsulan();
        this.toggleTab(3, '3');
        
      }
      console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  // setGrupKiriman = (e) =>{
  //   this.setState({
  //     dataPilih: e
  //   });
  // }

  getGrup = () => {
    //page = this.state.page;
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    axios
    .post(config.apiRoot+'pokir/createGrup', data)
    .then(response => {
      if(response.data.status){
        localStorage.setItem("codexv-token-pokir", response.data.token);
        let setData = this.state.dataPilih;
        setData.token = response.data.token;
        this.setState({ dataPilih: setData});
        // console.log(this.state.dataPilih);
        this.getData();
        this.modalUsulan();
        this.toggleTab(3, '3');
      }
      // console.log(response);
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

  getSkor = () => {
    //page = this.state.page;
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    axios
    .post(config.apiRoot+'getData/skor', data)
    .then(response => {
      //this.setData(response.data)
      if(response.data.status){
        this.setState({ dataSkor: response.data});
        
      }
      // console.log("skor");
      // console.log(response.data.data[0].isi)
      // console.log("skor");
      // console.log(this.state.dataSkor);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  getOpd = () => {
    //page = this.state.page;
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    axios
    .post(config.apiRoot+'getData/opd', data)
    .then(response => {
      //this.setData(response.data)
      if(response.data.status){
        this.setState({ dataOpd: response.data});
        
      }
      // console.log("skor");
      // console.log(response.data.data[0].isi)
      // console.log("skor");
      // console.log(this.state.dataOpd);
    })
    .catch(function (error) {
      console.log(error);
    });
  }


  handleKecamatanSubmit = (event)=>{
    event.preventDefault();

    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('token', localStorage.getItem('codexv-token-pokir'));
    data.append('kecamatan', this.state.dataPilih.kecamatan);
    data.append('kategori', this.state.dataPilih.kategori);
    // console.log(this.state.dataPilih.kecamatan);
    axios
    .post(config.apiRoot+'musrenbang/kiriman/page-'+1, data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataKiriman: response.data.data, jumlahPageKiriman: response.data.jumlahPage, jumlahAllKiriman: response.data.jumlahAll, dataKecamatan: response.data.kecamatan});
        
      }
      // this.changePesan(response.data.pesan);
      // console.log('sdf');
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

  pilihSkor(no = 0){

    const isi = [];
    var isiSkor;
    const skorData = this.state.dataSkor;
    
    if(skorData.length !== 0){
      // console.log('skorData');
      isiSkor = skorData.data[no].isi;
      // console.log(isiSkor);
      isi.push(<option key={0} value="">-= Pilh Skor =-</option>);
      for(let i=0; i<isiSkor.length; i++){
        isi.push(<option key={i+1} value={isiSkor[i].Kd_Bobot}>{isiSkor[i].Range}</option>);
      }
    
    // for(let i=0; i<skorData.length; i++){
    //   isi.push(<option key={i} value="">-= Pilh Satuan =-</option>);
    // }

      return(
        <FormGroup row>
          <Col md="5">
            <Label htmlFor="selectLg">SKOR {skorData.data[no].Kriteria}</Label>
          </Col>
          <Col xs="12" md="7" size="lg">
            <Input type="select" name="satuan" bsSize="lg" data-skor={no} onChange={this.handleSkorChange} required autoFocus> 
            {isi}
            </Input>
          </Col>
        </FormGroup>
      );
    }
  }

  pilihOpd(){

    const isi = [];
    var isiSkor;
    const skorData = this.state.dataOpd;
    
    if(skorData.length !== 0){
      // console.log('skorData');
      isiSkor = skorData.data;
      // console.log('opd')
      // console.log(isiSkor);
      isi.push(<option key={0} value="">-= Pilh OPD =-</option>);
      for(let i=0; i<isiSkor.length; i++){
        isi.push(<option key={i+1} value={isiSkor[i].Kd_User}>{isiSkor[i].isi[0].Nm_Sub_Unit}</option>);
      }
    
    // for(let i=0; i<skorData.length; i++){
    //   isi.push(<option key={i} value="">-= Pilh Satuan =-</option>);
    // }

      return(
        <FormGroup row>
          <Col md="5">
            <Label htmlFor="selectLg">Pilih OPD</Label>
          </Col>
          <Col xs="12" md="7" size="lg">
            <Input type="select" name="satuan" bsSize="lg" onChange={this.handleOpdChange} required autoFocus> 
            {isi}
            </Input>
          </Col>
        </FormGroup>
      );
    }
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

                <Modal isOpen={this.state.modalSkor} toggle={this.modalSkor} className={'modal-lg ' + this.props.className}>
                  <ModalHeader toggle={this.modalSkor}>{this.state.aksi} Data</ModalHeader>
                  <Form method="post"  onSubmit={this.handleSkorSubmit.bind(this)} className="form-horizontal" id="form-skor">
                    <ModalBody>
                      {this.state.pesan}
                      {this.pilihOpd()}
                    </ModalBody>
                    <ModalFooter>
                      <Button color="primary" type="submit" form="form-skor" value="Submit">{this.state.aksi} Data</Button>
                      <Button color="secondary" onClick={this.modalSkor}>Cancel</Button>
                    </ModalFooter>
                  </Form>
                </Modal>
                
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
                  <ModalHeader toggle={this.modalUsulan}>Memulai Usulan Pokir</ModalHeader>
                  <ModalBody>
                    <div>
                      <Col md="12">
                        Apakah Yakin Memulai Usulan Baru?
                      </Col>
                    </div>
                    {/* <Form>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="file-multiple-input">Upload Foto</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" id="foto" onChange={this.handleFileChange} />
                        </Col>
                      </FormGroup>
                    </Form> */}
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
                    {/* <NavItem>
                      <NavLink
                        active={this.state.activeTab[3] === '2'}
                        onClick={() => { this.toggleTab(3, '2'); }}
                      >
                        <i className="cui-cloud-download icons font-2xl"></i>
                        <span className={this.state.activeTab[3] === '2' ? '' : 'd-none'}> Download Berita Acara</span>
                        
                      </NavLink>
                    </NavItem> */}
                    {/* <NavItem>
                      <NavLink
                        active={this.state.activeTab[3] === '3'}
                        onClick={() => { this.toggleTab(3, '3'); }} >
                          <i className="cui-layers icons font-2xl "></i>
                          <span className={this.state.activeTab[3] === '3' ? '' : 'd-none'}> Masukkan Usulan</span>
                          {'\u00A0'}<Badge pill color="danger">{this.state.jumlahAll}</Badge>
                      </NavLink>
                    </NavItem> */}
                    {/* <NavItem>
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
                          <span className={this.state.activeTab[3] === '6' ? '' : 'd-none'}> Kirim Ke OPD</span>
                      </NavLink>
                    </NavItem> */}
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

export default AdminTambah;
