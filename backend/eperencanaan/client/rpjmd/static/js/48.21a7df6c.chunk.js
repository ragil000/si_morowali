(window.webpackJsonp=window.webpackJsonp||[]).push([[48],{265:function(e,a,t){e.exports=t.p+"static/media/loading.557336d4.gif"},371:function(e,a,t){"use strict";t.r(a);var n=t(272),l=t(104),r=t(105),c=t(107),m=t(106),u=t(108),d=t(109),i=t(1),o=t.n(i),s=t(13),g=t(2),h=t(3),p=t(4),E=t(27),_=t(28),S=t(17),k=t(11),v=t(8),f=t(29),P=t(7),b=t(26),j=t(5),K=t(25),w=t(14),y=t(9),C=t(10),D=t(12),T=t(269),I=t.n(T),x=t(268),A=t(265),O=t.n(A),N=function(e){function a(e){var t;return Object(l.a)(this,a),(t=Object(c.a)(this,Object(m.a)(a).call(this,e))).componentWillMount=function(){t.getData()},t.handleChange=function(e){return function(a){var l=parseInt(a.target.attributes.getNamedItem("data-number").value);if(1===l){var r=t.state.dataAll.map(function(l,r){if(e!==r)return l;var c=Object(n.a)({},l,{Kd_Keg:a.target.value});return t.setState({dataPilih:c}),c});t.setState({dataAll:r})}if(2===l){var c=t.state.dataAll.map(function(l,r){if(e!==r)return l;var c=Object(n.a)({},l,{outcome_kegiatan:a.target.value});return t.setState({dataPilih:c}),c});t.setState({dataAll:c})}}},t.changePesan=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null,a=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"success";null===e?t.setState({pesan:""}):t.setState({pesan:o.a.createElement(s.a,{color:a},e)}),setTimeout(function(){t.setState({pesan:""})},3e3)},t.setData=function(e){e.status&&t.setState({dataAll:e.data,jumlahPage:e.jumlahPage,jumlahAll:e.jumlahAll,dataTambah:e.dataTambah,dataOpd:e.dataOpd}),e.data.length>0?t.rpjmdTahun=parseInt(e.data[0].rpjmd_tahun):t.rpjmdTahun=0},t.getData=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1;t.setState({loading:!0});var a=new FormData;a.append("session",localStorage.getItem("codexv-session")),a.append("rpjmd",localStorage.getItem("codexv-rpjmd")),a.append("search",t.state.pencarian),I.a.post(x.apiRoot+t.link+"/page-"+e,a).then(function(e){t.setData(e.data),console.log(e),t.setState({loading:!1})}).catch(function(e){console.log(e),t.setState({loading:!1}),t.changePesan("Tidak dapat terhubung pada server!","danger")})},t.getKegiatan=function(e,a,n){t.setState({loading:!0});var l=new FormData;l.append("session",localStorage.getItem("codexv-session")),l.append("urusan",e),l.append("bidang",a),l.append("program",n),I.a.post(x.apiRoot+"opd/get-data/kegiatan",l).then(function(e){e.data.status&&t.setState({dataTambah:e.data.data}),t.setState({loading:!1}),console.log(e)}).catch(function(e){console.log(e),t.setState({loading:!1})})},t.handleSubmit=function(){t.setState({loading:!0});var e="";"Edit"===t.state.aksi?e=x.apiRoot+t.link+"/update":"Tambah"===t.state.aksi&&(e=x.apiRoot+t.link+"/create");var a=new FormData;a.append("session",localStorage.getItem("codexv-session")),a.append("rpjmd",localStorage.getItem("codexv-rpjmd")),a.append("perumusan_program_id",t.state.dataPilih.perumusan_program_id),a.append("Kd_Keg",t.state.dataPilih.Kd_Keg),a.append("outcome_kegiatan",t.state.dataPilih.outcome_kegiatan),I.a.post(e,a,{headers:{"Content-Type":"multipart/form-data"}}).then(function(e){e.data.status?(t.modalCreateClose(),t.getData(t.state.page),t.changePesan(e.data.pesan)):t.changePesan(e.data.pesan,"warning"),t.setState({loading:!1}),console.log(e.data)}).catch(function(e){console.log(e),t.setState({loading:!1}),t.changePesan("Tidak dapat terhubung pada server!","danger")})},t.handleDelete=function(){t.setState({loading:!0});var e=new FormData;e.append("session",localStorage.getItem("codexv-session")),e.append("rpjmd",localStorage.getItem("codexv-rpjmd")),e.append("perumusan_program_id",t.state.dataPilih.perumusan_program_id),I.a.post(x.apiRoot+t.link+"/delete",e).then(function(e){e.data.status?(t.modalDelete(),t.getData(t.state.page),t.changePesan(e.data.pesan)):t.changePesan(e.data.pesan,"warning"),t.setState({loading:!1}),console.log(e)}).catch(function(e){console.log(e),t.setState({loading:!1}),t.changePesan("Tidak dapat terhubung pada server!","danger")})},t.handleCariSubmit=function(e){e.preventDefault(),t.getData()},t.changePage=function(e){t.setState({page:e}),t.getData(e)},t.pageNation=function(){var e=[];t.state.page>1?e.push(o.a.createElement(g.a,{onClick:function(){return t.changePage(t.state.page-1)},key:0},o.a.createElement(h.a,{previous:!0,tag:"button"},"Prev"))):e.push(o.a.createElement(g.a,{disabled:!0,key:0},o.a.createElement(h.a,{previous:!0,tag:"button"},"Prev")));for(var a=!1,n=!1,l=function(l){n=a,a=!1,l+2>=t.state.page&&l-2<=t.state.page&&(a=!0),1!==l&&l!==t.state.jumlahPage||(a=!0),a?l===t.state.page?e.push(o.a.createElement(g.a,{active:!0,key:l},o.a.createElement(h.a,{tag:"button"},l))):e.push(o.a.createElement(g.a,{key:l,onClick:function(){return t.changePage(l)}},o.a.createElement(h.a,{tag:"button"},l))):n!==a&&e.push(o.a.createElement(g.a,{key:l,disabled:!0},o.a.createElement(h.a,{tag:"button"},"...")))},r=1;r<=t.state.jumlahPage;r++)l(r);return t.state.page<t.state.jumlahPage?e.push(o.a.createElement(g.a,{onClick:function(){return t.changePage(t.state.page+1)},key:t.state.jumlahPage+2},o.a.createElement(h.a,{next:!0,tag:"button"},"Next"))):e.push(o.a.createElement(g.a,{disabled:!0,key:t.state.jumlahPage+2},o.a.createElement(h.a,{next:!0,tag:"button"},"Next"))),o.a.createElement(p.a,null,e)},t.dataPilihAwal={id:0,name:"0",ageid:0},t.state={loading:!1,dataAll:[],jumlahPage:1,modalCreate:!1,modalDelete:!1,modalPesan:!1,dataPilih:t.dataPilihAwal,dataTambah:[],dataOpd:[],pencarian:"",page:1,aksi:"Tambah",name:"",age:0,edit:0},document.title="Menyusun Renstra OPD",t.link="opd/menyusun/renstra-opd",t.modalDelete=t.modalDelete.bind(Object(d.a)(Object(d.a)(t))),t.handlePencarianChange=t.handlePencarianChange.bind(Object(d.a)(Object(d.a)(t))),t}return Object(u.a)(a,e),Object(r.a)(a,[{key:"handlePencarianChange",value:function(e){this.setState({pencarian:e.target.value})}},{key:"modalCreateClose",value:function(){arguments.length>0&&void 0!==arguments[0]&&arguments[0];this.setState({modalCreate:!1})}},{key:"modalCreate",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];0===e.length?this.setState({dataPilih:this.dataPilihAwal}):(this.setState({dataPilih:e}),console.log(e))}},{key:"modalDelete",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.setState({modalDelete:!this.state.modalDelete,dataPilih:e})}},{key:"tambah",value:function(){this.setState({dataPilih:this.dataPilihAwal,edit:0,page:this.state.jumlahPage}),this.handleSubmit()}},{key:"edit",value:function(e){0!==this.state.edit&&this.simpan(e),this.getKegiatan(e.Kd_Urusan,e.Kd_Bidang,e.Kd_Prog),this.setState({dataPilih:this.dataPilihAwal,edit:e.perumusan_program_id})}},{key:"simpan",value:function(e){this.setState({edit:0,aksi:"Tambah"}),this.handleSubmit(),console.log(this.state.dataPilih)}},{key:"isi",value:function(){var e=this;return this.state.loading?o.a.createElement("div",null,o.a.createElement("img",{src:O.a,alt:"logo"})):o.a.createElement("div",null,this.state.pesan,o.a.createElement(E.a,null,o.a.createElement(_.a,{xs:"128",md:"10"},o.a.createElement(S.a,{method:"post",onSubmit:this.handleCariSubmit,className:"form-horizontal"},o.a.createElement(k.a,{row:!0},o.a.createElement(_.a,{xs:"9",md:"5"},o.a.createElement(v.a,{type:"text",placeholder:"Pencarian",onChange:this.handlePencarianChange,value:this.state.pencarian})),o.a.createElement(_.a,{xs:"3",md:"2"},o.a.createElement(f.a,{color:"primary"},"Cari"))))),o.a.createElement(_.a,{xs:"12",md:"2"})),o.a.createElement(P.a,{responsive:!0,striped:!0,bordered:!0},o.a.createElement("thead",{style:{textAlign:"center",backgroundColor:"#0066ff",color:"white"}},o.a.createElement("tr",null,o.a.createElement("th",{rowSpan:"3"},"Tujuan"),o.a.createElement("th",{rowSpan:"3"},"Sasaran"),o.a.createElement("th",{rowSpan:"3"},"Indikator"),o.a.createElement("th",{rowSpan:"3"},"Kode"),o.a.createElement("th",{rowSpan:"3"},"Program"),o.a.createElement("th",{rowSpan:"3"},"Kegiatan"),o.a.createElement("th",{rowSpan:"2",colSpan:"2"},"Indikator Kinerka (Outcome)"),o.a.createElement("th",{rowSpan:"3"},"Kondisi Kinerja pada Awal RPJMD (Tahun 0)"),o.a.createElement("th",{colSpan:"17"},"Capaian Kerja"),o.a.createElement("th",{rowSpan:"3"},"Lokasi"),o.a.createElement("th",{rowSpan:"3"},"Penanggung Jawab"),o.a.createElement("th",{rowSpan:"3"},"Aksi")),o.a.createElement("tr",null,o.a.createElement("th",{colSpan:"3"},this.rpjmdTahun),o.a.createElement("th",{colSpan:"3"},this.rpjmdTahun+1),o.a.createElement("th",{colSpan:"3"},this.rpjmdTahun+2),o.a.createElement("th",{colSpan:"3"},this.rpjmdTahun+3),o.a.createElement("th",{colSpan:"3"},this.rpjmdTahun+4),o.a.createElement("th",{colSpan:"2"},"Kondisi Kinerja Akhir Periode")),o.a.createElement("tr",null,o.a.createElement("th",null,"Program"),o.a.createElement("th",null,"Kegiatan"),o.a.createElement("th",{colSpan:"2"},"Target"),o.a.createElement("th",null,"Rp"),o.a.createElement("th",{colSpan:"2"},"Target"),o.a.createElement("th",null,"Rp"),o.a.createElement("th",{colSpan:"2"},"Target"),o.a.createElement("th",null,"Rp"),o.a.createElement("th",{colSpan:"2"},"Target"),o.a.createElement("th",null,"Rp"),o.a.createElement("th",{colSpan:"2"},"Target"),o.a.createElement("th",null,"Rp"),o.a.createElement("th",null,"Target"),o.a.createElement("th",null,"Rp")),o.a.createElement("tr",null,o.a.createElement("th",null,"(1)"),o.a.createElement("th",null,"(2)"),o.a.createElement("th",null,"(3)"),o.a.createElement("th",null,"(4)"),o.a.createElement("th",{colSpan:"2"},"(5)"),o.a.createElement("th",{colSpan:"2"},"(6)"),o.a.createElement("th",null,"(7)"),o.a.createElement("th",{colSpan:"2"},"(8)"),o.a.createElement("th",null,"(9)"),o.a.createElement("th",{colSpan:"2"},"(10)"),o.a.createElement("th",null,"(11)"),o.a.createElement("th",{colSpan:"2"},"(12)"),o.a.createElement("th",null,"(13)"),o.a.createElement("th",{colSpan:"2"},"(14)"),o.a.createElement("th",null,"(15)"),o.a.createElement("th",{colSpan:"2"},"(16)"),o.a.createElement("th",null,"(17)"),o.a.createElement("th",null,"(18)"),o.a.createElement("th",null,"(19)"),o.a.createElement("th",null,"(20)"),o.a.createElement("th",null,"(21)"),o.a.createElement("th",null))),o.a.createElement("tbody",null,this.state.dataAll.map(function(a,t){return a.perumusan_program_id!==e.state.edit?a?o.a.createElement("tr",{key:t},o.a.createElement("td",null,a.tujuan_nama),o.a.createElement("td",null,a.sasaran_nama),o.a.createElement("td",null,a.indikator_nama),o.a.createElement("td",null,a.Kd_Urusan+"."+a.Kd_Bidang+"."+a.Kd_Prog+"."+a.Kd_Keg),o.a.createElement("td",null,a.Ket_Program),o.a.createElement("td",null,a.Ket_Kegiatan),o.a.createElement("td",null,a.outcome),o.a.createElement("td",null,a.outcome_kegiatan),o.a.createElement("td",null,a.kondisi_awal),o.a.createElement("td",null,a.target1_tahun),o.a.createElement("td",null,a.target1_satuan_nama),o.a.createElement("td",null,a.target1_harga),o.a.createElement("td",null,a.target2_tahun),o.a.createElement("td",null,a.target2_satuan_nama),o.a.createElement("td",null,a.target2_harga),o.a.createElement("td",null,a.target3_tahun),o.a.createElement("td",null,a.target3_satuan_nama),o.a.createElement("td",null,a.target3_harga),o.a.createElement("td",null,a.target4_tahun),o.a.createElement("td",null,a.target4_satuan_nama),o.a.createElement("td",null,a.target4_harga),o.a.createElement("td",null,a.target5_tahun),o.a.createElement("td",null,a.target5_satuan_nama),o.a.createElement("td",null,a.target5_harga),o.a.createElement("td",null,a.akhir_target),o.a.createElement("td",null,parseInt(a.target1_harga)+parseInt(a.target2_harga)+parseInt(a.target3_harga)+parseInt(a.target4_harga)+parseInt(a.target5_harga)),o.a.createElement("td",null,a.lokasi),o.a.createElement("td",null,a.Nm_Sub_Unit),o.a.createElement("td",null,o.a.createElement(f.a,{color:"info",onClick:function(){e.setState({aksi:"Edit"}),e.edit(a)},className:"mr-1"},"Edit"))):null:a?o.a.createElement("tr",{key:t},o.a.createElement("td",null,a.tujuan_nama),o.a.createElement("td",null,a.sasaran_nama),o.a.createElement("td",null,a.indikator_nama),o.a.createElement("td",null,a.Kd_Urusan+"."+a.Kd_Bidang+"."+a.Kd_Prog+"."+a.Kd_Keg),o.a.createElement("td",null,a.Ket_Program),o.a.createElement("td",null,o.a.createElement(v.a,{type:"select",value:a.Kd_Keg,"data-number":"1",onChange:e.handleChange(t),required:!0,autoFocus:!0},o.a.createElement("option",{key:"-1",value:""},"-= Pilih Kegiatan =-"),e.state.dataTambah.map(function(e,a){return e?o.a.createElement("option",{key:a,value:e.Kd_Keg},e.Ket_Kegiatan):null}))),o.a.createElement("td",null,a.outcome),o.a.createElement("td",null,o.a.createElement(v.a,{type:"text",value:a.outcome_kegiatan,"data-number":"2",onChange:e.handleChange(t)})),o.a.createElement("td",null,a.kondisi_awal),o.a.createElement("td",null,a.target1_tahun),o.a.createElement("td",null,a.target1_satuan_nama),o.a.createElement("td",null,a.target1_harga),o.a.createElement("td",null,a.target2_tahun),o.a.createElement("td",null,a.target2_satuan_nama),o.a.createElement("td",null,a.target2_harga),o.a.createElement("td",null,a.target3_tahun),o.a.createElement("td",null,a.target3_satuan_nama),o.a.createElement("td",null,a.target3_harga),o.a.createElement("td",null,a.target4_tahun),o.a.createElement("td",null,a.target4_satuan_nama),o.a.createElement("td",null,a.target4_harga),o.a.createElement("td",null,a.target5_tahun),o.a.createElement("td",null,a.target5_satuan_nama),o.a.createElement("td",null,a.target5_harga),o.a.createElement("td",null,a.akhir_target),o.a.createElement("td",null,parseInt(a.target1_harga)+parseInt(a.target2_harga)+parseInt(a.target3_harga)+parseInt(a.target4_harga)+parseInt(a.target5_harga)),o.a.createElement("td",null,a.lokasi),o.a.createElement("td",null,a.Nm_Sub_Unit),o.a.createElement("td",null,o.a.createElement(f.a,{color:"success",onClick:function(){e.simpan(a)},className:"mr-1"},"Simpan"))):null}))),this.pageNation())}},{key:"render",value:function(){return o.a.createElement("div",{className:"animated fadeIn"},o.a.createElement(E.a,null,o.a.createElement(_.a,{xs:"12",lg:"12"},o.a.createElement(b.a,null,o.a.createElement(j.a,null,o.a.createElement("i",{className:"fa fa-align-justify"})," ",document.title),o.a.createElement(K.a,null,o.a.createElement("h5",{style:{textAlign:"center"}},"Matriks Rencana Program, Kegiatan, Indikator Kinerja, Kelompok Sasaran dan Pendanaan Indikatif"),o.a.createElement("table",null,o.a.createElement("tbody",null,o.a.createElement("tr",null,o.a.createElement("td",null,"Urusan"),o.a.createElement("td",null,":"),o.a.createElement("td",null,this.state.dataOpd.Nm_Urusan)),o.a.createElement("tr",null,o.a.createElement("td",null,"Bidang"),o.a.createElement("td",null,":"),o.a.createElement("td",null,this.state.dataOpd.Nm_Bidang)),o.a.createElement("tr",null,o.a.createElement("td",null,"Unit"),o.a.createElement("td",null,":"),o.a.createElement("td",null,this.state.dataOpd.Nm_Unit)),o.a.createElement("tr",null,o.a.createElement("td",null,"Sub"),o.a.createElement("td",null,":"),o.a.createElement("td",null,this.state.dataOpd.Nm_Sub_Unit)))),o.a.createElement("hr",null),o.a.createElement(w.a,{isOpen:this.state.modalDelete,toggle:this.modalDelete,className:this.props.className},o.a.createElement(y.a,{toggle:this.modalDelete},"Hapus Data"),o.a.createElement(C.a,null,"Apakah Anda Yakin Menghapus Data?"),o.a.createElement(D.a,null,o.a.createElement(f.a,{color:"danger",onClick:this.handleDelete},"Ya"),o.a.createElement(f.a,{color:"secondary",onClick:this.modalDelete},"Batal"))),this.isi())))))}}]),a}(i.Component);a.default=N}}]);
//# sourceMappingURL=48.21a7df6c.chunk.js.map