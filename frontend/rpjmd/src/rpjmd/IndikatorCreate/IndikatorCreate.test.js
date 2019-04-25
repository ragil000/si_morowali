import React from 'react';
import ReactDOM from 'react-dom';
import IndikatorCreate from './IndikatorCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<IndikatorCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
