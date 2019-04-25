import React from 'react';
import ReactDOM from 'react-dom';
import AdminTambah from './AdminTambah';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<AdminTambah />, div);
  ReactDOM.unmountComponentAtNode(div);
});
