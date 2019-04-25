import React from 'react';
import ReactDOM from 'react-dom';
import ViewPerumusanProgram from './ViewPerumusanProgram';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<ViewPerumusanProgram />, div);
  ReactDOM.unmountComponentAtNode(div);
});
