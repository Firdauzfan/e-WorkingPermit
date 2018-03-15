/*************************************************************************
*
* ADOBE CONFIDENTIAL
* ___________________
*
*  Copyright 2008 Adobe Systems Incorporated
*  All Rights Reserved.
*
* NOTICE:  All information contained herein is, and remains
* the property of Adobe Systems Incorporated and its suppliers,
* if any.  The intellectual and technical concepts contained
* herein are proprietary to Adobe Systems Incorporated and its
* suppliers and may be covered by U.S. and Foreign Patents,
* patents in process, and are protected by trade secret or copyright law.
* Dissemination of this information or reproduction of this material
* is strictly forbidden unless prior written permission is obtained
* from Adobe Systems Incorporated.
*
* AdobePatentID="B564"
* AdobePatentID="B565"
*
**************************************************************************/

ICE = {};

// Set the ICE.useConfig flag to false in case you do not want to use the ice.conf.js file or if
// this file is missing form your server. This should be done to avoid HTTP error code 404.
ICE.useConfig = true;

(function () {
	var isNotInIde = parent == window || ( parent != window && !(/ide\.htm/i).test(parent.location.href) );
	if (isNotInIde) {
		/*
		 * This setting defines the default shortcut for launching the InContext Editing Login
		 * dialog on any PC machine.
		 * 
		 * DO NOT MODIFY THIS CONSTANT!
		 * 
		 * Instead modify the ICE.USER_LOGIN_PC variable inside the ice.conf.js file.
		 */
		ICE.DEFAULT_LOGIN_PC = "CTRL+E";

		/*
		 * This setting defines the default shortcut for launching the InContext Editing Login
		 * dialog on any MAC machine.
		 * 
		 * DO NOT MODIFY THIS CONSTANT!
		 * 
		 * Instead modify the ICE.USER_LOGIN_MAC variable inside the ice.conf.js file.
		 */
		ICE.DEFAULT_LOGIN_MAC = "CMD+E";

		/**
		 * Gets the relative path based on the ice.js includes.
		 */
		ICE.getSiteRoot = function() {
			var searchPath = "includes/ice/ice.js";
		    var s = null;
		    var url = '';
		    var scripts = document.getElementsByTagName("script");
		    for (var i=0; i<scripts.length; i++) {
				url = scripts[i].src.toLowerCase();
				if (typeof url != "undefined") {
					if (url.indexOf(searchPath) != -1) {
						s = scripts[i].src;
						break;
					}
				}
		    }

			s = s.substring(0, s.length - searchPath.length);

			if (!/http/i.test(s)) {
				// This Happens on IE
				var m = s.match(/\.\.\//g);
				var deep = m?m.length:0;
				var loca = window.location;
				var path = loca.pathname.replace(/\/([^\/]*)$/, '/');
				var temp = path.split('/');
				var newLength = temp.length - deep - 1;
				temp.length = (newLength >= 0) ? newLength : 0;
				path = temp.join('/') + '/';
				s = loca.protocol + '//'+ loca.hostname + (loca.port?':' + loca.port:'') + path;
			}

			return s;
		};

		/**
		 * Adds a link to the current configuration file to the page HEAD so the values in this file become available
		 */
		ICE.getConfig = function() {
			var scr = document.createElement('SCRIPT');
			scr.type = 'text/javascript';
			var head=document.getElementsByTagName('HEAD')[0];
			head.appendChild(scr);
			scr.onreadystatechange = scr.onload = function(e) {
				e = e || event;
				if (e.type == 'readystatechange') {
					if (typeof this.jsloaded == 'undefined' && (this.readyState == 'complete')){
						this.jsloaded = true;
						ICE.attachKeyEvent();
					}
				} else {
					ICE.attachKeyEvent();
				}
			};
			var siteRoot = ICE.getSiteRoot();
			scr.src = siteRoot + 'includes/ice/ice.conf.js';
		};

		/**
		 * This function returns the available transport object as instance
		 *
		 * @return Object The transport instance
		 */
		ICE.getTransport = function() {
			var ret = false;
			var options = ['new XMLHttpRequest()',
				'new ActiveXObject("Msxml2.XMLHTTP")',
				'new ActiveXObject("Microsoft.XMLHTTP")'];

			for (var i=0; i<options.length; i++) {
				try {
					ret = eval(options[i]);
					break;
				} catch(err) {
					ret = false;
				}
			}
			return ret;
		};

		/**
		 * This function begins the actual edit by pointing the browser to the new URL.
		 */
		ICE.startEdit = function() {
			var redirectto = window.location.href;
			var siteRoot = ICE.getSiteRoot();
			redirectto = redirectto.substring(siteRoot.length);
			redirectto =  siteRoot + 'includes/ice/ide.html#page=' + encodeURIComponent(redirectto);

			// Make a request so we have the page cached
			var transport = ICE.getTransport();
			transport.open('GET', redirectto, false);
			transport.send(null);

			// Do the actual redirect
			window.location.href = redirectto;
		};

		/**
		 * This function attaches key events so we catch the combination that will launch the InContext Editing Login UI
		 */
		ICE.attachKeyEvent = function() {
			var platform = navigator.userAgent.match(/mac/i) ? "MAC" : "PC";
			var shortcut = ICE['DEFAULT_LOGIN_' + platform];

			if (typeof ICE['USER_LOGIN_' + platform] == 'string') {
				shortcut = ICE['USER_LOGIN_' + platform];
			}

			if (shortcut !== '' && shortcut.indexOf('+') != -1) {
				ICE.shortcut = {
					ctrlKey: shortcut.indexOf('CTRL+') != -1,
					altKey: shortcut.indexOf('ALT+') != -1,
					metaKey: shortcut.indexOf('CMD+') != -1,
					shiftKey: shortcut.indexOf('SHIFT+') != -1,
					keyCode: shortcut.slice(-1).charCodeAt(0),
					platform: platform
				};

				ICE.isShortcutPressed = function(event) {
					var retVal = true;
					retVal = retVal && (ICE.shortcut.ctrlKey ? event.ctrlKey : !event.ctrlKey);
					if (ICE.shortcut.platform == "MAC") {
						retVal = retVal && (ICE.shortcut.metaKey ? event.metaKey : !event.metaKey);
					}
					retVal = retVal && (ICE.shortcut.altKey ? event.altKey : !event.altKey);
					retVal = retVal && (ICE.shortcut.shiftKey ? event.shiftKey : !event.shiftKey);
					retVal = retVal && (ICE.shortcut.keyCode == event.keyCode);
					return retVal;
				};

				ICE.onkeydown = function (e) {
					e = e || event;
					if (ICE.isShortcutPressed(e)) {
						//stop keyboard shortcut and redirect to ICE IDE
						try{e.cancelBubble = true;}catch(err){}
						try{e.returnValue = false;}catch(err){}
						try{e.stopPropagation();}catch(err){}
						try{e.preventDefault();}catch(err){}
						ICE.startEdit();
						return false;
					}
				};

				if (document.addEventListener) {
					document.addEventListener('keydown', ICE.onkeydown, false);
				} else if (document.attachEvent) {
					document.attachEvent('onkeydown', ICE.onkeydown);
				} else {
					document.onkeydown = ICE.onkeydown;
				}
			}
		};

		/**
		 * Depending on the current setting - to use or not the config file - we'll decide to read the config or not
		 */
		if (ICE.useConfig) {
			// If the site owner has decided to use the ice.conf.js we'll go ahead and read it
			ICE.getConfig();
		} else {
			// Otherwise we'll go with the defaults
			ICE.attachKeyEvent();
		}
	}
})();
