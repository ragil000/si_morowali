import React from 'react';
import ReactDOM from 'react-dom';
import ImportKecamatan from './ImportKecamatan';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<ImportKecamatan />, div);
  ReactDOM.unmountComponentAtNode(div);
});
