(window.webpackJsonp=window.webpackJsonp||[]).push([[52],{265:function(a,t,e){a.exports=e.p+"static/media/loading.557336d4.gif"},375:function(a,t,e){"use strict";e.r(t);var n=e(272),l=e(104),r=e(105),u=e(107),d=e(106),s=e(108),i=e(109),c=e(1),m=e.n(c),h=e(13),o=e(2),g=e(3),p=e(4),b=e(27),E=e(28),v=e(7),_=e(29),S=e(8),P=e(26),f=e(5),T=e(25),k=e(14),j=e(9),K=e(10),y=e(12),A=e(269),C=e.n(A),O=e(268),D=e(265),x=e.n(D),w=function(a){function t(a){var e;return Object(l.a)(this,t),(e=Object(u.a)(this,Object(d.a)(t).call(this,a))).componentWillMount=function(){e.getData()},e.handleChange=function(a){return function(t){var l=parseInt(t.target.attributes.getNamedItem("data-number").value);if(1===l){var r=e.state.dataAll.map(function(l,r){var u=l;return a!==r?u:(u=Object(n.a)({},l,{Kd_Urusan:t.target.value}),e.setState({dataPilih:u}),u)});e.setState({dataAll:r}),e.getBidang(t.target.value)}if(2===l){var u=e.state.dataAll.map(function(l,r){var u=l;return a!==r?u:(u=Object(n.a)({},l,{Kd_Bidang:t.target.value}),e.setState({dataPilih:u}),u)});e.setState({dataAll:u}),e.getProgram(e.state.dataPilih.Kd_Urusan,t.target.value)}if(3===l){var d=e.state.dataAll.map(function(l,r){var u=l;return a!==r?u:(u=Object(n.a)({},l,{Kd_Prog:t.target.value}),e.setState({dataPilih:u}),u)});e.setState({dataAll:d}),e.getKegiatan(e.state.dataPilih.Kd_Urusan,e.state.dataPilih.Kd_Bidang,t.target.value)}if(4===l){var s=e.state.dataAll.map(function(l,r){var u=l;return a!==r?u:(u=Object(n.a)({},l,{Kd_Keg:t.target.value}),e.setState({dataPilih:u}),u)});e.setState({dataAll:s})}if(5===l){var i=e.state.dataAll.map(function(l,r){var u=l;return a!==r?u:(u=Object(n.a)({},l,{outcome:t.target.value}),e.setState({dataPilih:u}),u)});e.setState({dataAll:i})}if(6===l){var c=e.state.dataAll.map(function(l,r){var u=l;return a!==r?u:(u=Object(n.a)({},l,{outcome_kegiatan:t.target.value}),e.setState({dataPilih:u}),u)});e.setState({dataAll:c})}if(7===l){var m=e.state.dataAll.map(function(l,r){var u=l;return a!==r?u:(1===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target1_lokasi:t.target.value})),2===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target2_lokasi:t.target.value})),3===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target3_lokasi:t.target.value})),4===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target4_lokasi:t.target.value})),5===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target5_lokasi:t.target.value})),e.setState({dataPilih:u}),u)});e.setState({dataAll:m})}if(8===l){var h=e.state.dataAll.map(function(l,r){var u=l;return a!==r?u:(1===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target1_tahun:t.target.value})),2===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target2_tahun:t.target.value})),3===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target3_tahun:t.target.value})),4===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target4_tahun:t.target.value})),5===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target5_tahun:t.target.value})),e.setState({dataPilih:u}),u)});e.setState({dataAll:h})}if(9===l){var o=e.state.dataAll.map(function(l,r){var u=l;return a!==r?u:(1===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target1_satuan:t.target.value})),2===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target2_satuan:t.target.value})),3===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target3_satuan:t.target.value})),4===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target4_satuan:t.target.value})),5===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target5_satuan:t.target.value})),e.setState({dataPilih:u}),u)});e.setState({dataAll:o})}if(10===l){var g=e.state.dataAll.map(function(l,r){var u=l;return a!==r?u:(1===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target1_harga:t.target.value})),2===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target2_harga:t.target.value})),3===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target3_harga:t.target.value})),4===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target4_harga:t.target.value})),5===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target5_harga:t.target.value})),e.setState({dataPilih:u}),u)});e.setState({dataAll:g})}if(11===l){var p=e.state.dataAll.map(function(l,r){var u=l;return a!==r?u:(1===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target1_sumber_dana:t.target.value})),2===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target2_sumber_dana:t.target.value})),3===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target3_sumber_dana:t.target.value})),4===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target4_sumber_dana:t.target.value})),5===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target5_sumber_dana:t.target.value})),e.setState({dataPilih:u}),u)});e.setState({dataAll:p})}if(12===l){var b=e.state.dataAll.map(function(l,r){var u=l;return a!==r?u:(1===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target1_catatan:t.target.value})),2===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target2_catatan:t.target.value})),3===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target3_catatan:t.target.value})),4===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target4_catatan:t.target.value})),5===e.state.dataTambah.tahun&&(u=Object(n.a)({},l,{target5_catatan:t.target.value})),e.setState({dataPilih:u}),u)});e.setState({dataAll:b})}}},e.changePesan=function(){var a=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null,t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"success";null===a?e.setState({pesan:""}):e.setState({pesan:m.a.createElement(h.a,{color:t},a)}),setTimeout(function(){e.setState({pesan:""})},3e3)},e.setData=function(a){a.status&&e.setState({dataAll:a.data,jumlahPage:a.jumlahPage,jumlahAll:a.jumlahAll,dataTambah:a.dataTambah,dataUrusan:a.dataUrusan,dataSatuan:a.dataSatuan}),a.data.length>0?e.rpjmdTahun=parseInt(a.data[0].rpjmd_tahun):e.rpjmdTahun=0,console.log(e.state.dataTambah.tahun)},e.getData=function(){var a=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1;e.setState({loading:!0});var t=new FormData;t.append("session",localStorage.getItem("codexv-session")),t.append("rpjmd",localStorage.getItem("codexv-rpjmd")),t.append("search",e.state.pencarian),C.a.post(O.apiRoot+e.link+"/page-"+a,t).then(function(a){e.setData(a.data),console.log(a),e.setState({loading:!1})}).catch(function(a){console.log(a),e.setState({loading:!1}),e.changePesan("Tidak dapat terhubung pada server!","danger")})},e.getBidang=function(a){e.setState({loading:!0});var t=new FormData;t.append("session",localStorage.getItem("codexv-session")),t.append("urusan",a),C.a.post(O.apiRoot+"rpjmd/get-data/bidang",t).then(function(a){a.data.status&&e.setState({dataBidang:a.data.data}),e.setState({loading:!1})}).catch(function(a){console.log(a),e.setState({loading:!1})})},e.getProgram=function(a,t){e.setState({loading:!0});var n=new FormData;n.append("session",localStorage.getItem("codexv-session")),n.append("urusan",a),n.append("bidang",t),C.a.post(O.apiRoot+"rpjmd/get-data/program",n).then(function(a){a.data.status&&e.setState({dataProgram:a.data.data}),e.setState({loading:!1})}).catch(function(a){console.log(a),e.setState({loading:!1})})},e.getKegiatan=function(a,t,n){e.setState({loading:!0});var l=new FormData;l.append("session",localStorage.getItem("codexv-session")),l.append("urusan",a),l.append("bidang",t),l.append("program",n),C.a.post(O.apiRoot+"opd/get-data/kegiatan",l).then(function(a){a.data.status&&e.setState({dataKegiatan:a.data.data}),e.setState({loading:!1}),console.log(a)}).catch(function(a){console.log(a),e.setState({loading:!1})})},e.handleSubmit=function(){e.setState({loading:!0});var a="";"Edit"===e.state.aksi?a=O.apiRoot+e.link+"/update":"Tambah"===e.state.aksi&&(a=O.apiRoot+e.link+"/create");var t=new FormData;t.append("session",localStorage.getItem("codexv-session")),t.append("rpjmd",localStorage.getItem("codexv-rpjmd")),t.append("perumusan_program_id",e.state.dataPilih.perumusan_program_id),t.append("Kd_Urusan",e.state.dataPilih.Kd_Urusan),t.append("Kd_Bidang",e.state.dataPilih.Kd_Bidang),t.append("Kd_Prog",e.state.dataPilih.Kd_Prog),t.append("Kd_Keg",e.state.dataPilih.Kd_Keg),t.append("outcome",e.state.dataPilih.outcome),t.append("outcome_kegiatan",e.state.dataPilih.outcome_kegiatan),t.append("target"+e.state.dataTambah.tahun+"_lokasi",e.state.dataPilih["target"+e.state.dataTambah.tahun+"_lokasi"]),t.append("target"+e.state.dataTambah.tahun+"_tahun",e.state.dataPilih["target"+e.state.dataTambah.tahun+"_tahun"]),t.append("target"+e.state.dataTambah.tahun+"_satuan",e.state.dataPilih["target"+e.state.dataTambah.tahun+"_satuan"]),t.append("target"+e.state.dataTambah.tahun+"_harga",e.state.dataPilih["target"+e.state.dataTambah.tahun+"_harga"]),t.append("target"+e.state.dataTambah.tahun+"_sumber_dana",e.state.dataPilih["target"+e.state.dataTambah.tahun+"_sumber_dana"]),t.append("target"+e.state.dataTambah.tahun+"_catatan",e.state.dataPilih["target"+e.state.dataTambah.tahun+"_catatan"]),t.append("tahun",e.state.dataTambah.tahun),C.a.post(a,t,{headers:{"Content-Type":"multipart/form-data"}}).then(function(a){a.data.status?(e.modalCreateClose(),e.getData(e.state.page),e.changePesan(a.data.pesan)):e.changePesan(a.data.pesan,"warning"),e.setState({loading:!1}),console.log(a.data)}).catch(function(a){console.log(a),e.setState({loading:!1}),e.changePesan("Tidak dapat terhubung pada server!","danger")})},e.handleDelete=function(){e.setState({loading:!0});var a=new FormData;a.append("session",localStorage.getItem("codexv-session")),a.append("rpjmd",localStorage.getItem("codexv-rpjmd")),a.append("perumusan_program_id",e.state.dataPilih.perumusan_program_id),C.a.post(O.apiRoot+e.link+"/delete",a).then(function(a){a.data.status?(e.modalDelete(),e.getData(e.state.page),e.changePesan(a.data.pesan)):e.changePesan(a.data.pesan,"warning"),e.setState({loading:!1}),console.log(a)}).catch(function(a){console.log(a),e.setState({loading:!1}),e.changePesan("Tidak dapat terhubung pada server!","danger")})},e.handleCariSubmit=function(a){a.preventDefault(),e.getData()},e.changePage=function(a){e.setState({page:a}),e.getData(a)},e.pageNation=function(){var a=[];e.state.page>1?a.push(m.a.createElement(o.a,{onClick:function(){return e.changePage(e.state.page-1)},key:0},m.a.createElement(g.a,{previous:!0,tag:"button"},"Prev"))):a.push(m.a.createElement(o.a,{disabled:!0,key:0},m.a.createElement(g.a,{previous:!0,tag:"button"},"Prev")));for(var t=!1,n=!1,l=function(l){n=t,t=!1,l+2>=e.state.page&&l-2<=e.state.page&&(t=!0),1!==l&&l!==e.state.jumlahPage||(t=!0),t?l===e.state.page?a.push(m.a.createElement(o.a,{active:!0,key:l},m.a.createElement(g.a,{tag:"button"},l))):a.push(m.a.createElement(o.a,{key:l,onClick:function(){return e.changePage(l)}},m.a.createElement(g.a,{tag:"button"},l))):n!==t&&a.push(m.a.createElement(o.a,{key:l,disabled:!0},m.a.createElement(g.a,{tag:"button"},"...")))},r=1;r<=e.state.jumlahPage;r++)l(r);return e.state.page<e.state.jumlahPage?a.push(m.a.createElement(o.a,{onClick:function(){return e.changePage(e.state.page+1)},key:e.state.jumlahPage+2},m.a.createElement(g.a,{next:!0,tag:"button"},"Next"))):a.push(m.a.createElement(o.a,{disabled:!0,key:e.state.jumlahPage+2},m.a.createElement(g.a,{next:!0,tag:"button"},"Next"))),m.a.createElement(p.a,null,a)},e.dataPilihAwal={id:0,name:"0",ageid:0},e.state={loading:!1,dataAll:[],jumlahPage:1,modalCreate:!1,modalDelete:!1,modalPesan:!1,dataPilih:e.dataPilihAwal,dataTambah:[],dataUrusan:[],dataBidang:[],dataProgram:[],dataKegiatan:[],dataSatuan:[],pencarian:"",page:1,aksi:"Tambah",name:"",age:0,edit:0},document.title="Menyusun RKPD Verifikasi",e.link="opd/menyusun/rkpd-verifikasi",e.modalDelete=e.modalDelete.bind(Object(i.a)(Object(i.a)(e))),e.handlePencarianChange=e.handlePencarianChange.bind(Object(i.a)(Object(i.a)(e))),e}return Object(s.a)(t,a),Object(r.a)(t,[{key:"handlePencarianChange",value:function(a){this.setState({pencarian:a.target.value})}},{key:"modalCreateClose",value:function(){arguments.length>0&&void 0!==arguments[0]&&arguments[0];this.setState({modalCreate:!1})}},{key:"modalCreate",value:function(){var a=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];0===a.length?this.setState({dataPilih:this.dataPilihAwal}):(this.setState({dataPilih:a}),console.log(a))}},{key:"modalDelete",value:function(){var a=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.setState({modalDelete:!this.state.modalDelete,dataPilih:a})}},{key:"tambah",value:function(){this.setState({dataPilih:this.dataPilihAwal,edit:0,page:this.state.jumlahPage}),this.handleSubmit()}},{key:"edit",value:function(a){0!==this.state.edit&&this.simpan(a),this.setState({dataPilih:this.dataPilihAwal,edit:a.idAll})}},{key:"simpan",value:function(a){this.setState({edit:0,aksi:"Tambah"}),this.handleSubmit(),console.log(this.state.dataPilih)}},{key:"isi",value:function(){var a=this;return this.state.loading?m.a.createElement("div",null,m.a.createElement("img",{src:x.a,alt:"logo"})):m.a.createElement("div",null,this.state.pesan,m.a.createElement(b.a,null,m.a.createElement(E.a,{xs:"128",md:"10"}),m.a.createElement(E.a,{xs:"12",md:"2"})),m.a.createElement(v.a,{responsive:!0,striped:!0,bordered:!0},m.a.createElement("thead",{style:{textAlign:"center",backgroundColor:"#0066ff",color:"white"}},m.a.createElement("tr",null,m.a.createElement("th",{rowSpan:"2",colSpan:"4"},"Kode"),m.a.createElement("th",{rowSpan:"2",colSpan:"4"},"Urusan / Bidang / Program / Kegiatan"),m.a.createElement("th",{colSpan:"2"},"Indikator Kinerka (Outcome)"),m.a.createElement("th",{colSpan:"5"},"Tahun ",this.rpjmdTahun+parseInt(this.state.dataTambah.tahun)-1," (Tahun Berjalan)"),m.a.createElement("th",{rowSpan:"2"},"Catatan Penting"),m.a.createElement("th",{colSpan:"3"},"Tahun ",this.rpjmdTahun+parseInt(this.state.dataTambah.tahun)," (Tahun Berikutnya)"),m.a.createElement("th",{rowSpan:"2"},"Aksi")),m.a.createElement("tr",null,m.a.createElement("th",null,"Program"),m.a.createElement("th",null,"Kegiatan"),m.a.createElement("th",null,"Lokasi"),m.a.createElement("th",{colSpan:"2"},"Target capaian kinerja"),m.a.createElement("th",null,"Kebutuhan Dana/ pagu indikatif (Rp)"),m.a.createElement("th",null,"Sumber Dana"),m.a.createElement("th",{colSpan:"2"},"Target capaian kinerja"),m.a.createElement("th",null,"Kebutuhan Dana/ pagu indikatif (Rp)")),m.a.createElement("tr",null,m.a.createElement("th",{colSpan:"4"},"(1)"),m.a.createElement("th",{colSpan:"4"},"(2)"),m.a.createElement("th",{colSpan:"2"},"(3)"),m.a.createElement("th",null,"(4)"),m.a.createElement("th",{colSpan:"2"},"(5)"),m.a.createElement("th",null,"(6)"),m.a.createElement("th",null,"(7)"),m.a.createElement("th",null,"(8)"),m.a.createElement("th",{colSpan:"2"},"(9)"),m.a.createElement("th",null,"(10)"),m.a.createElement("th",null,"(11)"))),m.a.createElement("tbody",null,this.state.dataAll.map(function(t,e){return t.idAll!==a.state.edit?0===t.Kd_Keg?t?m.a.createElement("tr",{key:e},m.a.createElement("td",null,t.Kd_Urusan),m.a.createElement("td",null,t.Kd_Bidang),m.a.createElement("td",null,t.Kd_Prog),m.a.createElement("td",null,t.Kd_Keg),m.a.createElement("td",null,t.Nm_Urusan),m.a.createElement("td",null,t.Nm_Bidang),m.a.createElement("td",null,t.Ket_Program),m.a.createElement("td",null,t.Ket_Kegiatan),m.a.createElement("td",null),m.a.createElement("td",null),m.a.createElement("td",null),m.a.createElement("td",null),m.a.createElement("td",null),m.a.createElement("td",null),m.a.createElement("td",null),m.a.createElement("td",null),m.a.createElement("td",null),m.a.createElement("td",null),m.a.createElement("td",null),m.a.createElement("td",null)):null:t?m.a.createElement("tr",{key:e},m.a.createElement("td",null,t.Kd_Urusan),m.a.createElement("td",null,t.Kd_Bidang),m.a.createElement("td",null,t.Kd_Prog),m.a.createElement("td",null,t.Kd_Keg),m.a.createElement("td",null,t.Nm_Urusan),m.a.createElement("td",null,t.Nm_Bidang),m.a.createElement("td",null,t.Ket_Program),m.a.createElement("td",null,t.Ket_Kegiatan),m.a.createElement("td",null,t.outcome),m.a.createElement("td",null,t.outcome_kegiatan),m.a.createElement("td",null,t["target"+a.state.dataTambah.tahun+"_lokasi"]),m.a.createElement("td",null,t["target"+a.state.dataTambah.tahun+"_tahun"]),m.a.createElement("td",null,t["target"+a.state.dataTambah.tahun+"_satuan_nama"]),m.a.createElement("td",null,t["target"+a.state.dataTambah.tahun+"_harga"]),m.a.createElement("td",null,t["target"+a.state.dataTambah.tahun+"_sumber_dana"]),m.a.createElement("td",null,t["target"+a.state.dataTambah.tahun+"_catatan"]),m.a.createElement("td",null,t["target"+(parseInt(a.state.dataTambah.tahun)+1)+"_tahun"]),m.a.createElement("td",null,t["target"+(parseInt(a.state.dataTambah.tahun)+1)+"_satuan_nama"]),m.a.createElement("td",null,t["target"+(parseInt(a.state.dataTambah.tahun)+1)+"_harga"]),m.a.createElement("td",null,m.a.createElement(_.a,{color:"info",onClick:function(){a.setState({aksi:"Edit"}),a.edit(t)},className:"mr-1"},"Edit"))):null:t?m.a.createElement("tr",{key:e},m.a.createElement("td",null,t.Kd_Urusan),m.a.createElement("td",null,t.Kd_Bidang),m.a.createElement("td",null,t.Kd_Prog),m.a.createElement("td",null,t.Kd_Keg),m.a.createElement("td",null,m.a.createElement(S.a,{type:"select",value:t.Kd_Urusan,"data-number":"1",onChange:a.handleChange(e),required:!0,autoFocus:!0},m.a.createElement("option",{key:"-1",value:""},"-= Pilih Urusan =-"),a.state.dataUrusan.map(function(a,t){return a?m.a.createElement("option",{key:t,value:a.Kd_Urusan},a.Nm_Urusan):null}))),m.a.createElement("td",null,m.a.createElement(S.a,{type:"select",value:t.Kd_Bidang,"data-number":"2",onChange:a.handleChange(e),required:!0,autoFocus:!0},m.a.createElement("option",{key:"-1",value:""},"-= Pilih Bidang =-"),a.state.dataBidang.map(function(a,t){return a?m.a.createElement("option",{key:t,value:a.Kd_Bidang},a.Nm_Bidang):null}))),m.a.createElement("td",null,m.a.createElement(S.a,{type:"select",value:t.Kd_Prog,"data-number":"3",onChange:a.handleChange(e),required:!0,autoFocus:!0},m.a.createElement("option",{key:"-1",value:""},"-= Pilih Program =-"),a.state.dataProgram.map(function(a,t){return a?m.a.createElement("option",{key:t,value:a.Kd_Prog},a.Ket_Program):null}))),m.a.createElement("td",null,m.a.createElement(S.a,{type:"select",value:t.Kd_Keg,"data-number":"4",onChange:a.handleChange(e),required:!0,autoFocus:!0},m.a.createElement("option",{key:"-1",value:""},"-= Pilih Kegiatan =-"),a.state.dataKegiatan.map(function(a,t){return a?m.a.createElement("option",{key:t,value:a.Kd_Keg},a.Ket_Kegiatan):null}))),m.a.createElement("td",null,m.a.createElement(S.a,{type:"text",value:t.outcome,"data-number":"5",onChange:a.handleChange(e)})),m.a.createElement("td",null,m.a.createElement(S.a,{type:"text",value:t.outcome_kegiatan,"data-number":"6",onChange:a.handleChange(e)})),m.a.createElement("td",null,m.a.createElement(S.a,{type:"text",value:t["target"+a.state.dataTambah.tahun+"_lokasi"],"data-number":"7",onChange:a.handleChange(e)})),m.a.createElement("td",null,m.a.createElement(S.a,{type:"text",value:t["target"+a.state.dataTambah.tahun+"_tahun"],"data-number":"8",onChange:a.handleChange(e)})),m.a.createElement("td",null,m.a.createElement(S.a,{type:"select",value:t["target"+a.state.dataTambah.tahun+"_satuan"],"data-number":"9",onChange:a.handleChange(e),required:!0,autoFocus:!0},m.a.createElement("option",{key:"-1",value:""},"-= Pilih Satuan =-"),a.state.dataSatuan.map(function(a,t){return a?m.a.createElement("option",{key:t,value:a.Kd_Satuan},a.Uraian):null}))),m.a.createElement("td",null,m.a.createElement(S.a,{type:"text",value:t["target"+a.state.dataTambah.tahun+"_harga"],"data-number":"10",onChange:a.handleChange(e)})),m.a.createElement("td",null,m.a.createElement(S.a,{type:"text",value:t["target"+a.state.dataTambah.tahun+"_sumber_dana"],"data-number":"11",onChange:a.handleChange(e)})),m.a.createElement("td",null,m.a.createElement(S.a,{type:"text",value:t["target"+a.state.dataTambah.tahun+"_catatan"],"data-number":"12",onChange:a.handleChange(e)})),m.a.createElement("td",null,t["target"+(parseInt(a.state.dataTambah.tahun)+1)+"_tahun"]),m.a.createElement("td",null,t["target"+(parseInt(a.state.dataTambah.tahun)+1)+"_satuan_nama"]),m.a.createElement("td",null,t["target"+(parseInt(a.state.dataTambah.tahun)+1)+"_harga"]),m.a.createElement("td",null,m.a.createElement(_.a,{color:"success",onClick:function(){a.simpan(t)},className:"mr-1"},"Simpan"))):null}))),this.pageNation())}},{key:"render",value:function(){return m.a.createElement("div",{className:"animated fadeIn"},m.a.createElement(b.a,null,m.a.createElement(E.a,{xs:"12",lg:"12"},m.a.createElement(P.a,null,m.a.createElement(f.a,null,m.a.createElement("i",{className:"fa fa-align-justify"})," ",document.title),m.a.createElement(T.a,null,m.a.createElement("h5",{style:{textAlign:"center"}},"RENCANA KERJA PEMERINTAH DAERAH TAHUN ",this.rpjmdTahun+parseInt(this.state.dataTambah.tahun)-1," ( Tahun Berjalan)"),m.a.createElement("hr",null),m.a.createElement(k.a,{isOpen:this.state.modalDelete,toggle:this.modalDelete,className:this.props.className},m.a.createElement(j.a,{toggle:this.modalDelete},"Hapus Data"),m.a.createElement(K.a,null,"Apakah Anda Yakin Menghapus Data?"),m.a.createElement(y.a,null,m.a.createElement(_.a,{color:"danger",onClick:this.handleDelete},"Ya"),m.a.createElement(_.a,{color:"secondary",onClick:this.modalDelete},"Batal"))),this.isi())))))}}]),t}(c.Component);t.default=w}}]);
//# sourceMappingURL=52.07b34841.chunk.js.map