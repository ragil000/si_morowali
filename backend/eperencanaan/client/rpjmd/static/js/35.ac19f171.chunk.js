(window.webpackJsonp=window.webpackJsonp||[]).push([[35],{2:function(e,a,t){"use strict";var n=t(262),l=t(263),r=t(1),i=t.n(r),s=t(0),c=t.n(s),o=t(261),d=t.n(o),m=t(260),u={active:c.a.bool,children:c.a.node,className:c.a.string,cssModule:c.a.object,disabled:c.a.bool,tag:m.m},g=function(e){var a=e.active,t=e.className,r=e.cssModule,s=e.disabled,c=e.tag,o=Object(l.a)(e,["active","className","cssModule","disabled","tag"]),u=Object(m.i)(d()(t,"page-item",{active:a,disabled:s}),r);return i.a.createElement(c,Object(n.a)({},o,{className:u}))};g.propTypes=u,g.defaultProps={tag:"li"},a.a=g},265:function(e,a,t){e.exports=t.p+"static/media/loading.557336d4.gif"},3:function(e,a,t){"use strict";var n=t(262),l=t(263),r=t(1),i=t.n(r),s=t(0),c=t.n(s),o=t(261),d=t.n(o),m=t(260),u={"aria-label":c.a.string,children:c.a.node,className:c.a.string,cssModule:c.a.object,next:c.a.bool,previous:c.a.bool,tag:m.m},g=function(e){var a,t=e.className,r=e.cssModule,s=e.next,c=e.previous,o=e.tag,u=Object(l.a)(e,["className","cssModule","next","previous","tag"]),g=Object(m.i)(d()(t,"page-link"),r);c?a="Previous":s&&(a="Next");var h,p=e["aria-label"]||a;c?h="\xab":s&&(h="\xbb");var E=e.children;return E&&Array.isArray(E)&&0===E.length&&(E=null),u.href||"a"!==o||(o="button"),(c||s)&&(E=[i.a.createElement("span",{"aria-hidden":"true",key:"caret"},E||h),i.a.createElement("span",{className:"sr-only",key:"sr"},p)]),i.a.createElement(o,Object(n.a)({},u,{className:g,"aria-label":p}),E)};g.propTypes=u,g.defaultProps={tag:"a"},a.a=g},360:function(e,a,t){"use strict";t.r(a);var n=t(104),l=t(105),r=t(107),i=t(106),s=t(108),c=t(109),o=t(1),d=t.n(o),m=t(13),u=t(2),g=t(3),h=t(4),p=t(27),E=t(28),_=t(17),b=t(11),v=t(8),P=t(29),j=t(7),f=t(26),C=t(5),k=t(25),S=t(14),y=t(9),N=t(10),x=t(47),D=t(349),w=t(12),O=t(269),I=t.n(O),M=t(268),T=t(265),R=t.n(T),F=function(e){function a(e){var t;return Object(n.a)(this,a),(t=Object(r.a)(this,Object(i.a)(a).call(this,e))).componentWillMount=function(){t.getData()},t.changePesan=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null,a=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"success";null===e?t.setState({pesan:""}):t.setState({pesan:d.a.createElement(m.a,{color:a},e)}),setTimeout(function(){t.setState({pesan:""})},3e3)},t.setData=function(e){e.status&&t.setState({dataAll:e.data,jumlahPage:e.jumlahPage,jumlahAll:e.jumlahAll,dataTambah:e.dataTambah,dataUrusan:e.dataUrusan})},t.getData=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1;t.setState({loading:!0});var a=new FormData;a.append("session",localStorage.getItem("codexv-session")),a.append("rpjmd",localStorage.getItem("codexv-rpjmd")),a.append("search",t.state.pencarian),I.a.post(M.apiRoot+"rpjmd/menyusun/isu-strategi/page-"+e,a).then(function(e){t.setData(e.data),console.log(e),t.setState({loading:!1})}).catch(function(e){console.log(e),t.setState({loading:!1}),t.changePesan("Tidak dapat terhubung pada server!","danger")})},t.getBidang=function(e){t.setState({loading:!0});var a=new FormData;a.append("session",localStorage.getItem("codexv-session")),a.append("urusan",e),I.a.post(M.apiRoot+"rpjmd/get-data/bidang",a).then(function(e){e.data.status&&t.setState({dataBidang:e.data.data}),t.setState({loading:!1})}).catch(function(e){console.log(e),t.setState({loading:!1})})},t.handleSubmit=function(e){e.preventDefault(),t.setState({loading:!0});var a="";"Edit"===t.state.aksi?a=M.apiRoot+"rpjmd/menyusun/isu-strategi/update":"Tambah"===t.state.aksi&&(a=M.apiRoot+"rpjmd/menyusun/isu-strategi/create");var n=new FormData;n.append("session",localStorage.getItem("codexv-session")),n.append("rpjmd",localStorage.getItem("codexv-rpjmd")),n.append("isu_strategi_id",t.state.dataPilih.isu_strategi_id),n.append("misi_id",t.state.dataPilih.misi_id),n.append("isu_strategi_urusan",t.state.dataPilih.isu_strategi_urusan),n.append("isu_strategi_rpjpd",t.state.dataPilih.isu_strategi_rpjpd),n.append("isu_strategi_rtrw",t.state.dataPilih.isu_strategi_rtrw),n.append("isu_strategi_rpjmn",t.state.dataPilih.isu_strategi_rpjmn),n.append("isu_strategi_dinamika",t.state.dataPilih.isu_strategi_dinamika),n.append("isu_strategi_rpjmd",t.state.dataPilih.isu_strategi_rpjmd),n.append("Kd_Urusan",t.state.dataPilih.Kd_Urusan),n.append("Kd_Bidang",t.state.dataPilih.Kd_Bidang),I.a.post(a,n,{headers:{"Content-Type":"multipart/form-data"}}).then(function(e){e.data.status?(t.modalCreateClose(),t.getData(),t.changePesan(e.data.pesan)):t.changePesan(e.data.pesan,"warning"),t.setState({loading:!1})}).catch(function(e){console.log(e),t.setState({loading:!1}),t.changePesan("Tidak dapat terhubung pada server!","danger")})},t.handleDelete=function(){t.setState({loading:!0});var e=new FormData;e.append("session",localStorage.getItem("codexv-session")),e.append("rpjmd",localStorage.getItem("codexv-rpjmd")),e.append("isu_strategi_id",t.state.dataPilih.isu_strategi_id),I.a.post(M.apiRoot+"rpjmd/menyusun/isu-strategi/delete",e).then(function(e){e.data.status?(t.modalDelete(),t.getData(),t.changePesan(e.data.pesan)):t.changePesan(e.data.pesan,"warning"),t.setState({loading:!1})}).catch(function(e){console.log(e),t.setState({loading:!1}),t.changePesan("Tidak dapat terhubung pada server!","danger")})},t.handleCariSubmit=function(e){e.preventDefault(),t.getData()},t.changePage=function(e){t.setState({page:e}),t.getData(e)},t.pageNation=function(){var e=[];t.state.page>1?e.push(d.a.createElement(u.a,{onClick:function(){return t.changePage(t.state.page-1)},key:0},d.a.createElement(g.a,{previous:!0,tag:"button"},"Prev"))):e.push(d.a.createElement(u.a,{disabled:!0,key:0},d.a.createElement(g.a,{previous:!0,tag:"button"},"Prev")));for(var a=!1,n=!1,l=function(l){n=a,a=!1,l+2>=t.state.page&&l-2<=t.state.page&&(a=!0),1!==l&&l!==t.state.jumlahPage||(a=!0),a?l===t.state.page?e.push(d.a.createElement(u.a,{active:!0,key:l},d.a.createElement(g.a,{tag:"button"},l))):e.push(d.a.createElement(u.a,{key:l,onClick:function(){return t.changePage(l)}},d.a.createElement(g.a,{tag:"button"},l))):n!==a&&e.push(d.a.createElement(u.a,{key:l,disabled:!0},d.a.createElement(g.a,{tag:"button"},"...")))},r=1;r<=t.state.jumlahPage;r++)l(r);return t.state.page<t.state.jumlahPage?e.push(d.a.createElement(u.a,{onClick:function(){return t.changePage(t.state.page+1)},key:t.state.jumlahPage+2},d.a.createElement(g.a,{next:!0,tag:"button"},"Next"))):e.push(d.a.createElement(u.a,{disabled:!0,key:t.state.jumlahPage+2},d.a.createElement(g.a,{next:!0,tag:"button"},"Next"))),d.a.createElement(h.a,null,e)},t.dataPilihAwal={isu_strategi_id:"",misi_id:"",isu_strategi_urusan:"",isu_strategi_rpjpd:"",isu_strategi_rtrw:"",isu_strategi_rpjmn:"",isu_strategi_dinamika:"",isu_strategi_rpjmd:"",Kd_Urusan:"",Kd_Bidang:""},t.state={loading:!1,dataAll:[],jumlahPage:1,modalCreate:!1,modalDelete:!1,dataPilih:t.dataPilihAwal,dataTambah:[],dataUrusan:[],dataBidang:[],dataMisi:[],pencarian:"",page:1,aksi:"Tambah"},document.title="Menyusun Perumusan Isu Strategis",t.modalCreateClose=t.modalCreateClose.bind(Object(c.a)(Object(c.a)(t))),t.modalCreate=t.modalCreate.bind(Object(c.a)(Object(c.a)(t))),t.modalDelete=t.modalDelete.bind(Object(c.a)(Object(c.a)(t))),t.handleChange=t.handleChange.bind(Object(c.a)(Object(c.a)(t))),t.handlePencarianChange=t.handlePencarianChange.bind(Object(c.a)(Object(c.a)(t))),t.handleDelete=t.handleDelete.bind(Object(c.a)(Object(c.a)(t))),t}return Object(s.a)(a,e),Object(l.a)(a,[{key:"handlePencarianChange",value:function(e){this.setState({pencarian:e.target.value})}},{key:"handleChange",value:function(e){var a=parseInt(e.target.attributes.getNamedItem("data-number").value),t=this.state.dataPilih;1===a?t.misi_id=e.target.value:2===a?t.isu_strategi_urusan=e.target.value:3===a?t.isu_strategi_rpjpd=e.target.value:4===a?t.isu_strategi_rtrw=e.target.value:5===a?t.isu_strategi_rpjmn=e.target.value:6===a?t.isu_strategi_dinamika=e.target.value:7===a?t.isu_strategi_rpjmd=e.target.value:8===a?(t.Kd_Urusan=e.target.value,this.getBidang(e.target.value)):9===a&&(t.Kd_Bidang=e.target.value),console.log(e.target.value),this.setState({dataPilih:t})}},{key:"modalCreateClose",value:function(){arguments.length>0&&void 0!==arguments[0]&&arguments[0];this.setState({modalCreate:!1})}},{key:"modalCreate",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];0===e.length?this.setState({modalCreate:!0,dataPilih:this.dataPilihAwal}):(this.setState({modalCreate:!0,dataPilih:e}),console.log(e))}},{key:"modalDelete",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.setState({modalDelete:!this.state.modalDelete,dataPilih:e})}},{key:"isi",value:function(){var e=this;return this.state.loading?d.a.createElement("div",null,d.a.createElement("img",{src:R.a,alt:"logo"})):d.a.createElement("div",null,this.state.pesan,d.a.createElement(p.a,null,d.a.createElement(E.a,{xs:"128",md:"10"},d.a.createElement(_.a,{method:"post",onSubmit:this.handleCariSubmit,className:"form-horizontal"},d.a.createElement(b.a,{row:!0},d.a.createElement(E.a,{xs:"9",md:"5"},d.a.createElement(v.a,{type:"text",onChange:this.handlePencarianChange,value:this.state.pencarian,placeholder:"Pencarian"})),d.a.createElement(E.a,{xs:"3",md:"2"},d.a.createElement(P.a,{color:"primary"},"Cari"))))),d.a.createElement(E.a,{xs:"12",md:"2"},d.a.createElement(P.a,{color:"info",onClick:function(){e.setState({aksi:"Tambah"}),e.modalCreate()},className:"mr-1"},"Tambah"))),d.a.createElement(j.a,{responsive:!0,striped:!0,bordered:!0},d.a.createElement("thead",{style:{textAlign:"center",backgroundColor:"#0066ff",color:"white"}},d.a.createElement("tr",null,d.a.createElement("th",{rowSpan:"2"},"No"),d.a.createElement("th",{rowSpan:"2"},"Misi"),d.a.createElement("th",{rowSpan:"2"},"Isu Strategi Urusan"),d.a.createElement("th",{colSpan:"4"},"Kajian Kebijakan"),d.a.createElement("th",{rowSpan:"2"},"Isu Strategi RPJMD"),d.a.createElement("th",{rowSpan:"2"},"Bidang"),d.a.createElement("th",{rowSpan:"2"},"Urusan"),d.a.createElement("th",{rowSpan:"2"},"Aksi")),d.a.createElement("tr",null,d.a.createElement("th",null,"RPJPD"),d.a.createElement("th",null,"RTRW"),d.a.createElement("th",null,"RPJMN/RPJMD PROVINSI"),d.a.createElement("th",null,"DINAMIKA INTERNASIONAL"))),d.a.createElement("tbody",null,this.state.dataAll.map(function(a,t){return a?d.a.createElement("tr",{key:t},d.a.createElement("td",null,20*(e.state.page-1)+t+1),d.a.createElement("td",null,a.misi_nama),d.a.createElement("td",null,a.isu_strategi_urusan),d.a.createElement("td",null,a.isu_strategi_rpjpd),d.a.createElement("td",null,a.isu_strategi_rtrw),d.a.createElement("td",null,a.isu_strategi_rpjmn),d.a.createElement("td",null,a.isu_strategi_dinamika),d.a.createElement("td",null,a.isu_strategi_rpjmd),d.a.createElement("td",null,a.Nm_Urusan),d.a.createElement("td",null,a.Nm_Bidang),d.a.createElement("td",null,d.a.createElement(P.a,{color:"info",onClick:function(){e.setState({aksi:"Edit"}),e.modalCreate(a)},className:"mr-1"},"Edit"),"|",d.a.createElement(P.a,{color:"danger",onClick:function(){return e.modalDelete(a)},className:"mr-1"},"Delete"))):null}))),this.pageNation())}},{key:"render",value:function(){return d.a.createElement("div",{className:"animated fadeIn"},d.a.createElement(p.a,null,d.a.createElement(E.a,{xs:"12",lg:"12"},d.a.createElement(f.a,null,d.a.createElement(C.a,null,d.a.createElement("i",{className:"fa fa-align-justify"})," ",document.title),d.a.createElement(k.a,null,d.a.createElement("h5",{style:{textAlign:"center"}},"Isu Strategi"),d.a.createElement("hr",null),d.a.createElement(S.a,{isOpen:this.state.modalCreate,toggle:this.modalCreateClose,className:"modal-lg "+this.props.className},d.a.createElement(y.a,{toggle:this.modalCreateClose},this.state.aksi," Data"),d.a.createElement(_.a,{method:"post",onSubmit:this.handleSubmit,className:"form-horizontal",id:"form-data"},d.a.createElement(N.a,null,d.a.createElement(b.a,{row:!0},d.a.createElement(E.a,{md:"3"},d.a.createElement(x.a,{htmlFor:"text-input"},"Misi *")),d.a.createElement(E.a,{xs:"12",md:"9"},d.a.createElement(v.a,{type:"select","data-number":"1",placeholder:"",onChange:this.handleChange,value:this.state.dataPilih.misi_id,required:!0,autoFocus:!0},d.a.createElement("option",{key:"-1",value:""},"-= Pilih Misi =-"),this.state.dataTambah.map(function(e,a){return e?d.a.createElement("option",{key:a,value:e.misi_id},e.misi_nama):null})),d.a.createElement(D.a,{color:"muted"},"Pilih Misi"))),d.a.createElement(b.a,{row:!0},d.a.createElement(E.a,{md:"3"},d.a.createElement(x.a,{htmlFor:"text-input"},"Isu Strategi Urusan *")),d.a.createElement(E.a,{xs:"12",md:"9"},d.a.createElement(v.a,{type:"text","data-number":"2",placeholder:"",onChange:this.handleChange,value:this.state.dataPilih.isu_strategi_urusan,required:!0,autoFocus:!0}),d.a.createElement(D.a,{color:"muted"},"Isi Isu Strategi Urusan"))),d.a.createElement(b.a,{row:!0},d.a.createElement(E.a,{md:"3"},d.a.createElement(x.a,{htmlFor:"text-input"},"Isu Strategi RPJPD *")),d.a.createElement(E.a,{xs:"12",md:"9"},d.a.createElement(v.a,{type:"text","data-number":"3",placeholder:"",onChange:this.handleChange,value:this.state.dataPilih.isu_strategi_rpjpd,required:!0,autoFocus:!0}),d.a.createElement(D.a,{color:"muted"},"Isu Strategi RPJPD"))),d.a.createElement(b.a,{row:!0},d.a.createElement(E.a,{md:"3"},d.a.createElement(x.a,{htmlFor:"text-input"},"Isi RTRW *")),d.a.createElement(E.a,{xs:"12",md:"9"},d.a.createElement(v.a,{type:"text","data-number":"4",placeholder:"",onChange:this.handleChange,value:this.state.dataPilih.isu_strategi_rtrw,required:!0,autoFocus:!0}),d.a.createElement(D.a,{color:"muted"},"Isi RTRW"))),d.a.createElement(b.a,{row:!0},d.a.createElement(E.a,{md:"3"},d.a.createElement(x.a,{htmlFor:"text-input"},"Isi RPJMN *")),d.a.createElement(E.a,{xs:"12",md:"9"},d.a.createElement(v.a,{type:"text","data-number":"5",placeholder:"",onChange:this.handleChange,value:this.state.dataPilih.isu_strategi_rpjmn,required:!0,autoFocus:!0}),d.a.createElement(D.a,{color:"muted"},"Isi RPJMN"))),d.a.createElement(b.a,{row:!0},d.a.createElement(E.a,{md:"3"},d.a.createElement(x.a,{htmlFor:"text-input"},"Isi Dinamika *")),d.a.createElement(E.a,{xs:"12",md:"9"},d.a.createElement(v.a,{type:"text","data-number":"6",placeholder:"",onChange:this.handleChange,value:this.state.dataPilih.isu_strategi_dinamika,required:!0,autoFocus:!0}),d.a.createElement(D.a,{color:"muted"},"Isi Dinamika"))),d.a.createElement(b.a,{row:!0},d.a.createElement(E.a,{md:"3"},d.a.createElement(x.a,{htmlFor:"text-input"},"Isi RPJMD *")),d.a.createElement(E.a,{xs:"12",md:"9"},d.a.createElement(v.a,{type:"text","data-number":"7",placeholder:"",onChange:this.handleChange,value:this.state.dataPilih.isu_strategi_rpjmd,required:!0,autoFocus:!0}),d.a.createElement(D.a,{color:"muted"},"Isi RPJMD"))),d.a.createElement(b.a,{row:!0},d.a.createElement(E.a,{md:"3"},d.a.createElement(x.a,{htmlFor:"text-input"},"Urusan *")),d.a.createElement(E.a,{xs:"12",md:"9"},d.a.createElement(v.a,{type:"select","data-number":"8",placeholder:"",onChange:this.handleChange,value:this.state.dataPilih.Kd_Urusan,required:!0,autoFocus:!0},d.a.createElement("option",{key:"-1",value:""},"-= Pilih Urusan =-"),this.state.dataUrusan.map(function(e,a){return e?d.a.createElement("option",{key:a,value:e.Kd_Urusan},e.Nm_Urusan):null})),d.a.createElement(D.a,{color:"muted"},"Pilih Urusan"))),d.a.createElement(b.a,{row:!0},d.a.createElement(E.a,{md:"3"},d.a.createElement(x.a,{htmlFor:"text-input"},"Bidang *")),d.a.createElement(E.a,{xs:"12",md:"9"},d.a.createElement(v.a,{type:"select","data-number":"9",placeholder:"",onChange:this.handleChange,value:this.state.dataPilih.Kd_Bidang,required:!0,autoFocus:!0},d.a.createElement("option",{key:"-1",value:""},"-= Pilih Bidang =-"),this.state.dataBidang.map(function(e,a){return e?d.a.createElement("option",{key:a,value:e.Kd_Bidang},e.Nm_Bidang):null})),d.a.createElement(D.a,{color:"muted"},"Pilih Bidang")))),d.a.createElement(w.a,null,d.a.createElement(P.a,{color:"primary",type:"submit",form:"form-data",value:"Submit"},this.state.aksi," Data"),d.a.createElement(P.a,{color:"secondary",onClick:this.modalCreateClose},"Cancel")))),d.a.createElement(S.a,{isOpen:this.state.modalDelete,toggle:this.modalDelete,className:this.props.className},d.a.createElement(y.a,{toggle:this.modalDelete},"Hapus Data"),d.a.createElement(N.a,null,"Apakah Anda Yakin Menghapus Data?"),d.a.createElement(w.a,null,d.a.createElement(P.a,{color:"danger",onClick:this.handleDelete},"Ya")," ",d.a.createElement(P.a,{color:"secondary",onClick:this.modalDelete},"Batal"))),this.isi())))))}}]),a}(o.Component);a.default=F},4:function(e,a,t){"use strict";var n=t(262),l=t(263),r=t(1),i=t.n(r),s=t(0),c=t.n(s),o=t(261),d=t.n(o),m=t(260),u={children:c.a.node,className:c.a.string,listClassName:c.a.string,cssModule:c.a.object,size:c.a.string,tag:m.m,listTag:m.m,"aria-label":c.a.string},g=function(e){var a,t=e.className,r=e.listClassName,s=e.cssModule,c=e.size,o=e.tag,u=e.listTag,g=e["aria-label"],h=Object(l.a)(e,["className","listClassName","cssModule","size","tag","listTag","aria-label"]),p=Object(m.i)(d()(t),s),E=Object(m.i)(d()(r,"pagination",((a={})["pagination-"+c]=!!c,a)),s);return i.a.createElement(o,{className:p,"aria-label":g},i.a.createElement(u,Object(n.a)({},h,{className:E})))};g.propTypes=u,g.defaultProps={tag:"nav",listTag:"ul","aria-label":"pagination"},a.a=g},5:function(e,a,t){"use strict";var n=t(262),l=t(263),r=t(1),i=t.n(r),s=t(0),c=t.n(s),o=t(261),d=t.n(o),m=t(260),u={tag:m.m,className:c.a.string,cssModule:c.a.object},g=function(e){var a=e.className,t=e.cssModule,r=e.tag,s=Object(l.a)(e,["className","cssModule","tag"]),c=Object(m.i)(d()(a,"card-header"),t);return i.a.createElement(r,Object(n.a)({},s,{className:c}))};g.propTypes=u,g.defaultProps={tag:"div"},a.a=g}}]);
//# sourceMappingURL=35.ac19f171.chunk.js.map