import React from 'react';
import ReactDOM from 'react-dom';
import AdminUsulanPokir from './AdminUsulanPokir';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<AdminUsulanPokir />, div);
  ReactDOM.unmountComponentAtNode(div);
});
