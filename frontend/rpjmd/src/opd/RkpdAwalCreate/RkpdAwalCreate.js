import React, { Component } from 'react';
import { Alert, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';

class RkpdAwalCreate extends Component {
  
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

    document.title = "Menyusun RKPD Awal";
    this.link = 'opd/menyusun/rkpd-awal';
    
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
    if(no === 2){
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
        dataOpd:dataAll.dataOpd, 
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
              <th rowSpan="2" colSpan="4">Kode</th>
              <th rowSpan="2">Urusan / Bidang / Program / Kegiatan</th>
              <th colSpan="2">Indikator Kinerka (Outcome)</th>
              <th colSpan="5">Tahun {this.rpjmdTahun+parseInt(this.state.dataTambah.tahun)-1} (Tahun Berjalan)</th>
              
              <th rowSpan="2">Catatan Penting</th>
              <th colSpan="3">Tahun {this.rpjmdTahun+parseInt(this.state.dataTambah.tahun)} (Tahun Berikutnya)</th>
              <th rowSpan="2">Aksi</th>
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
            <th colSpan="4">(1)</th>
            <th>(2)</th>
            <th colSpan="2">(3)</th>
            <th>(4)</th>
            <th colSpan="2">(5)</th>
            <th>(6)</th>
            <th>(7)</th>
            <th>(8)</th>
            <th colSpan="2">(9)</th>
            <th>(10)</th>
            <th>(11)</th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataAll.map((data, key) => {
              if(data.idAll !== this.state.edit){
                if(data.Kd_Keg === 0){
                  return data ? (
                    <tr key={key}>
                      <td>{data.Kd_Urusan}</td>
                      <td>{data.Kd_Bidang}</td>
                      <td>{data.Kd_Prog}</td>
                      <td>{data.Kd_Keg}</td>
                      <td>{data.nama_jenis}</td>
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
                  return data ? (
                    <tr key={key}>
                      <td>{data.Kd_Urusan}</td>
                      <td>{data.Kd_Bidang}</td>
                      <td>{data.Kd_Prog}</td>
                      <td>{data.Kd_Keg}</td>
                      <td>{data.nama_jenis}</td>
                      <td>{data.outcome}</td>
                      <td>{data.outcome_kegiatan}</td>
                      <td>{data.lokasi}</td>
                      <td>{data['target'+this.state.dataTambah.tahun+'_tahun']}</td>
                      <td>{data['target'+this.state.dataTambah.tahun+'_satuan_nama']}</td>
                      <td>{data['target'+this.state.dataTambah.tahun+'_harga']}</td>
                      <td>{data['target'+this.state.dataTambah.tahun+'_sumber_dana']}</td>
                      <td>{data['target'+this.state.dataTambah.tahun+'_catatan']}</td>
                      
                      <td>{data['target'+(parseInt(this.state.dataTambah.tahun)+1)+'_tahun']}</td>
                      <td>{data['target'+(parseInt(this.state.dataTambah.tahun)+1)+'_satuan_nama']}</td>
                      <td>{data['target'+(parseInt(this.state.dataTambah.tahun)+1)+'_harga']}</td>
                      <td>
                        <Button color="info" onClick={() => {this.setState({aksi:'Edit'});this.edit(data);}} className="mr-1">Edit</Button>
                        {/* <Button color="danger" onClick={() => this.modalDelete(data)} className="mr-1">Hapus</Button> */}
                      </td>
                    </tr>
                  ) : (null);
                }
              }else{
                return data ? (
                  <tr key={key}>
                    <td>{data.Kd_Urusan}</td>
                    <td>{data.Kd_Bidang}</td>
                    <td>{data.Kd_Prog}</td>
                    <td>{data.Kd_Keg}</td>
                    <td>{data.nama_jenis}</td>
                    <td>{data.outcome}</td>
                    <td>{data.outcome_kegiatan}</td>
                    <td>{data.lokasi}</td>
                    <td>{data['target'+this.state.dataTambah.tahun+'_tahun']}</td>
                    <td>{data['target'+this.state.dataTambah.tahun+'_satuan_nama']}</td>
                    <td>{data['target'+this.state.dataTambah.tahun+'_harga']}</td>
                    <td><Input type="text" style={this.styleForm} value={data['target'+this.state.dataTambah.tahun+'_sumber_dana']} data-number="1" onChange={this.handleChange(key)}/></td>
                    <td><Input type="text" style={this.styleForm} value={data['target'+this.state.dataTambah.tahun+'_catatan']} data-number="2" onChange={this.handleChange(key)}/></td>
                    <td>{data['target'+(parseInt(this.state.dataTambah.tahun)+1)+'_tahun']}</td>
                    <td>{data['target'+(parseInt(this.state.dataTambah.tahun)+1)+'_satuan_nama']}</td>
                    <td>{data['target'+(parseInt(this.state.dataTambah.tahun)+1)+'_harga']}</td>
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
              <h5 style={{textAlign: 'center',}}>RANCANGAN AWAL</h5>
              <h5 style={{textAlign: 'center',}}>RENCANA KERJA PEMERINTAH DAERAH TAHUN {this.rpjmdTahun+parseInt(this.state.dataTambah.tahun)-1} ( Tahun Berjalan)</h5>
                {/* <table>
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
                </table> */}
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

export default RkpdAwalCreate;
