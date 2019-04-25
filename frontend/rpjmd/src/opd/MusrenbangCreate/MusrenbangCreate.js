import React, { Component } from 'react';
import { Alert, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';

class MusrenbangCreate extends Component {
  
  constructor(props) {
    super(props);

    this.dataPilihAwal = {
      id:0,
      name:'0',
      ageid:0,
    };

    this.styleForm = {
      minWidth:300,
    }

    this.state = {
      loading:false,
      dataAll: [],
      jumlahPage: 1,
      modalCreate: false,
      modalDelete: false,
      modalPesan: false,
      dataPilih: this.dataPilihAwal,
      dataTambah:[],
      dataOpd:[],
      dataProgram:[],
      dataKegiatan:[],
      dataRkpd:[],
      pencarian: '',
      page: 1,
      aksi:'Tambah',
      name:"",
      age:0,
      edit:0,
    }

    document.title = "Hasil Musrenbang";
    this.link = 'opd/menyusun/renstra-kab';
    
    this.modalDelete = this.modalDelete.bind(this);

    this.handlePencarianChange = this.handlePencarianChange.bind(this);
  }

  componentWillMount = () => {
    this.getData();
  }

  handlePencarianChange(event){
    this.setState({ pencarian: event.target.value});
  }

  handleChange = idx => evt => {

    let no = parseInt(evt.target.attributes.getNamedItem('data-number').value);
    
    if(no === 1){
      
      if(evt.target.value === "1"){
        this.getProgram(this.state.dataPilih.Kd_Urusan, this.state.dataPilih.Kd_Bidang);
        this.keterangan(true, this.state.dataPilih, idx);
      }else{
        this.keterangan(true, this.state.dataPilih, idx);
        
      }
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        if (idx !== sidx) return shareholder;
        let data = { ...shareholder, terima: evt.target.value, Kd_Prog:0, Kd_Keg:0 };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 2){
      this.getKegiatan(this.state.dataPilih.Kd_Urusan, this.state.dataPilih.Kd_Bidang, evt.target.value);
        
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {

        if (idx !== sidx) return shareholder;
        
        
        let data = { ...shareholder, Kd_Prog: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 3){
      this.getRkpd(this.state.dataPilih.Kd_Urusan, this.state.dataPilih.Kd_Bidang, this.state.dataPilih.Kd_Prog, evt.target.value);
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        if (idx !== sidx) return shareholder;
        let data = { ...shareholder, Kd_Keg: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 3){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        if (idx !== sidx) return shareholder;
        let data = { ...shareholder, perumusan_program_id: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
  };
//////modal
  modalCreateClose(e = []) {
    this.setState({
      modalCreate: false,
    });
    
  }

  modalCreate(e = []) {
    
    if(e.length === 0){
      this.setState({
        // modalCreate: true,
        dataPilih: this.dataPilihAwal
      });
      
    }else{
      this.setState({
        // modalCreate: true,
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
        // dataTambah:dataAll.dataTambah,
      });
    }
    // if(dataAll.data.length > 0)
    //   this.rpjmdTahun = parseInt(dataAll.data[0]['rpjmd_tahun']);
    // else
    //   this.rpjmdTahun = 0;

  }

  getData = (page = 1) => {
    
    this.setState({ loading: true });
    // console.log('response');
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('search', this.state.pencarian);
    
    // data.append('kecamatan', this.state.dataPilih.kecamatan);
    // data.append('kategori', this.state.dataPilih.kategori);
    
    axios
    .post(config.apiRoot+'opd/menyusun/hasil-musrenbang/page-'+page, data)
    .then(response => {
      // this.setData(response.data)

      this.setState({ 
        dataOpd: response.data.dataOpd, 
      });
      data.append('Kd_Urusan', response.data.dataOpd.Kd_Urusan);
      data.append('Kd_Bidang', response.data.dataOpd.Kd_Bidang);
      data.append('Kd_Unit', response.data.dataOpd.Kd_Unit);
      data.append('Kd_Sub', response.data.dataOpd.Kd_Sub);

      axios
      .post(config.apiMusrenbang+'api/musrenbang/kiriman/page-'+page, data)
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

      console.log(response);
      this.setState({ loading: false });
    })
    .catch(error => {
      console.log(error);
      this.setState({ loading: false });
      this.changePesan('Tidak dapat terhubung pada server!', 'danger');
    });


    


  }

  getProgram = (urusan, bidang) => {
    console.log(urusan+"-"+bidang);
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('urusan', urusan);
    data.append('bidang', bidang);
    axios
    .post(config.apiRoot+'rpjmd/get-data/program', data)
    .then(response => {
      // if(response.data.status){
        this.setState({ dataProgram: response.data.data});
      // }
      this.setState({ loading: false });
      console.log(response);
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
    });
  }

  getKegiatan = (urusan, bidang, program) => {
    
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('urusan', urusan);
    data.append('bidang', bidang);
    data.append('program', program);
    axios
    .post(config.apiRoot+'opd/get-data/kegiatan', data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataKegiatan: response.data.data});
      }
      this.setState({ loading: false });
      console.log(response);
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
    });
  }

  getRkpd = (urusan, bidang, program, kegiatan) => {
    
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('urusan', urusan);
    data.append('bidang', bidang);
    data.append('program', program);
    data.append('kegiatan', kegiatan);
    axios
    .post(config.apiRoot+'opd/get-data/rkpd', data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataRkpd: response.data.data});
      }
      this.setState({ loading: false });
      console.log(response);
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
    });
  }

