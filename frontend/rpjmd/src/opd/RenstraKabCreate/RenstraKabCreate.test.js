import React from 'react';
import ReactDOM from 'react-dom';
import RenstraKabCreate from './RenstraKabCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<RenstraKabCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
