import React from 'react';
import ReactDOM from 'react-dom';
import ViewPerumusanTujuanSasaran from './ViewPerumusanTujuanSasaran';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<ViewPerumusanTujuanSasaran />, div);
  ReactDOM.unmountComponentAtNode(div);
});
