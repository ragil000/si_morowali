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
        name: 'Kecamatan',
        url: '/kecamatan',
        icon: 'icon-puzzle',
        children: [
          {
            name: 'Tambah Usulan',
            url: '/kecamatan/tambah-usulan',
            icon: 'icon-puzzle',
          },
          // {
          //   name: 'Data Usulan',
          //   url: '/kecamatan/data-usulan',
          //   icon: 'icon-puzzle',
          // },
        ],
      },
      {
        name: 'Import',
        url: '/kecamatan/import',
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
  