import React, { Component } from 'react';
import { Button, Card, CardBody, Col, Row, } from 'reactstrap';
// import { AppSwitch } from '@coreui/react'

class PenetapanRPJMD extends Component {
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
                <Card style={{border:0}}>
                  <h3>Penetapan Akhir RPJMD</h3>
                </Card>
                  <Col xs="12" sm="6" md="4">
                    <Card>
                      <Button href="#/tahapan/penetapan-rpjmd/daftar-renstra" block color="warning" xs="12" sm="12" md="12">
                        Daftar Renstra PD yang telah Upload
                      </Button>
                    </Card>
                  </Col>
                <Row>
                  <Col xs="12" sm="6" md="4">
                    <Card>
                      <Button href="#/tahapan/penetapan-rpjmd/visi-misi" block color="success" xs="12" sm="12" md="12">
                        <blockquote className="card-bodyquote text-white">
                          <h4><i class="fa fa-file-o fa-lg mt-4"></i> 1. Visi Misi</h4>
                        </blockquote>
                      </Button>
                    </Card>
                  </Col>
                  <Col xs="12" sm="6" md="4">
                    <Card>
                      <Button href="#/tahapan/penetapan-rpjmd/gambaran-umum" block color="primary" xs="12" sm="12" md="12">
                        <blockquote className="card-bodyquote text-white">
                          <h4><i class="fa fa-file-image-o fa-lg mt-4"></i> 2. Gambaran Umum Daerah</h4>
                        </blockquote>
                      </Button>
                    </Card>
                  </Col>
                  <Col xs="12" sm="6" md="4">
                    <Card>
                      <Button href="#/tahapan/penetapan-rpjmd/rumusan-masalah" block color="info" xs="12" sm="6" md="4">
                        <blockquote className="card-bodyquote text-white">
                          <h4><i class="fa fa-book fa-lg mt-4"></i> 3. Rumusan Masalah</h4>
                        </blockquote>
                      </Button>
                    </Card>
                  </Col>
                  <Col xs="12" sm="6" md="4">
                    <Card>
                      <Button href="#/tahapan/penetapan-rpjmd/strategi-rpjmd" block color="success" xs="12" sm="6" md="4">
                        <blockquote className="card-bodyquote">
                          <h4><i class="fa fa-file-text-o fa-lg mt-4"></i> 4. Isu Strategi RPJMD</h4>
                        </blockquote>
                      </Button>
                    </Card>
                  </Col>
                  <Col xs="12" sm="6" md="4">
                    <Card>
                      <Button href="#/tahapan/penetapan-rpjmd/tujuan-sarana" block color="primary" xs="12" sm="6" md="4">
                        <blockquote className="card-bodyquote">
                          <h4><i class="fa fa-hand-o-right fa-lg mt-4"></i> 5. Tujuan dan Sarana RPJMD</h4>
                        </blockquote>
                      </Button>
                    </Card>
                  </Col>
                  <Col xs="12" sm="6" md="4">
                    <Card>
                      <Button href="#/tahapan/penetapan-rpjmd/sasaran" block color="info" xs="12" sm="6" md="4">
                        <blockquote className="card-bodyquote text-white">
                          <h4><i class="fa fa-bar-chart fa-lg mt-4"></i> 6. Sasaran RPJMD & Sasaran Urusan</h4>
                        </blockquote>
                      </Button>
                    </Card>
                  </Col>
                  <Col xs="12" sm="6" md="4">
                    <Card>
                      <Button href="#/tahapan/penetapan-rpjmd/strategi" block color="success" xs="12" sm="6" md="4">
                        <blockquote className="card-bodyquote text-white">
                          <h4><i class="fa fa-line-chart fa-lg mt-4"></i> 7. Strategi & Arah Kebijakan</h4>
                        </blockquote>
                      </Button>
                    </Card>
                  </Col>
                  <Col xs="12" sm="6" md="4">
                    <Card>
                      <Button href="#/tahapan/penetapan-rpjmd/kebijakan" block color="primary" xs="12" sm="6" md="4">
                        <blockquote className="card-bodyquote">
                          <h4><i class="fa fa-money fa-lg mt-4"></i> 8. Arah Kebijakan Keuangan Daerah</h4>
                        </blockquote>
                      </Button>
                    </Card>
                  </Col>
                  <Col xs="12" sm="6" md="4">
                    <Card>
                      <Button href="#/tahapan/penetapan-rpjmd/pembangunan" block color="info" xs="12" sm="6" md="4">
                        <blockquote className="card-bodyquote text-white">
                          <h4><i class="fa fa-hospital-o fa-lg mt-4"></i> 9. Program Pembangunan</h4>
                        </blockquote>
                      </Button>
                    </Card>
                  </Col>
                  <Col xs="12" sm="6" md="4">
                    <Card>
                      <Button href="#/tahapan/penetapan-rpjmd/indikatif" block color="success" xs="12" sm="6" md="4">
                        <blockquote className="card-bodyquote">
                          <h4><i class="fa fa-inbox fa-lg mt-4"></i> 10. Program & Pagu Indikator</h4>
                        </blockquote>
                      </Button>
                    </Card>
                  </Col>
                  <Col xs="12" sm="6" md="4">
                    <Card>
                      <Button href="#/tahapan/penetapan-rpjmd/lampiran" block color="primary" xs="12" sm="6" md="4">
                        <blockquote className="card-bodyquote">
                          <h4><i class="fa fa-paperclip fa-lg mt-4"></i> 11. Lampiran</h4>
                        </blockquote>
                      </Button>
                    </Card>
                  </Col>
                </Row>
              </CardBody>
            </Card>
          </Col>
      </div>
    );
  }
}

export default PenetapanRPJMD;
