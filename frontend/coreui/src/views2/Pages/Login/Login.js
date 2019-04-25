import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { Button, Card, CardBody, CardGroup, Col, Container, Form, Input, InputGroup, InputGroupAddon, InputGroupText, Row } from 'reactstrap';
import axios from 'axios';
import qs from "qs";

class Login extends Component {

  state = {
    user: '',
    pass: ''
  }


  handleUserChange = event => {
    this.setState({ user: event.target.value });
  }
  handlePassChange = event => {
    this.setState({ pass: event.target.value });
  }

  handleSubmit = event => {
    event.preventDefault();

    const user = {
      user: this.state.user,
      pass: this.state.pass,
    };
    let config = {
      headers: {
        header1: 'value',
      }
    }
    // http://morowalikab.com/satuanharga/admin/ssh/get-ssh1/-
    // axios.post(`http://localhost/ci/reactphp/index.php/welcome/login`, { user })
    //   .then(response => { 
    //     console.log(response)
    //   })
    //   .catch(error => {
    //       console.log(error.response)
    //   })
    var token = "mytokenasjdfkjsadlkfjsadlkfjslakdjf";
    let data = new FormData();
    data.append('user', user.user);
    axios
    .post('http://localhost/ci/reactphp/index.php/welcome/login', data)
    .then(function (response) {
      console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  render() {
    return (
      <div className="app flex-row align-items-center">
        <Container>
          <Row className="justify-content-center">
            <Col md="8">
              <CardGroup>
                <Card className="p-4">
                  <CardBody>
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
                        <Col xs="6" className="text-right">
                          <Button color="link" className="px-0">Forgot password?</Button>
                        </Col>
                      </Row>
                    </Form>
                  </CardBody>
                </Card>
                <Card className="text-white bg-primary py-5 d-md-down-none" style={{ width: '44%' }}>
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
