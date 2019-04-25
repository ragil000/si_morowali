import React from 'react';
import ReactDOM from 'react-dom';
import PokirTambah from './PokirTambah';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<PokirTambah />, div);
  ReactDOM.unmountComponentAtNode(div);
});
