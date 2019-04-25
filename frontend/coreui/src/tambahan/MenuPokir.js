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
        name: 'Pokir',
        url: '/pokir',
        icon: 'icon-puzzle',
        children: [
          {
            name: 'Tambah Usulan',
            url: '/pokir/tambah-usulan',
            icon: 'icon-puzzle',
          },
          // {
          //   name: 'Data Usulan',
          //   url: '/pokir/data-usulan',
          //   icon: 'icon-puzzle',
          // },
        ],
      },
      {
        divider: true,
      },
    ],
  };
  