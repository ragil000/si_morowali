import React from 'react';
import ReactDOM from 'react-dom';
import SasaranCreate from './SasaranCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<SasaranCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