///. set data

// submit

  handleSubmit = () => {
    this.setState({ loading: true });
    let link = '';
    if(this.state.aksi === 'Edit'){
      link = config.apiRoot+this.link+'/update';
      
    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+this.link+'/create';
    }
    link = config.apiMusrenbang+'api/musrenbang/kiriman/update';
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    
    data.append('id', this.state.dataPilih.idAll);
    data.append('terima', this.state.dataPilih.terima);
    data.append('Kd_Keg', this.state.dataPilih.Kd_Keg);
    data.append('Kd_Prog', this.state.dataPilih.Kd_Prog);
    data.append('perumusan_program_id', this.state.dataPilih.perumusan_program_id);

    axios
    .post(link, data, head)
    .then(response => {
      if(response.data.status){
        this.modalCreateClose();
        this.getData(this.state.page);
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
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('perumusan_program_id', this.state.dataPilih.perumusan_program_id);
    axios
    .post(config.apiRoot+this.link+'/delete', data)
    .then(response => {
      if(response.data.status){
        this.modalDelete();
        this.getData(this.state.page);
        this.changePesan(response.data.pesan);
      }else{
        this.changePesan(response.data.pesan, 'warning');
      }
      this.setState({ loading: false });
      console.log(response);
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

tambah(){
  this.setState({dataPilih:this.dataPilihAwal, edit:0, page:this.state.jumlahPage});
  this.handleSubmit();
}

edit(data){
  this.setState({dataPilih:data, edit:data.idAll});
  if(this.state.edit !== 0){
    this.simpan(data);
  }
  // this.getKegiatan(data.Kd_Urusan, data.Kd_Bidang, data.Kd_Prog);
  
}

simpan(data){
  this.setState({edit:0, aksi:'Tambah'});
  this.handleSubmit();
  console.log(this.state.dataPilih);
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

downloadGambar = (data) =>{
  var asal = 'pokir';

  if(data.asal === '1'){
    asal = 'kelurahan'; 
  }else if(data.asal === '2'){
    asal = 'kecamatan';
  }
  // console.log(data.asal);
  return (
    <Form method="post" action={config.apiMusrenbang+'attachments/foto-'+asal+'/'+data.file} target="_blank">
      <img alt="gambar-musrenbang" src={config.apiMusrenbang+'attachments/foto-'+asal+'/'+data.file} style={{height:'100px'}} /><br/>
      <Input  type="hidden" name="session" value={localStorage.getItem('codexv-session')}/>
      <Button color="success"><i className="fa fa-file-photo-o"> Foto</i></Button>
    </Form>
  );
}

terima(data){
  if(data.terima === "1"){
    return ('Terima');
  }else if(data.terima === "2"){
    return ('Tolak');
  }else{
    return ('Belum Ada Keterangan');
  }
}

keterangan(data, key){
  let set = false;
  if(this.state.dataPilih.terima === "1"){
    set = true;
  }
  if(set){
    return (
      <div>
        <Input type="select" style={this.styleForm} value={data.Kd_Prog} data-number="2" onChange={this.handleChange(key)}>
          <option key="-1" value="">-= Pilih Program =-</option>
          {this.state.dataProgram.map((data, key) => {
            return data ? (
              <option key={key} value={data.Kd_Prog}>{data.Ket_Program}</option>
            ) : (null);
          })}
        </Input>
        <Input type="select" style={this.styleForm} value={data.Kd_Keg} data-number="3" onChange={this.handleChange(key)}>
          <option key="-1" value="">-= Pilih Kegiatan =-</option>
          {this.state.dataKegiatan.map((data, key) => {
            return data ? (
              <option key={key} value={data.Kd_Keg}>{data.Ket_Kegiatan}</option>
            ) : (null);
          })}
        </Input>
        <Input type="select" style={this.styleForm} value={data.perumusan_program_id} data-number="4" onChange={this.handleChange(key)}>
          <option key="-1" value="">-= Pilih RKPD =-</option>
          {this.state.dataRkpd.map((data, key) => {
            return data ? (
              <option key={key} value={data.perumusan_program_id}>{data.outcome}</option>
            ) : (null);
          })}
        </Input>
      </div>
    );
  }else{
    return null;
  }
}

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
            {/* <Form method="post" onSubmit={this.handleCariSubmit} className="form-horizontal">
              <FormGroup row>
                <Col xs="9" md="5">
                <Input type="text" placeholder="Pencarian" onChange={this.handlePencarianChange} value={this.state.pencarian} />
                </Col>
                <Col xs="3" md="2">
                  <Button color="primary" >Cari</Button>
                </Col>
              </FormGroup>
            </Form> */}
            </Col>
            <Col xs="12" md="2">
              {/* <Button color="info" onClick={() => {this.setState({aksi:'Tambah'});this.tambah();}} className="mr-1">Tambah</Button> */}
            </Col> 
          </Row> 
          <Table responsive striped bordered>
            <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
              <tr>
                <th>Aksi</th>
                <th>Keterangan</th>
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
              </tr>
            </thead>
            <tbody>
            {this.state.dataAll.map((data, key) => {
              if(data.idAll !== this.state.edit){
                return data ? (
                  <tr key={key}>
                    <td>
                        <Button color="info" onClick={() => {this.setState({aksi:'Edit'});this.edit(data);}} className="mr-1">Edit</Button>
                        {/* <Button color="danger" onClick={() => this.modalDelete(data)} className="mr-1">Hapus</Button> */}
                      </td>
                    <td>{this.terima(data)}</td>
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
                  </tr>
                ) : (null);
              }else{
                return data ? (
                  <tr key={key}>
                    <td>
                      <Button color="success" onClick={() => {this.simpan(data)}}  className="mr-1">Simpan</Button>
                    </td>
                    <td>
                      <Input type="select" value={data.terima} data-number="1" onChange={this.handleChange(key)}>
                        <option value="0">Pilih Keterangan</option>
                        <option value="1">Terima</option>
                        <option value="2">Tolak</option>
                      </Input>
                    {this.keterangan(data, key)}
                    </td>
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
                  </tr>
                ) : (null);
              }
              
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
                <Modal isOpen={this.state.modalDelete} toggle={this.modalDelete} className={ this.props.className}>
                  <ModalHeader toggle={this.modalDelete}>Hapus Data</ModalHeader>
                  <ModalBody>
                    Apakah Anda Yakin Menghapus Data?
                  </ModalBody>
                  <ModalFooter>
                    <Button color="danger" onClick={this.handleDelete}>Ya</Button>
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

export default MusrenbangCreate;
