import React from 'react';
import ReactDOM from 'react-dom';
import Tahapan from './Tahapan';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<Tahapan />, div);
  ReactDOM.unmountComponentAtNode(div);
});
