import React from 'react';
import ReactDOM from 'react-dom';
import SasaranCreate2 from './SasaranCreate2';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<SasaranCreate2 />, div);
  ReactDOM.unmountComponentAtNode(div);
});
