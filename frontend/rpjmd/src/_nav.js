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
      name: 'Penyusunan RPJMD',
      url: '/menyusun',
      icon: 'icon-puzzle',
      children: [
        {
          name: 'Visi',
          url: '/menyusun/visi',
          icon: 'icon-puzzle',
        },
        {
          name: 'Misi',
          url: '/menyusun/misi',
          icon: 'icon-puzzle',
        },
        {
          name: 'Tujuan',
          url: '/menyusun/tujuan',
          icon: 'icon-puzzle',
        },
        {
          name: 'Sasaran',
          url: '/menyusun/sasaran',
          icon: 'icon-puzzle',
        },
        {
          name: 'Indikator',
          url: '/menyusun/indikator',
          icon: 'icon-puzzle',
        },
        {
          name: 'Rumusan Masalah',
          url: '/menyusun/rumusan-masalah',
          icon: 'icon-puzzle',
        },
        {
          name: 'Isu Strategi',
          url: '/menyusun/isu-strategi',
          icon: 'icon-puzzle',
        },
        {
          name: 'Tujuan Sasaran',
          url: '/menyusun/tujuan-sasaran',
          icon: 'icon-puzzle',
        },
        {
          name: 'Perumusan Strategi',
          url: '/menyusun/perumusan-strategi',
          icon: 'icon-puzzle',
        },
        {
          name: 'Perumusan Program',
          url: '/menyusun/perumusan-program',
          icon: 'icon-puzzle',
        },
        {
          name: 'Matrix Keuangan',
          url: '/menyusun/proyeksi-keuangan',
          icon: 'icon-puzzle',
        },
        {
          name: 'Pagu Indikatif Pertahun',
          url: '/menyusun/perumusan-pagu',
          icon: 'icon-puzzle',
        },

        
      ],
    },
    {
      name: 'SOTK',
      url: '/sotk',
      icon: 'icon-puzzle',
      children: [
        {
          name: 'Urusan',
          url: '/sotk/urusan',
          icon: 'icon-puzzle',
        },
        {
          name: 'Bidang',
          url: '/sotk/bidang',
          icon: 'icon-puzzle',
        },
        {
          name: 'Fungsi',
          url: '/sotk/fungsi',
          icon: 'icon-puzzle',
        },
        {
          name: 'Sub Unit',
          url: '/sotk/sub-unit',
          icon: 'icon-puzzle',
        },
      ],
    },
    {
      name: 'User',
      url: '/admin',
      icon: 'icon-puzzle',
      children: [
        {
          name: 'Users',
          url: '/admin/user',
          icon: 'icon-puzzle',
        },
      ],
    },
  ],
};
