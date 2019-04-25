import React, { Component } from 'react';
import { Alert, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';

import PraRkaCreate from '../PraRkaCreate';
import Download from '../../rpjmd/other/Download';

class RkpdFinalCreate extends Component {
  
  constructor(props) {
    super(props);

    this.dataPilihAwal = {
      id:0,
      name:'0',
      ageid:0,
    };

    this.state = {
      loading:false,
      dataAll: [],
      jumlahPage: 1,
      modalCreate: false,
      modalDelete: false,
      modalPesan: false,
      dataPilih: this.dataPilihAwal,
      dataTambah:[],
      dataUrusan:[],
      dataBidang:[],
      dataProgram:[],
      dataKegiatan:[],
      dataSatuan:[],
      pencarian: '',
      lihatRka: false,
      page: 1,
      aksi:'Tambah',
      name:"",
      age:0,
      edit:0,
    }

    document.title = "Menyusun RKPD Final";
    this.link = 'opd/menyusun/rkpd-verifikasi';
    
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
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        data = { ...shareholder, Kd_Urusan: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
      this.getBidang(evt.target.value);
    }
    if(no === 2){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        data = { ...shareholder, Kd_Bidang: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
      this.getProgram(this.state.dataPilih.Kd_Urusan, evt.target.value);
    }
    if(no === 3){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        data = { ...shareholder, Kd_Prog: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
      this.getKegiatan(this.state.dataPilih.Kd_Urusan, this.state.dataPilih.Kd_Bidang, evt.target.value);
    }
    if(no === 4){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        data = { ...shareholder, Kd_Keg: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 5){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        data = { ...shareholder, outcome: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 6){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        data = { ...shareholder, outcome_kegiatan: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 7){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        if(this.state.dataTambah.tahun === 1){
          data = { ...shareholder, 'target1_lokasi': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 2){
          data = { ...shareholder, 'target2_lokasi': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 3){
          data = { ...shareholder, 'target3_lokasi': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 4){
          data = { ...shareholder, 'target4_lokasi': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 5){
          data = { ...shareholder, 'target5_lokasi': evt.target.value };
        }
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 8){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        if(this.state.dataTambah.tahun === 1){
          data = { ...shareholder, 'target1_tahun': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 2){
          data = { ...shareholder, 'target2_tahun': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 3){
          data = { ...shareholder, 'target3_tahun': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 4){
          data = { ...shareholder, 'target4_tahun': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 5){
          data = { ...shareholder, 'target5_tahun': evt.target.value };
        }
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 9){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        // 
        if (idx !== sidx) return data;
        if(this.state.dataTambah.tahun === 1){
          data = { ...shareholder, 'target1_satuan': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 2){
          data = { ...shareholder, 'target2_satuan': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 3){
          data = { ...shareholder, 'target3_satuan': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 4){
          data = { ...shareholder, 'target4_satuan': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 5){
          data = { ...shareholder, 'target5_satuan': evt.target.value };
        }
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 10){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        if(this.state.dataTambah.tahun === 1){
          data = { ...shareholder, 'target1_harga': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 2){
          data = { ...shareholder, 'target2_harga': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 3){
          data = { ...shareholder, 'target3_harga': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 4){
          data = { ...shareholder, 'target4_harga': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 5){
          data = { ...shareholder, 'target5_harga': evt.target.value };
        }
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 11){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        if(this.state.dataTambah.tahun === 1){
          data = { ...shareholder, 'target1_sumber_dana': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 2){
          data = { ...shareholder, 'target2_sumber_dana': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 3){
          data = { ...shareholder, 'target3_sumber_dana': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 4){
          data = { ...shareholder, 'target4_sumber_dana': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 5){
          data = { ...shareholder, 'target5_sumber_dana': evt.target.value };
        }
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 12){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        let data = shareholder;
        if (idx !== sidx) return data;
        if(this.state.dataTambah.tahun === 1){
          data = { ...shareholder, 'target1_catatan': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 2){
          data = { ...shareholder, 'target2_catatan': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 3){
          data = { ...shareholder, 'target3_catatan': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 4){
          data = { ...shareholder, 'target4_catatan': evt.target.value };
        }
        if(this.state.dataTambah.tahun === 5){
          data = { ...shareholder, 'target5_catatan': evt.target.value };
        }
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
        dataTambah:dataAll.dataTambah,
        dataUrusan:dataAll.dataUrusan,
        dataSatuan:dataAll.dataSatuan,
      });
    }
    if(dataAll.data.length > 0)
      this.rpjmdTahun = parseInt(dataAll.data[0]['rpjmd_tahun']);
    else
      this.rpjmdTahun = 0;
    console.log(this.state.dataTambah.tahun);
  }

  getData = (page = 1) => {
    
    this.setState({ loading: true });
    // console.log('response');
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('search', this.state.pencarian);
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

    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('perumusan_program_id', this.state.dataPilih.perumusan_program_id);
    data.append('Kd_Urusan', this.state.dataPilih.Kd_Urusan);
    data.append('Kd_Bidang', this.state.dataPilih.Kd_Bidang);
    data.append('Kd_Prog', this.state.dataPilih.Kd_Prog);
    data.append('Kd_Keg', this.state.dataPilih.Kd_Keg);
    data.append('outcome', this.state.dataPilih.outcome);
    data.append('outcome_kegiatan', this.state.dataPilih.outcome_kegiatan);
    data.append('target'+this.state.dataTambah.tahun+'_lokasi', this.state.dataPilih['target'+this.state.dataTambah.tahun+'_lokasi']);
    data.append('target'+this.state.dataTambah.tahun+'_tahun', this.state.dataPilih['target'+this.state.dataTambah.tahun+'_tahun']);
    data.append('target'+this.state.dataTambah.tahun+'_satuan', this.state.dataPilih['target'+this.state.dataTambah.tahun+'_satuan']);
    data.append('target'+this.state.dataTambah.tahun+'_harga', this.state.dataPilih['target'+this.state.dataTambah.tahun+'_harga']);
    data.append('target'+this.state.dataTambah.tahun+'_sumber_dana', this.state.dataPilih['target'+this.state.dataTambah.tahun+'_sumber_dana']);
    data.append('target'+this.state.dataTambah.tahun+'_catatan', this.state.dataPilih['target'+this.state.dataTambah.tahun+'_catatan']);
    data.append('tahun', this.state.dataTambah.tahun);
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
  if(this.state.edit !== 0){
    this.simpan(data);
  }
  this.setState({dataPilih:data, edit:data.idAll});
}

lihatRkaKeluar(){
  console.log('keluar');
  console.log(this.props);
  // this.setState({lihatRka:false});
}

lihatRka(data){
  this.setState({lihatRka:true, dataPilih:data});
}

simpan(data){
  this.setState({edit:0, aksi:'Tambah'});
  this.handleSubmit();
  console.log(this.state.dataPilih);
}

// isi
  isi(){
    if(this.state.loading){
      return(
        <div>
          <img src={loadingImage} alt="logo"/>
        </div>
      );
    }else if(this.state.lihatRka){
      return(
        <div>
          <PraRkaCreate name="namaku" tahun={this.state.dataTambah.tahun} bappeda={true} data={this.state.dataPilih} lihatRkaKeluar={()=>{this.setState({lihatRka:false});window.location.reload();}} />
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
            <Download link={this.link}/>
            </Col>
            <Col xs="12" md="2">
              {/* <Button color="info" onClick={() => {this.setState({aksi:'Tambah'});this.tambah();}} className="mr-1">Tambah</Button> */}
            </Col> 
          </Row> 
          <Table responsive striped bordered>
          <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
            <tr>
              <th rowSpan="2">Aksi</th>
              <th rowSpan="2" colSpan="4">Kode</th>
              <th rowSpan="2" colSpan="4">Urusan / Bidang / Program / Kegiatan</th>
              <th colSpan="2">Indikator Kinerka (Outcome)</th>
              <th colSpan="5">Tahun {this.rpjmdTahun+parseInt(this.state.dataTambah.tahun)-1} (Tahun Berjalan)</th>
              <th rowSpan="2">Catatan Penting</th>
              <th colSpan="3">Tahun {this.rpjmdTahun+parseInt(this.state.dataTambah.tahun)} (Tahun Berikutnya)</th>
              <th rowSpan="2">OPD</th>
            </tr>
            <tr>
              <th>Program</th>
              <th>Kegiatan</th>
              <th>Lokasi</th>
              <th colSpan="2">Target capaian kinerja</th>
              <th>Kebutuhan Dana/ pagu indikatif (Rp)</th>
              <th>Sumber Dana</th>
              <th colSpan="2">Target capaian kinerja</th>
              <th>Kebutuhan Dana/ pagu indikatif (Rp)</th>
            </tr>
            <tr>
              <th>(1)</th>
              <th colSpan="4">(2)</th>
              <th colSpan="4">(3)</th>
              <th colSpan="2">(4)</th>
              <th>(5)</th>
              <th colSpan="2">(6)</th>
              <th>(7)</th>
              <th>(8)</th>
              <th>(9)</th>
              <th colSpan="2">(10)</th>
              <th>(11)</th>
              <th>(12)</th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataAll.map((data, key) => {
              if(data.Kd_Keg === 0){
                return data ? (
                  <tr key={key}>
                    <td></td>
                    <td>{data.Kd_Urusan}</td>
                    <td>{data.Kd_Bidang}</td>
                    <td>{data.Kd_Prog}</td>
                    <td>{data.Kd_Keg}</td>
                    <td>{data.Nm_Urusan}</td>
                    <td>{data.Nm_Bidang}</td>
                    <td>{data.Ket_Program}</td>
                    <td>{data.Ket_Kegiatan}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                ) : (null);
              }else{

                if(data['target'+this.state.dataTambah.tahun+'_status'] === '3'){
                  this.warnaFinal = {backgroundColor:'#a1f7af'}
                }else if(data['target'+this.state.dataTambah.tahun+'_status'] === '2'){
                  this.warnaFinal = {backgroundColor:'#4da6ff'}
                }else if(data['target'+this.state.dataTambah.tahun+'_status'] === '1'){
                  this.warnaFinal = {backgroundColor:'#ffa64d'}
                }else{
                  this.warnaFinal = null;
                }
                return data ? (
                  <tr key={key} style={this.warnaFinal}>
                    <td>
                      <Button color="success" onClick={() => {this.lihatRka(data);}} className="mr-1">Lihat PRA RKA</Button>
                      {/* <Button color="danger" onClick={() => this.modalDelete(data)} className="mr-1">Hapus</Button> */}
                    </td>
                    <td>{data.Kd_Urusan}</td>
                    <td>{data.Kd_Bidang}</td>
                    <td>{data.Kd_Prog}</td>
                    <td>{data.Kd_Keg}</td>
                    <td>{data.Nm_Urusan}</td>
                    <td>{data.Nm_Bidang}</td>
                    <td>{data.Ket_Program}</td>
                    <td>{data.Ket_Kegiatan}</td>
                    <td>{data.outcome}</td>
                    <td>{data.outcome_kegiatan}</td>
                    <td>{data['target'+this.state.dataTambah.tahun+'_lokasi']}</td>
                    <td>{data['target'+this.state.dataTambah.tahun+'_tahun']}</td>
                    <td>{data['target'+this.state.dataTambah.tahun+'_satuan_nama']}</td>
                    <td>{data['target'+this.state.dataTambah.tahun+'_harga']}</td>
                    <td>{data['target'+this.state.dataTambah.tahun+'_sumber_dana']}</td>
                    <td>{data['target'+this.state.dataTambah.tahun+'_catatan']}</td>
                    <td>{data['target'+(parseInt(this.state.dataTambah.tahun)+1)+'_tahun']}</td>
                    <td>{data['target'+(parseInt(this.state.dataTambah.tahun)+1)+'_satuan_nama']}</td>
                    <td>{data['target'+(parseInt(this.state.dataTambah.tahun)+1)+'_harga']}</td>
                    <td>{data.Nm_Sub_Unit}</td>
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
                <h5 style={{textAlign: 'center',}}>RENCANA KERJA PEMERINTAH DAERAH TAHUN {this.rpjmdTahun+parseInt(this.state.dataTambah.tahun)-1} ( Tahun Berjalan)</h5>
                <hr/>
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

export default RkpdFinalCreate;
