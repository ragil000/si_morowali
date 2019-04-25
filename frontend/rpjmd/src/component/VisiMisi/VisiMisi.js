import React, { Component } from 'react';
import { Input,  Card, CardBody, Col, Row, Table } from 'reactstrap';

class VisiMisi extends Component {
  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardBody>
                <h4>Visi</h4>
                <Input  disabled />
              </CardBody>
              <CardBody>
                <h4>Penjelasan Visi</h4>
                <Table responsive striped bordered>
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Penjelasan Visi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="3">Tidak ada data penjelasan visi</td>
                    </tr>
                  </tbody>
                </Table>
              </CardBody>
              <CardBody>
                <h4>Misi</h4>
                <Table responsive striped bordered>
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Misi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="3">Tidak ada data penjelasan misi</td>
                    </tr>
                  </tbody>
                </Table>
              </CardBody>
              <CardBody>
                <h4>Program Prioritas</h4>
                <Table responsive striped bordered>
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Misi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="3">Tidak ada data program prioritas</td>
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

export default VisiMisi;
