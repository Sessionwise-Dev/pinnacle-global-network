(()=>{"use strict";var e={n:t=>{var n=t&&t.__esModule?()=>t.default:()=>t;return e.d(n,{a:n}),n},d:(t,n)=>{for(var r in n)e.o(n,r)&&!e.o(t,r)&&Object.defineProperty(t,r,{enumerable:!0,get:n[r]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t)};const t=jQuery;var n,r=e.n(t),a=wp.compose.createHigherOrderComponent,l=wp.element.Fragment,o=wp.editor.InspectorControls,c=wp.components,i=c.PanelBody,u=c.SelectControl,s=wp.hooks.addFilter,p=wp.i18n.__,d=function(e){return(e<10?"0":"")+e};r()(document).on("ready",(function(){window.acf&&(window.acf.addAction("render_block_preview/type=image",(function(e){if(e[0].querySelector("img")){var t=e[0].querySelector(".block-image").querySelector(".placeholder-image");t&&t.remove()}else{var n=e[0].querySelector(".block-image"),r=document.createElement("img");r.classList.add("placeholder-image"),r.src=theme.templateURL+"/dist/images/img-placeholder-16x9.svg",n.appendChild(r)}})),window.acf.addAction("render_block_preview/type=countdown",(function(e){var t=e[0].querySelector(".block-countdown-timer");console.log(t);var r=t.dataset.targetDate;if(console.log(r),!r)return!1;var a=new Date(r).getTime();if(a-(new Date).getTime()<0)return!1;var l=t.querySelector(".days-tile"),o=t.querySelector(".hours-tile"),c=t.querySelector(".minutes-tile"),i=t.querySelector(".seconds-tile");clearInterval(n),n=setInterval((function(){var e=(new Date).getTime(),t=(a-e)/1e3;t<=0&&(clearInterval(n),l.innerHTML="00",o.innerHTML="00",c.innerHTML="00",i.innerHTML="00");var r=d(parseInt(t/86400));t%=86400;var u=d(parseInt(t/3600));t%=3600;var s=d(parseInt(t/60)),p=d(parseInt(t%60));l.innerHTML=r,o.innerHTML=u,c.innerHTML=s,i.innerHTML=p}),1e3)})))}));var m=["core/paragraph","core/list","core/heading"],g=[{label:p("None"),value:"none"},{label:p("XS"),value:"xs"},{label:p("SM"),value:"sm"},{label:p("MD"),value:"md"},{label:p("LG"),value:"lg"},{label:p("XL"),value:"xl"}];s("blocks.registerBlockType","pgn/attribute/spacing",(function(e,t){return m.includes(t)?(e.attributes.spacing={type:"string",default:g[2].value},e.supports.className=!0,e):e})),s("editor.BlockEdit","pgn/with-spacing-control",a((function(e){return function(t){if(!m.includes(t.name))return React.createElement(e,t);var n=t.attributes,r=n.spacing,a=function(){var e=arguments.length>1?arguments[1]:void 0;return(arguments.length>0&&void 0!==arguments[0]?arguments[0]:"").split(" ").filter((function(t){return!e.includes(t)})).join(" ").replace(/\s+/g," ").trimStart()}(n.className,g.map((function(e){return"mt-"+e.value})));return t.attributes.className=r?"mt-".concat(r," ").concat(a):a,React.createElement(l,null,React.createElement(e,t),React.createElement(o,null,React.createElement(i,{title:p("Space Above"),initialOpen:!0},React.createElement(u,{value:r,options:g,onChange:function(e){t.setAttributes({spacing:e})}}))))}}),"withSpacingControl"))})();