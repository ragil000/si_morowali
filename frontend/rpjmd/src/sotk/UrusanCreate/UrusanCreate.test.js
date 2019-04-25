import React from 'react';
import ReactDOM from 'react-dom';
import UrusanCreate from './UrusanCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<UrusanCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
