import React from 'react';
import ReactDOM from 'react-dom';
import OpdPaguCreate from './OpdPaguCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<OpdPaguCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
