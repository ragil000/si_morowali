import React, { Component } from 'react';
import { Alert, Input, CardBody, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';
import Download from '../../rpjmd/other/Download';

class PraRkaCreate extends Component {
  
  constructor(props) {
    super(props);
    this.styleForm = {
      minWidth:300,
    }

    this.dataPilihAwal = {
      belanja_id:0,
      perumusan_program_id:this.props.data.perumusan_program_id,
      nama_belanja:'',
      volume:0,
      satuan:0,
      harga:0,
    };

    this.state = {
      loading:false,
      dataAll: [],
      jumlahPage: 1,
      modalCreate: false,
      modalDelete: false,
      modalPesan: false,
      dataRkpd: this.props.data,
      dataPilih: this.dataPilihAwal,
      dataTambah:[],
      dataSsh:[],
      dataHspk:[],
      dataAsb:[],
      dataRek4:[],
      dataRek5:[],
      dataProfil:this.props.data,
      dataOpd:[],
      dataUrusan:[],
      dataBidang:[],
      dataProgram:[],
      dataKegiatan:[],
      dataSatuan:[],
      pencarian: '',
      page: 1,
      aksi:'Tambah',
      name:"",
      age:0,
      edit:0,
      komentar:'',
      // lihatRka:false,
    }

    this.getAllSatuanHarga();

    document.title = "Menyusun Pra RKA";

    if(this.props.perubahan){
      this.link = 'opd/menyusun/rka-pra-perubahan';
    }else{
      this.link = 'opd/menyusun/rka-pra';
    }
    
    console.log(this.link);
    
    this.modalDelete = this.modalDelete.bind(this);

    this.handlePencarianChange = this.handlePencarianChange.bind(this);


    // console.log("sd");
    console.log(this.props.data);
    // console.log("sd");
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
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        data = { ...shareholder, Kd_Rek_4: evt.target.value };
        this.setState({dataPilih:data});
        this.getDataTambahan(data);
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 2){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        data = { ...shareholder, Kd_Rek_5: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
      // this.getProgram(this.state.dataPilih.Kd_Urusan, evt.target.value);
    }
    if(no === 3){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        
        if (idx !== sidx) return data;
        data = { ...shareholder, nama_belanja: evt.target.options[evt.target.selectedIndex].text, harga:evt.target.options[evt.target.selectedIndex].dataset.harga, satuan: evt.target.options[evt.target.selectedIndex].dataset.satuan };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
      // this.getKegiatan(this.state.dataPilih.Kd_Urusan, this.state.dataPilih.Kd_Bidang, evt.target.value);
    }
    if(no === 4){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        data = { ...shareholder, volume: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
      // this.getKegiatan(this.state.dataPilih.Kd_Urusan, this.state.dataPilih.Kd_Bidang, evt.target.value);
    }
    if(no === 5){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        data = { ...shareholder, satuan: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 6){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        data = { ...shareholder, harga: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 7){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        data = { ...shareholder, komentar: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
   
    // this.getBidang(this.state.dataPilih.Kd_Urusan);
    // this.getProgram(this.state.dataPilih.Kd_Urusan, this.state.dataPilih.Kd_Bidang);
    // this.getKegiatan(this.state.dataPilih.Kd_Urusan, this.state.dataPilih.Kd_Bidang, this.state.dataPilih.Kd_Prog);
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
        dataTambah:dataAll.dataTambah,
        dataUrusan:dataAll.dataUrusan,
        dataSatuan:dataAll.dataSatuan,
        dataRek4:dataAll.dataRek4,
      });
    }
  }

  getData = (page = 1) => {
    
    this.setState({ loading: true });
    // console.log('response');
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('perumusan_program_id', this.state.dataRkpd.perumusan_program_id);
    data.append('search', this.state.pencarian);
    data.append('tahun', this.props.tahun);
    axios
    .post(config.apiRoot+this.link+'/page-'+page, data)
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

  getRek5 = (Kd_Rek_1, Kd_Rek_2, Kd_Rek_3, Kd_Rek_4) => {
      
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('Kd_Rek_1', Kd_Rek_1);
    data.append('Kd_Rek_2', Kd_Rek_2);
    data.append('Kd_Rek_3', Kd_Rek_3);
    data.append('Kd_Rek_4', Kd_Rek_4);
    axios
    .post(config.apiRoot+'rpjmd/get-data/rek-5', data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataRek5: response.data.data});
      }
      this.setState({ loading: false });
      console.log(response.data);
      // console.log("-------------"+urusan+bidang);
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
    });
  }

  getAllSatuanHarga = () => {
      
    this.setState({ loading: true });
    let data = new FormData();
    data.append('search', this.state.pencarian);
    axios
    .post(config.apiSatuanHarga+'ApiController/getAll', data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataSsh: response.data.dataSsh, dataHspk: response.data.dataHspk, dataAsb: response.data.dataAsb});
      }
      this.setState({ loading: false });
      console.log(response.data);
      // console.log("-------------"+urusan+bidang);
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
    // console.log(this.state.dataPilih.perumusan_program_id);
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('belanja_id', this.state.dataPilih.belanja_id);
    data.append('perumusan_program_id', this.props.data.perumusan_program_id);
    data.append('Kd_Rek_1', this.state.dataPilih.Kd_Rek_1);
    data.append('Kd_Rek_2', this.state.dataPilih.Kd_Rek_2);
    data.append('Kd_Rek_3', this.state.dataPilih.Kd_Rek_3);
    data.append('Kd_Rek_4', this.state.dataPilih.Kd_Rek_4);
    data.append('Kd_Rek_5', this.state.dataPilih.Kd_Rek_5);
    data.append('nama_belanja', this.state.dataPilih.nama_belanja);
    data.append('volume', this.state.dataPilih.volume);
    data.append('satuan', this.state.dataPilih.satuan);
    data.append('harga', this.state.dataPilih.harga);
    data.append('tahun', this.props.tahun);
    if(this.props.bappeda){
      data.append('status', 2);
      data.append('komentar', this.state.dataPilih.komentar);
    }else{
      data.append('status', 0);
      data.append('komentar', '');
    }
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
    data.append('belanja_id', this.state.dataPilih.belanja_id);
    data.append('perumusan_program_id', this.state.dataPilih.perumusan_program_id);
    data.append('tahun', this.props.tahun);
    axios
    .post(config.apiRoot+this.link+'/delete', data)
    .then(response => {
      if(response.data.status){
        this.getData(this.state.page);
        this.changePesan(response.data.pesan);
      }else{
        this.changePesan(response.data.pesan, 'warning');
      }
      this.modalDelete();
      this.setState({ loading: false });
      console.log(response);
    })
    .catch(error => {
      console.log(error);
      this.setState({ loading: false });
      this.changePesan('Tidak dapat terhubung pada server!', 'danger');
    });
  }

  sendData = (status) => {
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('perumusan_program_id', this.state.dataPilih.perumusan_program_id);
    data.append('status', status);
    data.append('tahun', this.props.tahun);
    axios
    .post(config.apiRoot+this.link+'/kirim', data)
    .then(response => {
      if(response.data.status){
        this.props.lihatRkaKeluar();
        this.changePesan(response.data.pesan);
      }else{
        this.changePesan(response.data.pesan, 'warning');
      }
      this.setState({ loading: false });
      console.log(response);
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
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

getDataTambahan(data){
    this.getRek5(5, 2, 2, data.Kd_Rek_4);
}

tambah(data){
  this.setState({dataPilih:data, edit:0, page:this.state.jumlahPage});
  this.handleSubmit();
}

edit(data){
  this.getDataTambahan(data);
  if(this.state.edit !== 0){
    this.simpan(data);
  }
  this.setState({dataPilih:this.dataPilihAwal, edit:data.idAll});
}

simpan(data){
  this.setState({edit:0, aksi:'Tambah'});
  this.handleSubmit();
  console.log(this.state.dataPilih);
}

  // isi
  isi(){
    let dataProfil = this.props.data;
    if(this.state.loading){
      return(
        <div>
          <img src={loadingImage} alt="logo"/>
        </div>
      );
    }else{
      if(this.props.bappeda){
        this.tombolKirim = <Button color="warning" onClick={() => {this.sendData(1)}} className="mr-1">Kirim ke OPD</Button>; 
        if(!this.props.perubahan){
          this.tombolFinal = <Button color="success" onClick={() => {this.sendData(3)}} className="mr-1">Final</Button>; 
        }
        
      }else{
        this.tombolKirim = null;
        this.tombolFinal = null;
      }
      return(
        <div>
          {this.state.pesan}
          <Row>
            <Col xs="128" md="10">
            <Button color="info" onClick={this.props.lihatRkaKeluar} className="mr-1">Kembali</Button>
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
            <Download link={this.link} rka={true} tahun={this.props.tahun} perumusan_program_id={this.state.dataRkpd.perumusan_program_id} />
            </Col>
            <Col xs="12" md="2">
              
            </Col> 
          </Row> 
          <Table responsive striped bordered>
            <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
              <tr>
                <th colSpan="11">RENCANA KERJA DAN ANGGARAN </th>
                <th>PRA</th>
              </tr>
              <tr>
                <th colSpan="11">SATUAN KERJA PERANGKAT DAERAH</th>
                <th>RKA - OPD</th>
              </tr>
              <tr>
                <th colSpan="11">KABUPATEN MOROWALI</th>
                <th>2.2.1</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Urusan Pemerintahan</td>
                <td>:</td>
                <td>{dataProfil.Kd_Urusan}</td>
                <td colSpan="9">{dataProfil.Nm_Urusan}</td>
              </tr>
              <tr>
                <td>Organisasi</td>
                <td>:</td>
                <td>{dataProfil.Kd_Urusan+"."+dataProfil.Kd_Bidang}</td>
                <td colSpan="9">{dataProfil.Nm_Bidang}</td>
              </tr>
              <tr>
                <td>Unit Organisasi</td>
                <td>:</td>
                <td>{dataProfil.Kd_Urusan+"."+dataProfil.Kd_Bidang+"."+dataProfil.Kd_Unit}</td>
                <td colSpan="9">{dataProfil.Nm_Sub_Unit}</td>
              </tr>
              <tr>
                <td>Sub Unit Organisasi</td>
                <td>:</td>
                <td>{dataProfil.Kd_Urusan+"."+dataProfil.Kd_Bidang+"."+dataProfil.Kd_Unit+"."+dataProfil.Kd_Sub}</td>
                <td colSpan="9">{dataProfil.Nm_Sub_Unit}</td>
              </tr>
              <tr>
                <td>Program</td>
                <td>:</td>
                <td>{dataProfil.Kd_Urusan+"."+dataProfil.Kd_Bidang+"."+dataProfil.Kd_Prog}</td>
                <td colSpan="9">{dataProfil.Ket_Program}</td>
              </tr>
              <tr>
                <td>Kegiatan</td>
                <td>:</td>
                <td>{dataProfil.Kd_Urusan+"."+dataProfil.Kd_Bidang+"."+dataProfil.Kd_Prog+"."+dataProfil.Kd_Keg}</td>
                <td colSpan="9">{dataProfil.Ket_Kegiatan}</td>
              </tr>
              <tr>
                <td>Lokasi Kegiatan</td>
                <td>:</td>
                <td colSpan="10">Tersebar</td>
              </tr>
              <tr>
                <td>Jumlah Tahun n - 1</td>
                <td>:</td>
                <td colSpan="10">Rp. </td>
              </tr>
              <tr>
                <td>Jumlah Tahun n </td>
                <td>:</td>
                <td colSpan="10">Rp. </td>
              </tr>
              <tr>
                <td>Jumlah Tahun n + 1</td>
                <td>:</td>
                <td colSpan="10">Rp. </td>
              </tr>
            </tbody>
          </Table>
          <Table responsive striped bordered>
            <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
              <tr>
                <th colSpan="3">RENCANA KERJA DAN ANGGARAN </th>
              </tr>
              <tr>
                <th>Indikator</th>
                <th>Tolak Ukur Kinerja</th>
                <th>Target Kinerja</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Capaian Program</td>
                <td></td>
                <td>100%</td>
              </tr>
              <tr>
                <td>Masukan</td>
                <td></td>
                <td>Rp. </td>
              </tr>
              <tr>
                <td>Keluaran</td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>Hasil</td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td colSpan="3">Kelompok  Sasaran Kegiatan : Kelompok Nelayan </td>
              </tr>
            </tbody>
          </Table>
          <Button color="info" onClick={() => {this.setState({aksi:'Tambah'});this.tambah(this.dataPilihAwal);}} className="mr-1">Tambah</Button>
          {this.tombolKirim}
          {this.tombolFinal}
          <Table responsive striped bordered>
          <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
            <tr>
              <th rowSpan="2" colSpan="5">Kode</th>
              <th rowSpan="2">U r a i a n</th>
              <th colSpan="3">Rincian Penghitungan</th>
              <th rowSpan="2">Jumlah (Rp)</th>
              <th rowSpan="2">Aksi</th>
            </tr>
            <tr>
            <th>Volume</th>
            <th>Satuan</th>
            <th>Harga Satuan</th>
            </tr>
            <tr>
              <th colSpan="5">(1)</th>
              <th>(2)</th>
              <th>(3)</th>
              <th>(4)</th>
              <th>(5)</th>
              <th>(6)</th>
              <th>(7)</th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataAll.map((data, key) => {
              if(data.idAll !== this.state.edit){
                if(data.Kd_Rek_1 !== ''){
                  if(data.Kd_Rek_5 !== ''){
                    return data ? (
                      <tr key={key}>
                        <td>{data.Kd_Rek_1}</td>
                        <td>{data.Kd_Rek_2}</td>
                        <td>{data.Kd_Rek_3}</td>
                        <td>{data.Kd_Rek_4}</td>
                        <td>{data.Kd_Rek_5}</td>
                        <td>{data.nama_belanja}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{data.total}</td>
                        <td>
                          <Button color="info" onClick={() => {this.setState({aksi:'Tambah'});this.tambah(data);}} className="mr-1">Tambah</Button>
                        </td>
                      </tr>
                    ) : (null);
                  }else if(data.Kd_Rek_3 !== '' && data.Kd_Rek_4 === ''){
                    return data ? (
                      <tr key={key}>
                        <td>{data.Kd_Rek_1}</td>
                        <td>{data.Kd_Rek_2}</td>
                        <td>{data.Kd_Rek_3}</td>
                        <td>{data.Kd_Rek_4}</td>
                        <td>{data.Kd_Rek_5}</td>
                        <td>{data.nama_belanja}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{data.total}</td>
                        <td></td>
                      </tr>
                    ) : (null);
                  }else{
                    return data ? (
                      <tr key={key}>
                        <td>{data.Kd_Rek_1}</td>
                        <td>{data.Kd_Rek_2}</td>
                        <td>{data.Kd_Rek_3}</td>
                        <td>{data.Kd_Rek_4}</td>
                        <td>{data.Kd_Rek_5}</td>
                        <td>{data.nama_belanja}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{data.total}</td>
                        <td></td>
                      </tr>
                    ) : (null);
                  }
                }else{
                  
                  if(data.komentar !== ""){
                    this.warnaRow = {backgroundColor:"#ffc34d"};
                  }else{
                    this.warnaRow = null;
                  }
                  // console.log(data.status);
                  if(this.props.bappeda){
                    return data ? (
                      <tr key={key} style={this.warnaRow}>
                        <td colSpan="5">{data.komentar}</td>
                        <td> - {data.nama_belanja}</td>
                        <td>{data.volume}</td>
                        <td>{data.satuan_nama}</td>
                        <td>{data.harga}</td>
                        <td>{data.harga*data.volume}</td>
                        <td>
                        <Button color="danger" onClick={() => {this.setState({aksi:'Edit'});this.edit(data);}} className="mr-1">Tolak</Button>
                        </td>
                      </tr>
                    ) : (null);
                  }else{
                    return data ? (
                      <tr key={key} style={this.warnaRow}>
                        {/* <td>{data.Kd_Rek_1}</td>
                        <td>{data.Kd_Rek_2}</td>
                        <td>{data.Kd_Rek_3}</td>
                        <td></td> */}
                        <td colSpan="5">{data.komentar}</td>
                        <td> - {data.nama_belanja}</td>
                        <td>{data.volume}</td>
                        <td>{data.satuan_nama}</td>
                        <td>{data.harga}</td>
                        <td>{data.harga*data.volume}</td>
                        <td>
                          <Button color="info" onClick={() => {this.setState({aksi:'Edit'});this.edit(data);}} className="mr-1">Edit</Button>
                          <Button color="danger" onClick={() => this.modalDelete(data)} className="mr-1">Hapus</Button>
                        </td>
                      </tr>
                    ) : (null);
                  }
                }
              }else{
                if(data.Kd_Keg === 0 && data.Kd_Prog !== 0){
                  return data ? (
                    <tr key={key}>
                      <td>{data.Kd_Urusan}</td>
                      <td>{data.Kd_Bidang}</td>
                      <td>{data.Kd_Prog}</td>
                      <td>{data.Kd_Keg}</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><Input type="text" style={this.styleForm} value={data['target'+this.state.dataTambah.tahun+'_harga']} data-number="10" onChange={this.handleChange(key)}/></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <Button color="success" onClick={() => {this.simpan(data)}}  className="mr-1">Simpan</Button>
                      </td>
                    </tr>
                  ) : (null);
                }else{
                  if(this.props.bappeda){
                    return data ? (
                      <tr key={key}>
                        <td>{data.Kd_Rek_1}</td>
                        <td>{data.Kd_Rek_2}</td>
                        <td>{data.Kd_Rek_3}</td>
                        <td></td>
                        <td></td>
                        <td> - {data.nama_belanja}</td>
                        <td>{data.volume}</td>
                        <td>{data.satuan_nama}</td>
                        <td>{data.harga}</td>
                        <td>{data.harga*data.volume}</td>
                        <td>
                          <Input type="text" style={this.styleForm} value={data.komentar} data-number="7" onChange={this.handleChange(key)}/>
                          <Button color="danger" onClick={() => {this.simpan(data)}}  className="mr-1">Tolak</Button>
                        </td>
                      </tr>
                    ) : (null);
                  }else{
                    return data ? (
                      <tr key={key}>
                        <td>{data.Kd_Rek_1}</td>
                        <td>{data.Kd_Rek_2}</td>
                        <td>{data.Kd_Rek_3}</td>
                        <td>
                          <Input type="select" style={this.styleForm} value={data.Kd_Rek_4} data-number="1" onChange={this.handleChange(key)} required autoFocus >
                            <option key="-1" value="">-= Pilih Kode Rekening 4 =-</option>
                            {this.state.dataRek4.map((data, key) => {
                              return data ? (
                                <option key={key} value={data.Kd_Rek_4}>{data.Nm_Rek_4}</option>
                              ) : (null);
                            })}
                          </Input>
                        </td>
                        <td>
                        <Input type="select" style={this.styleForm} value={data.Kd_Rek_5} data-number="2" onChange={this.handleChange(key)} required autoFocus >
                            <option key="-1" value="">-= Pilih Kode Rekening 5 =-</option>
                            {this.state.dataRek5.map((data, key) => {
                              return data ? (
                                <option key={key} value={data.Kd_Rek_5}>{data.Nm_Rek_5}</option>
                              ) : (null);
                            })}
                          </Input>
                        </td>
                        <td>
                          <Input type="select" style={this.styleForm} value={data.nama_belanja}  data-number="3" onChange={this.handleChange(key)} required autoFocus >
                            <option key="-1" value="">-= Pilih Data =-</option>
                            {this.state.dataSsh.map((data, key) => {
                              return data ? (
                              <option key={key} data-harga={data.harga_zona2} data-satuan={data.Satuan} value={data.Kd_Ssh1+'-'+data.Kd_Ssh2+'-'+data.Kd_Ssh3+'-'+data.Kd_Ssh4+'-'+data.Kd_Ssh5+'-'+data.Kd_Ssh6}>{data.Nama_Barang+' ('+data.Spesifikasi+')'}</option>
                              ) : (null);
                            })}
                            {this.state.dataHspk.map((data, key) => {
                              return data ? (
                              <option key={key} data-harga={data.HargaZona2} data-satuan={data.Kd_Satuan} value={data.Kd_Hspk1+'-'+data.Kd_Hspk2+'-'+data.Kd_Hspk3+'-'+data.Kd_Hspk4}>{data.Uraian_Kegiatan}</option>
                              ) : (null);
                            })}
                            {this.state.dataAsb.map((data, key) => {
                              return data ? (
                              <option key={key} data-harga={data.HargaZona2} data-satuan={data.Kd_Satuan} value={data.Kd_Asb1+'-'+data.Kd_Asb2+'-'+data.Kd_Asb3+'-'+data.Kd_Asb4+'-'+data.Kd_Asb5}>{data.Jenis_Pekerjaan}</option>
                              ) : (null);
                            })}
                          </Input>
                          {data.nama_belanja}
                        </td>
                        <td><Input type="text" style={this.styleForm} value={data.volume} data-number="4" onChange={this.handleChange(key)}/></td>
                        <td>
                          <Input type="select" style={this.styleForm} value={data.satuan} data-number="5" onChange={this.handleChange(key)} required autoFocus >
                            <option key="-1" value="">-= Pilih Satuan =-</option>
                            {this.state.dataSatuan.map((data, key) => {
                              return data ? (
                                <option key={key} value={data.Kd_Satuan}>{data.Uraian}</option>
                              ) : (null);
                            })}
                          </Input>
                        </td>
                        <td>{data.harga}</td>
                        <td>{data.harga*data.volume}</td>
                        <td>
                          <Button color="success" onClick={() => {this.simpan(data)}}  className="mr-1">Simpan</Button>
                        </td>
                      </tr>
                    ) : (null);
                  }
                }
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
    // console.log(this.props.data);
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
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
          </Col>
        </Row>
      </div>
    );
  }
}

export default PraRkaCreate;
