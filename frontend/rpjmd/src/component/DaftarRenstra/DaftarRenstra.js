import React, { Component } from 'react';
import {  Card, CardBody,  Col,  Row, Table } from 'reactstrap';

class DaftarRenstra extends Component {
  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardBody>
                <h4 style={{textAlign: 'center',}}>Daftar Renstra PD</h4>
                <Row>
                </Row>
              </CardBody>
              <CardBody>
                <Table responsive striped bordered>
                  <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Perangkat Daerah</th>
                      <th>Status</th>
                    </tr>
                    <tr>
                      <th>(1)</th>
                      <th>(2)</th>
                      <th>(3)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
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

export default DaftarRenstra;
