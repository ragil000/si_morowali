import React from 'react';
import ReactDOM from 'react-dom';
import StrategiCreate from './StrategiCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<StrategiCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
