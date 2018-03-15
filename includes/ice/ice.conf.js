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

if (typeof ICE == 'undefined') {
	ICE = {};
}

/*
 * This setting defines the shortcut for launching the InContext Editing Login dialog on any PC machine.
 * If you want to disable this keyboard shortcut leave an empty value for the option.
 *
 * The shortcut definition must include one or more keyboard modifiers and a character. The available PC
 * keyboard modifier are: CTRL, ALT and SHIFT. All keyboard modifiers and the required character must be
 * separated by "+" (without the quotes).
 *
 * Sample shortcuts:
 *   CTRL+E
 *   CTRL+ALT+Y
 *   CTRL+ALT+SHIFT+W
 *
 * NOTE: Please make sure you do not overwrite any default keyboard shortcut available in your web browser(s).
 */
ICE.USER_LOGIN_PC = "CTRL+E";

/*
 * This setting defines the shortcut for launching the InContext Editing Login dialog on any Macintosh machine
 * If you want to disable this keyboard shortcut leave an empty value for the option.
 *
 * The shortcut definition must include one or more keyboard modifiers and a character. The available Macintosh
 * keyboard modifier are: CMD, CTRL, ALT and SHIFT. All keyboard modifiers and the required character must be
 * separated by "+" (without the quotes).
 *
 * Sample shortcuts:
 *   CTRL+E
 *   CTRL+CMD+ALT+Y
 *   CMD+ALT+SHIFT+W
 *
 * NOTE: Please make sure you do not overwrite any default keyboard shortcut available in your web browser(s).
 */
ICE.USER_LOGIN_MAC = "CMD+E";

