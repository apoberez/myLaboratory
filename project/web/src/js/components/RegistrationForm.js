/**
 * Created by ap on 19.04.15.
 */

/**
 *  @jsx React.DOM
 */
var React = require('react');
var RegistrationStore = require('../stores/RegistrationStore');
var FormHorizontal = require('./FormHorizontal');
var Actions = require('../actions/SecurityActions');
var cx = require('classnames');

var RegForm = React.createClass({

    getInitialState: function () {
        return {
            email: '',
            password: '',
            passwordConfirm: '',
            errors: {}
        }
    },

    render: function () {
        return (
            <FormHorizontal>
                <FormHorizontal.Input
                    errors={this.state.errors.email}
                    label='Email'
                    placeholder='enter email'
                    onChange={this.setEmail}
                />
                <FormHorizontal.Input
                    errors={this.state.errors.password}
                    label='Password'
                    placeholder='enter password'
                    onChange={this.setPassword}
                />
                <FormHorizontal.Input
                    errors={this.state.errors.passwordConfirm}
                    label='Confirm'
                    placeholder='confirm password'
                    onChange={this.setPasswordConfirm}
                />
                <FormHorizontal.Submit onClick={this.submitRegistration} label='Submit' disabled={this.state.disabled}/>
            </FormHorizontal>
        );
    },


    componentDidMount: function () {
        RegistrationStore.addFailListener(this._onFail);
        RegistrationStore.addSuccessListener(this._onSuccess);
    },

    componentWillUnmount: function () {
        //RegistrationStore.removeChangeListener(this._onChange);//todo
    },

    setEmail: function (e) {
        this.setState({email: e.target.value});
    },

    setPassword: function (e) {
        this.setState({password: e.target.value});
    },

    setPasswordConfirm: function (e) {
        this.setState({passwordConfirm: e.target.value});
    },

    submitRegistration: function (e) {
        e.preventDefault();
        this.setState({
            disabled: true
        });
        Actions.confirmRegistration(this.state.email, this.state.password, this.state.passwordConfirm);
    },

    _onFail: function () {
        this.setState({
            errors: RegistrationStore.getErrors(),
            disabled: false
        });
    },

    _onSuccess: function () {
        this.setState({
            errors: RegistrationStore.getErrors(),
            disabled: false
        });
    }
});

module.exports = RegForm;