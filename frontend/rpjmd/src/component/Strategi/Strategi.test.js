import React from 'react';
import ReactDOM from 'react-dom';
import Strategi from './Strategi';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<Strategi />, div);
  ReactDOM.unmountComponentAtNode(div);
});
