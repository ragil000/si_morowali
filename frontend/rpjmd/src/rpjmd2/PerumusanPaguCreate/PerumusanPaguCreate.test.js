import React from 'react';
import ReactDOM from 'react-dom';
import PerumusanPaguCreate from './PerumusanPaguCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<PerumusanPaguCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
