import React from 'react';
import ReactDOM from 'react-dom';
import RenjaPerubahanCreate from './RenjaPerubahanCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<RenjaPerubahanCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
