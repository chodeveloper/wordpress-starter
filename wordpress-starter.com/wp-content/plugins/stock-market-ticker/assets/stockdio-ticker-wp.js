!function(d,_){"use strict";if("IntersectionObserver"in d&&"IntersectionObserverEntry"in d&&"intersectionRatio"in d.IntersectionObserverEntry.prototype)"isIntersecting"in d.IntersectionObserverEntry.prototype||Object.defineProperty(d.IntersectionObserverEntry.prototype,"isIntersecting",{get:function(){return 0<this.intersectionRatio}});else{var e=[];t.prototype.THROTTLE_TIMEOUT=100,t.prototype.POLL_INTERVAL=null,t.prototype.USE_MUTATION_OBSERVER=!0,t.prototype.observe=function(e){if(!this._observationTargets.some(function(t){return t.element==e})){if(!e||1!=e.nodeType)throw new Error("target must be an Element");this._registerInstance(),this._observationTargets.push({element:e,entry:null}),this._monitorIntersections(),this._checkForIntersections()}},t.prototype.unobserve=function(e){this._observationTargets=this._observationTargets.filter(function(t){return t.element!=e}),this._observationTargets.length||(this._unmonitorIntersections(),this._unregisterInstance())},t.prototype.disconnect=function(){this._observationTargets=[],this._unmonitorIntersections(),this._unregisterInstance()},t.prototype.takeRecords=function(){var t=this._queuedEntries.slice();return this._queuedEntries=[],t},t.prototype._initThresholds=function(t){var e=t||[0];return Array.isArray(e)||(e=[e]),e.sort().filter(function(t,e,n){if("number"!=typeof t||isNaN(t)||t<0||1<t)throw new Error("threshold must be a number between 0 and 1 inclusively");return t!==n[e-1]})},t.prototype._parseRootMargin=function(t){var e=(t||"0px").split(/\s+/).map(function(t){var e=/^(-?\d*\.?\d+)(px|%)$/.exec(t);if(!e)throw new Error("rootMargin must be specified in pixels or percent");return{value:parseFloat(e[1]),unit:e[2]}});return e[1]=e[1]||e[0],e[2]=e[2]||e[0],e[3]=e[3]||e[1],e},t.prototype._monitorIntersections=function(){this._monitoringIntersections||(this._monitoringIntersections=!0,this.POLL_INTERVAL?this._monitoringInterval=setInterval(this._checkForIntersections,this.POLL_INTERVAL):(n(d,"resize",this._checkForIntersections,!0),n(_,"scroll",this._checkForIntersections,!0),this.USE_MUTATION_OBSERVER&&"MutationObserver"in d&&(this._domObserver=new MutationObserver(this._checkForIntersections),this._domObserver.observe(_,{attributes:!0,childList:!0,characterData:!0,subtree:!0}))))},t.prototype._unmonitorIntersections=function(){this._monitoringIntersections&&(this._monitoringIntersections=!1,clearInterval(this._monitoringInterval),this._monitoringInterval=null,o(d,"resize",this._checkForIntersections,!0),o(_,"scroll",this._checkForIntersections,!0),this._domObserver&&(this._domObserver.disconnect(),this._domObserver=null))},t.prototype._checkForIntersections=function(){var h=this._rootIsInDom(),c=h?this._getRootRect():{top:0,bottom:0,left:0,right:0,width:0,height:0};this._observationTargets.forEach(function(t){var e=t.element,n=m(e),o=this._rootContainsTarget(e),i=t.entry,r=h&&o&&this._computeTargetAndRootIntersection(e,c),s=t.entry=new a({time:d.performance&&performance.now&&performance.now(),target:e,boundingClientRect:n,rootBounds:c,intersectionRect:r});i?h&&o?this._hasCrossedThreshold(i,s)&&this._queuedEntries.push(s):i&&i.isIntersecting&&this._queuedEntries.push(s):this._queuedEntries.push(s)},this),this._queuedEntries.length&&this._callback(this.takeRecords(),this)},t.prototype._computeTargetAndRootIntersection=function(t,e){if("none"!=d.getComputedStyle(t).display){for(var n,o,i,r,s,h,c,a,u=m(t),l=v(t),p=!1;!p;){var f=null,g=1==l.nodeType?d.getComputedStyle(l):{};if("none"==g.display)return;if(l==this.root||l==_?(p=!0,f=e):l!=_.body&&l!=_.documentElement&&"visible"!=g.overflow&&(f=m(l)),f&&(n=f,o=u,void 0,i=Math.max(n.top,o.top),r=Math.min(n.bottom,o.bottom),s=Math.max(n.left,o.left),h=Math.min(n.right,o.right),a=r-i,!(u=0<=(c=h-s)&&0<=a&&{top:i,bottom:r,left:s,right:h,width:c,height:a})))break;l=v(l)}return u}},t.prototype._getRootRect=function(){var t;if(this.root)t=m(this.root);else{var e=_.documentElement,n=_.body;t={top:0,left:0,right:e.clientWidth||n.clientWidth,width:e.clientWidth||n.clientWidth,bottom:e.clientHeight||n.clientHeight,height:e.clientHeight||n.clientHeight}}return this._expandRectByRootMargin(t)},t.prototype._expandRectByRootMargin=function(n){var t=this._rootMarginValues.map(function(t,e){return"px"==t.unit?t.value:t.value*(e%2?n.width:n.height)/100}),e={top:n.top-t[0],right:n.right+t[1],bottom:n.bottom+t[2],left:n.left-t[3]};return e.width=e.right-e.left,e.height=e.bottom-e.top,e},t.prototype._hasCrossedThreshold=function(t,e){var n=t&&t.isIntersecting?t.intersectionRatio||0:-1,o=e.isIntersecting?e.intersectionRatio||0:-1;if(n!==o)for(var i=0;i<this.thresholds.length;i++){var r=this.thresholds[i];if(r==n||r==o||r<n!=r<o)return!0}},t.prototype._rootIsInDom=function(){return!this.root||i(_,this.root)},t.prototype._rootContainsTarget=function(t){return i(this.root||_,t)},t.prototype._registerInstance=function(){e.indexOf(this)<0&&e.push(this)},t.prototype._unregisterInstance=function(){var t=e.indexOf(this);-1!=t&&e.splice(t,1)},d.IntersectionObserver=t,d.IntersectionObserverEntry=a}function a(t){this.time=t.time,this.target=t.target,this.rootBounds=t.rootBounds,this.boundingClientRect=t.boundingClientRect,this.intersectionRect=t.intersectionRect||{top:0,bottom:0,left:0,right:0,width:0,height:0},this.isIntersecting=!!t.intersectionRect;var e=this.boundingClientRect,n=e.width*e.height,o=this.intersectionRect,i=o.width*o.height;this.intersectionRatio=n?i/n:this.isIntersecting?1:0}function t(t,e){var n,o,i,r=e||{};if("function"!=typeof t)throw new Error("callback must be a function");if(r.root&&1!=r.root.nodeType)throw new Error("root must be an Element");this._checkForIntersections=(n=this._checkForIntersections.bind(this),o=this.THROTTLE_TIMEOUT,i=null,function(){i||(i=setTimeout(function(){n(),i=null},o))}),this._callback=t,this._observationTargets=[],this._queuedEntries=[],this._rootMarginValues=this._parseRootMargin(r.rootMargin),this.thresholds=this._initThresholds(r.threshold),this.root=r.root||null,this.rootMargin=this._rootMarginValues.map(function(t){return t.value+t.unit}).join(" ")}function n(t,e,n,o){"function"==typeof t.addEventListener?t.addEventListener(e,n,o||!1):"function"==typeof t.attachEvent&&t.attachEvent("on"+e,n)}function o(t,e,n,o){"function"==typeof t.removeEventListener?t.removeEventListener(e,n,o||!1):"function"==typeof t.detatchEvent&&t.detatchEvent("on"+e,n)}function m(t){var e;try{e=t.getBoundingClientRect()}catch(t){}return e?(e.width&&e.height||(e={top:e.top,right:e.right,bottom:e.bottom,left:e.left,width:e.right-e.left,height:e.bottom-e.top}),e):{top:0,bottom:0,left:0,right:0,width:0,height:0}}function i(t,e){for(var n=e;n;){if(n==t)return!0;n=v(n)}return!1}function v(t){var e=t.parentNode;return e&&11==e.nodeType&&e.host?e.host:e}}(window,document);

