import React, { Component } from 'react';
import { Button, FormGroup, Label, Input, Card, CardBody, Col, Row, Table } from 'reactstrap';

class Pembangunan extends Component {
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
              <CardBody>
                <Table responsive striped bordered>
                  <thead>
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
                  </tbody>
                </Table>
              </CardBody>
            </Card>
          </Col>
        </Row>

      </div>

    );
  }
}

export default Pembangunan;
