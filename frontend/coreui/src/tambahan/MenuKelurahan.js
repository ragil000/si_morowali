export default {
    items: [
      {
        name: 'Dashboard',
        url: '/dashboard',
        icon: 'icon-speedometer',
        badge: {
          variant: 'info',
          text: 'NEW',
        },
      },
      {
        title: true,
        name: 'Components',
        wrapper: {
          element: '',
          attributes: {},
        },
      },
      {
        name: 'Kelurahan',
        url: '/kelurahan',
        icon: 'icon-puzzle',
        children: [
          {
            name: 'Tambah Usulan',
            url: '/kelurahan/tambah-usulan',
            icon: 'icon-puzzle',
          },
          // {
          //   name: 'Data Usulan',
          //   url: '/kelurahan/data-usulan',
          //   icon: 'icon-puzzle',
          // },
        ],
      },
      {
        divider: true,
      },
    ],
  };
  