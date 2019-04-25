import React, { Component } from 'react';
import { Alert, FormGroup, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';
import Download from '../../rpjmd/other/Download';

class RenstraOpdCreate extends Component {
  
  constructor(props) {
    super(props);

    this.styleForm = {
      minWidth:300,
    }

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
      dataOpd:[],
      pencarian: '',
      page: 1,
      aksi:'Tambah',
      name:"",
      age:0,
      edit:0,
    }

    document.title = "Menyusun Renstra OPD";
    this.link = 'opd/menyusun/renstra-opd';
    
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
        if (idx !== sidx) return shareholder;
        let data = { ...shareholder, Kd_Keg: evt.target.value };
        this.setState({dataPilih:data});
        return data;
      });
      this.setState({ dataAll: newdataTests });
    }
    if(no === 2){
      const newdataTests = this.state.dataAll.map((shareholder, sidx) => {
        if (idx !== sidx) return shareholder;
        let data = { ...shareholder, outcome_kegiatan: evt.target.value };
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
        dataOpd:dataAll.dataOpd, 
      });
    }
    if(dataAll.data.length > 0)
      this.rpjmdTahun = parseInt(dataAll.data[0]['rpjmd_tahun']);
    else
      this.rpjmdTahun = 0;

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
        this.setState({ dataTambah: response.data.data});
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

  handleSubmit = (data2 = []) => {
    this.setState({ loading: true });
    let link = '';
    if(this.state.aksi === 'Edit'){
      link = config.apiRoot+this.link+'/update';
      
    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+this.link+'/create';
    }
    // console.log(data2);
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    
    if(this.state.aksi === 'Tambah'){
      data.append('perumusan_program_id', data2.perumusan_program_id);
    }else{
      data.append('perumusan_program_id', this.state.dataPilih.perumusan_program_id);
      data.append('Kd_Keg', this.state.dataPilih.Kd_Keg);
      data.append('outcome_kegiatan', this.state.dataPilih.outcome_kegiatan);
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
      this.modalDelete();
      if(response.data.status){
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

tambah(data){
  // console.log(data);
  this.setState({dataPilih:data, edit:0, page:this.state.jumlahPage});
  this.handleSubmit(data);
}

edit(data){
  if(this.state.edit !== 0){
    this.simpan(data);
  }
  this.getKegiatan(data.Kd_Urusan, data.Kd_Bidang, data.Kd_Prog);
  this.setState({dataPilih:this.dataPilihAwal, edit:data.idAll});
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
    }else{
      return(
        <div>
          {this.state.pesan}
          <Row>
            <Col xs="128" md="10">
            <Download link="opd/menyusun/renstra-opd"/>
            <Form method="post" onSubmit={this.handleCariSubmit} className="form-horizontal">
              <FormGroup row>
                <Col xs="9" md="5">
                <Input type="text" placeholder="Pencarian" onChange={this.handlePencarianChange} value={this.state.pencarian} />
                </Col>
                <Col xs="3" md="2">
                  <Button color="primary" >Cari</Button>
                </Col>
              </FormGroup>
            </Form>
            </Col>
            <Col xs="12" md="2">
              {/* <Button color="info" onClick={() => {this.setState({aksi:'Tambah'});this.tambah();}} className="mr-1">Tambah</Button> */}
            </Col> 
          </Row> 
          <Table responsive striped bordered>
          <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
            <tr>
              <th rowSpan="3">Tujuan</th>
              <th rowSpan="3">Sasaran</th>
              <th rowSpan="3">Indikator</th>
              <th rowSpan="3" colSpan="4">Kode</th>
              <th rowSpan="3">Program</th>
              <th rowSpan="3">Kegiatan</th>
              <th rowSpan="2" colSpan="2">Indikator Kinerka (Outcome)</th>
              <th rowSpan="3">Kondisi Kinerja pada Awal RPJMD (Tahun 0)</th>
              <th colSpan="17">Capaian Kerja</th>
              <th rowSpan="3">Lokasi</th>
              <th rowSpan="3">Penanggung Jawab</th>
              <th rowSpan="3">Aksi</th>
            </tr>
            <tr>
            
            <th colSpan="3">{this.rpjmdTahun}</th>
            <th colSpan="3">{this.rpjmdTahun+1}</th>
            <th colSpan="3">{this.rpjmdTahun+2}</th>
            <th colSpan="3">{this.rpjmdTahun+3}</th>
            <th colSpan="3">{this.rpjmdTahun+4}</th>
              <th colSpan="2">Kondisi Kinerja Akhir Periode</th>
            </tr>
            <tr>
            <th>Program</th>
            <th>Kegiatan</th>
            <th colSpan="2">Target</th>
              <th>Rp</th>
              <th colSpan="2">Target</th>
              <th>Rp</th>
              <th colSpan="2">Target</th>
              <th>Rp</th>
              <th colSpan="2">Target</th>
              <th>Rp</th>
              <th colSpan="2">Target</th>
              <th>Rp</th>
              <th>Target</th>
              <th>Rp</th>
            </tr>
            <tr>
            <th>(1)</th>
            <th>(2)</th>
            <th>(3)</th>
            <th colSpan="4">(4)</th>
            <th colSpan="2">(5)</th>
            <th colSpan="2">(6)</th>
            <th>(7)</th>
            <th colSpan="2">(8)</th>
            <th>(9)</th>
            <th colSpan="2">(10)</th>
            <th>(11)</th>
            <th colSpan="2">(12)</th>
            <th>(13)</th>
            <th colSpan="2">(14)</th>
            <th>(15)</th>
            <th colSpan="2">(16)</th>
            <th>(17)</th>
            <th>(18)</th>
            <th>(19)</th>
            <th>(20)</th>
            <th>(21)</th>
            <th></th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataAll.map((data, key) => {
              if(data.idAll !== this.state.edit){
                if(data.Kd_Keg === ''){
                  return data ? (
                    <tr key={key}>
                      <td>{data.tujuan_nama}</td>
                      <td>{data.sasaran_nama}</td>
                      <td>{data.indikator_nama}</td>
                      <td>{data.Kd_Urusan}</td>
                      <td>{data.Kd_Bidang}</td>
                      <td>{data.Kd_Prog}</td>
                      <td>{data.Kd_Keg}</td>
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
                      <td>
                      <Button color="info" onClick={() => {this.setState({aksi:'Tambah'});this.tambah(data);}} className="mr-1">Tambah</Button>
                        {/* <Button color="danger" onClick={() => this.modalDelete(data)} className="mr-1">Hapus</Button> */}
                      </td>
                    </tr>
                  ) : (null);
                }else{
                  return data ? (
                    <tr key={key}>
                      <td>{data.tujuan_nama}</td>
                      <td>{data.sasaran_nama}</td>
                      <td>{data.indikator_nama}</td>
                      <td>{data.Kd_Urusan}</td>
                      <td>{data.Kd_Bidang}</td>
                      <td>{data.Kd_Prog}</td>
                      <td>{data.Kd_Keg}</td>
                      <td>{data.Ket_Program}</td>
                      <td>{data.Ket_Kegiatan}</td>
                      <td>{data.outcome}</td>
                      <td>{data.outcome_kegiatan}</td>
                      <td>{data.kondisi_awal}</td>
                      <td>{data.target1_tahun}</td>
                      <td>{data.target1_satuan_nama}</td>
                      <td>{data.target1_harga}</td>
                      <td>{data.target2_tahun}</td>
                      <td>{data.target2_satuan_nama}</td>
                      <td>{data.target2_harga}</td>
                      <td>{data.target3_tahun}</td>
                      <td>{data.target3_satuan_nama}</td>
                      <td>{data.target3_harga}</td>
                      <td>{data.target4_tahun}</td>
                      <td>{data.target4_satuan_nama}</td>
                      <td>{data.target4_harga}</td>
                      <td>{data.target5_tahun}</td>
                      <td>{data.target5_satuan_nama}</td>
                      <td>{data.target5_harga}</td>
                      <td>{data.akhir_target}</td>
                      <td>{(parseInt(data.target1_harga)+parseInt(data.target2_harga)+parseInt(data.target3_harga)+parseInt(data.target4_harga)+parseInt(data.target5_harga))}</td>
                      <td>{data.lokasi}</td>
                      <td>{data.Nm_Sub_Unit}</td>
                      <td>
                        <Button color="info" onClick={() => {this.setState({aksi:'Edit'});this.edit(data);}} className="mr-1">Edit</Button>
                        <Button color="danger" onClick={() => this.modalDelete(data)} className="mr-1">Hapus</Button>
                      </td>
                    </tr>
                  ) : (null);
                }
              }else{
                return data ? (
                  <tr key={key}>
                    <td>{data.tujuan_nama}</td>
                    <td>{data.sasaran_nama}</td>
                    <td>{data.indikator_nama}</td>
                    <td>{data.Kd_Urusan}</td>
                    <td>{data.Kd_Bidang}</td>
                    <td>{data.Kd_Prog}</td>
                    <td>{data.Kd_Keg}</td>
                    <td>{data.Ket_Program}</td>
                    <td>
                      <Input type="select" style={this.styleForm} value={data.Kd_Keg} data-number="1" onChange={this.handleChange(key)} required autoFocus >
                        <option key="-1" value="">-= Pilih Kegiatan =-</option>
                        {this.state.dataTambah.map((data, key) => {
                          return data ? (
                            <option key={key} value={data.Kd_Keg}>{data.Ket_Kegiatan}</option>
                          ) : (null);
                        })}
                      </Input>
                    </td>
                    <td>{data.outcome}</td>
                    <td>
                      <Input type="text" style={this.styleForm} value={data.outcome_kegiatan} data-number="2" onChange={this.handleChange(key)}/>
                    </td>
                    <td>{data.kondisi_awal}</td>
                    <td>{data.target1_tahun}</td>
                    <td>{data.target1_satuan_nama}</td>
                    <td>{data.target1_harga}</td>
                    <td>{data.target2_tahun}</td>
                    <td>{data.target2_satuan_nama}</td>
                    <td>{data.target2_harga}</td>
                    <td>{data.target3_tahun}</td>
                    <td>{data.target3_satuan_nama}</td>
                    <td>{data.target3_harga}</td>
                    <td>{data.target4_tahun}</td>
                    <td>{data.target4_satuan_nama}</td>
                    <td>{data.target4_harga}</td>
                    <td>{data.target5_tahun}</td>
                    <td>{data.target5_satuan_nama}</td>
                    <td>{data.target5_harga}</td>
                    
                    <td>{data.akhir_target}</td>
                    <td>{(parseInt(data.target1_harga)+parseInt(data.target2_harga)+parseInt(data.target3_harga)+parseInt(data.target4_harga)+parseInt(data.target5_harga))}</td>
                    <td>{data.lokasi}</td>
                    <td>{data.Nm_Sub_Unit}</td>
                    <td>
                    <Button color="success" onClick={() => {this.simpan(data)}}  className="mr-1">Simpan</Button>
                    </td>
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
              <h5 style={{textAlign: 'center',}}>Matriks Rencana Program, Kegiatan, Indikator Kinerja, Kelompok Sasaran dan Pendanaan Indikatif</h5>
                <table>
                  <tbody>
                    <tr>
                      <td>Urusan</td>
                      <td>:</td>
                      <td>{this.state.dataOpd.Nm_Urusan}</td>
                    </tr>
                    <tr>
                      <td>Bidang</td>
                      <td>:</td>
                      <td>{this.state.dataOpd.Nm_Bidang}</td>
                    </tr>
                    <tr>
                      <td>Unit</td>
                      <td>:</td>
                      <td>{this.state.dataOpd.Nm_Unit}</td>
                    </tr>
                    <tr>
                      <td>Sub</td>
                      <td>:</td>
                      <td>{this.state.dataOpd.Nm_Sub_Unit}</td>
                    </tr>
                  </tbody>
                </table>
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

export default RenstraOpdCreate;
