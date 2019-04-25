import React, { Component } from 'react';
import { Button, FormGroup, Label, Input, Card, CardBody, Col, Row, Table } from 'reactstrap';

class Indikatif extends Component {
  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardBody>
                <h5 style={{textAlign: 'center',}}>PERUMUSAN PAGU INDIKATIF PROGRAM/TAHUN</h5>
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
                      <th rowSpan="3">Kode</th>
                      <th rowSpan="3">Program</th>
                      <th rowSpan="3">Indikator Kinerka (Outcome)</th>
                      <th rowSpan="3">Kondisi Kinerja pada Awal RPJMD (Tahun 0)</th>
                      <th colSpan="17">Capaian Kineja</th>
                      <th rowSpan="3">Penanggung Jawab</th>
                      <th rowSpan="3">Aksi</th>
                    </tr>
                    <tr>
                      <th colSpan="3">Tahun 1</th>
                      <th colSpan="3">Tahun 2</th>
                      <th colSpan="3">Tahun 3</th>
                      <th colSpan="3">Tahun 4</th>
                      <th colSpan="3">Tahun 5</th>
                      <th colSpan="2">Kondisi Kinerja Akhir Periode</th>
                    </tr>
                    <tr>
                      <th>Target</th>
                      <th>Rp</th>
                      <th>Lokasi</th>
                      <th>Target</th>
                      <th>Rp</th>
                      <th>Lokasi</th>
                      <th>Target</th>
                      <th>Rp</th>
                      <th>Lokasi</th>
                      <th>Target</th>
                      <th>Rp</th>
                      <th>Lokasi</th>
                      <th>Target</th>
                      <th>Rp</th>
                      <th>Lokasi</th>
                      <th>Target</th>
                      <th>Rp</th>
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
                      <th>(11)</th>
                      <th>(12)</th>
                      <th>(13)</th>
                      <th>(14)</th>
                      <th>(15)</th>
                      <th>(16)</th>
                      <th>(17)</th>
                      <th>(18)</th>
                      <th>(19)</th>
                      <th>(20)</th>
                      <th>(21)</th>
                      <th>(22)</th>
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

export default Indikatif;
