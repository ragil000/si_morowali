(window.webpackJsonp=window.webpackJsonp||[]).push([[29],{2:function(a,e,t){"use strict";var n=t(262),l=t(263),s=t(1),i=t.n(s),r=t(0),o=t.n(r),c=t(261),d=t.n(c),m=t(260),u={active:o.a.bool,children:o.a.node,className:o.a.string,cssModule:o.a.object,disabled:o.a.bool,tag:m.m},g=function(a){var e=a.active,t=a.className,s=a.cssModule,r=a.disabled,o=a.tag,c=Object(l.a)(a,["active","className","cssModule","disabled","tag"]),u=Object(m.i)(d()(t,"page-item",{active:e,disabled:r}),s);return i.a.createElement(o,Object(n.a)({},c,{className:u}))};g.propTypes=u,g.defaultProps={tag:"li"},e.a=g},265:function(a,e,t){a.exports=t.p+"static/media/loading.557336d4.gif"},3:function(a,e,t){"use strict";var n=t(262),l=t(263),s=t(1),i=t.n(s),r=t(0),o=t.n(r),c=t(261),d=t.n(c),m=t(260),u={"aria-label":o.a.string,children:o.a.node,className:o.a.string,cssModule:o.a.object,next:o.a.bool,previous:o.a.bool,tag:m.m},g=function(a){var e,t=a.className,s=a.cssModule,r=a.next,o=a.previous,c=a.tag,u=Object(l.a)(a,["className","cssModule","next","previous","tag"]),g=Object(m.i)(d()(t,"page-link"),s);o?e="Previous":r&&(e="Next");var h,p=a["aria-label"]||e;o?h="\xab":r&&(h="\xbb");var b=a.children;return b&&Array.isArray(b)&&0===b.length&&(b=null),u.href||"a"!==c||(c="button"),(o||r)&&(b=[i.a.createElement("span",{"aria-hidden":"true",key:"caret"},b||h),i.a.createElement("span",{className:"sr-only",key:"sr"},p)]),i.a.createElement(c,Object(n.a)({},u,{className:g,"aria-label":p}),b)};g.propTypes=u,g.defaultProps={tag:"a"},e.a=g},354:function(a,e,t){"use strict";t.r(e);var n=t(104),l=t(105),s=t(107),i=t(106),r=t(108),o=t(109),c=t(1),d=t.n(c),m=t(13),u=t(2),g=t(3),h=t(4),p=t(27),b=t(28),E=t(17),v=t(11),f=t(8),k=t(29),j=t(7),C=t(26),P=t(5),y=t(25),N=t(14),S=t(9),D=t(10),O=t(47),x=t(349),T=t(12),_=t(269),w=t.n(_),M=t(268),A=t(265),I=t.n(A),F=function(a){function e(a){var t;return Object(n.a)(this,e),(t=Object(s.a)(this,Object(i.a)(e).call(this,a))).componentWillMount=function(){t.getData()},t.changePesan=function(){var a=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null,e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"success";null===a?t.setState({pesan:""}):t.setState({pesan:d.a.createElement(m.a,{color:e},a)}),setTimeout(function(){t.setState({pesan:""})},3e3)},t.setData=function(a){a.status&&t.setState({dataAll:a.data,jumlahPage:a.jumlahPage,jumlahAll:a.jumlahAll,dataKategori:a.kategori,dataTambah:a.dataTambah})},t.getData=function(){var a=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1;t.setState({loading:!0});var e=new FormData;e.append("session",localStorage.getItem("codexv-session")),e.append("rpjmd",localStorage.getItem("codexv-rpjmd")),e.append("search",t.state.pencarian),w.a.post(M.apiRoot+"rpjmd/menyusun/indikator/page-"+a,e).then(function(a){t.setData(a.data),console.log(a),t.setState({loading:!1})}).catch(function(a){console.log(a),t.setState({loading:!1}),t.changePesan("Tidak dapat terhubung pada server!","danger")})},t.handleSubmit=function(a){a.preventDefault(),t.setState({loading:!0});var e="";"Edit"===t.state.aksi?e=M.apiRoot+"rpjmd/menyusun/indikator/update":"Tambah"===t.state.aksi&&(e=M.apiRoot+"rpjmd/menyusun/indikator/create");var n=new FormData;n.append("session",localStorage.getItem("codexv-session")),n.append("rpjmd",localStorage.getItem("codexv-rpjmd")),n.append("indikator_id",t.state.dataPilih.indikator_id),n.append("indikator_nama",t.state.dataPilih.indikator_nama),n.append("sasaran_id",t.state.dataPilih.sasaran_id),w.a.post(e,n,{headers:{"Content-Type":"multipart/form-data"}}).then(function(a){a.data.status?(t.modalCreateClose(),t.getData(),t.changePesan(a.data.pesan)):t.changePesan(a.data.pesan,"warning"),t.setState({loading:!1}),console.log(a.data)}).catch(function(a){console.log(a),t.setState({loading:!1}),t.changePesan("Tidak dapat terhubung pada server!","danger")})},t.handleDelete=function(){t.setState({loading:!0});var a=new FormData;a.append("session",localStorage.getItem("codexv-session")),a.append("rpjmd",localStorage.getItem("codexv-rpjmd")),a.append("indikator_id",t.state.dataPilih.indikator_id),w.a.post(M.apiRoot+"rpjmd/menyusun/indikator/delete",a).then(function(a){a.data.status?(t.modalDelete(),t.getData(),t.changePesan(a.data.pesan)):t.changePesan(a.data.pesan,"warning"),t.setState({loading:!1}),console.log(a)}).catch(function(a){console.log(a),t.setState({loading:!1}),t.changePesan("Tidak dapat terhubung pada server!","danger")})},t.handleCariSubmit=function(a){a.preventDefault(),t.getData()},t.changePage=function(a){t.setState({page:a}),t.getData(a)},t.pageNation=function(){var a=[];t.state.page>1?a.push(d.a.createElement(u.a,{onClick:function(){return t.changePage(t.state.page-1)},key:0},d.a.createElement(g.a,{previous:!0,tag:"button"},"Prev"))):a.push(d.a.createElement(u.a,{disabled:!0,key:0},d.a.createElement(g.a,{previous:!0,tag:"button"},"Prev")));for(var e=!1,n=!1,l=function(l){n=e,e=!1,l+2>=t.state.page&&l-2<=t.state.page&&(e=!0),1!==l&&l!==t.state.jumlahPage||(e=!0),e?l===t.state.page?a.push(d.a.createElement(u.a,{active:!0,key:l},d.a.createElement(g.a,{tag:"button"},l))):a.push(d.a.createElement(u.a,{key:l,onClick:function(){return t.changePage(l)}},d.a.createElement(g.a,{tag:"button"},l))):n!==e&&a.push(d.a.createElement(u.a,{key:l,disabled:!0},d.a.createElement(g.a,{tag:"button"},"...")))},s=1;s<=t.state.jumlahPage;s++)l(s);return t.state.page<t.state.jumlahPage?a.push(d.a.createElement(u.a,{onClick:function(){return t.changePage(t.state.page+1)},key:t.state.jumlahPage+2},d.a.createElement(g.a,{next:!0,tag:"button"},"Next"))):a.push(d.a.createElement(u.a,{disabled:!0,key:t.state.jumlahPage+2},d.a.createElement(g.a,{next:!0,tag:"button"},"Next"))),d.a.createElement(h.a,null,a)},t.dataPilihAwal={sasaran_id:0,indikator_id:"",indikator_nama:""},t.state={loading:!1,dataAll:[],jumlahPage:1,modalCreate:!1,modalDelete:!1,dataPilih:t.dataPilihAwal,dataTambah:[],pencarian:"",page:1,aksi:"Tambah"},document.title="Menyusun Indikator",t.modalCreateClose=t.modalCreateClose.bind(Object(o.a)(Object(o.a)(t))),t.modalCreate=t.modalCreate.bind(Object(o.a)(Object(o.a)(t))),t.modalDelete=t.modalDelete.bind(Object(o.a)(Object(o.a)(t))),t.handleChange=t.handleChange.bind(Object(o.a)(Object(o.a)(t))),t.handlePencarianChange=t.handlePencarianChange.bind(Object(o.a)(Object(o.a)(t))),t.handleDelete=t.handleDelete.bind(Object(o.a)(Object(o.a)(t))),t}return Object(r.a)(e,a),Object(l.a)(e,[{key:"handlePencarianChange",value:function(a){this.setState({pencarian:a.target.value})}},{key:"handleChange",value:function(a){var e=parseInt(a.target.attributes.getNamedItem("data-number").value),t=this.state.dataPilih;1===e?t.indikator_nama=a.target.value:2===e&&(t.sasaran_id=a.target.value),this.setState({dataPilih:t})}},{key:"modalCreateClose",value:function(){arguments.length>0&&void 0!==arguments[0]&&arguments[0];this.setState({modalCreate:!1})}},{key:"modalCreate",value:function(){var a=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];0===a.length?this.setState({modalCreate:!0,dataPilih:this.dataPilihAwal}):(this.setState({modalCreate:!0,dataPilih:a}),console.log(a))}},{key:"modalDelete",value:function(){var a=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.setState({modalDelete:!this.state.modalDelete,dataPilih:a})}},{key:"isi",value:function(){var a=this;return this.state.loading?d.a.createElement("div",null,d.a.createElement("img",{src:I.a,alt:"logo"})):d.a.createElement("div",null,this.state.pesan,d.a.createElement(p.a,null,d.a.createElement(b.a,{xs:"128",md:"10"},d.a.createElement(E.a,{method:"post",onSubmit:this.handleCariSubmit,className:"form-horizontal"},d.a.createElement(v.a,{row:!0},d.a.createElement(b.a,{xs:"9",md:"5"},d.a.createElement(f.a,{type:"text",onChange:this.handlePencarianChange,value:this.state.pencarian,placeholder:"Pencarian"})),d.a.createElement(b.a,{xs:"3",md:"2"},d.a.createElement(k.a,{color:"primary"},"Cari"))))),d.a.createElement(b.a,{xs:"12",md:"2"},d.a.createElement(k.a,{color:"info",onClick:function(){a.setState({aksi:"Tambah"}),a.modalCreate()},className:"mr-1"},"Tambah"))),d.a.createElement(j.a,{responsive:!0,striped:!0,bordered:!0},d.a.createElement("thead",{style:{textAlign:"center",backgroundColor:"#0066ff",color:"white"}},d.a.createElement("tr",null,d.a.createElement("th",null,"No"),d.a.createElement("th",null,"Sasaran"),d.a.createElement("th",null,"Indikator"),d.a.createElement("th",null,"Aksi"))),d.a.createElement("tbody",null,this.state.dataAll.map(function(e,t){return e?d.a.createElement("tr",{key:t},d.a.createElement("td",null,20*(a.state.page-1)+t+1),d.a.createElement("td",null,e.sasaran_nama),d.a.createElement("td",null,e.indikator_nama),d.a.createElement("td",null,d.a.createElement(k.a,{color:"info",onClick:function(){a.setState({aksi:"Edit"}),a.modalCreate(e)},className:"mr-1"},"Edit"),"|",d.a.createElement(k.a,{color:"danger",onClick:function(){return a.modalDelete(e)},className:"mr-1"},"Delete"))):null}))),this.pageNation())}},{key:"render",value:function(){return d.a.createElement("div",{className:"animated fadeIn"},d.a.createElement(p.a,null,d.a.createElement(b.a,{xs:"12",lg:"12"},d.a.createElement(C.a,null,d.a.createElement(P.a,null,d.a.createElement("i",{className:"fa fa-align-justify"})," ",document.title),d.a.createElement(y.a,null,d.a.createElement(N.a,{isOpen:this.state.modalCreate,toggle:this.modalCreateClose,className:"modal-lg "+this.props.className},d.a.createElement(S.a,{toggle:this.modalCreateClose},this.state.aksi," Data"),d.a.createElement(E.a,{method:"post",onSubmit:this.handleSubmit,className:"form-horizontal",id:"form-data"},d.a.createElement(D.a,null,d.a.createElement(v.a,{row:!0},d.a.createElement(b.a,{md:"3"},d.a.createElement(O.a,{htmlFor:"text-input"},"Sasaran *")),d.a.createElement(b.a,{xs:"12",md:"9"},d.a.createElement(f.a,{type:"select","data-number":"2",placeholder:"",onChange:this.handleChange,value:this.state.dataPilih.sasaran_id,required:!0,autoFocus:!0},d.a.createElement("option",{key:"-1",value:""},"-= Pilih Sasaran =-"),this.state.dataTambah.map(function(a,e){return a?d.a.createElement("option",{key:e,value:a.sasaran_id},a.sasaran_nama):null})),d.a.createElement(x.a,{color:"muted"},"Pilih Sasaran"))),d.a.createElement(v.a,{row:!0},d.a.createElement(b.a,{md:"3"},d.a.createElement(O.a,{htmlFor:"text-input"},"Indikator *")),d.a.createElement(b.a,{xs:"12",md:"9"},d.a.createElement(f.a,{type:"text",id:"visi","data-number":"1",placeholder:"",onChange:this.handleChange,value:this.state.dataPilih.indikator_nama,required:!0,autoFocus:!0}),d.a.createElement(x.a,{color:"muted"},"Isi Indikator")))),d.a.createElement(T.a,null,d.a.createElement(k.a,{color:"primary",type:"submit",form:"form-data",value:"Submit"},this.state.aksi," Data"),d.a.createElement(k.a,{color:"secondary",onClick:this.modalCreateClose},"Cancel")))),d.a.createElement(N.a,{isOpen:this.state.modalDelete,toggle:this.modalDelete,className:this.props.className},d.a.createElement(S.a,{toggle:this.modalDelete},"Hapus Data"),d.a.createElement(D.a,null,"Apakah Anda Yakin Menghapus Data?"),d.a.createElement(T.a,null,d.a.createElement(k.a,{color:"danger",onClick:this.handleDelete},"Ya")," ",d.a.createElement(k.a,{color:"secondary",onClick:this.modalDelete},"Batal"))),this.isi())))))}}]),e}(c.Component);e.default=F},4:function(a,e,t){"use strict";var n=t(262),l=t(263),s=t(1),i=t.n(s),r=t(0),o=t.n(r),c=t(261),d=t.n(c),m=t(260),u={children:o.a.node,className:o.a.string,listClassName:o.a.string,cssModule:o.a.object,size:o.a.string,tag:m.m,listTag:m.m,"aria-label":o.a.string},g=function(a){var e,t=a.className,s=a.listClassName,r=a.cssModule,o=a.size,c=a.tag,u=a.listTag,g=a["aria-label"],h=Object(l.a)(a,["className","listClassName","cssModule","size","tag","listTag","aria-label"]),p=Object(m.i)(d()(t),r),b=Object(m.i)(d()(s,"pagination",((e={})["pagination-"+o]=!!o,e)),r);return i.a.createElement(c,{className:p,"aria-label":g},i.a.createElement(u,Object(n.a)({},h,{className:b})))};g.propTypes=u,g.defaultProps={tag:"nav",listTag:"ul","aria-label":"pagination"},e.a=g},5:function(a,e,t){"use strict";var n=t(262),l=t(263),s=t(1),i=t.n(s),r=t(0),o=t.n(r),c=t(261),d=t.n(c),m=t(260),u={tag:m.m,className:o.a.string,cssModule:o.a.object},g=function(a){var e=a.className,t=a.cssModule,s=a.tag,r=Object(l.a)(a,["className","cssModule","tag"]),o=Object(m.i)(d()(e,"card-header"),t);return i.a.createElement(s,Object(n.a)({},r,{className:o}))};g.propTypes=u,g.defaultProps={tag:"div"},e.a=g}}]);
//# sourceMappingURL=29.a5e8b17e.chunk.js.map