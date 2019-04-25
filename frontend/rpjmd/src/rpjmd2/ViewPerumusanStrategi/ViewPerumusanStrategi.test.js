import React from 'react';
import ReactDOM from 'react-dom';
import ViewPerumusanStrategi from './ViewPerumusanStrategi';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<ViewPerumusanStrategi />, div);
  ReactDOM.unmountComponentAtNode(div);
});
