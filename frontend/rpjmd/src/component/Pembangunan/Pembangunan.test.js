import React from 'react';
import ReactDOM from 'react-dom';
import Pembangunan from './Pembangunan';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<Pembangunan />, div);
  ReactDOM.unmountComponentAtNode(div);
});
