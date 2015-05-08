/**
 * Created by ap on 27.04.15.
 */

/**
 *  @jsx React.DOM
 */
var React = require('react');
var cx = require('classnames');

var FormHorizontal = React.createClass({
    render: function () {
        return (
            <form name="registration" className="form-horizontal">
                {this.props.children}
            </form>
        );
    }
});

FormHorizontal.Input = React.createClass({
    render: function () {
        var errors = this.props.errors || '';
        var errorMessage = (typeof errors === 'string') ? errors : errors.join('\n');
        var classes = cx({
            'has-error': errors
        });
        return (
            <div className={"form-group " + classes}>
                <label className="col-sm-2 control-label">{this.props.label}</label>
                <div className="col-sm-10">
                    <input type="text" className="form-control" placeholder={this.props.placeholder} onChange={this.props.onChange} />
                </div>
                <div className="col-sm-offset-2 col-sm-10">
                    <span className="text-danger">{errorMessage}</span>
                </div>
            </div>
        )
    }
});

FormHorizontal.Submit = React.createClass({
    render: function () {
        return (
            <div className="form-group">
                <div className="col-sm-offset-2 col-sm-10">
                    <button disabled={this.props.disabled} type="submit" className="btn btn-default" onClick={this.props.onClick} >{this.props.label}</button>
                </div>
            </div>
        );
    }
});

module.exports = FormHorizontal;