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
        name: 'Data Usulan',
        url: '/musrenbang',
        icon: 'icon-puzzle',
        children: [
          // {
          //   name: 'Tambah Usulan',
          //   url: '/kelurahan/tambah-usulan',
          //   icon: 'icon-puzzle',
          // },
          {
            name: 'Musrenbang',
            url: '/usulan/data-musrenbang',
            icon: 'icon-puzzle',
          },
          {
            name: 'Pokir',
            url: '/usulan/data-pokir',
            icon: 'icon-puzzle',
          },
        ],
      },
      {
        name: 'Akun',
        url: '/akun',
        icon: 'icon-pie-chart',
        badge: {
          variant: 'info',
          text: 'NEW',
        },
      },
      {
        name: 'Import',
        url: '/import',
        icon: 'icon-pie-chart',
        badge: {
          variant: 'info',
          text: 'NEW',
        },
      },
      {
        divider: true,
      },
    ],
  };
  