import React from 'react';
import ReactDOM from 'react-dom';
import StrategiKebijakan from './StrategiKebijakan';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<StrategiKebijakan />, div);
  ReactDOM.unmountComponentAtNode(div);
});
