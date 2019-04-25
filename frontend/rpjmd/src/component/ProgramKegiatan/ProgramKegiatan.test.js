import React from 'react';
import ReactDOM from 'react-dom';
import ProgramKegiatan from './ProgramKegiatan';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<ProgramKegiatan />, div);
  ReactDOM.unmountComponentAtNode(div);
});
