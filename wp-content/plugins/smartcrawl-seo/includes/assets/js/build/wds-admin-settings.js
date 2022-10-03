!function(){var e={4184:function(e,t){var s;!function(){"use strict";var r={}.hasOwnProperty;function o(){for(var e=[],t=0;t<arguments.length;t++){var s=arguments[t];if(s){var n=typeof s;if("string"===n||"number"===n)e.push(s);else if(Array.isArray(s)){if(s.length){var i=o.apply(null,s);i&&e.push(i)}}else if("object"===n)if(s.toString===Object.prototype.toString)for(var a in s)r.call(s,a)&&s[a]&&e.push(a);else e.push(s.toString())}}return e.join(" ")}e.exports?(o.default=o,e.exports=o):void 0===(s=function(){return o}.apply(t,[]))||(e.exports=s)}()}},t={};function s(r){var o=t[r];if(void 0!==o)return o.exports;var n=t[r]={exports:{}};return e[r](n,n.exports,s),n.exports}s.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return s.d(t,{a:t}),t},s.d=function(e,t){for(var r in t)s.o(t,r)&&!s.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},s.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){"use strict";var e=window.wp.element,t=window.ReactDOM,r=window.React,o=s.n(r);class n extends o().Component{constructor(e){super(e),this.state={hasError:!1}}static getDerivedStateFromError(){return{hasError:!0}}componentDidCatch(e,t){console.error(e),console.error(t)}render(){return this.state.hasError?(0,e.createElement)("div",{className:"sui-notice sui-notice-error"},(0,e.createElement)("div",{className:"sui-notice-content"},(0,e.createElement)("div",{className:"sui-notice-message"},(0,e.createElement)("span",{className:"sui-notice-icon sui-icon-warning-alert sui-md","aria-hidden":"true"}),(0,e.createElement)("p",null,(0,e.createElement)("strong",null,"Something went wrong. Please contact ",(0,e.createElement)("a",{target:"_blank",href:"https://wpmudev.com/get-support/"},"support"),"."))))):this.props.children}}var i=n;function a(){return(a=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var s=arguments[t];for(var r in s)Object.prototype.hasOwnProperty.call(s,r)&&(e[r]=s[r])}return e}).apply(this,arguments)}function l(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var c=s(4184),d=s.n(c);class u extends o().Component{handleClick(e){e.preventDefault(),this.props.onClick()}render(){let t,s;this.props.href?(t="a",s={href:this.props.href,target:this.props.target}):(t="button",s={disabled:this.props.disabled,onClick:e=>this.handleClick(e)});const r=this.props.text&&this.props.text.trim();return(0,e.createElement)(o().Fragment,null,(0,e.createElement)(t,a({},s,{className:d()(this.props.className,"sui-button-"+this.props.color,{"sui-button-onload":this.props.loading,"sui-button-ghost":this.props.ghost,"sui-button-icon":!r,"sui-button-dashed":this.props.dashed,"sui-button":r}),id:this.props.id}),this.text(),this.loadingIcon()))}text(){const t=this.props.icon?(0,e.createElement)("span",{className:this.props.icon,"aria-hidden":"true"}):"";return(0,e.createElement)("span",{className:d()({"sui-loading-text":this.props.loading})},t," ",this.props.text)}loadingIcon(){return this.props.loading?(0,e.createElement)("span",{className:"sui-icon-loader sui-loading","aria-hidden":"true"}):""}}l(u,"defaultProps",{id:"",text:"",color:"",dashed:!1,icon:!1,loading:!1,ghost:!1,disabled:!1,href:"",target:"",className:"",onClick:()=>!1});var p=window.wp.i18n,h=SUI,m=s.n(h),g=jQuery,f=s.n(g);class w extends o().Component{constructor(e){super(e),this.props=e}componentDidMount(){m().openModal(this.props.id,this.props.focusAfterClose,this.props.focusAfterOpen?this.props.focusAfterOpen:this.getTitleId(),!1,!1)}componentWillUnmount(){m().closeModal()}handleKeyDown(e){f()(e.target).is(".sui-modal.sui-active input")&&13===e.keyCode&&(e.preventDefault(),e.stopPropagation(),!this.props.enterDisabled&&this.props.onEnter&&this.props.onEnter(e))}render(){const t=this.getHeaderActions(),s=Object.assign({},{"sui-modal-sm":this.props.small,"sui-modal-lg":!this.props.small},this.props.dialogClasses);return(0,e.createElement)("div",{className:d()("sui-modal",s),onKeyDown:e=>this.handleKeyDown(e)},(0,e.createElement)("div",{role:"dialog",id:this.props.id,className:d()("sui-modal-content",this.props.id+"-modal"),"aria-modal":"true","aria-labelledby":this.props.id+"-modal-title","aria-describedby":this.props.id+"-modal-description"},(0,e.createElement)("div",{className:"sui-box",role:"document"},(0,e.createElement)("div",{className:d()("sui-box-header",{"sui-flatten sui-content-center sui-spacing-top--40":this.props.small})},this.props.beforeTitle,(0,e.createElement)("h3",{id:this.getTitleId(),className:d()("sui-box-title",{"sui-lg":this.props.small})},this.props.title),t),(0,e.createElement)("div",{className:d()("sui-box-body",{"sui-content-center":this.props.small})},this.props.description&&(0,e.createElement)("p",{className:"sui-description",id:this.props.id+"-modal-description"},this.props.description),this.props.children),this.props.footer&&(0,e.createElement)("div",{className:"sui-box-footer"},this.props.footer))))}getTitleId(){return this.props.id+"-modal-title"}getHeaderActions(){const t=this.getCloseButton();return this.props.small?t:this.props.headerActions?this.props.headerActions:(0,e.createElement)("div",{className:"sui-actions-right"},t)}getCloseButton(){return(0,e.createElement)("button",{id:this.props.id+"-close-button",type:"button",onClick:()=>this.props.onClose(),disabled:this.props.disableCloseButton,className:d()("sui-button-icon",{"sui-button-float--right":this.props.small})},(0,e.createElement)("span",{className:"sui-icon-close sui-md","aria-hidden":"true"}),(0,e.createElement)("span",{className:"sui-screen-reader-text"},(0,p.__)("Close this dialog window","wds")))}}l(w,"defaultProps",{id:"",title:"",description:"",small:!1,headerActions:!1,focusAfterOpen:"",focusAfterClose:"container",dialogClasses:[],disableCloseButton:!1,enterDisabled:!1,onEnter:!1,beforeTitle:!1,onClose:()=>!1});var E=class{static get(e,t="general"){Array.isArray(e)||(e=[e]);let s=window["_wds_"+t]||{};return e.forEach((e=>{s=s&&s.hasOwnProperty(e)?s[e]:""})),s}static get_bool(e,t="general"){return!!this.get(e,t)}},b=ajaxurl,v=s.n(b);class _{static post(e,t,s={}){return new Promise((function(r,o){const n=Object.assign({},{action:e,_wds_nonce:t},s);f().post(v(),n).done((e=>{var t;e.success?r(null==e?void 0:e.data):o(null==e||null===(t=e.data)||void 0===t?void 0:t.message)})).fail((()=>o()))}))}static uploadFile(e,t,s){const r=new FormData;return r.append("file",s),r.append("action",e),r.append("_wds_nonce",t),new Promise(((e,t)=>{f().ajax({url:v(),cache:!1,contentType:!1,processData:!1,type:"post",data:r}).done((s=>{var r;s.success?e(null==s?void 0:s.data):t(null==s||null===(r=s.data)||void 0===r?void 0:r.message)})).fail((()=>t()))}))}}class C extends r.Component{constructor(e){super(e),this.state={requestInProgress:!1}}resetData(){this.requestInProgress(!0).then((()=>{this.post("wds_data_reset").then((()=>{this.props.afterReset()})).finally((()=>this.requestInProgress(!1))).catch((()=>this.props.onError()))}))}requestInProgress(e){return new Promise((t=>{this.setState({requestInProgress:e},t)}))}render(){return(0,e.createElement)(w,{id:"wds-data-reset-modal",title:(0,p.__)("Reset Settings & Data","wds"),description:(0,p.__)("Are you sure you want to reset SmartCrawl’s settings and data back to the factory defaults?","wds"),focusAfterOpen:"wds-data-reset-cancel-button",focusAfterClose:"wds-data-reset-button",disableCloseButton:this.state.requestInProgress,onClose:()=>this.props.onClose(),small:!0},(0,e.createElement)(u,{id:"wds-data-reset-cancel-button",text:(0,p.__)("Cancel","wds"),ghost:!0,disabled:this.state.requestInProgress,onClick:()=>this.props.onClose()}),(0,e.createElement)(u,{ghost:!0,color:"red",icon:"sui-icon-refresh",loading:this.state.requestInProgress,onClick:()=>this.resetData(),text:(0,p.__)("Reset","wds")}))}post(e){const t=E.get("nonce","reset");return _.post(e,t)}}l(C,"defaultProps",{onClose:()=>!1,afterReset:()=>!1,onError:()=>!1});class N extends o().Component{render(){return(0,e.createElement)("div",{className:"sui-floating-notices"},(0,e.createElement)("div",{role:"alert",id:this.props.id,className:"sui-notice","aria-live":"assertive"}))}}l(N,"defaultProps",{id:""});class y{static showSuccessNotice(e,t,s=!0){return this.showNotice(e,t,"success",s)}static showErrorNotice(e,t,s=!0){return this.showNotice(e,t,"error",s)}static showInfoNotice(e,t,s=!0){return this.showNotice(e,t,"info",s)}static showWarningNotice(e,t,s=!0){return this.showNotice(e,t,"warning",s)}static closeNotice(e){SUI.closeNotice(e)}static showNotice(e,t,s="success",r=!0){SUI.closeNotice(e),SUI.openNotice(e,"<p>"+t+"</p>",{type:s,icon:{error:"warning-alert",info:"info",warning:"warning-alert",success:"check-tick"}[s],dismiss:{show:r}})}}class P extends o().Component{constructor(e){super(e),this.state={resetInProgress:!1}}startResetting(){this.setState({resetInProgress:!0})}stopResetting(){this.setState({resetInProgress:!1})}resetSuccessful(){this.stopResetting(),y.showSuccessNotice("wds-data-reset-notice",(0,p.__)("Data and settings have been reset successfully!","wds"),!1),setTimeout((()=>window.location.reload()),1500)}showErrorMessage(){y.showErrorNotice("wds-data-reset-notice",(0,p.__)("We could not reset your site due to an error.","wds"),!1)}render(){return(0,e.createElement)(o().Fragment,null,(0,e.createElement)(N,{id:"wds-data-reset-notice"}),(0,e.createElement)(u,{id:"wds-data-reset-button",icon:"sui-icon-refresh",ghost:!0,text:(0,p.__)("Reset","wds"),onClick:()=>this.startResetting()}),this.state.resetInProgress&&(0,e.createElement)(C,{onClose:()=>this.stopResetting(),afterReset:()=>this.resetSuccessful(),onError:()=>this.showErrorMessage()}))}}class x extends o().Component{render(){const t=Math.ceil(this.props.progress),s=t+"%";return(0,e.createElement)(o().Fragment,null,(0,e.createElement)("div",{className:"sui-progress-block"},(0,e.createElement)("div",{className:"sui-progress"},(0,e.createElement)("span",{className:"sui-progress-icon","aria-hidden":"true"},(0,e.createElement)("span",{className:"sui-icon-loader sui-loading"})),(0,e.createElement)("div",{className:"sui-progress-text"},s),(0,e.createElement)("div",{className:"sui-progress-bar"},(0,e.createElement)("span",{style:{transition:0!==t&&"transform 0.4s linear 0s",transformOrigin:"left center",transform:`translateX(${t-100}%)`}})))),(0,e.createElement)("div",{className:"sui-progress-state"},this.props.stateMessage))}}l(x,"defaultProps",{progress:"",stateMessage:""});class S extends o().Component{constructor(e){super(e),this.state={modalState:"actions",requestInProgress:!1,progress:0,progressMessage:""}}resetData(){this.setState({modalState:"progress",requestInProgress:!0},(()=>{this.post("wds_multisite_data_reset").then((e=>{const t=e.total_sites,s=e.completed_sites,r=e.progress_message,o=t>0?s/t*100:0;this.setState({progress:o,progressMessage:r},(()=>{t!==s?this.resetData():this.props.afterReset()}))})).catch((()=>{this.setState({modalState:"actions",requestInProgress:!1},(()=>this.props.onError()))}))}))}isModalState(e){return this.state.modalState===e}render(){const t=this.isModalState("progress")?(0,p.__)("Resetting your subsite settings, please keep this window open …","wds"):(0,p.__)("Are you sure you want to reset all the subsites?","wds");return(0,e.createElement)(w,{id:"wds-multisite-data-reset-modal",title:(0,p.__)("Reset Subsites","wds"),description:t,disableCloseButton:this.state.requestInProgress,focusAfterOpen:"wds-multisite-reset-cancel-button",focusAfterClose:"wds-multisite-reset-button",onClose:()=>this.props.onClose(),small:!0},this.isModalState("actions")&&this.getActionButtons(),this.isModalState("progress")&&this.getProgressBar())}getActionButtons(){return(0,e.createElement)(o().Fragment,null,(0,e.createElement)(u,{id:"wds-multisite-reset-cancel-button",text:(0,p.__)("Cancel","wds"),ghost:!0,disabled:this.state.requestInProgress,onClick:()=>this.props.onClose()}),(0,e.createElement)(u,{ghost:!0,color:"red",icon:"sui-icon-refresh",loading:this.state.requestInProgress,onClick:()=>this.resetData(),text:(0,p.__)("Reset","wds")}))}getProgressBar(){const t=(0,e.createInterpolateElement)(this.state.progressMessage,{strong:(0,e.createElement)("strong",null)});return(0,e.createElement)(x,{progress:this.state.progress,stateMessage:t})}post(e){const t=E.get("multisite_nonce","reset");return _.post(e,t)}}l(S,"defaultProps",{onClose:()=>!1,afterReset:()=>!1,onError:()=>!1});class I extends o().Component{constructor(e){super(e),this.state={resetInProgress:!1}}startResetting(){this.setState({resetInProgress:!0})}stopResetting(){this.setState({resetInProgress:!1})}resetSuccessful(){this.stopResetting(),y.showSuccessNotice("wds-multisite-reset-notice",(0,p.__)("Data and settings for all subsites have been reset successfully!","wds"),!1),setTimeout((()=>window.location.reload()),1500)}showErrorMessage(){y.showErrorNotice("wds-multisite-reset-notice",(0,p.__)("We could not reset your network due to an unknown error. Please try again.","wds"),!1)}render(){return(0,e.createElement)(o().Fragment,null,(0,e.createElement)(N,{id:"wds-multisite-reset-notice"}),(0,e.createElement)(u,{color:"red",ghost:!0,id:"wds-multisite-reset-button",text:(0,p.__)("Reset Subsites","wds"),onClick:()=>this.startResetting()}),this.state.resetInProgress&&(0,e.createElement)(S,{onClose:()=>this.stopResetting(),afterReset:()=>this.resetSuccessful(),onError:()=>this.showErrorMessage()}))}}!function(s){const r=document.getElementById("wds-data-reset-button-placeholder");r&&(0,t.render)((0,e.createElement)(i,null,(0,e.createElement)(P,null)),r);const o=document.getElementById("wds-multisite-reset-button-placeholder");function n(){var e=s(this),t=e.closest(".wds-custom-meta-tags").find(".wds-custom-meta-tag:first-of-type").clone();t.insertBefore(e),t.find("input").val("").trigger("focus")}o&&(0,t.render)((0,e.createElement)(i,null,(0,e.createElement)(I,null)),o),window.Wds=window.Wds||{},s((function(){window.Wds.styleable_file_input(),s(document).on("click",".wds-custom-meta-tags button",n),Wds.vertical_tabs()}))}(jQuery)}()}();