jQuery(function () {	
	jQuery("select[name=stockdio_ticker_options\\[default_layoutType\\]]").imagepicker();
	
	if (typeof(stockdio_events) == "undefined") {
		  stockdio_events = true;
		  var stockdio_eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
		  var stockdio_eventer = window[stockdio_eventMethod];
		  var stockdio_messageEvent = stockdio_eventMethod == "attachEvent" ? "onmessage" : "message";
		  stockdio_eventer(stockdio_messageEvent, function (e) {
			 if (typeof(e.data) != "undefined" && typeof(e.data.method) != "undefined") {
				eval(e.data.method);
			 }
		  },false);	 
		  
		window.onload = function () {
		   if (window.IntersectionObserver) {
				var elements = document.querySelectorAll('iframe[iframesrc]');		
				var element; var i;
				for (i=0; i< elements.length; i++){
					element = elements[i];
					if (element!=null && typeof(element) != "undefined") {					
						  var observer = new IntersectionObserver(function(entries) {
								//entries.forEach(function(entry) {
								var entry;var j;
								for (j=0; j< entries.length; j++){	
									entry = entries[j];
									element = entry.target;
									if (element.src != ""){
										observer.unobserve(element);
									}
									else {
										if (entry.isIntersecting) {
											if (entry.intersectionRatio > 0) {
												element.src = element.getAttribute("iframesrc");
											}
										}
									}
								//});					
								}
						  }, {
							rootMargin: "0px"
						  });
						  observer.POLL_INTERVAL = 100; // Time in milliseconds.
						  observer.observe(element);
						}
					};
			}		
			else{
				//browser do not support IntersectionObserver
				changeStockdioIframeSrc();
			}			
		}

		changeStockdioIframeSrc = function(){
			setTimeout(function(){
				var elements = document.querySelectorAll('iframe[iframesrc]');	
				var element;var i;
				for (i=0; i< elements.length; i++){
					element = elements[i];
					var b = false;
					if (element!=null && typeof(element) != "undefined" && element.src == "") {
						if (checkVisible(element))
							element.src = element.getAttribute("iframesrc");
						else b = true;
					}
					if (b) changeStockdioIframeSrc();
				}

			}, 100);
		}

		checkVisible = function(element) {
		  var rect = element.getBoundingClientRect();
		  var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
		  return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
		}	
	}
});


