import React from 'react';
import ReactDOM from 'react-dom';
import RkpdVerifikasiCreate from './RkpdVerifikasiCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<RkpdVerifikasiCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
