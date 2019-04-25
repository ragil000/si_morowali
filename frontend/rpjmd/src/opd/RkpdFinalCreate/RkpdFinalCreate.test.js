import React from 'react';
import ReactDOM from 'react-dom';
import RkpdFinalCreate from './RkpdFinalCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<RkpdFinalCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
