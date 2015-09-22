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
    },

    updateRegistration: function(formData){
        AppDispatcher.dispatch({
            actionType: SecurityConstants.REGISTRATION_FORM_CHANGED,
            formData: formData
        });
    }
};

module.exports = SecurityActions;