import React from 'react';
import ReactDOM from 'react-dom';
import RkpdPerubahanCreate from './RkpdPerubahanCreate';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<RkpdPerubahanCreate />, div);
  ReactDOM.unmountComponentAtNode(div);
});
