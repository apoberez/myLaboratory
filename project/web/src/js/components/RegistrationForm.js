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
var assign = require('object-assign');

var RegForm = React.createClass({


    getInitialState: function () {
        return {
            formData: this.getComponentsData(),
            disabled: true,
            errors: {}
        }
    },

    render: function () {
        var fields = {
            EMAIL: 'email'
        };
        return (
            <FormHorizontal>
                <FormHorizontal.Input
                    ref={fields.EMAIL}
                    name={fields.EMAIL}
                    errors={this.state.errors[fields.EMAIL]}
                    label='Email'
                    placeholder='enter email'
                    onChange={this._onChange}
                />
                <FormHorizontal.Input
                    ref='password'
                    name='password'
                    errors={this.state.errors.password}
                    label='Password'
                    placeholder='enter password'
                    onChange={this._onChange}
                />
                <FormHorizontal.Input
                    ref='passwordConfirm'
                    name='passwordConfirm'
                    errors={this.state.errors.passwordConfirm}
                    label='Confirm'
                    placeholder='confirm password'
                    onChange={this._onChange}
                />
                <FormHorizontal.Submit onClick={this.submitRegistration} label='Submit' disabled={this.state.disabled}/>
            </FormHorizontal>
        );
    },


    componentDidMount: function () {
        RegistrationStore.addFailListener(this._onValidation);
        RegistrationStore.addSuccessListener(this._onValidation);
    },

    componentWillUnmount: function () {
        //RegistrationStore.removeChangeListener(this._onChange);//todo
    },

    submitRegistration: function (e) {
        e.preventDefault();
        Actions.confirmRegistration(this.state.formData);
    },

    getComponentsData: function () {
        var data = {};
        for(var component in this.refs) {
            if (this.refs.hasOwnProperty(component)) {
                data[component] = this.refs[component].getValue();
            }
        }
        return data;
    },

    _onChange: function (e, field, value) {
        var formData = assign({}, this.state.formData);
        formData[field] = value;
        this.setState({formData: formData});
        Actions.updateRegistration(formData);
    },

    _onValidation: function () {
        var errors = RegistrationStore.getErrors();
        console.log(errors ? true : false);
        this.setState({
            errors: errors || {},
            disabled: errors ? true : false
        });
    },

    _onFail: function () {

    },

    _onSuccess: function () {
        this.setState({
            errors: RegistrationStore.getErrors(),
            disabled: false
        });
    }
});

module.exports = RegForm;