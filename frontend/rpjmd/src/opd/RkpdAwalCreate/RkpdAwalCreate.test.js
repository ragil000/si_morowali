import React from 'react';
import ReactDOM from 'react-dom';
import RkpdAwalCreate from './RkpdAwalCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<RkpdAwalCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
