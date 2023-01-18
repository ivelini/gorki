(function(){"use strict";var n={394:function(n,t,e){var o=e(963),a=e(252),r=e(577);const s={class:"container"},l={class:"header row"},i={class:"span12"},c={class:"navbar"},u={class:"navbar-inner"},d=(0,a._)("a",{class:"btn btn-navbar","data-toggle":"collapse","data-target":".nav-collapse"},[(0,a._)("span",{class:"icon-bar"}),(0,a._)("span",{class:"icon-bar"}),(0,a._)("span",{class:"icon-bar"})],-1),p={class:"nav-collapse collapse"},v={class:"nav pull-right"},f={key:0},h=(0,a._)("a",{href:"/register"},"Регистрация",-1),g=[h],m={key:1},b={href:"/logoute"},w=(0,a._)("footer",null,[(0,a._)("div",{class:"container"},[(0,a._)("div",{class:"row"},[(0,a._)("div",{class:"copyright span4"},[(0,a._)("p",null,"Тестовое - RESTFull серис бронирования")])])])],-1);function _(n,t,e,o,h,_){const y=(0,a.up)("router-link"),k=(0,a.up)("router-view");return(0,a.wg)(),(0,a.iD)(a.HY,null,[(0,a._)("div",s,[(0,a._)("div",l,[(0,a._)("div",i,[(0,a._)("div",c,[(0,a._)("div",u,[d,(0,a._)("div",p,[(0,a._)("ul",v,[(0,a._)("li",null,[(0,a.Wm)(y,{to:{name:"home"}},{default:(0,a.w5)((()=>[(0,a.Uk)("Забронировать")])),_:1})]),(0,a._)("li",null,[(0,a.Wm)(y,{to:{name:"list"}},{default:(0,a.w5)((()=>[(0,a.Uk)("Список")])),_:1})]),h.user.name?((0,a.wg)(),(0,a.iD)("li",m,[(0,a._)("a",b,(0,r.zw)(h.user.name)+" - Выход",1)])):((0,a.wg)(),(0,a.iD)("li",f,g))])])])])])])]),(0,a.Wm)(k),w],64)}var y={data(){return{user:{name:""}}},mounted(){null!=this.getToken()&&this.getUser()},methods:{async getUser(){let n=await fetch("http://127.0.0.1:8000/api/user",{method:"GET",headers:{"Content-Type":"application/json",Authorization:`Bearer ${this.getToken()}`}}),t=await n.json();this.user.name=t.name,console.log(t)},getToken(){return localStorage.getItem("token")}}},k=e(744);const O=(0,k.Z)(y,[["render",_]]);var T=O,j=e(201);const D=(0,a._)("h2",null,"Забронировать /",-1),x=(0,a._)("p",null,"Выбрать дату бронирования",-1),W=(0,a.uE)('<div class="contact-us container"><div class="row"><div class="contact-form span7"><form><label for="name" class="nameLabel">Дата</label><input id="date" type="date"><button type="submit">Забронировать</button></form></div></div></div>',1);function C(n,t,e,o,r,s){const l=(0,a.up)("header-content");return(0,a.wg)(),(0,a.iD)(a.HY,null,[(0,a.Wm)(l,null,{default:(0,a.w5)((()=>[D,x])),_:1}),W],64)}const E={class:"page-title"},H={class:"container"},U={class:"row"},Z={class:"span12"};function I(n,t){return(0,a.wg)(),(0,a.iD)("div",E,[(0,a._)("div",H,[(0,a._)("div",U,[(0,a._)("div",Z,[(0,a.WI)(n.$slots,"default")])])])])}const P={},Y=(0,k.Z)(P,[["render",I]]);var z=Y,F={components:{HeaderContent:z}};const S=(0,k.Z)(F,[["render",C]]);var $=S;const A=(0,a._)("h2",null,"Список /",-1),B=(0,a._)("p",null,"Мои даты бронирования",-1),G=(0,a.uE)('<div class="call-to-action container"><div class="row"><div class="call-to-action-text span12"><div class="ca-text"><p><span style="color:orange;font-weight:bold;">ID: 1</span>; <span style="color:green;font-weight:bold;">Дата создания: 17.01.2023 20:34</span>; <span style="color:black;font-weight:bold;">Дата брони: 20.01.2023</span>; <span style="color:red;font-weight:bold;">Не подтверждена</span></p></div></div></div></div>',1);function L(n,t,e,o,r,s){const l=(0,a.up)("header-content");return(0,a.wg)(),(0,a.iD)(a.HY,null,[(0,a.Wm)(l,null,{default:(0,a.w5)((()=>[A,B])),_:1}),G],64)}var M={components:{HeaderContent:z}};const R=(0,k.Z)(M,[["render",L]]);var q=R;const J=[{path:"/",name:"home",component:$},{path:"/list",name:"list",component:q}],K=(0,j.p7)({history:(0,j.PO)("/"),routes:J});var N=K,Q=e(907),V=(0,Q.MT)({state:{},getters:{},mutations:{},actions:{},modules:{}});(0,o.ri)(T).use(V).use(N).mount("#app")}},t={};function e(o){var a=t[o];if(void 0!==a)return a.exports;var r=t[o]={exports:{}};return n[o](r,r.exports,e),r.exports}e.m=n,function(){var n=[];e.O=function(t,o,a,r){if(!o){var s=1/0;for(u=0;u<n.length;u++){o=n[u][0],a=n[u][1],r=n[u][2];for(var l=!0,i=0;i<o.length;i++)(!1&r||s>=r)&&Object.keys(e.O).every((function(n){return e.O[n](o[i])}))?o.splice(i--,1):(l=!1,r<s&&(s=r));if(l){n.splice(u--,1);var c=a();void 0!==c&&(t=c)}}return t}r=r||0;for(var u=n.length;u>0&&n[u-1][2]>r;u--)n[u]=n[u-1];n[u]=[o,a,r]}}(),function(){e.d=function(n,t){for(var o in t)e.o(t,o)&&!e.o(n,o)&&Object.defineProperty(n,o,{enumerable:!0,get:t[o]})}}(),function(){e.g=function(){if("object"===typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(n){if("object"===typeof window)return window}}()}(),function(){e.o=function(n,t){return Object.prototype.hasOwnProperty.call(n,t)}}(),function(){var n={143:0};e.O.j=function(t){return 0===n[t]};var t=function(t,o){var a,r,s=o[0],l=o[1],i=o[2],c=0;if(s.some((function(t){return 0!==n[t]}))){for(a in l)e.o(l,a)&&(e.m[a]=l[a]);if(i)var u=i(e)}for(t&&t(o);c<s.length;c++)r=s[c],e.o(n,r)&&n[r]&&n[r][0](),n[r]=0;return e.O(u)},o=self["webpackChunkfrontend"]=self["webpackChunkfrontend"]||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))}();var o=e.O(void 0,[998],(function(){return e(394)}));o=e.O(o)})();
//# sourceMappingURL=app.9642c42e.js.map