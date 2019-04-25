import React from 'react';
import ReactDOM from 'react-dom';
import RenjaAwalCreate from './RenjaAwalCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<RenjaAwalCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
