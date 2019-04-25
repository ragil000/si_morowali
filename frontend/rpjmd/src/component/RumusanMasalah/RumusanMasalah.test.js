import React from 'react';
import ReactDOM from 'react-dom';
import RumusanMasalah from './RumusanMasalah';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<RumusanMasalah />, div);
  ReactDOM.unmountComponentAtNode(div);
});
