import React, { Component } from 'react';
// import { Link } from 'react-router-dom';
import { Button, Card, CardBody, CardGroup, Col, Container, Form, Input, InputGroup, InputGroupAddon, InputGroupText, Row } from 'reactstrap';
import axios from 'axios';
import config from '../../config';
import morowaliImage from './morowali.jpg';
import loadingImage from '../../assets/img/loading.gif';

var sectionStyle = {
  // width: "100%",
  height: "100%",
  backgroundPosition: 'center',
  backgroundRepeat: 'no-repeat',
  backgroundSize: 'cover',
  backgroundImage: `url(${morowaliImage})`
};

var loading = {
  position:'relative',
  // height: "1%",
  width:"20%",
  backgroundPosition: 'center',
  backgroundRepeat: 'no-repeat',
  backgroundSize: 'cover',
  backgroundImage: `url(${loadingImage})`
}


class Login extends Component {

  constructor(props) {
    super(props);
    
    this.state = {
      loading:false,
      user: '',
      pass: '',
      session: '',
      pesan: '',
      jenis: 2, //1. musrenbang | 2. rpjmd
    };
    document.title = "Login";

    this.handleSubmit = this.handleSubmit.bind(this);

    this.handleUserChange = this.handleUserChange.bind(this);
    this.handlePassChange = this.handlePassChange.bind(this);
    localStorage.setItem("codexv-rpjmd", 0);
  }


  handleUserChange = event => {
    this.setState({ user: event.target.value });
  }
  handlePassChange = event => {
    this.setState({ pass: event.target.value });
  }


  cekLogin = data =>{
    if(data.status){
      localStorage.setItem("codexv-level", data.level);
      localStorage.setItem("codexv-akun", data.akun);
      localStorage.setItem("codexv-session", data.session);
      this.props.history.push('/dashboard');
    }else{
      
      this.setState({ pesan: data.pesan });

    }
  }


  handleSubmit = event => {
    event.preventDefault();
    
    this.setState({ loading: true });
    const user = {
      user: this.state.user,
      pass: this.state.pass,
    };
    let data = new FormData();
    data.append('user', user.user);
    data.append('pass', user.pass);
    data.append('jenis', user.jenis);
    // console.log("response");
    axios
    .post(config.apiRoot+'rpjmd/login/'+config.index, data)
    .then(response => {
      this.cekLogin(response.data);
      console.log(response);
      this.setState({ loading: false });
    })
    .catch(error=>{
      // console.log(error);
      this.setState({ pesan: 'Gagal terhubung pada server' });
      this.setState({ loading: false });
    });
  }

  loading(){
    if(this.state.loading){
      return(<CardBody style={loading}></CardBody>);
    }else{
      return(<div></div>);
    }
  }

  render() {
    this.tampilPesan = this.state.pesan !== ''?<label>{this.state.pesan}</label>:'';
    
    return (
      <div className="app flex-row align-items-center" style={sectionStyle}>
        <Container>
          <Row className="justify-content-center">
            <Col md="8">
              <CardGroup>
                  <CardBody style={{textAlign: 'center', fontSize:100,
                    color:'#000000',
                    fontFamily:'Times New Roman',
                    paddingLeft:30,
                    paddingRight:30,
                    paddingBottom:200,
                    // position:'absolute',
                    // top:-200,
                    textShadowColor:'#585858',
                    textShadowOffset:{width: 5, height: 5},
                    textShadowRadius:10,}}>
                    <h1>MOROWALI SEJAHTERA BERSAMA</h1>
                  </CardBody>
              </CardGroup>
            </Col>
          </Row>
          <Row className="justify-content-center">
            <Col md="8">
              <CardGroup>
                <Card className="p-4">
                {this.loading()}
                  <CardBody>
                    <div></div>
                    {this.tampilPesan}
                    <Form  onSubmit={this.handleSubmit} method="POST">
                      <h1>Login</h1>
                      <p className="text-muted">Sign In to your account</p>
                      <InputGroup className="mb-3">
                        <InputGroupAddon addonType="prepend">
                          <InputGroupText>
                            <i className="icon-user"></i>
                          </InputGroupText>
                        </InputGroupAddon>
                        <Input type="text"  onChange={this.handleUserChange} placeholder="Username" autoComplete="username" />
                      </InputGroup>
                      <InputGroup className="mb-4">
                        <InputGroupAddon addonType="prepend">
                          <InputGroupText>
                            <i className="icon-lock"></i>
                          </InputGroupText>
                        </InputGroupAddon>
                        <Input type="password" onChange={this.handlePassChange} placeholder="Password" autoComplete="current-password" />
                      </InputGroup>
                      <Row>
                        <Col xs="6">
                          <Button color="primary" className="px-4">Login</Button>
                        </Col>
                      </Row>
                    </Form>
                  </CardBody>
                </Card>
              </CardGroup>
            </Col>
          </Row>
        </Container>
      </div>
    );
    
    
  }
}

export default Login;
