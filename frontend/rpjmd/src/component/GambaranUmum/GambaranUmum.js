import React, { Component } from 'react';
import { Button, FormGroup, Label, Input, Card, CardBody, Col, Row, Table } from 'reactstrap';

class GambaranUmum extends Component {
  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardBody>
                <h4 style={{textAlign: 'center',}}>Gambran Umum Daerah, Rumusan Masalah dan Isu Strategis Urusan</h4>
                <Row>
                  <Col  xs="12" lg="5">
                    <FormGroup row>
                      <Col md="3">
                        <Label htmlFor="select">Filter by Urusan</Label>
                      </Col>
                      <Col xs="12" md="9">
                        <Input type="select" name="status" value={true} >
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
                      <th>No</th>
                      <th>Data</th>
                      <th>Capaian Kerja</th>
                      <th>Standar/Target Nasional</th>
                      <th>Standar/Target Daerah</th>
                      <th>Rumusan Masalah</th>
                      <th>Lokasi</th>
                      <th>Isu Strategi Usulan</th>
                      <th>Aksi</th>
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
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="9" style={{textAlign: 'center',}}>URUSAN WAJIB</td>
                    </tr>
                    <tr>
                      <td colspan="9" style={{textAlign: 'center',}}>URUSAN PILIHAN</td>
                    </tr>
                    <tr>
                      <td colspan="9" style={{textAlign: 'center',}}>FUNGSI PENUNJANG</td>
                    </tr>
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

export default GambaranUmum;
