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
      name: 'Penyusunan Renstra',
      url: '/menyusun',
      icon: 'icon-puzzle',
      children: [
        {
          name: 'Visi',
          url: '/menyusun/opd/visi',
          icon: 'icon-puzzle',
        },
        {
          name: 'Misi',
          url: '/menyusun/opd/misi',
          icon: 'icon-puzzle',
        },
        {
          name: 'Tujuan',
          url: '/menyusun/opd/tujuan',
          icon: 'icon-puzzle',
        },
        {
          name: 'Sasaran',
          url: '/menyusun/opd/sasaran',
          icon: 'icon-puzzle',
        },
        {
          name: 'Indikator',
          url: '/menyusun/opd/indikator',
          icon: 'icon-puzzle',
        },
        {
          name: 'Pegawai',
          url: '/menyusun/opd/pegawai',
          icon: 'icon-puzzle',
        },
        {
          name: 'Renstra OPD',
          url: '/menyusun/opd/renstra-opd',
          icon: 'icon-puzzle',
        },
      ],
    },
    {
      name: 'Penyusunan RKPD',
      url: '/menyusun/rkpd',
      icon: 'icon-puzzle',
      children: [
        {
          name: 'Hasil Musrenbang',
          url: '/menyusun/rkpd/hasil-musrenbang',
          icon: 'icon-puzzle',
        },
        {
          name: 'Hasil Pokir',
          url: '/menyusun/rkpd/hasil-pokir',
          icon: 'icon-puzzle',
        },
        {
          name: 'Renja Awal',
          url: '/menyusun/rkpd/renja-awal',
          icon: 'icon-puzzle',
        },
        {
          name: 'Renja Perubahan',
          url: '/menyusun/rkpd/renja-perubahan',
          icon: 'icon-puzzle',
        },
      ],
    },
  ],
};
