import React, { Component } from 'react';
import { Alert, FormGroup, Input, Card, CardBody, CardHeader, Col, Pagination, PaginationItem, PaginationLink, Row, Table, Modal, ModalBody, ModalFooter, ModalHeader, Button, Form, } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';

//https://goshakkk.name/array-form-inputs/

class SasaranCreate2 extends Component {
  
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
      dataTest: [
        {id:1, name:'aka', age:15},
        {id:2, name:'chiro', age:20},
      ],
      jumlahPage: 1,
      modalCreate: false,
      modalDelete: false,
      dataPilih: this.dataPilihAwal,
      dataTambah:[],
      pencarian: '',
      page: 1,
      aksi:'Tambah',
      name:"",
      age:0,
      edit:0,
    }

    document.title = "Menyusun Sasaran";
    
    this.modalPesan = this.modalPesan.bind(this);

    // this.handleChange = this.handleChange.bind(this);
    this.handlePencarianChange = this.handlePencarianChange.bind(this);
    
    

  }

  componentWillMount = () => {
    this.getData();
  }

  handlePencarianChange(event){
    this.setState({ pencarian: event.target.value});
  }

  // handleChange(event){

  //   let no = parseInt(event.target.attributes.getNamedItem('data-number').value);
  //   let setData = this.state.dataPilih;
  //   if(no===1){
  //     setData.name = event.target.value;
  //   }else if(no===2){
  //     setData.age = event.target.value;
  //   }
  //   // console.log(event.target.value);
  //   this.setState({ dataPilih: setData});
  // }


  handleChange = idx => evt => {

    let no = parseInt(evt.target.attributes.getNamedItem('data-number').value);
    
    if(no === 1){
      const newdataTests = this.state.dataTest.map((shareholder, sidx) => {
        if (idx !== sidx) return shareholder;
        this.setState({dataPilih:shareholder});
        return { ...shareholder, name: evt.target.value };
      });
      this.setState({ dataTest: newdataTests });
    }else if(no === 2){
      const newdataTests = this.state.dataTest.map((shareholder, sidx) => {
        if (idx !== sidx){ return shareholder;}
        this.setState({dataPilih:shareholder});
        return { ...shareholder, age: evt.target.value };
      });
      this.setState({ dataTest: newdataTests });
      
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
  modalPesan(e = []) {
    this.setState({
      modalPesan: !this.state.modalPesan,
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
    .post(config.apiRoot+'rpjmd/menyusun/sasaran/page-'+page, data)
    .then(response => {
      this.setData(response.data)
      // console.log(response);
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

  getCek = (id) => {
      
    this.setState({ loading: true });
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('urusan', 1);
    data.append('bidang', 1);
    axios
    .post(config.apiRoot+'rpjmd/get-data/opd', data)
    .then(response => {
      if(response.data.status){
        this.setState({ dataTambah: response.data.data});
      }
      this.setState({ loading: false });
      console.log(response.data);
      console.log("-------------");
    })
    .catch(error=>{
      console.log(error);
      this.setState({ loading: false });
    });
  }

  cekSubmit = (event) =>{
    event.preventDefault();
    this.getCek(16);
    this.setState({ loading: true });
    let link = '';
    let page = 1;
    let set = 'perumusan-pagu';
    link = config.apiRoot+'rpjmd/menyusun/'+set+'/page-'+page;
    // link = config.apiRoot+'rpjmd/menyusun/'+set+'/create';
    // link = config.apiRoot+'rpjmd/menyusun/'+set+'/update';
    // link = config.apiRoot+'rpjmd/menyusun/'+set+'/delete';
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('search', '');

    // perumusan pagu
    // data.append('perumusan_program_id', 4);
    // data.append('target1_harga', 3);
    // data.append('target1_lokasi', 'lokasi1');
    // data.append('target2_harga', 3);
    // data.append('target2_lokasi', 'lokasi2');
    // data.append('target3_harga', 3);
    // data.append('target3_lokasi', 'lokasi3');
    // data.append('target4_harga', 3);
    // data.append('target4_lokasi', 'lokasi4');
    // data.append('target5_harga', 3);
    // data.append('target5_lokasi', 'lokasi5');
    // data.append('akhir_target', 'akhir');
    // data.append('opd', '1-2-1-1');
    
    //proyeksi keuangan
    // data.append('proyeksi_keuangan_id', 2);
    // data.append('rekening', '4-1-1-11');
    // data.append('tahun1', 3);
    // data.append('tahun2', 3);
    // data.append('tahun3', 3);
    // data.append('tahun4', 4);
    // data.append('tahun5', 2);


    //analisis keuangan
    // data.append('analisis_keuangan_id', 1);
    // data.append('rekening', '4-1-1-9');
    // data.append('data_tahun_dasar', 2);
    // data.append('tingkat_pertumbuhan', 2);
    // data.append('tahun1', 3);
    // data.append('tahun2', 2);
    // data.append('tahun3', 2);
    // data.append('tahun4', 2);
    // data.append('tahun5', 2);


    /// pagu indikatif
    // data.append('strategi_kebijakan_id', 3);
    // data.append('tahun1', 2);
    // data.append('tahun2', 2);
    // data.append('tahun3', 2);
    // data.append('tahun4', 2);
    // data.append('tahun5', 2);



    //perumusan program
    // data.append('perumusan_program_id', 3);
    // data.append('strategi_kebijakan_id', 2);
    // data.append('Kd_Program', 2);
    // data.append('outcome', 'outcome2');
    // data.append('kondisi_awal', 'baik2');
    // data.append('kondisi_akhir', 'baik2');
    // data.append('lokasi', 'dfg');




    // tujuan sasaran
    // data.append('tujuan_sasaran_id', 11);
    // data.append('isu_strategi_id', 2);
    // data.append('indikator_id', 5);
    // data.append('tujuan_sasaran_kondisi_awal', '11');
    // data.append('target1_tahun', 2);
    // data.append('target1_satuan', 1);
    // data.append('target2_tahun', 2);
    // data.append('target2_satuan', 1);
    // data.append('target3_tahun', 2);
    // data.append('target3_satuan', 1);
    // data.append('target4_tahun', 2);
    // data.append('target4_satuan', 1);
    // data.append('target5_tahun', 2);
    // data.append('target5_satuan', 1);
    
    //strategi kebijakan
    // data.append('strategi_kebijakan_id', 2);
    // data.append('tujuan_sasaran_id', 9);
    // data.append('strategi_pembangunan', '21134');
    // data.append('arah_kebijakan', '222');

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
      
      console.log(response.data);
    })
    .catch(error=> {
      console.log(error);
      this.setState({ loading: false });
      this.changePesan('Tidak dapat terhubung pada server!', 'danger');
    });
  }

  handleSubmit = event => {
    event.preventDefault();
    this.setState({ loading: true });
    let link = '';
    if(this.state.aksi === 'Edit'){
      link = config.apiRoot+'rpjmd/menyusun/sasaran/update';
      
    }else if(this.state.aksi === 'Tambah'){
      link = config.apiRoot+'rpjmd/menyusun/sasaran/create';
    }

    link = config.apiRoot+'rpjmd/menyusun/sasaran/create';
    // console.log(this.state.dataPilih.visi_id);
    const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('rpjmd', localStorage.getItem('codexv-rpjmd'));
    data.append('sasaran_id', this.state.dataPilih.sasaran_id);
    data.append('sasaran_nama', this.state.dataPilih.sasaran_nama);
    data.append('tujuan_id', this.state.dataPilih.tujuan_id);
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
    data.append('id', this.state.dataPilih.sasaran_id);
    axios
    .post(config.apiRoot+'rpjmd/menyusun/sasaran/delete', data)
    .then(response => {
      if(response.data.status){
        this.modalDelete();
        this.getData();
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

test(event){
  // console.log(event.target.value);
}

cek(id){
  if(this.state.edit !== 0){
    this.modalPesan();
    
  }
}

edit(data){
  this.setState({dataPilih:this.dataPilihAwal, edit:data.id});
  console.log(this.state.dataPilih);
}

simpan(data){
  this.setState({edit:0});
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
            <Form method="post" onSubmit={this.handleCariSubmit} className="form-horizontal">
              <FormGroup row>
                <Col xs="9" md="5">
                <Input type="text" onBlur={this.test} placeholder="Pencarian" />
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
          <Table responsive striped>
            <thead>
            <tr>
              <th>No</th>
              <th>Tujuan</th>
              <th>Sasaran</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            {this.state.dataTest.map((data, key) => {
              if(data.id !== this.state.edit){
                return data ? (
                  <tr key={key}>
                    <td>{((this.state.page-1)*20)+key+1}</td>
                    <td>{data.name}</td>
                    <td>{data.age}</td>
                    <td>
                      <Button color="info" onClick={() => {this.edit(data)}} className="mr-1">Edit</Button>
                    </td>
                  </tr>
                ) : (null);
              }else{
                return data ? (
                  <tr key={key}>
                    <td>{((this.state.page-1)*20)+key+1}</td>
                    <td><Input type="text" value={data.name} data-number="1" onChange={this.handleChange(key)} onBlur={this.test} /></td>
                    <td><Input type="text" value={data.age} data-number="2" onChange={this.handleChange(key)} onBlur={this.test} /></td>
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
              <Form method="post"  onSubmit={this.cekSubmit} className="form-horizontal" id="form-cek">
                  
                <Button color="primary" type="submit" form="form-cek" value="Submit">cek Tes</Button>
              </Form>
                <Modal isOpen={this.state.modalPesan} toggle={this.modalPesan} className={ this.props.className}>
                  <ModalHeader toggle={this.modalPesan}>Hapus Data</ModalHeader>
                  <ModalBody>
                    Apakah Anda Yakin Menghapus Data?
                  </ModalBody>
                  <ModalFooter>
                    <Button color="danger" onClick={this.handleDelete}>Ya</Button>{' '}
                    <Button color="secondary" onClick={this.modalPesan}>Batal</Button>
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

export default SasaranCreate2;
