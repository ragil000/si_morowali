import React from 'react';
import ReactDOM from 'react-dom';
import ViewStrategiKebijakan from './ViewStrategiKebijakan';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<ViewStrategiKebijakan />, div);
  ReactDOM.unmountComponentAtNode(div);
});
