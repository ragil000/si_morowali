import React, { Component } from 'react';
// import { Link } from 'react-router-dom';
import { Button, Card, CardBody, CardGroup, Col, Container, Form, Input, InputGroup, InputGroupAddon, InputGroupText, Row } from 'reactstrap';
import axios from 'axios';
import config from '../../../config';
import morowaliImage from './morowali.jpg';

var sectionStyle = {
  // width: "100%",
  height: "100%",
  backgroundPosition: 'center',
  backgroundRepeat: 'no-repeat',
  backgroundSize: 'cover',
  backgroundImage: `url(${morowaliImage})`
};


class Login extends Component {

  constructor(props) {
    super(props);
    
    this.state = {
      user: '',
      pass: '',
      session: '',
      pesan: '',
    };
  }


  handleUserChange = event => {
    this.setState({ user: event.target.value });
  }
  handlePassChange = event => {
    this.setState({ pass: event.target.value });
  }

  setSession = session => {
    localStorage.setItem("codexv-session", JSON.stringify(session));
    
    this.props.history.push('/dashboard');
  }

  cekLogin = data =>{
    if(data.status){
      localStorage.setItem("codexv-level", data.level);
      this.setSession(data.session);
    }else{
      
      this.setState({ pesan: data.pesan });

    }
  }

  cariData = event => {
    const user = {
      user: this.state.user,
      pass: this.state.pass,
    };
    let data = new FormData();
    data.append('user', user.user);
    data.append('pass', user.pass);
    axios
    .post(config.apiRoot+'login/'+config.index, data)
    .then(response => {
      this.cekLogin(response.data);
      console.log(response);
    })
    .catch(error=>{
      // console.log(error);
      this.setState({ pesan: 'Gagal terhubung pada server' });
    });
  }

  handleSubmit = event => {
    event.preventDefault();
    this.cariData(event)
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
                  <CardBody>
                    
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
                        {/* <Col xs="6" className="text-right">
                          <Button color="link" className="px-0">Forgot password?</Button>
                        </Col> */}
                      </Row>
                    </Form>
                  </CardBody>
                </Card>
                {/* <Card className="text-white bg-primary py-5 d-md-down-none" style={{ width: '44%' }}>
                  <CardBody className="text-center">
                    <div>
                      <h2>Sign up</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                      <Link to="/register">
                        <Button color="primary" className="mt-3" active tabIndex={-1}>Register Now!</Button>
                      </Link>
                    </div>
                  </CardBody>
                </Card> */}
              </CardGroup>
            </Col>
          </Row>
        </Container>
      </div>
    );
  }
}

export default Login;