(function(){var t,e,i,s,l=function(t,e){return function(){return t.apply(e,arguments)}},n=[].indexOf||function(t){for(var e=0,i=this.length;i>e;e++)if(e in this&&this[e]===t)return e;return-1};jQuery.fn.extend({imagepicker:function(e){return null==e&&(e={}),this.each(function(){var i;return i=jQuery(this),i.data("picker")&&i.data("picker").destroy(),i.data("picker",new t(this,s(e))),null!=e.initialized?e.initialized.call(i.data("picker")):void 0})}}),s=function(t){var e;return e={hide_select:!0,show_label:!1,initialized:void 0,changed:void 0,clicked:void 0,selected:void 0,limit:void 0,limit_reached:void 0},jQuery.extend(e,t)},i=function(t,e){return 0===jQuery(t).not(e).length&&0===jQuery(e).not(t).length},t=function(){function t(t,e){this.opts=null!=e?e:{},this.sync_picker_with_select=l(this.sync_picker_with_select,this),this.select=jQuery(t),this.multiple="multiple"===this.select.attr("multiple"),null!=this.select.data("limit")&&(this.opts.limit=parseInt(this.select.data("limit"))),this.build_and_append_picker()}return t.prototype.destroy=function(){var t,e,i,s;for(s=this.picker_options,e=0,i=s.length;i>e;e++)t=s[e],t.destroy();return this.picker.remove(),this.select.unbind("change"),this.select.removeData("picker"),this.select.show()},t.prototype.build_and_append_picker=function(){var t=this;return this.opts.hide_select&&this.select.hide(),this.select.change(function(){return t.sync_picker_with_select()}),null!=this.picker&&this.picker.remove(),this.create_picker(),this.select.after(this.picker),this.sync_picker_with_select()},t.prototype.sync_picker_with_select=function(){var t,e,i,s,l;for(s=this.picker_options,l=[],e=0,i=s.length;i>e;e++)t=s[e],t.is_selected()?l.push(t.mark_as_selected()):l.push(t.unmark_as_selected());return l},t.prototype.create_picker=function(){return this.picker=jQuery("<ul class='thumbnails image_picker_selector'></ul>"),this.picker_options=[],this.recursively_parse_option_groups(this.select,this.picker),this.picker},t.prototype.recursively_parse_option_groups=function(t,i){var s,l,n,r,c,o,h,a,p,u;for(a=t.children("optgroup"),r=0,o=a.length;o>r;r++)n=a[r],n=jQuery(n),s=jQuery("<ul></ul>"),s.append(jQuery("<li class='group_title'>"+n.attr("label")+"</li>")),i.append(jQuery("<li>").append(s)),this.recursively_parse_option_groups(n,s);for(p=function(){var i,s,n,r;for(n=t.children("option"),r=[],i=0,s=n.length;s>i;i++)l=n[i],r.push(new e(l,this,this.opts));return r}.call(this),u=[],c=0,h=p.length;h>c;c++)l=p[c],this.picker_options.push(l),l.has_image()&&u.push(i.append(l.node));return u},t.prototype.has_implicit_blanks=function(){var t;return function(){var e,i,s,l;for(s=this.picker_options,l=[],e=0,i=s.length;i>e;e++)t=s[e],t.is_blank()&&!t.has_image()&&l.push(t);return l}.call(this).length>0},t.prototype.selected_values=function(){return this.multiple?this.select.val()||[]:[this.select.val()]},t.prototype.toggle=function(t){var e,s,l;return s=this.selected_values(),l=""+t.value(),this.multiple?n.call(this.selected_values(),l)>=0?(e=this.selected_values(),e.splice(jQuery.inArray(l,s),1),this.select.val([]),this.select.val(e)):null!=this.opts.limit&&this.selected_values().length>=this.opts.limit?null!=this.opts.limit_reached&&this.opts.limit_reached.call(this.select):this.select.val(this.selected_values().concat(l)):this.has_implicit_blanks()&&t.is_selected()?this.select.val(""):this.select.val(l),i(s,this.selected_values())||(this.select.change(),null==this.opts.changed)?void 0:this.opts.changed.call(this.select,s,this.selected_values())},t}(),e=function(){function t(t,e,i){this.picker=e,this.opts=null!=i?i:{},this.clicked=l(this.clicked,this),this.option=jQuery(t),this.create_node()}return t.prototype.destroy=function(){return this.node.find(".thumbnail").unbind()},t.prototype.has_image=function(){return null!=this.option.data("img-src")},t.prototype.is_blank=function(){return!(null!=this.value()&&""!==this.value())},t.prototype.is_selected=function(){var t;return t=this.picker.select.val(),this.picker.multiple?jQuery.inArray(this.value(),t)>=0:this.value()===t},t.prototype.mark_as_selected=function(){return this.node.find(".thumbnail").addClass("selected")},t.prototype.unmark_as_selected=function(){return this.node.find(".thumbnail").removeClass("selected")},t.prototype.value=function(){return this.option.val()},t.prototype.label=function(){return this.option.data("img-label")?this.option.data("img-label"):this.option.text()},t.prototype.clicked=function(){return this.picker.toggle(this),null!=this.opts.clicked&&this.opts.clicked.call(this.picker.select,this),null!=this.opts.selected&&this.is_selected()?this.opts.selected.call(this.picker.select,this):void 0},t.prototype.create_node=function(){var t,e;return this.node=jQuery("<li/>"),t=jQuery("<img class='image_picker_image'/>"),t.attr("src",this.option.data("img-src")),e=jQuery("<div class='thumbnail'>"),e.click({option:this},function(t){return t.data.option.clicked()}),e.append(t),this.opts.show_label&&e.append(jQuery("<p/>").html(this.label())),this.node.append(e),this.node},t}()}).call(this);
