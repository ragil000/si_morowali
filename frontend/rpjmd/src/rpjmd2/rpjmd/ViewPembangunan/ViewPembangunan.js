import React, { Component } from 'react';
import { Pagination, PaginationLink, PaginationItem, Alert, Button, Form, FormGroup, Label, Input, Card, CardBody, Col, Row, Table } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import loadingImage from '../../assets/img/loading.gif';

class ViewPembangunan extends Component {

  constructor(props) {
    super(props);

    this.state = {
      loading:false,
      pencarian:'',
      urusan:'',
      bidang:'',
      visi:'',
      dataAll: [],
      jumlahPage: 1,
      page: 1,
      dataTambah:[],
      dataBidang:[],

    }

    document.title = "Strategi dan Arah Kebijakan";
    
    // this.modalCreateClose = this.modalCreateClose.bind(this);
    // this.modalCreate = this.modalCreate.bind(this);
    // this.modalDelete = this.modalDelete.bind(this);

    this.handleChange = this.handleChange.bind(this);
    this.handlePencarianChange = this.handlePencarianChange.bind(this);
    this.handleCariSubmit = this.handleCariSubmit.bind(this);
    
    // this.handleDelete = this.handleDelete.bind(this);
  }

  componentWillMount = () => {
    this.getData();
  }

  handlePencarianChange(event){
    this.setState({ pencarian: event.target.value});
  }

  handleChange(event){

    let no = parseInt(event.target.attributes.getNamedItem('data-number').value);
    
    if(no===1){
      this.setState({ urusan: event.target.value, bidang:''});

      this.getBidang(event.target.value);
    }else if(no===2){
      this.setState({ bidang: event.target.value});
    }
    // console.log(event.target.value);
    
  }

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
      this.setState({ dataAll: dataAll.data, jumlahPage: dataAll.jumlahPage, jumlahAll: dataAll.jumlahAll, dataKategori:dataAll.kategori, dataTambah:dataAll.dataTambah, visi : dataAll.data[0].visi_nama});
    }
    // console.log(this.state.visi);
  }

  getData = (page = 1) => {
    
    this.setState({ loading: true });
    // console.log('response');
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('search', this.state.pencarian);
    data.append('urusan', this.state.urusan);
    data.append('bidang', this.state.bidang);
    axios
    .post(config.apiRoot+'rpjmd/tampil/strategi/page-'+page, data)
    .then(response => {
      this.setData(response.data)
      console.log(response);
      this.setState({ loading: false });
    })
    .catch(error => {
      console.log(error);
      this.setState({ loading: false, dataAll:[] });
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
      return (
        <div>
          <CardBody>
            <Table responsive striped bordered>
              <thead style={{textAlign: 'center', backgroundColor:'#0066ff', color: 'white'}}>
                <tr>
                  <th rowSpan="2">No</th>
                  <th rowSpan="2">Sasaran</th>
                  <th rowSpan="2">Strategi Pembangunan</th>
                  <th rowSpan="2">Arah Kebijakan</th>
                  <th rowSpan="2">Indikator</th>
                  <th rowSpan="2">Program</th>
                  <th rowSpan="2">Indikator Kinerka (Outcome)</th>
                  <th colSpan="2">Capaian Kineja</th>
                  <th rowSpan="2">Lokasi</th>
                  <th rowSpan="2">Aksi</th>
                </tr>
                <tr>
                  <th>Kondisi Awal</th>
                  <th>Kondisi Akhir</th>
                </tr>
                <tr>
                  <th>(1)</th>
                  <th>(2)</th>
                  <th>(3)</th>
                  <th>(4)</th>
                  <th>(5)</th>
                  <th>(6)</th>
                  <th>(7)</th>
                  <th>(8)</th>
                  <th>(9)</th>
                  <th>(10)</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              {this.state.dataAll.map((data, key) => {
                return data ? (
                  <tr key={key}>
                    <td>{((this.state.page-1)*20)+key+1}</td>
                    <td>{data.misi_nama}</td>
                    <td>{data.tujuan_nama}</td>
                    <td>{data.Nm_Bidang}</td>
                    <td>{data.Nm_Urusan}</td>
                    <td>{data.sasaran_nama}</td>
                    <td>{data.indikator_nama}</td>
                    <td>{data.strategi_nama}</td>
                    <td>{data.kebijakan_nama}</td>
                    <td>{data.Nm_Sub_Unit}</td>
                  </tr>
                ) : (null);
              })}
              </tbody>
            </Table>
            {this.pageNation()}
          </CardBody>
        </div>
      );
    }
  }


// .isi

  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardBody>
                <h5 style={{textAlign: 'center',}}>PERUMUSAN PROGRAM</h5>
                <hr/>
                <Row>
                  <Col md="3">Visi :</Col>
                  <Col xs="12" md="9"></Col>
                </Row>
                <hr/>
                <Row>
                  <Col md="3">Misi :</Col>
                  <Col xs="12" md="9"></Col>
                </Row>
              </CardBody>
              <CardBody>
                <Row>
                  <Col  xs="12" lg="5">
                    <FormGroup row>
                      <Col md="3">
                        <Label htmlFor="select">Filter by Urusan</Label>
                      </Col>
                      <Col xs="12" md="9">
                        <Input type="select" name="status" value={true} >
                        <option>...</option>
                        <option>II. Urusan Wajib</option>
                        <option>III. Urusan Pilihan</option>
                        <option>IV. Fungsi Penunjang</option>
                        </Input>
                      </Col>
                    </FormGroup>
                  </Col>
                  <Col  xs="12" lg="7">
                    <FormGroup row>
                      <Col xs="9" md="9">
                        <Input type="select" name="status" value={true} >
                        </Input>
                      </Col>
                      <Col xs="3" md="3">
                        <Button color="primary">submit</Button>
                      </Col>
                    </FormGroup>
                  </Col>
                </Row>
              </CardBody>
              {this.isi()}
            </Card>
          </Col>
        </Row>

      </div>

    );
  }
}

export default ViewPembangunan;
