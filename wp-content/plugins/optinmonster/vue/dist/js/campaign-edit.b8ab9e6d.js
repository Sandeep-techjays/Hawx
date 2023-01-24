(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["campaign-edit"],{6439:function(t,e,i){"use strict";var a=i("7836"),n=i.n(a);n.a},7836:function(t,e,i){},fd4fd:function(t,e,i){"use strict";i.r(e);var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return t.routeId?i("core-page",{staticClass:"omapi-campaign-settings"},[i("router-link",{staticClass:"omapi-link-arrow-before omapi-button__link",attrs:{to:{name:"campaigns"}}},[t._v("Return to Campaigns List")]),t.isLoading?i("core-loading",[i("h1",[t._v("Loading...")])]):i("form",{on:{submit:function(e){return e.preventDefault(),t.save(e)}}},[i("h1",[i("span",[t._v(t._s(t.title))])]),i("common-alerts",{attrs:{id:"om-notification-campaign",alerts:t.alerts}}),i("div",{staticClass:"omapi-card__flex omapi-campaign-settings-sections",class:{disabled:t.isDisabled}},[i("common-card",{staticClass:"omapi-campaign-settings__wrapper",attrs:{size:"two-thirds",title:"WordPress Output Settings",contentClass:"omapi-card__border",footerClass:"omapi-card__child"},scopedSlots:t._u([{key:"title",fn:function(){return[t._v("WordPress Output Settings")]},proxy:!0},{key:"footer",fn:function(){return[t.hasError?t._e():i("campaigns-advanced-settings",{attrs:{campaign:t.campaign}},[i("core-save-button",{attrs:{color:"green",disabled:!t.changed,saving:t.saving}})],1),!t.hasError&&t.isWooActive?i("campaigns-woo-settings",{attrs:{campaign:t.campaign}},[i("core-save-button",{attrs:{color:"green",disabled:!t.changed,saving:t.saving}})],1):t._e(),!t.hasError&&t.isEddActive?i("campaigns-edd-settings",{attrs:{campaign:t.campaign}},[i("core-save-button",{attrs:{color:"green",disabled:!t.changed,saving:t.saving}})],1):t._e()]},proxy:!0}],null,!1,1744435795)},[t.hasError?i("p",{staticClass:"text-setting"},[t._v("An error was encountered.")]):[i("p",{staticClass:"text-setting"},[t._v("Control when and where your campaigns are displayed once the targeting conditions are met.")]),"Inline"===t.campaignType?i("campaigns-inline-settings",{attrs:{campaign:t.campaign}}):t._e(),t.hasMailPoet?i("campaigns-mailpoet-settings",{attrs:{campaign:t.campaign}}):t._e()]],2),i("campaigns-right-column",{attrs:{campaignId:t.id,changed:t.changed,saving:t.saving,newStatus:t.newStatus,statusText:t.statusText},on:{updateStatus:t.onChangeStatus}})],1)],1)],1):t._e()},n=[],s=(i("8e6e"),i("ac6a"),i("456d"),i("bd86")),r=i("9b02"),c=i.n(r),o=i("2f62"),h=i("643a"),g=i("ed08");function u(t,e){var i=Object.keys(t);return Object.getOwnPropertySymbols&&i.push.apply(i,Object.getOwnPropertySymbols(t)),e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i}function d(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?u(i,!0).forEach((function(e){Object(s["a"])(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):u(i).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}var p={mixins:[h["a"]],data:function(){return{changed:!1,orig:!1,origMeta:{},newStatus:"",saving:!1}},mounted:function(){this.routeId&&(this.fetch(),this.updateTitle(),window.addEventListener("beforeunload",this.maybePreventExit))},beforeDestroy:function(){window.removeEventListener("beforeunload",this.maybePreventExit)},watch:{isLoading:function(t){t||this.fetch()},title:function(){this.updateTitle()},campaign:function(t,e){if(this.fetchedCampaign&&c()(e,"wp"))if(this.orig||(this.orig=this.getMetaString(e)),this.newStatus===this.campaignStatus){t=this.getMetaString(t);var i=Object(g["l"])(t,this.orig);this.changed=-1!==i}else this.changed=!0},newStatus:function(t,e){this.changed||(this.changed=this.newStatus!==this.campaignStatus)}},beforeRouteLeave:function(t,e,i){if(!this.changed||confirm("You have unsaved changes. Are you sure you want to lose these changes?"))return this.resetCampaign(),i()},computed:d({},Object(o["f"])(["alerts"]),{},Object(o["f"])("campaigns",["campaigns"]),{},Object(o["d"])("campaigns",["getCampaign","hasError"]),{},Object(o["d"])("wp",["hasMailPoet","isWooActive","isEddActive"]),{},Object(o["d"])(["isFetched","isFetching"]),{routeId:function(){return this.$get("$route.params.campaignId","")},campaign:function(){return this.getCampaign(this.routeId)},fetchedCampaign:function(){return this.isFetched(this.routeId)},fetchingCampaign:function(){return this.isFetching(this.routeId)},shouldFetch:function(){return!this.fetchingCampaign&&!this.fetchedCampaign},isLoading:function(){return!this.showAlerts&&(!this.fetchedCampaign||this.$store.getters.isLoading(["campaigns","me"]))},isDisabled:function(){return!this.hasError&&(this.isLoading||!this.isFetched("wpResources"))},showAlerts:function(){return Boolean(this.alerts.length)},title:function(){return this.$get("campaign.name","No Campaign Found")},statusText:function(){var t="active"!==this.newStatus;return this.isSplit?t?"Published":"Draft":t?this.settingEnabled?"Pending":"Draft":this.settingEnabled?"Published":"Pending"}}),methods:d({},Object(o["c"])("campaigns",["fetchCampaign","fetchWpDataForCampaign","saveWordPress"]),{},Object(o["e"])(["fetching","fetched"]),{fetch:function(){var t=this;this.fetchingCampaign||(this.fetchedCampaign||this.fetching(this.routeId),this.fetchCampaign({campaignId:this.routeId}).then((function(){return t.fetchWpData()})).catch((function(t){})))},fetchWpData:function(){var t=this,e=this.fetchedCampaign?Promise.resolve():this.fetchWpDataForCampaign({campaignId:this.routeId});return e.then((function(){return t.fetched(t.routeId)})).then((function(){return t.afterFetched()})).catch((function(t){}))},save:function(){var t=this;this.$store.commit("clearAlerts"),this.saving=!0,this.setStatus({campaigns:[this.id],status:this.newStatus}),this.saveWordPress({campaignId:this.id,settings:this.getSettings()}).then((function(){t.fetchWpData()}))},afterFetched:function(){this.orig=this.getMetaString(this.campaign),this.origMeta=this.$get("campaign.wp.post_meta",{}),this.newStatus=this.campaignStatus,this.changed=!1,this.saving=!1},updateTitle:function(){var t=this.$get("campaign.name",this.id);t&&(this.$store.dispatch("setTitle",{title:"Output Settings: ".concat(t),setBannerTitle:!1}),this.$store.commit("setBannerTitle","Campaign Output Settings"))},getMetaString:function(t){var e=this.getSettings(c()(t,"wp.post_meta",{}));return JSON.stringify(e)+this.newStatus},maybePreventExit:function(t){if(this.changed)return t.preventDefault(),t.returnValue="You have unsaved changes. Are you sure you want to lose these changes?",t.returnValue},resetCampaign:function(){this.newStatus=this.campaignStatus,this.updateCampaignMeta({campaignId:this.id,meta:this.origMeta})},onChangeStatus:function(t){switch(t){case"Pending":this.toggleEmbed("active"!==this.newStatus);break;case"Published":this.newStatus="active",this.toggleEmbed(!0);break;case"Draft":this.newStatus="paused",this.toggleEmbed(!1);break;default:break}},toggleEmbed:function(t){t!==this.settingEnabled&&(this.settingEnabled=t)}})},m=p,f=(i("6439"),i("2877")),l=Object(f["a"])(m,a,n,!1,null,null,null);e["default"]=l.exports}}]);
//# sourceMappingURL=campaign-edit.b8ab9e6d.js.map