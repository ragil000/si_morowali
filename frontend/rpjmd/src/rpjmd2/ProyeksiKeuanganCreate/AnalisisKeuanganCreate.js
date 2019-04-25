import React, { Component } from 'react';
import { FormText, Alert, FormGroup, Label, Input, CardBody, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';


class AnalisisKeuanganCreate extends Component {
  
  constructor(props) {
    super(props);

    this.dataPilihAwal = {
      analisis_keuangan_id:'',
      rekening:0,
      data_tahun_dasar:0,
      tingkat_pertumbuhan:0,
      tahun1:0,
      tahun2:0,
      tahun3:0,
      tahun4:0,
      tahun5:0,
    };

    this.state = {
      loading:false,
      dataAll: [],
      jumlahPage: 1,
      modalCreate: false,
      modalDelete: false,
      dataPilih: this.dataPilihAwal,
      dataMisi:[],
      dataRekening:[],
      pencarian: '',
      page: 1,
      aksi:'Tambah',
    }

    document.title = "ANALISIS KEUANGAN DAERAH PROVINSI/KABUPATEN/KOTA";
    
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
      setData.rekening = event.target.value;
    }else if(no===2){
      setData.tahun1 = event.target.value;
    }else if(no===3){
      setData.tahun2 = event.target.value;
    }else if(no===4){
      setData.tahun3 = event.target.value;
    }else if(no===5){
      setData.tahun4 = event.target.value;
    }else if(no===6){
      setData.tahun5 = event.target.value;
    }else if(no===7){
      setData.data_tahun_dasar = event.target.value;
    }else if(no===8){
      setData.tingkat_pertumbuhan = event.target.value;
    }
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
      e.rekening = e.Kd_Rek_1+"-"+e.Kd_Rek_2+"-"+e.Kd_Rek_3+"-"+e.Kd_Rek_4;
      this.setState({
        modalCreate: true,
        dataPilih: e
      });
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
        dataKategori:dataAll.kategori, 
        dataRekening:dataAll.dataRekening
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
    .post(config.apiRoot+'rpjmd/menyusun/analisis-keuangan/page-'+page, data)
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
  handleSubmit = event => {
    event.preventDefault();
    this.setState({ loading: true });
    let link = '';
    if(this.state.aksi === 'Edit'){
      link = config.apiRoot+'rpjmd/menyusun/analisis-keuangan/update';
      
    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+'rpjmd/menyusun/analisis-keuangan/create';
    }
    // console.log(this.state.dataPilih.visi_id);
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('analisis_keuangan_id', this.state.dataPilih.analisis_keuangan_id);
    data.append('rekening', this.state.dataPilih.rekening);
    data.append('data_tahun_dasar', this.state.dataPilih.data_tahun_dasar);
    data.append('tingkat_pertumbuhan', this.state.dataPilih.tingkat_pertumbuhan);
    data.append('tahun1', this.state.dataPilih.tahun1);
    data.append('tahun2', this.state.dataPilih.tahun2);
    data.append('tahun3', this.state.dataPilih.tahun3);
    data.append('tahun4', this.state.dataPilih.tahun4);
    data.append('tahun5', this.state.dataPilih.tahun5);
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
    data.append('analisis_keuangan_id', this.state.dataPilih.analisis_keuangan_id);
    axios
    .post(config.apiRoot+'rpjmd/menyusun/analisis-keuangan/delete', data)
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
            {/* <Form method="post" onSubmit={this.handleCariSubmit} className="form-horizontal">
              <FormGroup row>
                <Col xs="9" md="5">
                  <Input type="text" onChange={this.handlePencarianChange} value={this.state.pencarian} placeholder="Pencarian" />
                </Col>
                <Col xs="3" md="2">
                  <Button color="primary" >Cari</Button>
                </Col>
              </FormGroup>
            </Form> */}
            </Col>
            <Col xs="12" md="2">
              <Button color="info" onClick={() => {this.setState({aksi:'Tambah'});this.modalCreate();}} className="mr-1">Tambah</Button>
            </Col> 
          </Row> 
          
          <Table responsive striped bordered>
            <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
            <tr>
              <th rowSpan="3" colSpan="4">Kode</th>
              <th rowSpan="3">Jenis Belanja / Program Pembangunan</th>
              <th rowSpan="3">Data Tahun Dasar (Rp)</th>
              <th rowSpan="3">Tingkat Pertumbuhan (%)</th>
              <th colSpan="5">Prakiraan Pagu Indikatif</th>
              <th rowSpan="3">Aksi</th>
            </tr>
            <tr>  
              <th>Tahun 1</th>
              <th>Tahun 2</th>
              <th>Tahun 3</th>
              <th>Tahun 4</th>
              <th>Tahun 5</th>
            </tr>
            <tr>  
              <th>Rp</th>
              <th>Rp</th>
              <th>Rp</th>
              <th>Rp</th>
              <th>Rp</th>
            </tr>
            <tr>  
              <th colSpan="4">(1)</th>
              <th>(2)</th>
              <th>(3)</th>
              <th>(4)</th>
              <th>(5)</th>
              <th>(6)</th>
              <th>(7)</th>
              <th>(8)</th>
              <th>(9)</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataAll.map((data, key) => {
              return data ? (
                <tr key={key}>
                  <td>{data.Kd_Rek_1}</td>
                  <td>{data.Kd_Rek_2}</td>
                  <td>{data.Kd_Rek_3}</td>
                  <td>{data.Kd_Rek_4}</td>
                  <td>{data.Nm_Rek_4}</td>
                  <td>{data.data_tahun_dasar}</td>
                  <td>{data.tingkat_pertumbuhan}</td>
                  <td>{data.tahun1}</td>
                  <td>{data.tahun2}</td>
                  <td>{data.tahun3}</td>
                  <td>{data.tahun4}</td>
                  <td>{data.tahun5}</td>
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
              <CardBody>
                
                <h5 style={{textAlign: 'center',}}>ANALISIS KEUANGAN DAERAH PROVINSI/KABUPATEN/KOTA</h5>
                <hr/>
                <Modal isOpen={this.state.modalCreate} toggle={this.modalCreateClose} className={'modal-lg ' + this.props.className}>
                  <ModalHeader toggle={this.modalCreateClose}>{this.state.aksi} Data</ModalHeader>
                  <Form method="post"  onSubmit={this.handleSubmit} className="form-horizontal" id="form-data">
                    <ModalBody>
                    <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Rekening *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" data-number="1" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.rekening} required autoFocus>
                          <option key="-1" value="">-= Pilih Rekening =-</option>
                          {this.state.dataRekening.map((data, key) => {
                            return data ? (
                              <option key={key} value={data.Kd_Rek_1+"-"+data.Kd_Rek_2+"-"+data.Kd_Rek_3+"-"+data.Kd_Rek_4}>{data.Nm_Rek_4}</option>
                            ) : (null);
                          })}
                          </Input>
                          <FormText color="muted">Pilih Rekening</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Data Tahun Dasar *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="number" data-number="7" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.data_tahun_dasar} required autoFocus/>
                          <FormText color="muted">Isi Data Tahun Dasar</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Tingkat Pertumbuhan *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="number" data-number="8" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tingkat_pertumbuhan} required autoFocus/>
                          <FormText color="muted">Isi Tingkat Pertumbuhan</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">tahun1 *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="2" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun1} required autoFocus/>
                          <FormText color="muted">Isi tahun1</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">tahun2 *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="3" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun2} required autoFocus/>
                          <FormText color="muted">Isi tahun2</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">tahun3 *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="4" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun3} required autoFocus/>
                          <FormText color="muted">Isi tahun3</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">tahun4 *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="5" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun4} required autoFocus/>
                          <FormText color="muted">Isi tahun4</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">tahun5 *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="6" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.tahun5} required autoFocus/>
                          <FormText color="muted">Isi tahun5</FormText>
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
          </Col>
        </Row>
      </div>

    );
    
  }
}

export default AnalisisKeuanganCreate;
