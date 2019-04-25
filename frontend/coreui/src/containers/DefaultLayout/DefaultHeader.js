import React, { Component } from 'react';
// import { Link } from 'react-router-dom';

// Line 75:  'Modal' is not defined        react/jsx-no-undef
//   Line 76:  'ModalHeader' is not defined  react/jsx-no-undef
//   Line 77:  'ModalBody' is not defined    react/jsx-no-undef
//   Line 78:  'FormGroup' is not defined    react/jsx-no-undef
//   Line 79:  'Col' is not defined          react/jsx-no-undef
//   Line 80:  'Label' is not defined        react/jsx-no-undef
//   Line 82:  'Col' is not defined          react/jsx-no-undef
//   Line 83:  'Input' is not defined        react/jsx-no-undef
//   Line 84:  'FormText' is not defined     react/jsx-no-undef
//   Line 88:  'ModalFooter' is not defined  react/jsx-no-undef
//   Line 89:  'Button' is not defined       react/jsx-no-undef
//   Line 90:  'Button' is not defined       react/jsx-no-undef
import {  Alert, Form, Modal, ModalHeader, ModalBody, FormGroup, Col, Label, Input, DropdownItem, FormText, Button, ModalFooter, DropdownMenu, DropdownToggle, Nav, NavItem, NavLink } from 'reactstrap';
import PropTypes from 'prop-types';

import {  AppHeaderDropdown, AppNavbarBrand, AppSidebarToggler } from '@coreui/react';
import logo from '../../assets/img/brand/logo.svg'
import sygnet from '../../assets/img/brand/sygnet.svg'
import axios from 'axios';
import config from '../../config';

const propTypes = {
  children: PropTypes.node,
};

const defaultProps = {};



class DefaultHeader extends Component {
  constructor(props) {
    super(props);
    this.state = {
      password:'',
      passwordBaru:'',
      passwordUlang:'',
      modalPassword:false,
      pesan:'',
    }

    this.handlePasswordChange = this.handlePasswordChange.bind(this);
    this.handlePasswordBaruChange = this.handlePasswordBaruChange.bind(this);
    this.handlePasswordUlangChange = this.handlePasswordUlangChange.bind(this);

    this.modalPassword = this.modalPassword.bind(this);
    this.changePesan = this.changePesan.bind(this);

    

    this.handlePasswordSubmit = this.handlePasswordSubmit.bind(this);
  }

  modalPassword = () =>{
    this.setState({
      modalPassword: !this.state.modalPassword,
    });
  }

  handlePasswordChange = event => {
    this.setState({ password: event.target.value});
  }

  handlePasswordBaruChange = event => {
    this.setState({ passwordBaru: event.target.value});
  }

  handlePasswordUlangChange = event => {
    this.setState({ passwordUlang: event.target.value});
  }

