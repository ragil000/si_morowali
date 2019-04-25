import React from 'react';
import ReactDOM from 'react-dom';
import VisiCreate from './VisiCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<VisiCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
