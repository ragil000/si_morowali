import React from 'react';
import ReactDOM from 'react-dom';
import TujuanCreate from './TujuanCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<TujuanCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
