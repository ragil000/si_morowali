import React from 'react';
import ReactDOM from 'react-dom';
import PraRkaCreate from './PraRkaCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<PraRkaCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
