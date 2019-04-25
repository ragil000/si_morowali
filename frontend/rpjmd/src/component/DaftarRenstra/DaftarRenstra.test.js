import React from 'react';
import ReactDOM from 'react-dom';
import DaftarRenstra from './DaftarRenstra';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<DaftarRenstra />, div);
  ReactDOM.unmountComponentAtNode(div);
});
