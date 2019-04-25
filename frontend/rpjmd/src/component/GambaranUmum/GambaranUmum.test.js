import React from 'react';
import ReactDOM from 'react-dom';
import GambaranUmum from './GambaranUmum';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<GambaranUmum />, div);
  ReactDOM.unmountComponentAtNode(div);
});
