/**
 * Created by ap on 21.04.15.
 */

var AppDispatcher = require('../dispatchers/AppDispatcher');
var SecurityConstants = require('../constants/SecurityConstants');

var SecurityActions = {
    confirmRegistration: function(email, password, confirm){
        AppDispatcher.dispatch({
            actionType: SecurityConstants.CONFIRM_REGISTRATION,
            email: email,
            password: password,
            passwordConfirm: confirm
        });
    }
};

module.exports = SecurityActions;