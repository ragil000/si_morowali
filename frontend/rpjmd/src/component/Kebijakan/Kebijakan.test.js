import React from 'react';
import ReactDOM from 'react-dom';
import Kebijakan from './Kebijakan';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<Kebijakan />, div);
  ReactDOM.unmountComponentAtNode(div);
});
