import React, { Component } from 'react';
import { FormText, Alert, FormGroup, Label, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';
import VisiPenjelasan from './VisiPenjelasan';


class VisiCreate extends Component {
  
  constructor(props) {
    super(props);

    this.dataPilihAwal = {
      rpjmd_id:0,
      rpjmd_visi:'',
    };

    this.state = {
      loading:false,
      dataAll: [],
      jumlahPage: 1,
      modalCreate: false,
      modalDelete: false,
      dataPilih: this.dataPilihAwal,
      pencarian: '',
      page: 1,
      aksi:'Tambah',
    }

    document.title = "Menyusun Visi";
    
    this.modalCreateClose = this.modalCreateClose.bind(this);
    this.modalCreate = this.modalCreate.bind(this);
    this.modalDelete = this.modalDelete.bind(this);

    this.handleChange = this.handleChange.bind(this);
    this.handleDelete = this.handleDelete.bind(this);
    
    

  }

  componentWillMount = () => {
    this.getData();
  }

  handleChange(event){

    let no = event.target.attributes.getNamedItem('data-number').value;
    let setData = this.state.dataPilih;
    if(parseInt(no)===1){
      setData.rpjmd_visi = event.target.value;
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
      this.setState({ dataAll: dataAll.data, jumlahPage: dataAll.jumlahPage, jumlahAll: dataAll.jumlahAll, dataKategori:dataAll.kategori});
    }
    // this.getData();
    // console.log(dataAll);
  }

  getData = (page = 1) => {
    //page = this.state.page;
    this.setState({ loading: true });
    let data = new FormData();

    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('search', this.state.pencarian);

    axios
    .post(config.apiRoot+'rpjmd/menyusun/visi/page-'+page, data)
    .then(response => {
      this.setData(response.data)
      console.log(response);
      this.setState({ loading: false });
    })
    .catch(error => {
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
    link = config.apiRoot+'rpjmd/menyusun/visi/update';

    // console.log(this.state.dataPilih.visi_id);
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();

    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('rpjmd_visi', this.state.dataPilih.rpjmd_visi);

    axios
    .post(link, data, head)
    .then(response => {
      if(response.data.status){
        this.modalCreateClose();
        this.getData();
        this.changePesan(response.data.pesan);
      }else{
        this.changePesan(response.data.pesan, 'danger');
      }
      this.setState({ loading: false });
      // this.toggleClose();
      
      console.log(response.data);
    })
    .catch(error=> {
      console.log(error);
      this.setState({ loading: false });
    });
  }

  handleDelete = () =>{
    // console.log(this.state.dataPilih);
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('id', this.state.dataPilih.visi_id);
    axios
    .post(config.apiRoot+'rpjmd/menyusun/visi/delete', data)
    .then(response => {
      if(response.data.status){
        this.modalDelete();
        this.getData();
        
      }
      this.setState({ loading: false });
      this.changePesan(response.data.pesan);
      console.log(response);
    })
    .catch(error => {
      console.log(error);
      this.setState({ loading: false });
    });
  }
//. submit

// tombol
  buttonTambah(){
    if(this.state.dataAll.length === 0)
    return (
    <Col xs="12" md="2">
      <Button color="info" onClick={() => {this.setState({aksi:'Tambah'});this.modalCreate();}} className="mr-1">Tambah</Button>
    </Col>  
    );
  }

//.tombol

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

  render() {

    if(this.state.loading){
      return(
        <Row>
          <img src={loadingImage} alt="logo"/>
        </Row>
      );
    }else{
      return (
        <div className="animated fadeIn">
          <Row>
            <Col xs="12" lg="12">
              <Card>
                <CardHeader>
                  <i className="fa fa-align-justify"></i> {document.title}
                </CardHeader>
                <CardBody>
                  {this.state.pesan}
                  <Modal isOpen={this.state.modalCreate} toggle={this.modalCreateClose} className={'modal-lg ' + this.props.className}>
                    <ModalHeader toggle={this.modalCreateClose}>{this.state.aksi} Data</ModalHeader>
                    <Form method="post"  onSubmit={this.handleSubmit} className="form-horizontal" id="form-data">
                      <ModalBody>
                        <FormGroup row>
                          <Col md="3">
                            <Label htmlFor="text-input">Visi *</Label>
                          </Col>
                          <Col xs="12" md="9">
                            <Input type="text" data-number="1" placeholder="" onChange={this.handleChange} value={this.state.dataPilih.rpjmd_visi} required autoFocus/>
                            <FormText color="muted">Isi Visi</FormText>
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
                  <Row>
                  <Col xs="128" md="10">
                  {/* <Form method="post" onSubmit={this.handleCariSubmit} className="form-horizontal">
                    <FormGroup row>
                      <Col xs="9" md="5">
                        <Input type="text" onChange={this.handlePencarianChange} id="text-input-pencarian" name="pencarian" placeholder="Pencarian" />
                      </Col>
                      <Col xs="3" md="2">
                        <Button color="primary" >Cari</Button>
                      </Col>
                    </FormGroup>
                  </Form> */}
                  </Col>
                  {this.buttonTambah()} 
                  </Row>      
                  <Table responsive striped bordered>
          <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
                    <tr>
                      <th>Visi</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    {this.state.dataAll.map((data, key) => {
                      return data ? (
                        <tr key={key}>
                          <td>{data.rpjmd_visi}</td>
                          <td>
                            <Button color="info" onClick={() => {this.setState({aksi:'Edit'});this.modalCreate(data);}} className="mr-1">Edit</Button>
                            
                          </td>
                        </tr>
                      ) : (null);
                    })}
                    </tbody>
                  </Table>
                  {/* {this.pageNation()} */}
                </CardBody>
              </Card>
              <VisiPenjelasan/>
            </Col>
          </Row>
        </div>
  
      );
    }
  }
}

export default VisiCreate;