  handlePasswordSubmit =(event)=>{
    event.preventDefault();
    // const head = { headers: { 'Content-Type': 'multipart/form-data' } };
    let data = new FormData();
    data.append('session', localStorage.getItem('codexv-session'));
    data.append('token', localStorage.getItem('codexv-token-kelurahan'));
    data.append('password', this.state.password);
    data.append('passwordBaru', this.state.passwordBaru);
    data.append('passwordUlang', this.state.passwordUlang);
    
    axios
    .post(config.apiRoot+'akun/ubah-password', data)
    .then(response => {
      if(response.data.status){
        
      }
      this.setState({
        modalPassword: true,
      });
      this.changePesan(response.data.pesan);
      // this.toggleClose();
      // this.changePesan(response.data.pesan);
      console.log(response.data);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

  changePesan = (e = null, status = 'success') =>{
    if(e === null){
      this.setState({pesan: ''});
    }else{
      this.setState({pesan: <Alert color={status}>{e}</Alert>});
      // setTimeout(this.setState({pesan:''}), 5000);
    }
    setTimeout(()=>{ this.setState({pesan: ''}); }, 3000);
  }

  render() {

    // eslint-disable-next-line
    const { children, ...attributes } = this.props;

    return (
      
      <React.Fragment>
        <AppSidebarToggler className="d-lg-none" display="md" mobile />
        <AppNavbarBrand
          full={{ src: logo, width: 300, height: 25, alt: 'Musrenbang' }}
          minimized={{ src: sygnet, width: 300, height: 30, alt: 'Musrenbang' }}
        />
        <AppSidebarToggler className="d-md-down-none" display="lg" />

        <Nav className="d-md-down-none" navbar>
          <NavItem className="px-3">
            <NavLink href="/">Dashboard</NavLink>
          </NavItem>
          {/* <NavItem className="px-3">
            <Link to="/password">Users</Link>
          </NavItem>
          <NavItem className="px-3">
            <NavLink href="#">Settings</NavLink>
          </NavItem> */}
        </Nav>
        <Nav className="ml-auto" navbar>
          {/* <NavItem className="d-md-down-none">
            <NavLink href="#"><i className="icon-bell"></i><Badge pill color="danger">5</Badge></NavLink>
          </NavItem>
          <NavItem className="d-md-down-none">
            <NavLink href="#"><i className="icon-list"></i></NavLink>
          </NavItem>
          <NavItem className="d-md-down-none">
            <NavLink href="#"><i className="icon-location-pin"></i></NavLink>
          </NavItem> */}
          <AppHeaderDropdown direction="down">
            <DropdownToggle nav>
              <img src={'./assets/img/avatars/6.jpg'} className="img-avatar" alt="admin@bootstrapmaster.com" />
            </DropdownToggle>
            <DropdownMenu right style={{ right: 'auto' }}>
              {/* <DropdownItem header tag="div" className="text-center"><strong>Account</strong></DropdownItem>
              <DropdownItem><i className="fa fa-bell-o"></i> Updates<Badge color="info">42</Badge></DropdownItem>
              <DropdownItem><i className="fa fa-envelope-o"></i> Messages<Badge color="success">42</Badge></DropdownItem>
              <DropdownItem><i className="fa fa-tasks"></i> Tasks<Badge color="danger">42</Badge></DropdownItem>
              <DropdownItem><i className="fa fa-comments"></i> Comments<Badge color="warning">42</Badge></DropdownItem>
              <DropdownItem header tag="div" className="text-center"><strong>Settings</strong></DropdownItem>
              <DropdownItem><i className="fa fa-user"></i> Profile</DropdownItem>
              <DropdownItem><i className="fa fa-wrench"></i> Settings</DropdownItem>
              <DropdownItem><i className="fa fa-usd"></i> Payments<Badge color="secondary">42</Badge></DropdownItem>
              <DropdownItem><i className="fa fa-file"></i> Projects<Badge color="primary">42</Badge></DropdownItem>
              <DropdownItem divider /> */}
              <DropdownItem onClick={this.modalPassword}><i className="fa fa-shield"></i> Ganti Password</DropdownItem>
              <DropdownItem onClick={e => this.props.onLogout(e)}><i className="fa fa-lock"></i> Logout</DropdownItem>
            </DropdownMenu>
          </AppHeaderDropdown>
        </Nav>
        {/* <AppAsideToggler className="d-md-down-none" /> */}
        {/*<AppAsideToggler className="d-lg-none" mobile />*/}
        <Modal isOpen={this.state.modalPassword} toggle={this.modalPassword} className={ this.props.className}>
          <ModalHeader toggle={this.modalPassword}>Ubah Password</ModalHeader>
          <ModalBody>
          {this.state.pesan}
            <Form onSubmit={this.handlePasswordSubmit} method="POST" id="form-password">
            <FormGroup row>
                <Col md="3">
                  <Label htmlFor="text-input">Password Lama *</Label>
                </Col>
                <Col xs="12" md="9">
                  <Input type="password" id="password" onChange={this.handlePasswordChange}  required autoFocus/>
                  <FormText color="muted">Isi Password</FormText>
                </Col>
              </FormGroup>
              <FormGroup row>
                <Col md="3">
                  <Label htmlFor="text-input">Password Baru*</Label>
                </Col>
                <Col xs="12" md="9">
                  <Input type="password" id="password-baru" onChange={this.handlePasswordBaruChange}  required autoFocus/>
                  <FormText color="muted">Isi Password</FormText>
                </Col>
              </FormGroup>
              <FormGroup row>
                <Col md="3">
                  <Label htmlFor="text-input">Ulangi Password Baru*</Label>
                </Col>
                <Col xs="12" md="9">
                  <Input type="password" id="password-ulang" onChange={this.handlePasswordUlangChange}  required autoFocus/>
                  <FormText color="muted">Isi Password</FormText>
                </Col>
              </FormGroup>
            </Form>
          </ModalBody>
          <ModalFooter>
            <Button color="success" type="submit" form="form-password"  onClick={this.modalPassword}>Ganti Password</Button>{' '}
            <Button color="secondary" onClick={this.modalPassword}>Keluar</Button>
          </ModalFooter>
        </Modal>
        
      </React.Fragment>
      
      
    );
  }
}

DefaultHeader.propTypes = propTypes;
DefaultHeader.defaultProps = defaultProps;

export default DefaultHeader;
