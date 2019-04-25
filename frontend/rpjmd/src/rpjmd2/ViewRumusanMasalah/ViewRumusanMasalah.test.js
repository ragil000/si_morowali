import React from 'react';
import ReactDOM from 'react-dom';
import ViewRumusanMasalah from './ViewRumusanMasalah';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<ViewRumusanMasalah />, div);
  ReactDOM.unmountComponentAtNode(div);
});
