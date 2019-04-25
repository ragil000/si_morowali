import React from 'react';
import ReactDOM from 'react-dom';
import SubUnitCreate from './SubUnitCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<SubUnitCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
