import React, { Component } from 'react';
import { Button, Card, CardBody,  Col, Row, } from 'reactstrap';
// import { AppSwitch } from '@coreui/react'

class Tahapan extends Component {
  constructor(props) {
    super(props);

    this.toggle = this.toggle.bind(this);
    this.toggleFade = this.toggleFade.bind(this);
    this.state = {
      collapse: true,
      fadeIn: true,
      timeout: 300
    };
  }

  toggle() {
    this.setState({ collapse: !this.state.collapse });
  }

  toggleFade() {
    this.setState((prevState) => { return { fadeIn: !prevState }});
  }

  render() {
    return (
      <div className="animated fadeIn">
        
          <Col xs="12" sm="12" md="12">
            <Card>
              <CardBody>
              <Row>
                  <Col xs="5" sm="5" md="5">
                    <Col xs="12" sm="10" md="8">
                      <h4>Persiapan</h4>
                    </Col>
                    <Col xs="12" sm="10" md="8">
                      <Button block color="success" className="btn-pill">Sedang Dilaksanakan</Button>
                    </Col>
                  </Col>
                  <Col xs="2" sm="2" md="2">
                    <Col xs="12" sm="12" md="6">
                    <Button block color="success" className="btn-pill"><i class="cui-file icons"></i></Button>
                    </Col>
                  </Col>
                  <Col xs="5" sm="5" md="5">
                    <Col xs="12" sm="10" md="8">
                      <h4>Persiapan</h4>
                    </Col>
                    <Col xs="12" sm="10" md="8">
                      <Button block color="success" className="btn-pill">Sedang Dilaksanakan</Button>
                    </Col>
                  </Col>
                </Row>
                <Row>
                  <Col xs="5" sm="5" md="5">
                    <Col xs="12" sm="10" md="8">
                      <h4>Persiapan</h4>
                    </Col>
                    <Col xs="12" sm="10" md="8">
                      <Button block color="success" className="btn-pill">Sedang Dilaksanakan</Button>
                    </Col>
                  </Col>
                  <Col xs="2" sm="2" md="2">
                    <Col xs="12" sm="12" md="6">
                    <Button block color="success" className="btn-pill"><i class="cui-file icons"></i></Button>
                    </Col>
                  </Col>
                  <Col xs="5" sm="5" md="5">
                    <Col xs="12" sm="10" md="8">
                      <h4>Persiapan</h4>
                    </Col>
                    <Col xs="12" sm="10" md="8">
                      <Button block color="success" className="btn-pill">Sedang Dilaksanakan</Button>
                    </Col>
                  </Col>
                </Row>
            </CardBody>
            </Card>
          </Col>
        
      </div>
    );
  }
}

export default Tahapan;
