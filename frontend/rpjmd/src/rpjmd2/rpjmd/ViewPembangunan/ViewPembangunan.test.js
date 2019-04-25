import React from 'react';
import ReactDOM from 'react-dom';
import ViewPembangunan from './ViewPembangunan';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<ViewPembangunan />, div);
  ReactDOM.unmountComponentAtNode(div);
});
