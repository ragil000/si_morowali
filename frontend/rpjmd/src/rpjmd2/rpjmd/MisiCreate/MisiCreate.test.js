import React from 'react';
import ReactDOM from 'react-dom';
import MisiCreate from './MisiCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<MisiCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
