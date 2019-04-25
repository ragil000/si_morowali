import React from 'react';
import ReactDOM from 'react-dom';
import ViewKebijakan from './ViewKebijakan';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<ViewKebijakan />, div);
  ReactDOM.unmountComponentAtNode(div);
});
