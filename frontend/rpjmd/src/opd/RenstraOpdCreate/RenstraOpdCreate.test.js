import React from 'react';
import ReactDOM from 'react-dom';
import RenstraOpdCreate from './RenstraOpdCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<RenstraOpdCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
