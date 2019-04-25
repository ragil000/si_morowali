import React from 'react';
import ReactDOM from 'react-dom';
import ViewPerumusanIsuStrategis from './ViewPerumusanIsuStrategis';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<ViewPerumusanIsuStrategis />, div);
  ReactDOM.unmountComponentAtNode(div);
});
