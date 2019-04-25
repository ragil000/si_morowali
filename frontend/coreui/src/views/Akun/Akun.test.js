import React from 'react';
import ReactDOM from 'react-dom';
import Akun from './Akun';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<Akun />, div);
  ReactDOM.unmountComponentAtNode(div);
});
