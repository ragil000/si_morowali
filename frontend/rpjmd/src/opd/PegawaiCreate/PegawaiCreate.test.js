import React from 'react';
import ReactDOM from 'react-dom';
import PegawaiCreate from './PegawaiCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<PegawaiCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
