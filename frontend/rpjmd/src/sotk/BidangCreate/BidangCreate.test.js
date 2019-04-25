import React from 'react';
import ReactDOM from 'react-dom';
import BidangCreate from './BidangCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<BidangCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
