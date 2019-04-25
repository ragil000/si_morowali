import React, { Component } from 'react';
import { Alert, FormGroup, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';
import Download from '../../rpjmd/other/Download';

//https://goshakkk.name/array-form-inputs/

class MisiCreate extends Component {
  
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
      pencarian: '',
      page: 1,
      aksi:'Tambah',
      name:"",
      age:0,
      edit:0,
    }

    document.title = "Menyusun Misi OPD";
    this.link = 'opd/menyusun/misi';
    
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
        let data = { ...shareholder, opd_misi_nama: evt.target.value };
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
        // dataKategori:dataAll.kategori, 
        // dataTambah:dataAll.dataTambah
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
    // link = config.apiRoot+'rpjmd/menyusun/sasaran/create';
    // console.log(this.state.dataPilih.visi_id);
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    
    data.append('opd_misi_id', this.state.dataPilih.opd_misi_id);
    data.append('opd_visi_id', this.state.dataPilih.opd_visi_id);
    data.append('opd_misi_nama', this.state.dataPilih.opd_misi_nama);

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
    data.append('opd_misi_id', this.state.dataPilih.opd_misi_id);
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
  if(this.state.jumlahPage > 0)
    this.setState({dataPilih:this.dataPilihAwal, edit:0, page:this.state.jumlahPage});
  else
    this.setState({dataPilih:this.dataPilihAwal, edit:0, page:1});
  // this.setState({dataPilih:this.dataPilihAwal, edit:0, page:this.state.jumlahPage});
  this.handleSubmit();
}

edit(data){
  if(this.state.edit !== 0){
    this.simpan(data);
  }
  this.setState({dataPilih:this.dataPilihAwal, edit:data.opd_misi_id});
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
            <Download link="opd/menyusun/misi"/>
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
              <Button color="info" onClick={() => {this.setState({aksi:'Tambah'});this.tambah();}} className="mr-1">Tambah</Button>
            </Col> 
          </Row> 
          <Table responsive striped bordered>
          <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
            <tr>
              <th>No</th>
              <th>Visi</th>
              <th>Misi</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataAll.map((data, key) => {
              if(data.opd_misi_id !== this.state.edit){
                return data ? (
                  <tr key={key}>
                    <td>{((this.state.page-1)*20)+key+1}</td>
                    <td>{data.opd_visi_nama}</td>
                    <td>{data.opd_misi_nama}</td>
                    <td>
                      <Button color="info" onClick={() => {this.setState({aksi:'Edit'});this.edit(data);}} className="mr-1">Edit</Button>
                      <Button color="danger" onClick={() => this.modalDelete(data)} className="mr-1">Hapus</Button>
                    </td>
                  </tr>
                ) : (null);
              }else{
                return data ? (
                  <tr key={key}>
                    <td>{((this.state.page-1)*20)+key+1}</td>
                    <td>{data.opd_visi_nama}</td>
                    <td><Input type="text" value={data.opd_misi_nama} data-number="1" onChange={this.handleChange(key)}/></td>
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

export default MisiCreate;
