!function(e){var s={};function t(i){if(s[i])return s[i].exports;var r=s[i]={i:i,l:!1,exports:{}};return e[i].call(r.exports,r,r.exports,t),r.l=!0,r.exports}t.m=e,t.c=s,t.d=function(e,s,i){t.o(e,s)||Object.defineProperty(e,s,{enumerable:!0,get:i})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,s){if(1&s&&(e=t(e)),8&s)return e;if(4&s&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(t.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&s&&"string"!=typeof e)for(var r in e)t.d(i,r,function(s){return e[s]}.bind(null,r));return i},t.n=function(e){var s=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(s,"a",s),s},t.o=function(e,s){return Object.prototype.hasOwnProperty.call(e,s)},t.p="",t(t.s=0)}([function(e,s,t){e.exports=t(1)},function(e,s,t){"use strict";t.r(s);t(2);console.log("Hello World")},function(e,s){!function(e){Custom_Search=()=>{events=()=>{this.openButton.on("click",this.openOverlay.bind(this)),this.closeButton.on("click",this.closeOverlay.bind(this)),e(document).on("keydown",this.keyPressDispatcher.bind(this)),this.searchField.on("keyup",this.typingLogic.bind(this))},typingLogic=()=>{console.log("Typing logic"),this.searchField.val()!=this.previousValue&&(clearTimeout(this.typingTimer),this.searchField.val()?(this.isSpinnerVisible||(this.resultsDiv.html('<div class="spinner-loader"></div>'),this.isSpinnerVisible=!0),this.typingTimer=setTimeout(this.getResults.bind(this),750)):(this.resultsDiv.html(""),this.isSpinnerVisible=!1)),this.previousValue=this.searchField.val()},getResults=()=>{var s=this;e.getJSON(searchData.root_url+"/wp-json/search/v1/item?term= "+this.searchField.val(),(function(e){s.resultsDiv.html(`\n            <h2 class="search-overlay__section-title">Posts</h2>\n            ${e.length?'<ul class="result-list">':"<p>No posts match that search.</p>"}\n              ${e.map(e=>`\n                <li class="">\n                  <a class="professor-card" href="${e.permalink}">\n                    <span class="professor-card__name">${e.title}</span>\n                  </a>\n                </li>\n              `).join("")}\n            ${e.length?"</ul>":""}\n\n      `),s.isSpinnerVisible=!1}),this)},keyPressDispatcher=s=>{83!=s.keyCode||this.isOverlayOpen||e("input, textarea").is(":focus")||this.openOverlay(),27==s.keyCode&&this.isOverlayOpen&&this.closeOverlay()},openOverlay=()=>(this.searchOverlay.addClass("search-overlay--active"),e("body").addClass("body-no-scroll"),this.searchField.val(""),setTimeout(()=>this.searchField.focus(),301),console.log("our open method just ran!"),this.isOverlayOpen=!0,!1),closeOverlay=()=>{this.searchOverlay.removeClass("search-overlay--active"),e("body").removeClass("body-no-scroll"),console.log("our close method just ran!"),this.isOverlayOpen=!1};e("body").append('\n      <div class="search-overlay">\n        <div class="search-overlay__top">\n          <div class="container">\n            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>\n            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">\n            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>\n          </div>\n        </div>\n        \n        <div class="container">\n          <div id="search-overlay__results"></div>\n        </div>\n\n      </div>\n    '),this.resultsDiv=e("#search-overlay__results"),this.openButton=e(".js-search-trigger"),this.closeButton=e(".search-overlay__close"),this.searchOverlay=e(".search-overlay"),this.searchField=e("#search-term"),this.events(),this.isOverlayOpen=!1,this.isSpinnerVisible=!1,this.previousValue,this.typingTimer,console.log("search is ready")},Custom_Search()}(jQuery)}]);