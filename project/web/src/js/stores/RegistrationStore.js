/**
 * Created by ap on 21.04.15.
 */

var AppDispatcher = require('../dispatchers/AppDispatcher');
var assign = require('object-assign');
var EventEmitter = require('events').EventEmitter;
var constants = require('../constants/SecurityConstants');
var Validator = require('validator');
var $ = require('jquery');

//todo move to separate file
Validator.extend('notEmpty', function (value) {
    return !!value || value === 0;
});

function ModelValidator(data) {
    this.constraints = data.constraints;
    this.model = data.model;
}

ModelValidator.prototype.validate = function () {
    var errors = {};
    for (var field in this.constraints) {
        var fieldErrors = this.validateField(field);
        if (fieldErrors.length > 0) {
            errors[field] = fieldErrors;
        }
    }
    return errors;
};

ModelValidator.prototype.validateField = function (field) {
    var errors = [];
    if (this.constraints.hasOwnProperty(field)) {
        for (var i = 0, length = this.constraints[field].length; i < length; i++) {
            var constraint = this.constraints[field][i];
            var validationFunc;
            if (typeof(constraint.callback) === 'function') {
                validationFunc = constraint.callback
            } else if (Validator.hasOwnProperty(constraint.type)) {
                validationFunc = Validator[constraint.type]
            }
            if (validationFunc && !validationFunc.call(this, this.model[field])) {
                errors.push(constraint.message);
                if (constraint.stopPropagation !== false) {
                    break;
                }
            }
        }
    }
    return errors;
};

var model = {
    email: '',
    password: '',
    passwordConfirm: ''
};

var modelValidator = new ModelValidator({
    model: model,
    constraints: {
        email: [
            {type: 'notEmpty', message: 'required field'},
            {type: 'isEmail', message: 'enter valid email'}
        ],
        password: [
            {type: 'notEmpty', message: 'required field'}
        ],
        passwordConfirm: [
            {type: 'notEmpty', message: 'required field'},
            {callback: function(value){
                if(!this.model.password){ return true }
                return value === this.model.password
            }, message: 'mast match password'}
        ]
    }
});

function isEmptyObject(obj) {
    var name;
    for (name in obj) {
        if (obj.hasOwnProperty(name)) {
            return false;
        }
    }
    return true;
}

var errors = {};
var message = '';

var RegistrationStore = assign({}, EventEmitter.prototype, {
    getState: function () {
        return model;
    },

    getErrors: function () {
        return errors;
    },

    getMessage: function () {
        return message;
    },

    hasErrors: function () {
        return !isEmptyObject(errors);
    },

    submit: function () {
        errors = modelValidator.validate();
        if (this.hasErrors()) {
            this.emitFail();
        } else {
            this.sync();
        }
    },

    sync: function () {
        var self = this;
        $.ajax({
            method: 'post',
            url: '/en_EN/user/registration',
            dataType: 'json',
            success: function (response) {
                message = response.message;
                self.emitSuccess();
            },
            error: function (response) {
                response = JSON.parse(response.responseText);
                message = response.message;
                errors = response.errors;
                self.emitFail();
            },
            data: model
        });
    },


    addSuccessListener: function (callback) {
        this.on(constants.REGISTRATION_SUCCESS, callback)
    },

    addFailListener: function (callback) {
        this.on(constants.REGISTRATION_FAIL, callback)
    },

    addChangeListener: function (callback) {
        this.on(constants.REGISTRATION_CHANGED, callback);
    },

    emitChange: function () {
        this.emit(constants.REGISTRATION_CHANGED)
    },

    emitSuccess: function () {
        this.emit(constants.REGISTRATION_SUCCESS)
    },

    emitFail: function () {
        this.emit(constants.REGISTRATION_FAIL)
    }
});

AppDispatcher.register(function (payload) {
    switch (payload.actionType) {
        case constants.CONFIRM_REGISTRATION:
            model.email = payload.email;
            model.password = payload.password;
            model.passwordConfirm = payload.passwordConfirm;
            RegistrationStore.submit();
    }
});

module.exports = RegistrationStore;