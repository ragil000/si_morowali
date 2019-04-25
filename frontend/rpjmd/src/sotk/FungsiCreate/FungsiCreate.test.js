import React from 'react';
import ReactDOM from 'react-dom';
import FungsiCreate from './FungsiCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<FungsiCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
