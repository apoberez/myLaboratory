/**
 * Created by ap on 10.05.15.
 */

var React = require('react');

components = {
    react: React,
    RegistrationForm: React.createFactory(require('./components/RegistrationForm'))
};
module.exports = components;