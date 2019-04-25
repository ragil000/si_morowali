import React from 'react';
import ReactDOM from 'react-dom';
import ManajemenUser from './ManajemenUser';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<ManajemenUser />, div);
  ReactDOM.unmountComponentAtNode(div);
});
