import React, { Component } from 'react';
import {  Card, CardBody, Col, Row, Table } from 'reactstrap';

class Kebijakan extends Component {
  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardBody>
              <h4 style={{textAlign: 'center',}}>PROYEKSI KEMAMPUAN KEUANGAN DAERAH</h4>
                <Table responsive striped bordered>
                  <thead  style={{textAlign: 'center',}}>
                  <tr>
                      <th rowSpan="3">Kode</th>
                      <th rowSpan="3">Jenis Belanja / Program Pembangunan</th>
                      <th colSpan="5">Proyeksi</th>
                    </tr>
                    <tr>
                      <th>Tahun 1</th>
                      <th>Tahun 2</th>
                      <th>Tahun 3</th>
                      <th>Tahun 4</th>
                      <th>Tahun 5</th>
                    </tr>
                    <tr>
                      <th>Rp</th>
                      <th>Rp</th>
                      <th>Rp</th>
                      <th>Rp</th>
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
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </Table>
              </CardBody>
              <CardBody>
              <h4 style={{textAlign: 'center',}}>PRAKIRAAN PAGU INDIKATIF PER-URUSAN/ADMINISTRASI/PENUNJANG</h4>
                <Table responsive striped bordered>
                  <thead style={{textAlign: 'center',}}>
                  <tr>
                      <th rowSpan="3">Kode</th>
                      <th rowSpan="3">Urusan/Penunjang</th>
                      <th colSpan="5">Prakiraan Pagu Indikatif</th>
                    </tr>
                    <tr>
                      <th>Tahun 1</th>
                      <th>Tahun 2</th>
                      <th>Tahun 3</th>
                      <th>Tahun 4</th>
                      <th>Tahun 5</th>
                    </tr>
                    <tr>
                      <th>Rp</th>
                      <th>Rp</th>
                      <th>Rp</th>
                      <th>Rp</th>
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
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </Table>
              </CardBody>
              <CardBody>
              <h4 style={{textAlign: 'center',}}>ANALISIS KEUANGAN DAERAH PROVINSI/KABUPATEN/KOTA</h4>
                <Table responsive striped bordered>
                  <thead style={{textAlign: 'center',}}>
                  <tr>
                      <th rowSpan="3">Kode</th>
                      <th rowSpan="3">Jenis Belanja/Program Pembangunan</th>
                      <th rowSpan="3">Data Tahun Dasar (Rp)</th>
                      <th rowSpan="3">Tingkat Pertumbuhan (%)</th>
                      <th colSpan="5">Prakiraan Pagu Indikatif</th>
                    </tr>
                    <tr>
                      <th>Tahun 1</th>
                      <th>Tahun 2</th>
                      <th>Tahun 3</th>
                      <th>Tahun 4</th>
                      <th>Tahun 5</th>
                    </tr>
                    <tr>
                      <th>Rp</th>
                      <th>Rp</th>
                      <th>Rp</th>
                      <th>Rp</th>
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
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
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

export default Kebijakan;
