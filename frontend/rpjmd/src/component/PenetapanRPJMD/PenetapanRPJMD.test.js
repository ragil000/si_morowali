import React from 'react';
import ReactDOM from 'react-dom';
import PenetapanRPJMD from './PenetapanRPJMD';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<PenetapanRPJMD />, div);
  ReactDOM.unmountComponentAtNode(div);
});
