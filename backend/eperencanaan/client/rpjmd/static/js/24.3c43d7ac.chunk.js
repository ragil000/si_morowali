(window.webpackJsonp=window.webpackJsonp||[]).push([[24],{2:function(e,a,t){"use strict";var n=t(262),l=t(263),i=t(1),r=t.n(i),s=t(0),c=t.n(s),o=t(261),m=t.n(o),d=t(260),u={active:c.a.bool,children:c.a.node,className:c.a.string,cssModule:c.a.object,disabled:c.a.bool,tag:d.m},h=function(e){var a=e.active,t=e.className,i=e.cssModule,s=e.disabled,c=e.tag,o=Object(l.a)(e,["active","className","cssModule","disabled","tag"]),u=Object(d.i)(m()(t,"page-item",{active:a,disabled:s}),i);return r.a.createElement(c,Object(n.a)({},o,{className:u}))};h.propTypes=u,h.defaultProps={tag:"li"},a.a=h},3:function(e,a,t){"use strict";var n=t(262),l=t(263),i=t(1),r=t.n(i),s=t(0),c=t.n(s),o=t(261),m=t.n(o),d=t(260),u={"aria-label":c.a.string,children:c.a.node,className:c.a.string,cssModule:c.a.object,next:c.a.bool,previous:c.a.bool,tag:d.m},h=function(e){var a,t=e.className,i=e.cssModule,s=e.next,c=e.previous,o=e.tag,u=Object(l.a)(e,["className","cssModule","next","previous","tag"]),h=Object(d.i)(m()(t,"page-link"),i);c?a="Previous":s&&(a="Next");var p,g=e["aria-label"]||a;c?p="\xab":s&&(p="\xbb");var E=e.children;return E&&Array.isArray(E)&&0===E.length&&(E=null),u.href||"a"!==o||(o="button"),(c||s)&&(E=[r.a.createElement("span",{"aria-hidden":"true",key:"caret"},E||p),r.a.createElement("span",{className:"sr-only",key:"sr"},g)]),r.a.createElement(o,Object(n.a)({},u,{className:h,"aria-label":g}),E)};h.propTypes=u,h.defaultProps={tag:"a"},a.a=h},350:function(e,a,t){"use strict";t.r(a);var n=t(104),l=t(105),i=t(107),r=t(106),s=t(108),c=t(109),o=t(1),m=t.n(o),d=t(13),u=t(11),h=t(28),p=t(47),g=t(8),E=t(349),v=t(2),b=t(3),P=t(4),f=t(27),k=t(26),C=t(5),j=t(25),D=t(14),O=t(9),w=t(17),y=t(10),N=t(12),x=t(29),S=t(7),K=t(269),F=t.n(K),_=t(268),L=function(e){function a(e){var t;return Object(n.a)(this,a),(t=Object(i.a)(this,Object(r.a)(a).call(this,e))).handleDelete=function(){var e=new FormData;e.append("session",localStorage.getItem("codexv-session")),e.append("id",t.state.dataPilih.id),F.a.post(_.apiRoot+"akun/delete",e).then(function(e){e.data.status&&(t.toggleDelete(),t.getData()),t.changePesan(e.data.pesan)}).catch(function(e){console.log(e)})},t.changePesan=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null,a=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"success";null===e?t.setState({pesan:""}):t.setState({pesan:m.a.createElement(d.a,{color:a},e)}),setTimeout(function(){t.setState({pesan:""})},3e3)},t.handleUsernameChange=function(e){var a=t.state.dataPilih;a.username=e.target.value,t.setState({dataPilih:a})},t.handleEmailChange=function(e){var a=t.state.dataPilih;a.no_hp_ktp=e.target.value,t.setState({dataPilih:a})},t.handleKecamatanChange=function(e){var a=t.state.dataPilih;a.kecamatan=e.target.value,t.setState({dataPilih:a}),t.getKelurahan()},t.handleKelurahanChange=function(e){var a=t.state.dataPilih;a.kelurahan=e.target.value,t.setState({dataPilih:a}),t.formGroupLevel()},t.handleLevelChange=function(e){var a=t.state.dataPilih;a.level_id=e.target.value,t.setState({dataPilih:a}),t.formGroupLevel()},t.handleDewanChange=function(e){var a=t.state.dataPilih;a.dewan=e.target.value,t.setState({dataPilih:a}),t.formGroupLevel()},t.handleDapilChange=function(e){var a=t.state.dataPilih;a.dapil=e.target.value,t.setState({dataPilih:a}),t.formGroupLevel()},t.formGroupLevel=function(){var e=m.a.createElement("div",null,m.a.createElement(u.a,{row:!0},m.a.createElement(h.a,{md:"3"},m.a.createElement(p.a,{htmlFor:"text-input"},"Pilih Kecamatan *")),m.a.createElement(h.a,{xs:"12",md:"9"},m.a.createElement(g.a,{type:"select",id:"kecamatan",placeholder:"",onChange:t.handleKecamatanChange,value:t.state.dataPilih.kecamatan,required:!0,autoFocus:!0},m.a.createElement("option",{key:-1,value:""},"-= Pilih Kecamatan =-"),t.state.kecamatan.map(function(e,a){return e?m.a.createElement("option",{key:a,value:e.Kd_Kec},e.Nm_Kec):null})),m.a.createElement(E.a,{color:"muted"},"Isi Kecamatan"))),m.a.createElement(u.a,{row:!0},m.a.createElement(h.a,{md:"3"},m.a.createElement(p.a,{htmlFor:"text-input"},"Pilih Kelurahan *")),m.a.createElement(h.a,{xs:"12",md:"9"},m.a.createElement(g.a,{type:"select",id:"kelurahan",placeholder:"",onChange:t.handleKelurahanChange,value:t.state.dataPilih.kelurahan,required:!0,autoFocus:!0},m.a.createElement("option",{value:""},"-= Pilih Kelurahan =-"),t.state.kelurahan.map(function(e,a){return e?m.a.createElement("option",{key:a,value:e.Kd_Kel+"-"+e.Kd_Urut},e.Nm_Kel):null})),m.a.createElement(E.a,{color:"muted"},"Isi Kecamatan")))),a=m.a.createElement(u.a,{row:!0},m.a.createElement(h.a,{md:"3"},m.a.createElement(p.a,{htmlFor:"text-input"},"Pilih Kecamatan *")),m.a.createElement(h.a,{xs:"12",md:"9"},m.a.createElement(g.a,{type:"select",id:"kecamatan",placeholder:"",onChange:t.handleKecamatanChange,value:t.state.dataPilih.kecamatan,required:!0,autoFocus:!0},m.a.createElement("option",{key:-1,value:""},"-= Pilih Kecamatan =-"),t.state.kecamatan.map(function(e,a){return e?m.a.createElement("option",{key:a,value:e.Kd_Kec},e.Nm_Kec):null})),m.a.createElement(E.a,{color:"muted"},"Isi Kecamatan"))),n=m.a.createElement("div",null,m.a.createElement(u.a,{row:!0},m.a.createElement(h.a,{md:"3"},m.a.createElement(p.a,{htmlFor:"text-input"},"Nama Dewan *")),m.a.createElement(h.a,{xs:"12",md:"9"},m.a.createElement(g.a,{type:"text",id:"dewan",placeholder:"",onChange:t.handleDewanChange,value:t.state.dataPilih.dewan,required:!0,autoFocus:!0}),m.a.createElement(E.a,{color:"muted"},"Isi Dewan"))),m.a.createElement(u.a,{row:!0},m.a.createElement(h.a,{md:"3"},m.a.createElement(p.a,{htmlFor:"text-input"},"Pilih Dapil *")),m.a.createElement(h.a,{xs:"12",md:"9"},m.a.createElement(g.a,{type:"select",id:"dapil",placeholder:"",onChange:t.handleDapilChange,value:t.state.dataPilih.dapil,required:!0,autoFocus:!0},m.a.createElement("option",{key:-1,value:""},"-= Pilih Kecamatan =-"),t.state.dapil.map(function(e,a){return e?m.a.createElement("option",{key:a,value:e.Kd_Dapil},e.Nm_Dapil):null})),m.a.createElement(E.a,{color:"muted"},"Isi Kecamatan"))));1===parseInt(t.state.dataPilih.level_id)?t.setState({formGroupLevel:e}):2===parseInt(t.state.dataPilih.level_id)?t.setState({formGroupLevel:a}):3===parseInt(t.state.dataPilih.level_id)?t.setState({formGroupLevel:n}):t.setState({formGroupLevel:""})},t.handlePasswordChange=function(e){var a=t.state.dataPilih;a.password=e.target.value,t.setState({dataPilih:a})},t.handlePencarianChange=function(e){t.setState({pencarian:e.target.value})},t.handleCariSubmit=function(e){e.preventDefault(),t.getData()},t.handleSubmit=function(e){e.preventDefault();var a="";"Edit"===t.state.aksi?a=_.apiRoot+"akun/update":"Tambah"===t.state.aksi&&(a=_.apiRoot+"akun/create");var n=new FormData;n.append("session",localStorage.getItem("codexv-session")),n.append("username",t.state.dataPilih.username),n.append("email",t.state.dataPilih.no_hp_ktp),n.append("level",t.state.dataPilih.level_id),n.append("password",t.state.dataPilih.password),n.append("kecamatan",t.state.dataPilih.kecamatan),n.append("kelurahan",t.state.dataPilih.kelurahan),n.append("dapil",t.state.dataPilih.dapil),n.append("dewan",t.state.dataPilih.dewan),n.append("id",t.state.dataPilih.id),F.a.post(a,n,{headers:{"Content-Type":"multipart/form-data"}}).then(function(e){e.data.status&&(t.toggleClose(),t.getData()),t.changePesan(e.data.pesan)}).catch(function(e){t.changePesan("Gagal melakukan aksi")})},t.componentWillMount=function(){t.getData(),t.getKecamatan(),t.getDapil()},t.setData=function(e){e.status&&t.setState({dataAll:e.data,jumlahPage:e.jumlahPage})},t.getData=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1,a=new FormData;a.append("session",localStorage.getItem("codexv-session")),a.append("search",t.state.pencarian),F.a.post(_.apiRoot+"akun/page-"+e,a).then(function(e){t.setData(e.data)}).catch(function(e){console.log(e)})},t.getKecamatan=function(){var e=new FormData;e.append("session",localStorage.getItem("codexv-session")),F.a.post(_.apiRoot+"getData/kecamatan",e).then(function(e){e.data.status&&t.setState({kecamatan:e.data.data})}).catch(function(e){console.log(e)})},t.getKelurahan=function(){var e=new FormData;e.append("session",localStorage.getItem("codexv-session")),e.append("kecamatan",t.state.dataPilih.kecamatan),F.a.post(_.apiRoot+"getData/kelurahan",e).then(function(e){e.data.status&&(t.setState({kelurahan:e.data.data}),t.formGroupLevel())}).catch(function(e){console.log(e)})},t.getDapil=function(){var e=new FormData;e.append("session",localStorage.getItem("codexv-session")),F.a.post(_.apiRoot+"getData/dapil",e).then(function(e){e.data.status&&(t.setState({dapil:e.data.data}),t.formGroupLevel())}).catch(function(e){console.log(e)})},t.changePage=function(e){t.setState({page:e}),t.getData(e)},t.pageNation=function(){var e=[];t.state.page>1?e.push(m.a.createElement(v.a,{onClick:function(){return t.changePage(t.state.page-1)},key:0},m.a.createElement(b.a,{previous:!0,tag:"button"},"Prev"))):e.push(m.a.createElement(v.a,{disabled:!0,key:0},m.a.createElement(b.a,{previous:!0,tag:"button"},"Prev")));for(var a=!1,n=!1,l=function(l){n=a,a=!1,l+2>=t.state.page&&l-2<=t.state.page&&(a=!0),1!==l&&l!==t.state.jumlahPage||(a=!0),a?l===t.state.page?e.push(m.a.createElement(v.a,{active:!0,key:l},m.a.createElement(b.a,{tag:"button"},l))):e.push(m.a.createElement(v.a,{key:l,onClick:function(){return t.changePage(l)}},m.a.createElement(b.a,{tag:"button"},l))):n!==a&&e.push(m.a.createElement(v.a,{key:l,disabled:!0},m.a.createElement(b.a,{tag:"button"},"...")))},i=1;i<=t.state.jumlahPage;i++)l(i);return t.state.page<t.state.jumlahPage?e.push(m.a.createElement(v.a,{onClick:function(){return t.changePage(t.state.page+1)},key:t.state.jumlahPage+2},m.a.createElement(b.a,{next:!0,tag:"button"},"Next"))):e.push(m.a.createElement(v.a,{disabled:!0,key:t.state.jumlahPage+2},m.a.createElement(b.a,{next:!0,tag:"button"},"Next"))),m.a.createElement(P.a,null,e)},t.dataPilihAwal={id:0,no_hp_ktp:"",username:"",level_id:0,password:"",aktif:0,kecamatan:"",kelurahan:"",dewan:"",dapil:"",admin:0},t.state={dataAll:[],jumlahPage:1,modal:!1,modalDelete:!1,dataPilih:t.dataPilihAwal,pencarian:"",page:1,aksi:"Tambah",fileForm:[],pesan:"",formGroupLevel:[],kecamatan:[],kelurahan:[],dapil:[]},t.toggleClose=t.toggleClose.bind(Object(c.a)(Object(c.a)(t))),t.toggle=t.toggle.bind(Object(c.a)(Object(c.a)(t))),t.toggleDelete=t.toggleDelete.bind(Object(c.a)(Object(c.a)(t))),t.changePesan=t.changePesan.bind(Object(c.a)(Object(c.a)(t))),t.setData=t.setData.bind(Object(c.a)(Object(c.a)(t))),t.getData=t.getData.bind(Object(c.a)(Object(c.a)(t))),t.handleDelete=t.handleDelete.bind(Object(c.a)(Object(c.a)(t))),t.handleKecamatanChange=t.handleKecamatanChange.bind(Object(c.a)(Object(c.a)(t))),t.handleKelurahanChange=t.handleKelurahanChange.bind(Object(c.a)(Object(c.a)(t))),t.handlePencarianChange=t.handlePencarianChange.bind(Object(c.a)(Object(c.a)(t))),t.handleUsernameChange=t.handleUsernameChange.bind(Object(c.a)(Object(c.a)(t))),t.handleEmailChange=t.handleEmailChange.bind(Object(c.a)(Object(c.a)(t))),t.handleLevelChange=t.handleLevelChange.bind(Object(c.a)(Object(c.a)(t))),t.handlePasswordChange=t.handlePasswordChange.bind(Object(c.a)(Object(c.a)(t))),t}return Object(s.a)(a,e),Object(l.a)(a,[{key:"toggleClose",value:function(){arguments.length>0&&void 0!==arguments[0]&&arguments[0];this.setState({modal:!1})}},{key:"toggle",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];0===e.length?this.setState({modal:!0,dataPilih:this.dataPilihAwal}):this.setState({modal:!0,dataPilih:e})}},{key:"toggleDelete",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.setState({modalDelete:!this.state.modalDelete,dataPilih:e})}},{key:"render",value:function(){var e=this;return m.a.createElement("div",{className:"animated fadeIn"},m.a.createElement(f.a,null,m.a.createElement(h.a,{xs:"12",lg:"12"},m.a.createElement(k.a,null,m.a.createElement(C.a,null,m.a.createElement("i",{className:"fa fa-align-justify"})," Striped Table"),m.a.createElement(j.a,null,this.state.pesan,m.a.createElement(D.a,{isOpen:this.state.modal,toggle:this.toggleClose,className:"modal-lg "+this.props.className},m.a.createElement(O.a,{toggle:this.toggleClose},this.state.aksi," Data"),m.a.createElement(w.a,{method:"post",onSubmit:this.handleSubmit,className:"form-horizontal",id:"form-data"},m.a.createElement(y.a,null,m.a.createElement(u.a,{row:!0},m.a.createElement(h.a,{md:"3"},m.a.createElement(p.a,{htmlFor:"text-input"},"Username *")),m.a.createElement(h.a,{xs:"12",md:"9"},m.a.createElement(g.a,{type:"text",id:"username",placeholder:"",onChange:this.handleUsernameChange,value:this.state.dataPilih.username,required:!0,autoFocus:!0}),m.a.createElement(E.a,{color:"muted"},"Isi Username"))),m.a.createElement(u.a,{row:!0},m.a.createElement(h.a,{md:"3"},m.a.createElement(p.a,{htmlFor:"text-input"},"Nomor Hp / KTP *")),m.a.createElement(h.a,{xs:"12",md:"9"},m.a.createElement(g.a,{type:"number",id:"email",placeholder:"",onChange:this.handleEmailChange,value:this.state.dataPilih.no_hp_ktp,required:!0,autoFocus:!0}),m.a.createElement(E.a,{color:"muted"},"Isi Nomor Hp / KTP"))),m.a.createElement(u.a,{row:!0},m.a.createElement(h.a,{md:"3"},m.a.createElement(p.a,{htmlFor:"text-input"},"Level *")),m.a.createElement(h.a,{xs:"12",md:"9"},m.a.createElement(g.a,{type:"select",id:"level",placeholder:"",onChange:this.handleLevelChange,value:this.state.dataPilih.level_id,required:!0,autoFocus:!0},m.a.createElement("option",{value:""},"Pilih Level"),m.a.createElement("option",{value:"1"},"Kelurahan"),m.a.createElement("option",{value:"2"},"Kecamatan"),m.a.createElement("option",{value:"3"},"Pokir"),m.a.createElement("option",{value:"5"},"Admin")),m.a.createElement(E.a,{color:"muted"},"Isi Level"))),this.state.formGroupLevel,m.a.createElement(u.a,{row:!0},m.a.createElement(h.a,{md:"3"},m.a.createElement(p.a,{htmlFor:"text-input"},"Password *")),m.a.createElement(h.a,{xs:"12",md:"9"},m.a.createElement(g.a,{type:"password",id:"password",onChange:this.handlePasswordChange,placeholder:"",required:!0,autoFocus:!0}),m.a.createElement(E.a,{color:"muted"},"Isi Password")))),m.a.createElement(N.a,null,m.a.createElement(x.a,{color:"primary",type:"submit",form:"form-data",value:"Submit"},this.state.aksi," Data"),m.a.createElement(x.a,{color:"secondary",onClick:this.toggleClose},"Cancel")))),m.a.createElement(D.a,{isOpen:this.state.modalDelete,toggle:this.toggleDelete,className:this.props.className},m.a.createElement(O.a,{toggle:this.toggleDelete},"Hapus Data"),m.a.createElement(y.a,null,"Apakah Anda Yakin Menghapus Data ",this.state.dataPilih.nama,"?"),m.a.createElement(N.a,null,m.a.createElement(x.a,{color:"danger",onClick:this.handleDelete},"Ya")," ",m.a.createElement(x.a,{color:"secondary",onClick:this.toggleDelete},"Batal"))),m.a.createElement(f.a,null,m.a.createElement(h.a,{xs:"128",md:"10"},m.a.createElement(w.a,{method:"post",onSubmit:this.handleCariSubmit,className:"form-horizontal"},m.a.createElement(u.a,{row:!0},m.a.createElement(h.a,{xs:"9",md:"5"},m.a.createElement(g.a,{type:"text",onChange:this.handlePencarianChange,id:"text-input-pencarian",name:"pencarian",placeholder:"Pencarian"})),m.a.createElement(h.a,{xs:"3",md:"2"},m.a.createElement(x.a,{color:"primary"},"Cari"))))),m.a.createElement(h.a,{xs:"12",md:"2"},m.a.createElement(x.a,{color:"info",onClick:function(){e.setState({aksi:"Tambah"}),e.toggle()},className:"mr-1"},"Tambah"))),m.a.createElement(S.a,{responsive:!0,striped:!0},m.a.createElement("thead",null,m.a.createElement("tr",null,m.a.createElement("th",null,"No"),m.a.createElement("th",null,"Username"),m.a.createElement("th",null,"Nama Dinas"),m.a.createElement("th",null,"Level"),m.a.createElement("th",null,"Status"),m.a.createElement("th",null,"Aksi"))),m.a.createElement("tbody",null,m.a.createElement("tr",null,m.a.createElement("td",null,"1"),m.a.createElement("td",null,"tes"),m.a.createElement("td",null,"Pendidikan"),m.a.createElement("td",null,"OPD Provinsi"),m.a.createElement("td",null,"Aktif"),m.a.createElement("td",null)))),this.pageNation())))))}}]),a}(o.Component);a.default=L},4:function(e,a,t){"use strict";var n=t(262),l=t(263),i=t(1),r=t.n(i),s=t(0),c=t.n(s),o=t(261),m=t.n(o),d=t(260),u={children:c.a.node,className:c.a.string,listClassName:c.a.string,cssModule:c.a.object,size:c.a.string,tag:d.m,listTag:d.m,"aria-label":c.a.string},h=function(e){var a,t=e.className,i=e.listClassName,s=e.cssModule,c=e.size,o=e.tag,u=e.listTag,h=e["aria-label"],p=Object(l.a)(e,["className","listClassName","cssModule","size","tag","listTag","aria-label"]),g=Object(d.i)(m()(t),s),E=Object(d.i)(m()(i,"pagination",((a={})["pagination-"+c]=!!c,a)),s);return r.a.createElement(o,{className:g,"aria-label":h},r.a.createElement(u,Object(n.a)({},p,{className:E})))};h.propTypes=u,h.defaultProps={tag:"nav",listTag:"ul","aria-label":"pagination"},a.a=h},5:function(e,a,t){"use strict";var n=t(262),l=t(263),i=t(1),r=t.n(i),s=t(0),c=t.n(s),o=t(261),m=t.n(o),d=t(260),u={tag:d.m,className:c.a.string,cssModule:c.a.object},h=function(e){var a=e.className,t=e.cssModule,i=e.tag,s=Object(l.a)(e,["className","cssModule","tag"]),c=Object(d.i)(m()(a,"card-header"),t);return r.a.createElement(i,Object(n.a)({},s,{className:c}))};h.propTypes=u,h.defaultProps={tag:"div"},a.a=h}}]);
//# sourceMappingURL=24.3c43d7ac.chunk.js.map