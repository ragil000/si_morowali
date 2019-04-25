import React from 'react';
import ReactDOM from 'react-dom';
import PokirCreate from './PokirCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<PokirCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
