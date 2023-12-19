CKEDITOR.plugins.add("colorbutton",{requires:"panelbutton,floatpanel",lang:"af,ar,az,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,es-mx,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,oc,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn",icons:"bgcolor,textcolor",hidpi:!0,init:function(t){function e(e,a,c,s,i){var u,f=new CKEDITOR.style(n["colorButton_"+a+"Style"]),d=CKEDITOR.tools.getNextId()+"_colorBox",g={type:a};i=i||{},t.ui.add(e,CKEDITOR.UI_PANELBUTTON,{label:c,title:c,modes:{wysiwyg:1},editorFocus:0,toolbar:"colors,"+s,allowedContent:f,requiredContent:f,contentTransformations:i.contentTransformations,panel:{css:CKEDITOR.skin.getPath("editor"),attributes:{role:"listbox","aria-label":l.panelTitle}},onBlock:function(e,r){u=r,r.autoSize=!0,r.element.addClass("cke_colorblock"),r.element.setHtml(function(e,r,a,c){e=[];var s=n.colorButton_colors.split(","),i=n.colorButton_colorsPerRow||6,u=t.plugins.colordialog&&!1!==n.colorButton_enableMore,f=s.length+(u?2:1),d=CKEDITOR.tools.addFunction((function(e,r){function l(e){var l=n["colorButton_"+r+"Style"];t.removeStyle(new CKEDITOR.style(l,{color:"inherit"})),l.childRule="back"==r?function(t){return o(t)}:function(t){return!(t.is("a")||t.getElementsByTag("a").count())||o(t)},t.focus(),e&&t.applyStyle(new CKEDITOR.style(l,{color:e})),t.fire("saveSnapshot")}if(t.focus(),t.fire("saveSnapshot"),"?"!=e)return l(e&&"#"+e);t.getColorFromDialog((function(t){if(t)return l(t)}),null,c)}));for(!1!==n.colorButton_enableAutomatic&&e.push('<a class="cke_colorauto" _cke_focus=1 hidefocus=true title="',l.auto,'" draggable="false" ondragstart="return false;" onclick="CKEDITOR.tools.callFunction(',d,",null,'",r,"');return false;\" href=\"javascript:void('",l.auto,'\')" role="option" aria-posinset="1" aria-setsize="',f,'"><table role="presentation" cellspacing=0 cellpadding=0 width="100%"><tr><td colspan="'+i+'" align="center"><span class="cke_colorbox" id="',a,'"></span>',l.auto,"</td></tr></table></a>"),e.push('<table role="presentation" cellspacing=0 cellpadding=0 width="100%">'),a=0;a<s.length;a++){0==a%i&&e.push("</tr><tr>");var g=s[a].split("/"),b=g[0],p=g[1]||b;e.push('<td><a class="cke_colorbox" _cke_focus=1 hidefocus=true title="',g[1]?b:t.lang.colorbutton.colors[p]||p,'" draggable="false" ondragstart="return false;" onclick="CKEDITOR.tools.callFunction(',d,",'",p,"','",r,"'); return false;\" href=\"javascript:void('",p,'\')" data-value="'+p+'" role="option" aria-posinset="',a+2,'" aria-setsize="',f,'"><span class="cke_colorbox" style="background-color:#',p,'"></span></a></td>')}return u&&e.push('</tr><tr><td colspan="'+i+'" align="center"><a class="cke_colormore" _cke_focus=1 hidefocus=true title="',l.more,'" draggable="false" ondragstart="return false;" onclick="CKEDITOR.tools.callFunction(',d,",'?','",r,"');return false;\" href=\"javascript:void('",l.more,"')\"",' role="option" aria-posinset="',f,'" aria-setsize="',f,'">',l.more,"</a></td>"),e.push("</tr></table>"),e.join("")}(e,a,d,g)),r.element.getDocument().getBody().setStyle("overflow","hidden"),CKEDITOR.ui.fire("ready",this);var c=r.keys,s="rtl"==t.lang.dir;c[s?37:39]="next",c[40]="next",c[9]="next",c[s?39:37]="prev",c[38]="prev",c[CKEDITOR.SHIFT+9]="prev",c[32]="click"},refresh:function(){t.activeFilter.check(f)||this.setState(CKEDITOR.TRISTATE_DISABLED)},onOpen:function(){var e=(l=t.getSelection())&&l.getStartElement(),o=t.elementPath(e);if(o){e=o.block||o.blockLimit||t.document.getBody();do{o=e&&e.getComputedStyle("back"==a?"background-color":"color")||"transparent"}while("back"==a&&"transparent"==o&&e&&(e=e.getParent()));if(o&&"transparent"!=o||(o="#ffffff"),!1!==n.colorButton_enableAutomatic&&this._.panel._.iframe.getFrameDocument().getById(d).setStyle("background-color",o),e=l&&l.getRanges()[0]){var l=new CKEDITOR.dom.walker(e),c=e.collapsed?e.startContainer:l.next();for(e="";c;){if(c.type!==CKEDITOR.NODE_ELEMENT&&(c=c.getParent()),c=r(c.getComputedStyle("back"==a?"background-color":"color")),(e=e||c)!==c){e="";break}c=l.next()}for("transparent"==e&&(e=""),"fore"==a&&(g.automaticTextColor="#"+r(o)),g.selectionColor=e?"#"+e:"",l=e,e=u._.getItems(),c=0;c<e.count();c++){var s=e.getItem(c);s.removeAttribute("aria-selected"),l&&l==r(s.getAttribute("data-value"))&&s.setAttribute("aria-selected",!0)}}return o}}})}function o(t){return"false"==t.getAttribute("contentEditable")||t.getAttribute("data-nostyle")}function r(t){return CKEDITOR.tools.normalizeHex("#"+CKEDITOR.tools.convertRgbToHex(t||"")).replace(/#/g,"")}var n=t.config,l=t.lang.colorbutton;if(!CKEDITOR.env.hc){e("TextColor","fore",l.textColorTitle,10,{contentTransformations:[[{element:"font",check:"span{color}",left:function(t){return!!t.attributes.color},right:function(t){t.name="span",t.attributes.color&&(t.styles.color=t.attributes.color),delete t.attributes.color}}]]});var a={},c=t.config.colorButton_normalizeBackground;(void 0===c||c)&&(a.contentTransformations=[[{element:"span",left:function(t){var e=CKEDITOR.tools;return!("span"!=t.name||!t.styles||!t.styles.background)&&((t=e.style.parse.background(t.styles.background)).color&&1===e.object.keys(t).length)},right:function(e){var o=new CKEDITOR.style(t.config.colorButton_backStyle,{color:e.styles.background}).getDefinition();return e.name=o.element,e.styles=o.styles,e.attributes=o.attributes||{},e}}]]),e("BGColor","back",l.bgColorTitle,20,a)}}}),CKEDITOR.config.colorButton_colors="1ABC9C,2ECC71,3498DB,9B59B6,4E5F70,F1C40F,16A085,27AE60,2980B9,8E44AD,2C3E50,F39C12,E67E22,E74C3C,ECF0F1,95A5A6,DDD,FFF,D35400,C0392B,BDC3C7,7F8C8D,999,000",CKEDITOR.config.colorButton_foreStyle={element:"span",styles:{color:"#(color)"},overrides:[{element:"font",attributes:{color:null}}]},CKEDITOR.config.colorButton_backStyle={element:"span",styles:{"background-color":"#(color)"}};