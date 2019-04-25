import React from 'react';
import ReactDOM from 'react-dom';
import Sasaran from './Sasaran';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<Sasaran />, div);
  ReactDOM.unmountComponentAtNode(div);
});
