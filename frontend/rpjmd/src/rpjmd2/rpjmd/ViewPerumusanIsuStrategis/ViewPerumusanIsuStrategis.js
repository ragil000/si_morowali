import React, { Component } from 'react';
import { FormText, Alert, FormGroup, Label, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';


class ViewPerumusanIsuStrategis extends Component {
  
  constructor(props) {
    super(props);

    this.dataPilihAwal = {
      isu_strategi_id:'',
      misi_id:'',
      isu_strategi_urusan:'',
      isu_strategi_rpjpd:'',
      isu_strategi_rtrw:'',
      isu_strategi_rpjmn:'',
      isu_strategi_dinamika:'',
      isu_strategi_rpjmd:'',
      Kd_Urusan:'',
      Kd_Bidang:'',
    };

    this.state = {
      loading:false,
      dataAll: [],
      jumlahPage: 1,
      modalCreate: false,
      modalDelete: false,
      dataPilih: this.dataPilihAwal,
      dataTambah:[],
      dataUrusan:[],
      dataBidang:[],
      dataMisi:[],
      pencarian: '',
      page: 1,
      aksi:'Tambah',
    }

    document.title = "Menyusun Perumusan Isu Strategis";
    
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
      setData.misi_id = event.target.value;
    }else if(no===2){
      setData.isu_strategi_urusan = event.target.value;
    }else if(no===3){
      setData.isu_strategi_rpjpd = event.target.value;
    }else if(no===4){
      setData.isu_strategi_rtrw = event.target.value;
    }else if(no===5){
      setData.isu_strategi_rpjmn = event.target.value;
    }else if(no===6){
      setData.isu_strategi_dinamika = event.target.value;
    }else if(no===7){
      setData.isu_strategi_rpjmd = event.target.value;
    }else if(no===8){
      setData.Kd_Urusan = event.target.value;
      this.getBidang(event.target.value);
    }else if(no===9){
      setData.Kd_Bidang = event.target.value;
    }

    console.log(event.target.value);
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
      this.setState({
        modalCreate: true,
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
    .post(config.apiRoot+'rpjmd/menyusun/isu-strategi/page-'+page, data)
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


///. set data

// submit
  handleSubmit = event => {
    event.preventDefault();
    this.setState({ loading: true });
    let link = '';
    if(this.state.aksi === 'Edit'){
      link = config.apiRoot+'rpjmd/menyusun/isu-strategi/update';
      
    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+'rpjmd/menyusun/isu-strategi/create';
    }
    // console.log(this.state.dataPilih.visi_id);
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('isu_strategi_id', this.state.dataPilih.isu_strategi_id);
    data.append('misi_id', this.state.dataPilih.misi_id);
    data.append('isu_strategi_urusan', this.state.dataPilih.isu_strategi_urusan);
    data.append('isu_strategi_rpjpd', this.state.dataPilih.isu_strategi_rpjpd);
    data.append('isu_strategi_rtrw', this.state.dataPilih.isu_strategi_rtrw);
    data.append('isu_strategi_rpjmn', this.state.dataPilih.isu_strategi_rpjmn);
    data.append('isu_strategi_dinamika', this.state.dataPilih.isu_strategi_dinamika);
    data.append('isu_strategi_rpjmd', this.state.dataPilih.isu_strategi_rpjmd);
    data.append('Kd_Urusan', this.state.dataPilih.Kd_Urusan);
    data.append('Kd_Bidang', this.state.dataPilih.Kd_Bidang);

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
    data.append('isu_strategi_id', this.state.dataPilih.isu_strategi_id);
    axios
    .post(config.apiRoot+'rpjmd/menyusun/isu-strategi/delete', data)
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
            <Form method="post" onSubmit={this.handleCariSubmit} className="form-horizontal">
              <FormGroup row>
                <Col xs="9" md="5">
                  <Input type="text" onChange={this.handlePencarianChange} value={this.state.pencarian} placeholder="Pencarian" />
                </Col>
                <Col xs="3" md="2">
                  <Button color="primary" >Cari</Button>
                </Col>
              </FormGroup>
            </Form>
            </Col>
            <Col xs="12" md="2">
              <Button color="info" onClick={() => {this.setState({aksi:'Tambah'});this.modalCreate();}} className="mr-1">Tambah</Button>
            </Col> 
          </Row> 
          <Table responsive striped bordered>
          <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
            <tr>
              <th>No</th>
              <th>Misi</th>
              <th>Isu Strategi Urusan</th>
              <th>RPJPD</th>
              <th>RTRW</th>
              <th>RPJMN/RPJMD PROVINSI</th>
              <th>DINAMIKA INTERNASIONAL</th>
              <th>Isu Strategi RPJMD</th>
              <th>Bidang</th>
              <th>Urusan</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataAll.map((data, key) => {
              return data ? (
                <tr key={key}>
                  <td>{((this.state.page-1)*20)+key+1}</td>
                  <td>{data.misi_nama}</td>
                  <td>{data.isu_strategi_urusan}</td>
                  <td>{data.isu_strategi_rpjpd}</td>
                  <td>{data.isu_strategi_rtrw}</td>
                  <td>{data.isu_strategi_rpjmn}</td>
                  <td>{data.isu_strategi_dinamika}</td>
                  <td>{data.isu_strategi_rpjmd}</td>
                  <td>{data.Nm_Urusan}</td>
                  <td>{data.Nm_Bidang}</td>
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
            <Card>
              <CardHeader>
                <i className="fa fa-align-justify"></i> {document.title}
              </CardHeader>
              <CardBody>
                <Modal isOpen={this.state.modalCreate} toggle={this.modalCreateClose} className={'modal-lg ' + this.props.className}>
                  <ModalHeader toggle={this.modalCreateClose}>{this.state.aksi} Data</ModalHeader>
                  <Form method="post"  onSubmit={this.handleSubmit} className="form-horizontal" id="form-data">
                    <ModalBody>
                    <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Misi *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" data-number="1" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.misi_id} required autoFocus>
                          <option key="-1" value="">-= Pilih Misi =-</option>
                          {this.state.dataTambah.map((data, key) => {
                            return data ? (
                              <option key={key} value={data.misi_id}>{data.misi_nama}</option>
                            ) : (null);
                          })}
                          </Input>
                          <FormText color="muted">Pilih Misi</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Isu Strategi Urusan *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="2" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.isu_strategi_urusan} required autoFocus/>
                          <FormText color="muted">Isi Isu Strategi Urusan</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Isu Strategi RPJPD *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="3" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.isu_strategi_rpjpd} required autoFocus/>
                          <FormText color="muted">Isu Strategi RPJPD</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Isu Strategi RTRW *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="4" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.isu_strategi_rtrw} required autoFocus/>
                          <FormText color="muted">Isi Isu Strategi RTRW</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Isu Strategi RPJMN *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="5" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.isu_strategi_rpjmn} required autoFocus/>
                          <FormText color="muted">Isi Isu Strategi RPJMN</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Isu Strategi Dinamika *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="6" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.isu_strategi_dinamika} required autoFocus/>
                          <FormText color="muted">Isi Isu Strategi Dinamika</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Isu Strategi RPJMD *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="text" data-number="7" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.isu_strategi_rpjmd} required autoFocus/>
                          <FormText color="muted">Isi Isu Strategi RPJMD</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Urusan *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" data-number="8" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.Kd_Urusan} required autoFocus>
                          <option key="-1" value="">-= Pilih Urusan =-</option>
                          {this.state.dataUrusan.map((data, key) => {
                            return data ? (
                              <option key={key} value={data.Kd_Urusan}>{data.Nm_Urusan}</option>
                            ) : (null);
                          })}
                          </Input>
                          <FormText color="muted">Pilih Urusan</FormText>
                        </Col>
                      </FormGroup>
                      <FormGroup row>
                        <Col md="3">
                          <Label htmlFor="text-input">Bidang *</Label>
                        </Col>
                        <Col xs="12" md="9">
                          <Input type="select" data-number="9" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.Kd_Bidang} required autoFocus>
                          <option key="-1" value="">-= Pilih Bidang =-</option>
                          {this.state.dataBidang.map((data, key) => {
                            return data ? (
                              <option key={key} value={data.Kd_Bidang}>{data.Nm_Bidang}</option>
                            ) : (null);
                          })}
                          </Input>
                          <FormText color="muted">Pilih Bidang</FormText>
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
            </Card>
          </Col>
        </Row>
      </div>

    );
    
  }
}

export default ViewPerumusanIsuStrategis;
