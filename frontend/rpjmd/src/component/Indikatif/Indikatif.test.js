import React from 'react';
import ReactDOM from 'react-dom';
import Indikatif from './Indikatif';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<Indikatif />, div);
  ReactDOM.unmountComponentAtNode(div);
});
