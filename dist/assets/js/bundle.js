!function(e){var s={};function r(i){if(s[i])return s[i].exports;var t=s[i]={i:i,l:!1,exports:{}};return e[i].call(t.exports,t,t.exports,r),t.l=!0,t.exports}r.m=e,r.c=s,r.d=function(e,s,i){r.o(e,s)||Object.defineProperty(e,s,{enumerable:!0,get:i})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,s){if(1&s&&(e=r(e)),8&s)return e;if(4&s&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(r.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&s&&"string"!=typeof e)for(var t in e)r.d(i,t,function(s){return e[s]}.bind(null,t));return i},r.n=function(e){var s=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(s,"a",s),s},r.o=function(e,s){return Object.prototype.hasOwnProperty.call(e,s)},r.p="",r(r.s=0)}([function(e,s,r){e.exports=r(1)},function(e,s,r){"use strict";r.r(s);r(2),r(3);console.log("Hello World")},function(e,s){!function(e){Custom_Search=()=>{events=()=>{this.openButton.on("click",this.openOverlay.bind(this)),this.closeButton.on("click",this.closeOverlay.bind(this)),e(document).on("keydown",this.keyPressDispatcher.bind(this)),this.searchField.on("keyup",this.typingLogic.bind(this))},typingLogic=()=>{console.log("Typing logic"),this.searchField.val()!=this.previousValue&&(clearTimeout(this.typingTimer),this.searchField.val()?(this.isSpinnerVisible||(this.resultsDiv.html('<div class="spinner-loader"></div>'),this.isSpinnerVisible=!0),this.typingTimer=setTimeout(this.getResults.bind(this),750)):(this.resultsDiv.html(""),this.isSpinnerVisible=!1)),this.previousValue=this.searchField.val()},getResults=()=>{var s=this;e.getJSON(searchData.root_url+"/wp-json/search/v1/item?term= "+this.searchField.val(),(function(e){s.resultsDiv.html(`\n            <h2 class="search-overlay__section-title">Posts</h2>\n            ${e.length?'<ul class="result-list">':"<p>No posts match that search.</p>"}\n              ${e.map(e=>`\n                <li class="">\n                  <a class="professor-card" href="${e.permalink}">\n                    <span class="professor-card__name">${e.title}</span>\n                  </a>\n                </li>\n              `).join("")}\n            ${e.length?"</ul>":""}\n\n      `),s.isSpinnerVisible=!1}),this)},keyPressDispatcher=s=>{83!=s.keyCode||this.isOverlayOpen||e("input, textarea").is(":focus")||this.openOverlay(),27==s.keyCode&&this.isOverlayOpen&&this.closeOverlay()},openOverlay=()=>(this.searchOverlay.addClass("search-overlay--active"),e("body").addClass("body-no-scroll"),this.searchField.val(""),setTimeout(()=>this.searchField.focus(),301),console.log("our open method just ran!"),this.isOverlayOpen=!0,!1),closeOverlay=()=>{this.searchOverlay.removeClass("search-overlay--active"),e("body").removeClass("body-no-scroll"),console.log("our close method just ran!"),this.isOverlayOpen=!1};e("body").append('\n      <div class="search-overlay">\n        <div class="search-overlay__top">\n          <div class="container">\n            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>\n            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">\n            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>\n          </div>\n        </div>\n        \n        <div class="container">\n          <div id="search-overlay__results"></div>\n        </div>\n\n      </div>\n    '),this.resultsDiv=e("#search-overlay__results"),this.openButton=e(".js-search-trigger"),this.closeButton=e(".search-overlay__close"),this.searchOverlay=e(".search-overlay"),this.searchField=e("#search-term"),this.events(),this.isOverlayOpen=!1,this.isSpinnerVisible=!1,this.previousValue,this.typingTimer,console.log("search is ready")},Custom_Search()}(jQuery)},function(e,s){var r;r=jQuery,console.log("Form control init"),r("#frm-check-service-area").on("click","#btnGo",(function(e){e.preventDefault(),$fromControl=r(".form-control").val(),$parent=r(this).closest(".yani-delivery-areas"),r("#frm-check-service-area").hide(),$parent.find(".delivery-area-status").html("Checking...").removeClass("danger").removeClass("success").addClass("info"),r(".form-control").removeClass("bg-danger").removeClass("white"),r.getJSON(searchData.root_url+"/wp-json/search/v1/zip?term="+$fromControl,(function(e){e?($parent.find(".delivery-area-status").removeClass("info").addClass("success").html("Great news, we deliver to your area!"),r("#frm-check-service-area").show(),r(".yani-delivery-areas-banner").show(),r(".yani-delivery-areas").hide()):(r("#frm-check-service-area").show(),$parent.find(".delivery-area-status").removeClass("info").addClass("danger").html("Sorry, we're not yet in your neighborhood. Join us online for info on new delivery areas, recipes and farm events"),r(".form-control").addClass("bg-danger").addClass("white"))}))})),r(".yani-delivery-areas-banner").on("click","#btn-change-location",(function(e){r(".yani-delivery-areas-banner").hide(),r(".yani-delivery-areas").show(),r(".form-control").removeClass("bg-danger").removeClass("white"),$parent.find(".delivery-area-status").html("").removeClass("danger").removeClass("success").removeClass("info")}))}]);