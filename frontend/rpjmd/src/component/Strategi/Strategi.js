import React, { Component } from 'react';
import { Button, FormGroup, Label, Input, Card, CardBody, Col, Row, Table } from 'reactstrap';

class Strategi extends Component {
  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardBody>
                <h5 style={{textAlign: 'center',}}>PERUMUSAN ISU STRATEGIS RPJMD</h5>
              <Col md="3">Visi :</Col>
              <Col xs="12" md="9"></Col>
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
                      <th rowSpan="2">Misi</th>
                      <th rowSpan="2">Isu Strategi Urusan</th>
                      <th colSpan="4">Kajian Kebijakan</th>
                      <th rowSpan="2">Isu Strategi RPJMD</th>
                      <th rowSpan="2">Bidang/Urusan</th>
                      <th rowSpan="2">Aksi</th>
                    </tr>
                    <tr>
                      <th>RPJPD</th>
                      <th>RTRW</th>
                      <th>RPJMN/RPJMD PROVINSI</th>
                      <th>DINAMIKA INTERNASIONAL</th>
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

export default Strategi;
