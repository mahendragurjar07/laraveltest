'use strict';
/** 
 * Customer toaster methods
 */
var _position = 'top-right';
var _showHideTransition = 'slide';
var _stack = 4;
var _hideAfter = 10000;

var _toast = {
    success: function (msg) {
        $.toast({
            heading: 'Success',
            icon: 'success',
            text: msg,
            position: _position,
            showHideTransition: _showHideTransition,
            stack: _stack,
            hideAfter: _hideAfter
        })
    },
    error: function (msg) {
        $.toast({
            heading: 'Error',
            icon: 'error',
            text: msg,
            position: _position,
            showHideTransition: _showHideTransition,
            stack: _stack,
            hideAfter: _hideAfter
        })
    },
    warning: function (msg) {
        $.toast({
            heading: 'Warning',
            icon: 'warning',
            text: msg,
            position: _position,
            showHideTransition: _showHideTransition,
            stack: _stack,
            hideAfter: _hideAfter
        })
    },
    info: function (msg) {
        $.toast({
            heading: 'Information',
            icon: 'info',
            text: msg,
            position: _position,
            showHideTransition: _showHideTransition,
            stack: _stack,
            hideAfter: _hideAfter
        })
    },
    successSticky: function (msg) {
        $.toast({
            heading: 'Success',
            icon: 'success',
            text: msg,
            position: _position,
            showHideTransition: _showHideTransition,
            stack: _stack,
            hideAfter: _hideAfter
        })
    },
}