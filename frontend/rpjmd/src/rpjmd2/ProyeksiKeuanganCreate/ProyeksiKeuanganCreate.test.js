import React from 'react';
import ReactDOM from 'react-dom';
import ProyeksiKeuanganCreate from './ProyeksiKeuanganCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<ProyeksiKeuanganCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
