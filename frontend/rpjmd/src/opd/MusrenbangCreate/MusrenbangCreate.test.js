import React from 'react';
import ReactDOM from 'react-dom';
import MusrenbangCreate from './MusrenbangCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<MusrenbangCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
