(window.webpackJsonp=window.webpackJsonp||[]).push([[14],{12:function(e,a,t){"use strict";var n=t(245),l=t(247),s=t(1),o=t.n(s),r=t(0),i=t.n(r),c=t(244),u=t.n(c),m=t(246),d={tag:m.m,className:i.a.string,cssModule:i.a.object,innerRef:i.a.oneOfType([i.a.object,i.a.string,i.a.func])},g=function(e){var a=e.className,t=e.cssModule,s=e.innerRef,r=e.tag,i=Object(l.a)(e,["className","cssModule","innerRef","tag"]),c=Object(m.i)(u()(a,"card-body"),t);return o.a.createElement(r,Object(n.a)({},i,{className:c,ref:s}))};g.propTypes=d,g.defaultProps={tag:"div"},a.a=g},13:function(e,a,t){"use strict";var n=t(245),l=t(247),s=t(1),o=t.n(s),r=t(0),i=t.n(r),c=t(244),u=t.n(c),m=t(246),d={tag:m.m,inverse:i.a.bool,color:i.a.string,block:Object(m.e)(i.a.bool,'Please use the props "body"'),body:i.a.bool,outline:i.a.bool,className:i.a.string,cssModule:i.a.object,innerRef:i.a.oneOfType([i.a.object,i.a.string,i.a.func])},g=function(e){var a=e.className,t=e.cssModule,s=e.color,r=e.block,i=e.body,c=e.inverse,d=e.outline,g=e.tag,h=e.innerRef,p=Object(l.a)(e,["className","cssModule","color","block","body","inverse","outline","tag","innerRef"]),b=Object(m.i)(u()(a,"card",!!c&&"text-white",!(!r&&!i)&&"card-body",!!s&&(d?"border":"bg")+"-"+s),t);return o.a.createElement(g,Object(n.a)({},p,{className:b,ref:h}))};g.propTypes=d,g.defaultProps={tag:"div"},a.a=g},22:function(e,a,t){"use strict";var n=t(245),l=t(247),s=t(1),o=t.n(s),r=t(0),i=t.n(r),c=t(244),u=t.n(c),m=t(246),d={tag:m.m,noGutters:i.a.bool,className:i.a.string,cssModule:i.a.object,form:i.a.bool},g=function(e){var a=e.className,t=e.cssModule,s=e.noGutters,r=e.tag,i=e.form,c=Object(l.a)(e,["className","cssModule","noGutters","tag","form"]),d=Object(m.i)(u()(a,s?"no-gutters":null,i?"form-row":"row"),t);return o.a.createElement(r,Object(n.a)({},c,{className:d}))};g.propTypes=d,g.defaultProps={tag:"div"},a.a=g},262:function(e,a,t){"use strict";var n=t(245),l=t(247),s=t(1),o=t.n(s),r=t(0),i=t.n(r),c=t(244),u=t.n(c),m=t(246),d={tag:m.m,className:i.a.string,cssModule:i.a.object},g=function(e){var a=e.className,t=e.cssModule,s=e.tag,r=Object(l.a)(e,["className","cssModule","tag"]),i=Object(m.i)(u()(a,"card-header"),t);return o.a.createElement(s,Object(n.a)({},r,{className:i}))};g.propTypes=d,g.defaultProps={tag:"div"},a.a=g},264:function(e,a,t){"use strict";var n=t(245),l=t(247),s=t(1),o=t.n(s),r=t(0),i=t.n(r),c=t(244),u=t.n(c),m=t(246),d={active:i.a.bool,children:i.a.node,className:i.a.string,cssModule:i.a.object,disabled:i.a.bool,tag:m.m},g=function(e){var a=e.active,t=e.className,s=e.cssModule,r=e.disabled,i=e.tag,c=Object(l.a)(e,["active","className","cssModule","disabled","tag"]),d=Object(m.i)(u()(t,"page-item",{active:a,disabled:r}),s);return o.a.createElement(i,Object(n.a)({},c,{className:d}))};g.propTypes=d,g.defaultProps={tag:"li"},a.a=g},265:function(e,a,t){"use strict";var n=t(245),l=t(247),s=t(1),o=t.n(s),r=t(0),i=t.n(r),c=t(244),u=t.n(c),m=t(246),d={"aria-label":i.a.string,children:i.a.node,className:i.a.string,cssModule:i.a.object,next:i.a.bool,previous:i.a.bool,tag:m.m},g=function(e){var a,t=e.className,s=e.cssModule,r=e.next,i=e.previous,c=e.tag,d=Object(l.a)(e,["className","cssModule","next","previous","tag"]),g=Object(m.i)(u()(t,"page-link"),s);i?a="Previous":r&&(a="Next");var h,p=e["aria-label"]||a;i?h="\xab":r&&(h="\xbb");var b=e.children;return b&&Array.isArray(b)&&0===b.length&&(b=null),d.href||"a"!==c||(c="button"),(i||r)&&(b=[o.a.createElement("span",{"aria-hidden":"true",key:"caret"},b||h),o.a.createElement("span",{className:"sr-only",key:"sr"},p)]),o.a.createElement(c,Object(n.a)({},d,{className:g,"aria-label":p}),b)};g.propTypes=d,g.defaultProps={tag:"a"},a.a=g},266:function(e,a,t){"use strict";var n=t(245),l=t(247),s=t(1),o=t.n(s),r=t(0),i=t.n(r),c=t(244),u=t.n(c),m=t(246),d={children:i.a.node,className:i.a.string,listClassName:i.a.string,cssModule:i.a.object,size:i.a.string,tag:m.m,listTag:m.m,"aria-label":i.a.string},g=function(e){var a,t=e.className,s=e.listClassName,r=e.cssModule,i=e.size,c=e.tag,d=e.listTag,g=e["aria-label"],h=Object(l.a)(e,["className","listClassName","cssModule","size","tag","listTag","aria-label"]),p=Object(m.i)(u()(t),r),b=Object(m.i)(u()(s,"pagination",((a={})["pagination-"+i]=!!i,a)),r);return o.a.createElement(c,{className:p,"aria-label":g},o.a.createElement(d,Object(n.a)({},h,{className:b})))};g.propTypes=d,g.defaultProps={tag:"nav",listTag:"ul","aria-label":"pagination"},a.a=g},268:function(e,a,t){"use strict";var n=t(245),l=t(247),s=t(1),o=t.n(s),r=t(0),i=t.n(r),c=t(244),u=t.n(c),m=t(246),d={className:i.a.string,cssModule:i.a.object,size:i.a.string,bordered:i.a.bool,borderless:i.a.bool,striped:i.a.bool,inverse:Object(m.e)(i.a.bool,'Please use the prop "dark"'),dark:i.a.bool,hover:i.a.bool,responsive:i.a.oneOfType([i.a.bool,i.a.string]),tag:m.m,responsiveTag:m.m,innerRef:i.a.oneOfType([i.a.func,i.a.string,i.a.object])},g=function(e){var a=e.className,t=e.cssModule,s=e.size,r=e.bordered,i=e.borderless,c=e.striped,d=e.inverse,g=e.dark,h=e.hover,p=e.responsive,b=e.tag,E=e.responsiveTag,f=e.innerRef,v=Object(l.a)(e,["className","cssModule","size","bordered","borderless","striped","inverse","dark","hover","responsive","tag","responsiveTag","innerRef"]),k=Object(m.i)(u()(a,"table",!!s&&"table-"+s,!!r&&"table-bordered",!!i&&"table-borderless",!!c&&"table-striped",!(!g&&!d)&&"table-dark",!!h&&"table-hover"),t),j=o.a.createElement(b,Object(n.a)({},v,{ref:f,className:k}));if(p){var P=!0===p?"table-responsive":"table-responsive-"+p;return o.a.createElement(E,{className:P},j)}return j};g.propTypes=d,g.defaultProps={tag:"table",responsiveTag:"div"},a.a=g},270:function(e,a,t){"use strict";var n=t(245),l=t(250),s=t(1),o=t.n(s),r=t(257),i=t(0),c=t.n(i),u=t(244),m=t.n(u),d=t(246),g={tag:d.m,activeTab:c.a.any,className:c.a.string,cssModule:c.a.object},h={activeTabId:c.a.any},p=function(e){function a(a){var t;return(t=e.call(this,a)||this).state={activeTab:t.props.activeTab},t}Object(l.a)(a,e),a.getDerivedStateFromProps=function(e,a){return a.activeTab!==e.activeTab?{activeTab:e.activeTab}:null};var t=a.prototype;return t.getChildContext=function(){return{activeTabId:this.state.activeTab}},t.render=function(){var e=this.props,a=e.className,t=e.cssModule,l=e.tag,s=Object(d.j)(this.props,Object.keys(g)),r=Object(d.i)(m()("tab-content",a),t);return o.a.createElement(l,Object(n.a)({},s,{className:r}))},a}(s.Component);Object(r.polyfill)(p),a.a=p,p.propTypes=g,p.defaultProps={tag:"div"},p.childContextTypes=h},271:function(e,a,t){"use strict";t.d(a,"a",function(){return h});var n=t(245),l=t(247),s=t(1),o=t.n(s),r=t(0),i=t.n(r),c=t(244),u=t.n(c),m=t(246),d={tag:m.m,className:i.a.string,cssModule:i.a.object,tabId:i.a.any},g={activeTabId:i.a.any};function h(e,a){var t=e.className,s=e.cssModule,r=e.tabId,i=e.tag,c=Object(l.a)(e,["className","cssModule","tabId","tag"]),d=Object(m.i)(u()("tab-pane",t,{active:r===a.activeTabId}),s);return o.a.createElement(i,Object(n.a)({},c,{className:d}))}h.propTypes=d,h.defaultProps={tag:"div"},h.contextTypes=g},549:function(e,a,t){"use strict";t.r(a);var n=t(88),l=t(89),s=t(91),o=t(90),r=t(92),i=t(93),c=t(1),u=t.n(c),m=t(308),d=t(365),g=t(279),h=t(536),p=t(264),b=t(265),E=t(266),f=t(268),v=t(539),k=t(307),j=t(540),P=t(22),y=t(271),C=t(13),O=t(262),N=t(12),S=t(562),x=t(537),T=t(538),U=t(541),D=t(542),I=t(528),w=t(525),A=t(526),M=t(527),F=t(270),K=t(255),B=t.n(K),R=t(254),G=function(e){function a(e){var t;return Object(n.a)(this,a),(t=Object(s.a)(this,Object(o.a)(a).call(this,e))).cekGrup=function(){localStorage.getItem("codexv-token-kelurahan")||localStorage.setItem("codexv-token-kelurahan","")},t.downloadGambar=function(e){return u.a.createElement(m.a,{method:"post",action:R.apiRoot+"attachments/foto-kelurahan/"+e,target:"_blank"},u.a.createElement(d.a,{type:"hidden",name:"session",value:localStorage.getItem("codexv-session")}),u.a.createElement(g.a,{color:"success"},u.a.createElement("i",{className:"fa fa-file-photo-o"}," Foto")))},t.downloadFileUsulan=function(e){if(""!==e)return u.a.createElement(m.a,{method:"post",action:R.apiRoot+"attachments/usulan-kelurahan/"+e,target:"_blank"},u.a.createElement(d.a,{type:"hidden",name:"session",value:localStorage.getItem("codexv-session")}),u.a.createElement(g.a,{color:"info"},u.a.createElement("i",{className:"fa fa-file-pdf-o"}," Usulan")))},t.downloadFileBA=function(e){if(""!==e)return u.a.createElement(m.a,{method:"post",action:R.apiRoot+"attachments/berita-acara-kelurahan/"+e,target:"_blank"},u.a.createElement(d.a,{type:"hidden",name:"session",value:localStorage.getItem("codexv-session")}),u.a.createElement(g.a,{color:"primary"},u.a.createElement("i",{className:"fa fa-file-pdf-o"}," Berita Acara")))},t.handleDelete=function(){var e=new FormData;e.append("session",localStorage.getItem("codexv-session")),e.append("token",localStorage.getItem("codexv-token-kelurahan")),e.append("id",t.state.dataPilih.id),B.a.post(R.apiRoot+"kelurahan/delete",e).then(function(e){e.data.status&&(t.toggleDelete(),t.getData()),t.changePesan(e.data.pesan)}).catch(function(e){console.log(e)})},t.changePesan=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null,a=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"success";null===e?t.setState({pesan:""}):t.setState({pesan:u.a.createElement(h.a,{color:a},e)}),setTimeout(function(){t.setState({pesan:""})},3e3)},t.handleNamaChange=function(e){var a=t.state.dataPilih;a.nama=e.target.value,t.setState({dataPilih:a})},t.handleAlasanChange=function(e){var a=t.state.dataPilih;a.alasan=e.target.value,t.setState({dataPilih:a})},t.handleLokasiChange=function(e){var a=t.state.dataPilih;a.lokasi=e.target.value,t.setState({dataPilih:a})},t.handleVolumeChange=function(e){var a=t.state.dataPilih;a.volume=e.target.value,t.setState({dataPilih:a})},t.handleSatuanChange=function(e){var a=t.state.dataPilih;a.satuan=e.target.value,t.setState({dataPilih:a})},t.handlePaguChange=function(e){var a=t.state.dataPilih;a.pagu=e.target.value,t.setState({dataPilih:a})},t.handleManfaatChange=function(e){var a=t.state.dataPilih;a.manfaat=e.target.value,t.setState({dataPilih:a})},t.handlePengusulChange=function(e){var a=t.state.dataPilih;a.pengusul=e.target.value,t.setState({dataPilih:a})},t.handleFileChange=function(e){var a=t.state.dataPilih;a.file={foto:e.target.files[0]},t.setState({dataPilih:a}),console.log(e.target.files)},t.handleKategoriChange=function(e){var a=t.state.dataPilih;a.kategori=e.target.value,t.setState({dataPilih:a})},t.handlePencarianChange=function(e){t.setState({pencarian:e.target.value})},t.handleUsulanChange=function(e){t.setState({berkasUsulan:e.target.files[0]})},t.handleBAChange=function(e){t.setState({berkasBA:e.target.files[0]})},t.handleBerkasSubmit=function(e){e.preventDefault();var a=new FormData;a.append("session",localStorage.getItem("codexv-session")),a.append("token",localStorage.getItem("codexv-token-kelurahan")),a.append("ba",t.state.berkasBA),a.append("usulan",t.state.berkasUsulan),B.a.post(R.apiRoot+"kelurahan/upload-berkas",a,{headers:{"Content-Type":"multipart/form-data"}}).then(function(e){e.data.status&&t.getData(),t.changePesan(e.data.pesan),console.log(e.data)}).catch(function(e){console.log(e)})},t.handleCariSubmit=function(e){e.preventDefault(),t.getData()},t.submitKirimBerkas=function(e){e.preventDefault();var a=R.apiRoot+"kelurahan/kirim-berkas",n=new FormData;n.append("session",localStorage.getItem("codexv-session")),n.append("token",localStorage.getItem("codexv-token-kelurahan")),B.a.post(a,n,{headers:{"Content-Type":"multipart/form-data"}}).then(function(e){e.data.status&&t.getData(),t.changePesan(e.data.pesan),console.log(e.data)}).catch(function(e){console.log(e)})},t.handleSubmit=function(e){e.preventDefault();var a="";"Edit"===t.state.aksi?a=R.apiRoot+"kelurahan/update":"Tambah"===t.state.aksi&&(a=R.apiRoot+"kelurahan/create");var n=new FormData;n.append("session",localStorage.getItem("codexv-session")),n.append("id",t.state.dataPilih.id),n.append("token",localStorage.getItem("codexv-token-kelurahan")),n.append("nama",t.state.dataPilih.nama),n.append("alasan",t.state.dataPilih.alasan),n.append("lokasi",t.state.dataPilih.lokasi),n.append("volume",t.state.dataPilih.volume),n.append("satuan",t.state.dataPilih.satuan),n.append("pagu",t.state.dataPilih.pagu),n.append("manfaat",t.state.dataPilih.manfaat),n.append("pengusul",t.state.dataPilih.pengusul),n.append("file",t.state.dataPilih.file.foto),n.append("kategori",t.state.dataPilih.kategori),B.a.post(a,n,{headers:{"Content-Type":"multipart/form-data"}}).then(function(e){e.data.status&&(t.toggleClose(),t.getData()),t.changePesan(e.data.pesan),console.log(e.data)}).catch(function(e){console.log(e)})},t.componentWillMount=function(){t.cekGrup(),t.getData(),t.getSatuan(),t.getKiriman()},t.setData=function(e){e.status&&t.setState({dataAll:e.data,jumlahPage:e.jumlahPage,jumlahAll:e.jumlahAll,dataKategori:e.kategori})},t.getData=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1,a=new FormData;a.append("session",localStorage.getItem("codexv-session")),a.append("token",localStorage.getItem("codexv-token-kelurahan")),a.append("search",t.state.pencarian),B.a.post(R.apiRoot+"kelurahan/page-"+e,a).then(function(e){t.setData(e.data),console.log(e)}).catch(function(e){console.log(e)})},t.getKiriman=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1,a=new FormData;a.append("session",localStorage.getItem("codexv-session")),a.append("token",localStorage.getItem("codexv-token-kelurahan")),a.append("search",t.state.pencarian),B.a.post(R.apiRoot+"kelurahan/kiriman/page-"+e,a).then(function(e){e.data.status&&t.setState({dataKiriman:e.data.data,jumlahPageKiriman:e.data.jumlahPage,jumlahAllKiriman:e.data.jumlahAll}),console.log(e)}).catch(function(e){console.log(e)})},t.getGrup=function(){var e=new FormData;e.append("session",localStorage.getItem("codexv-session")),B.a.post(R.apiRoot+"kelurahan/createGrup",e).then(function(e){if(e.data.status){localStorage.setItem("codexv-token-kelurahan",e.data.token);var a=t.state.dataPilih;a.token=e.data.token,t.setState({dataPilih:a}),t.getData(),t.modalUsulan(),t.toggleTab(3,"2")}}).catch(function(e){console.log(e)})},t.getSatuan=function(){var e=new FormData;e.append("session",localStorage.getItem("codexv-session")),B.a.post(R.apiRoot+"getData/satuan",e).then(function(e){e.data.status&&t.setState({dataSatuan:e.data.data})}).catch(function(e){console.log(e)})},t.getGrupKiriman=function(e){var a=new FormData;a.append("session",localStorage.getItem("codexv-session")),a.append("id",e.id),B.a.post(R.apiRoot+"kelurahan/get-grup",a).then(function(e){if(e.data.status){localStorage.setItem("codexv-token-kelurahan",e.data.token);var a=t.state.dataPilih;a.token=e.data.token,t.setState({dataPilih:a}),t.getData(),t.toggleTab(3,"2")}console.log(e)}).catch(function(e){console.log(e)})},t.changePage=function(e){t.setState({page:e}),t.getData(e)},t.pageNation=function(){var e=[];t.state.page>1?e.push(u.a.createElement(p.a,{onClick:function(){return t.changePage(t.state.page-1)},key:0},u.a.createElement(b.a,{previous:!0,tag:"button"},"Prev"))):e.push(u.a.createElement(p.a,{disabled:!0,key:0},u.a.createElement(b.a,{previous:!0,tag:"button"},"Prev")));for(var a=!1,n=!1,l=function(l){n=a,a=!1,l+2>=t.state.page&&l-2<=t.state.page&&(a=!0),1!==l&&l!==t.state.jumlahPage||(a=!0),a?l===t.state.page?e.push(u.a.createElement(p.a,{active:!0,key:l},u.a.createElement(b.a,{tag:"button"},l))):e.push(u.a.createElement(p.a,{key:l,onClick:function(){return t.changePage(l)}},u.a.createElement(b.a,{tag:"button"},l))):n!==a&&e.push(u.a.createElement(p.a,{key:l,disabled:!0},u.a.createElement(b.a,{tag:"button"},"...")))},s=1;s<=t.state.jumlahPage;s++)l(s);return t.state.page<t.state.jumlahPage?e.push(u.a.createElement(p.a,{onClick:function(){return t.changePage(t.state.page+1)},key:t.state.jumlahPage+2},u.a.createElement(b.a,{next:!0,tag:"button"},"Next"))):e.push(u.a.createElement(p.a,{disabled:!0,key:t.state.jumlahPage+2},u.a.createElement(b.a,{next:!0,tag:"button"},"Next"))),u.a.createElement(E.a,null,e)},t.dataPilihAwal={token:"",id:0,nama:"",alasan:"",lokasi:"",volume:0,satuan:0,pagu:"0",manfaat:"",pengusul:"",file:{foto:""},kategori:0},t.state={dataAll:[],dataSatuan:[],dataKiriman:[],dataKategori:[],jumlahPage:1,jumlahAll:0,modal:!1,modalDelete:!1,modalUsulan:!1,dataPilih:t.dataPilihAwal,pencarian:"",page:1,aksi:"Tambah",fileForm:[],pesan:"",activeTab:new Array(4).fill("1"),berkasBA:"",berkasUsulan:""},t.toggleTab=t.toggleTab.bind(Object(i.a)(Object(i.a)(t))),t.toggleClose=t.toggleClose.bind(Object(i.a)(Object(i.a)(t))),t.toggle=t.toggle.bind(Object(i.a)(Object(i.a)(t))),t.toggleDelete=t.toggleDelete.bind(Object(i.a)(Object(i.a)(t))),t.modalUsulan=t.modalUsulan.bind(Object(i.a)(Object(i.a)(t))),t.changePesan=t.changePesan.bind(Object(i.a)(Object(i.a)(t))),t.setData=t.setData.bind(Object(i.a)(Object(i.a)(t))),t.getData=t.getData.bind(Object(i.a)(Object(i.a)(t))),t.getKiriman=t.getKiriman.bind(Object(i.a)(Object(i.a)(t))),t.handleKategoriChange=t.handleKategoriChange.bind(Object(i.a)(Object(i.a)(t))),t.getSatuan=t.getSatuan.bind(Object(i.a)(Object(i.a)(t))),t.getGrup=t.getGrup.bind(Object(i.a)(Object(i.a)(t))),t.handleDelete=t.handleDelete.bind(Object(i.a)(Object(i.a)(t))),t.handlePencarianChange=t.handlePencarianChange.bind(Object(i.a)(Object(i.a)(t))),t.handleNamaChange=t.handleNamaChange.bind(Object(i.a)(Object(i.a)(t))),t.handleAlasanChange=t.handleAlasanChange.bind(Object(i.a)(Object(i.a)(t))),t.handleLokasiChange=t.handleLokasiChange.bind(Object(i.a)(Object(i.a)(t))),t.handleVolumeChange=t.handleVolumeChange.bind(Object(i.a)(Object(i.a)(t))),t.handleSatuanChange=t.handleSatuanChange.bind(Object(i.a)(Object(i.a)(t))),t.handlePaguChange=t.handlePaguChange.bind(Object(i.a)(Object(i.a)(t))),t.handleManfaatChange=t.handleManfaatChange.bind(Object(i.a)(Object(i.a)(t))),t.handlePengusulChange=t.handlePengusulChange.bind(Object(i.a)(Object(i.a)(t))),t.handleFileChange=t.handleFileChange.bind(Object(i.a)(Object(i.a)(t))),t.handleBAChange=t.handleBAChange.bind(Object(i.a)(Object(i.a)(t))),t.handleUsulanChange=t.handleUsulanChange.bind(Object(i.a)(Object(i.a)(t))),t.handleBerkasSubmit=t.handleBerkasSubmit.bind(Object(i.a)(Object(i.a)(t))),t.submitKirimBerkas=t.submitKirimBerkas.bind(Object(i.a)(Object(i.a)(t))),t.cekGrup=t.cekGrup.bind(Object(i.a)(Object(i.a)(t))),t}return Object(r.a)(a,e),Object(l.a)(a,[{key:"lorem",value:function(){return"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit."}},{key:"setPosisi",value:function(e){var a="";return 1===parseInt(e)?a="Menunggu Mendownload Berita Acara":2===parseInt(e)?a="Menunggu Input Usulan":3===parseInt(e)?a="Menunggu Upload Berkas":4===parseInt(e)?a="Siap Untuk Dikirim ke Kecamatan":5===parseInt(e)&&(a="Usulan Telah Terkirim"),u.a.createElement("div",null,a)}},{key:"getAsal",value:function(e){var a="";return arguments.length>1&&void 0!==arguments[1]&&arguments[1]?a=0===parseInt(e)?"Kecamatan":"Kelurahan":1===parseInt(e)?a="Kelurahan":2===parseInt(e)&&(a="Kecamatan"),u.a.createElement("p",null,a)}},{key:"mulaiUsulanBaru",value:function(){var e=this;return u.a.createElement("div",null,u.a.createElement(g.a,{color:"secondary",onClick:function(){return e.modalUsulan()}},"Memulai Usulan"),u.a.createElement(f.a,{responsive:!0,striped:!0},u.a.createElement("thead",null,u.a.createElement("tr",null,u.a.createElement("th",null,"Grup ID"),u.a.createElement("th",null,"Tanggal Pembuatan"),u.a.createElement("th",null,"Asal Pembuatan"),u.a.createElement("th",null,"Posisi"),u.a.createElement("th",null,"Aksi"))),u.a.createElement("tbody",null,this.state.dataKiriman.map(function(a,t){return a?u.a.createElement("tr",{key:t},u.a.createElement("td",null,a.id),u.a.createElement("td",null,a.tgl),u.a.createElement("td",null,e.getAsal(a.user_kel,!0)),u.a.createElement("td",null,e.setPosisi(a.posisi)),u.a.createElement("td",null,u.a.createElement(g.a,{color:"info",onClick:function(){e.getGrupKiriman(a)},className:"mr-1"},"Periksa"),u.a.createElement(m.a,{method:"post",action:R.apiRoot+"data/export/kelurahan",target:"_blank"},u.a.createElement(d.a,{type:"hidden",name:"session",value:localStorage.getItem("codexv-session")}),u.a.createElement(d.a,{type:"hidden",name:"id",value:a.id}),u.a.createElement(d.a,{type:"hidden",name:"jenis",value:"kelurahan"}),u.a.createElement(g.a,{color:"secondary"},"Export")))):null}))),this.pageNation())}},{key:"downloadBA",value:function(){return u.a.createElement(m.a,{method:"post",action:R.apiRoot+"kelurahan/get-pdf/berita-acara-kelurahan",target:"_blank"},u.a.createElement(d.a,{type:"hidden",name:"session",value:localStorage.getItem("codexv-session")}),u.a.createElement(d.a,{type:"hidden",name:"token",value:localStorage.getItem("codexv-token-kelurahan")}),u.a.createElement(d.a,{type:"hidden",name:"jenis",value:"ba"}),u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{md:"2"},u.a.createElement(j.a,{htmlFor:"text-input"},"Masukkan Jumlah Peserta")),u.a.createElement(k.a,{xs:"12",md:"3"},u.a.createElement(d.a,{type:"number",name:"orang"}))),u.a.createElement(g.a,{color:"secondary"},"Download Berita Acara"))}},{key:"downloadUsulan",value:function(){return u.a.createElement(m.a,{method:"post",action:R.apiRoot+"kelurahan/get-pdf/usulan-kelurahan",target:"_blank"},u.a.createElement(d.a,{type:"hidden",name:"session",value:localStorage.getItem("codexv-session")}),u.a.createElement(d.a,{type:"hidden",name:"token",value:localStorage.getItem("codexv-token-kelurahan")}),u.a.createElement(d.a,{type:"hidden",name:"jenis",value:"usulan"}),u.a.createElement(g.a,{color:"secondary"},"Download Usulan"))}},{key:"inputUsulan",value:function(){var e=this;return u.a.createElement("div",{className:"animated fadeIn"},u.a.createElement(P.a,null,u.a.createElement(k.a,{xs:"128",md:"10"},u.a.createElement(m.a,{method:"post",onSubmit:this.handleCariSubmit,className:"form-horizontal"},u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{xs:"9",md:"5"},u.a.createElement(d.a,{type:"text",onChange:this.handlePencarianChange,id:"text-input-pencarian",name:"pencarian",placeholder:"Pencarian"})),u.a.createElement(k.a,{xs:"3",md:"2"},u.a.createElement(g.a,{color:"primary"},"Cari"))))),u.a.createElement(k.a,{xs:"12",md:"2"},u.a.createElement(g.a,{color:"primary",onClick:function(){e.setState({aksi:"Tambah"}),e.toggle()},className:"mr-1"},"Tambah Usulan"))),u.a.createElement(f.a,{responsive:!0,striped:!0},u.a.createElement("thead",null,u.a.createElement("tr",null,u.a.createElement("th",null,"Nama Usulan"),u.a.createElement("th",null,"Alasan Usulan"),u.a.createElement("th",null,"Lokasi Detail"),u.a.createElement("th",null,"Volume Usulan"),u.a.createElement("th",null,"Satuan Usulan"),u.a.createElement("th",null,"Pagu Anggaran"),u.a.createElement("th",null,"Penerima Manfaat"),u.a.createElement("th",null,"Nama Pengusul"),u.a.createElement("th",null,"Kategori"),u.a.createElement("th",null,"File"),u.a.createElement("th",null,"Aksi"))),u.a.createElement("tbody",null,this.state.dataAll.map(function(a,t){return a?u.a.createElement("tr",{key:t},u.a.createElement("td",null,a.nama),u.a.createElement("td",null,a.alasan),u.a.createElement("td",null,a.lokasi),u.a.createElement("td",null,a.volume),u.a.createElement("td",null,a.nama_satuan),u.a.createElement("td",null,a.pagu),u.a.createElement("td",null,a.manfaat),u.a.createElement("td",null,a.pengusul),u.a.createElement("td",null,a.kategori),u.a.createElement("td",null,e.downloadGambar(a.file),e.downloadFileBA(a.berkas_ba),e.downloadFileUsulan(a.berkas_usulan)),u.a.createElement("td",null,u.a.createElement(g.a,{color:"info",onClick:function(){e.setState({aksi:"Edit"}),e.toggle(a)},className:"mr-1"},"Edit"),"|",u.a.createElement(g.a,{color:"danger",onClick:function(){return e.toggleDelete(a)},className:"mr-1"},"Delete"))):null}))),this.pageNation())}},{key:"uploadBerkas",value:function(){return u.a.createElement(m.a,{method:"post",onSubmit:this.handleBerkasSubmit,id:"form-upload-berkas"},u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{md:"2"},u.a.createElement(j.a,{htmlFor:"file-multiple-input"},"Upload Berita Acara dan Absen")),u.a.createElement(k.a,{xs:"12",md:"10"},u.a.createElement(d.a,{type:"file",id:"berita",onChange:this.handleBAChange}))),u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{md:"2"},u.a.createElement(j.a,{htmlFor:"file-multiple-input"},"Upload Lampiran Usulan")),u.a.createElement(k.a,{xs:"12",md:"10"},u.a.createElement(d.a,{type:"file",id:"usulan",onChange:this.handleUsulanChange}))),u.a.createElement(g.a,{color:"primary",type:"submit",form:"form-upload-berkas",value:"Submit"},"Upload Berkas"))}},{key:"kirimUsulan",value:function(){return u.a.createElement(m.a,{method:"post",onSubmit:this.submitKirimBerkas,id:"form-kirim-berkas"},u.a.createElement(g.a,{color:"secondary"},"Kirim Berkas Ke Kecamatan"))}},{key:"toggleTab",value:function(e,a){var t=this.state.activeTab.slice();t[e]=a,this.setState({activeTab:t})}},{key:"tabPane",value:function(){return u.a.createElement(u.a.Fragment,null,u.a.createElement(y.a,{tabId:"1"},this.mulaiUsulanBaru()),u.a.createElement(y.a,{tabId:"2"},this.downloadBA()),u.a.createElement(y.a,{tabId:"3"},this.inputUsulan()),u.a.createElement(y.a,{tabId:"4"},this.downloadUsulan()),u.a.createElement(y.a,{tabId:"5"},this.uploadBerkas()),u.a.createElement(y.a,{tabId:"6"},this.kirimUsulan()))}},{key:"toggleClose",value:function(){arguments.length>0&&void 0!==arguments[0]&&arguments[0];this.setState({modal:!1})}},{key:"toggle",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];0===e.length?this.setState({modal:!0,dataPilih:this.dataPilihAwal}):this.setState({modal:!0,dataPilih:e})}},{key:"toggleDelete",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.setState({modalDelete:!this.state.modalDelete,dataPilih:e})}},{key:"modalUsulan",value:function(){this.setState({modalUsulan:!this.state.modalUsulan})}},{key:"render",value:function(){var e=this;return u.a.createElement("div",{className:"animated fadeIn"},u.a.createElement(P.a,null,u.a.createElement(k.a,{xs:"12",lg:"12"},u.a.createElement(C.a,null,u.a.createElement(O.a,null,u.a.createElement("i",{className:"fa fa-align-justify"})," Striped Table"),u.a.createElement(N.a,null,this.state.pesan,u.a.createElement(S.a,{isOpen:this.state.modal,toggle:this.toggleClose,className:"modal-lg "+this.props.className},u.a.createElement(x.a,{toggle:this.toggleClose},this.state.aksi," Data"),u.a.createElement(m.a,{method:"post",onSubmit:this.handleSubmit,className:"form-horizontal",id:"form-data"},u.a.createElement(T.a,null,this.state.pesan,u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{md:"3"},u.a.createElement(j.a,{htmlFor:"text-input"},"Nama Usulan *")),u.a.createElement(k.a,{xs:"12",md:"9"},u.a.createElement(d.a,{type:"text",id:"nama",placeholder:"",onChange:this.handleNamaChange,value:this.state.dataPilih.nama,required:!0,autoFocus:!0}),u.a.createElement(U.a,{color:"muted"},"Isi Nama Usulan"))),u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{md:"3"},u.a.createElement(j.a,{htmlFor:"text-input"},"Alasan Usulan *")),u.a.createElement(k.a,{xs:"12",md:"9"},u.a.createElement(d.a,{type:"text",id:"alasan",placeholder:"",onChange:this.handleAlasanChange,value:this.state.dataPilih.alasan,required:!0,autoFocus:!0}),u.a.createElement(U.a,{color:"muted"},"Isi Alasan Usulan"))),u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{md:"3"},u.a.createElement(j.a,{htmlFor:"text-input"},"Lokasi Detail *")),u.a.createElement(k.a,{xs:"12",md:"9"},u.a.createElement(d.a,{type:"text",id:"lokasi",placeholder:"",onChange:this.handleLokasiChange,value:this.state.dataPilih.lokasi,required:!0,autoFocus:!0}),u.a.createElement(U.a,{color:"muted"},"Isi Lokasi Usulan"))),u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{md:"3"},u.a.createElement(j.a,{htmlFor:"text-input"},"Volume Usulan *")),u.a.createElement(k.a,{xs:"12",md:"9"},u.a.createElement(d.a,{type:"text",id:"volume",placeholder:"",onChange:this.handleVolumeChange,value:this.state.dataPilih.volume,required:!0,autoFocus:!0}),u.a.createElement(U.a,{color:"muted"},"Isi Volume Usulan"))),u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{md:"3"},u.a.createElement(j.a,{htmlFor:"selectLg"},"Satuan Usulan *")),u.a.createElement(k.a,{xs:"12",md:"9",size:"lg"},u.a.createElement(d.a,{type:"select",name:"satuan",bsSize:"lg",onChange:this.handleSatuanChange,required:!0,autoFocus:!0},u.a.createElement("option",{key:0,value:""},"-= Pilh Satuan =-"),this.state.dataSatuan.map(function(e,a){return e?u.a.createElement("option",{key:a,value:e.Kd_Satuan},e.Uraian):null})))),u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{md:"3"},u.a.createElement(j.a,{htmlFor:"selectLg"},"Kategori *")),u.a.createElement(k.a,{xs:"12",md:"9",size:"lg"},u.a.createElement(d.a,{type:"select",name:"satuan",bsSize:"lg",onChange:this.handleKategoriChange,required:!0,autoFocus:!0},u.a.createElement("option",{key:0,value:""},"-= Pilh Kategori =-"),this.state.dataKategori.map(function(e,a){return e?u.a.createElement("option",{key:a,value:e.id},e.kategori):null})))),u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{md:"3"},u.a.createElement(j.a,{htmlFor:"text-input"},"Pagu Anggaran *")),u.a.createElement(k.a,{xs:"12",md:"9"},u.a.createElement(d.a,{type:"text",id:"pagu",placeholder:"",onChange:this.handlePaguChange,value:this.state.dataPilih.pagu,required:!0,autoFocus:!0}),u.a.createElement(U.a,{color:"muted"},"Isi Pagu Anggaran"))),u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{md:"3"},u.a.createElement(j.a,{htmlFor:"text-input"},"Penerima Manfaat *")),u.a.createElement(k.a,{xs:"12",md:"9"},u.a.createElement(d.a,{type:"text",id:"manfaat",placeholder:"",onChange:this.handleManfaatChange,value:this.state.dataPilih.manfaat,required:!0,autoFocus:!0}),u.a.createElement(U.a,{color:"muted"},"Isi Penerima Manfaat"))),u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{md:"3"},u.a.createElement(j.a,{htmlFor:"text-input"},"Nama Pengusul *")),u.a.createElement(k.a,{xs:"12",md:"9"},u.a.createElement(d.a,{type:"text",id:"pengusul",placeholder:"",onChange:this.handlePengusulChange,value:this.state.dataPilih.pengusul,required:!0,autoFocus:!0}),u.a.createElement(U.a,{color:"muted"},"Isi Nama Pengusul"))),u.a.createElement(v.a,{row:!0},u.a.createElement(k.a,{md:"3"},u.a.createElement(j.a,{htmlFor:"file-multiple-input"},"Upload Foto")),u.a.createElement(k.a,{xs:"12",md:"9"},u.a.createElement(d.a,{type:"file",id:"foto",onChange:this.handleFileChange})))),u.a.createElement(D.a,null,u.a.createElement(g.a,{color:"primary",type:"submit",form:"form-data",value:"Submit"},this.state.aksi," Data"),u.a.createElement(g.a,{color:"secondary",onClick:this.toggleClose},"Cancel")))),u.a.createElement(S.a,{isOpen:this.state.modalUsulan,toggle:this.modalUsulan,className:this.props.className},u.a.createElement(x.a,{toggle:this.modalUsulan},"Memulai Usulan Kelurahan"),u.a.createElement(T.a,null,u.a.createElement("div",null,u.a.createElement(k.a,{md:"12"},"Apakah Yakin Memulai Usulan Baru?"))),u.a.createElement(D.a,null,u.a.createElement(g.a,{color:"danger",onClick:this.getGrup},"Ya")," ",u.a.createElement(g.a,{color:"secondary",onClick:this.modalUsulan},"Batal"))),u.a.createElement(S.a,{isOpen:this.state.modalDelete,toggle:this.toggleDelete,className:this.props.className},u.a.createElement(x.a,{toggle:this.toggleDelete},"Hapus Data"),u.a.createElement(T.a,null,"Apakah Anda Yakin Menghapus Data ",this.state.dataPilih.nama,"?"),u.a.createElement(D.a,null,u.a.createElement(g.a,{color:"danger",onClick:this.handleDelete},"Ya")," ",u.a.createElement(g.a,{color:"secondary",onClick:this.toggleDelete},"Batal"))),u.a.createElement(k.a,{xs:"12",md:"12",className:"mb-12"},u.a.createElement(I.a,{tabs:!0},u.a.createElement(w.a,null,u.a.createElement(A.a,{active:"1"===this.state.activeTab[3],onClick:function(){e.toggleTab(3,"1")}},u.a.createElement("i",{className:"cui-laptop icons font-2xl"}),u.a.createElement("span",{className:"1"===this.state.activeTab[3]?"":"d-none"}," Membuat Usulan Baru"),"\xa0",u.a.createElement(M.a,{color:"success"},"New"))),u.a.createElement(w.a,null,u.a.createElement(A.a,{active:"2"===this.state.activeTab[3],onClick:function(){e.toggleTab(3,"2")}},u.a.createElement("i",{className:"cui-cloud-download icons font-2xl"}),u.a.createElement("span",{className:"2"===this.state.activeTab[3]?"":"d-none"}," Download Berita Acara"))),u.a.createElement(w.a,null,u.a.createElement(A.a,{active:"3"===this.state.activeTab[3],onClick:function(){e.toggleTab(3,"3")}},u.a.createElement("i",{className:"cui-layers icons font-2xl "}),u.a.createElement("span",{className:"3"===this.state.activeTab[3]?"":"d-none"}," Masukkan Usulan"),"\xa0",u.a.createElement(M.a,{pill:!0,color:"danger"},this.state.jumlahAll))),u.a.createElement(w.a,null,u.a.createElement(A.a,{active:"4"===this.state.activeTab[3],onClick:function(){e.toggleTab(3,"4")}},u.a.createElement("i",{className:"fa fa-cloud-download icons font-2xl"}),u.a.createElement("span",{className:"4"===this.state.activeTab[3]?"":"d-none"}," Download Lampiran Usulan"))),u.a.createElement(w.a,null,u.a.createElement(A.a,{active:"5"===this.state.activeTab[3],onClick:function(){e.toggleTab(3,"5")}},u.a.createElement("i",{className:"fa fa-cloud-upload icons font-2xl"}),u.a.createElement("span",{className:"5"===this.state.activeTab[3]?"":"d-none"}," Upload Berkas"))),u.a.createElement(w.a,null,u.a.createElement(A.a,{active:"6"===this.state.activeTab[3],onClick:function(){e.toggleTab(3,"6")}},u.a.createElement("i",{className:"fa fa-send icons font-2xl"}),u.a.createElement("span",{className:"6"===this.state.activeTab[3]?"":"d-none"}," Kirim Ke Kecamatan")))),u.a.createElement(F.a,{activeTab:this.state.activeTab[3]},this.tabPane())))))))}}]),a}(c.Component);a.default=G}}]);
//# sourceMappingURL=14.629a278c.chunk.js.map