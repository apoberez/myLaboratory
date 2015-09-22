import React from 'react';
import Classnames from 'classnames';

export class FormHorizontal extends React.Component {
    render() {
        return (
            <form name="registration" className="form-horizontal">
                {this.props.children}
            </form>
        );
    }
}

// todo rewrite to ES6
//FormHorizontal.Input = React.createClass({
//
//    getInitialState: function () {
//        return {
//            isDirty: false,
//            changed: false,
//            lostFocus: false
//        };
//    },
//
//    getMessage: function () {
//        var errors = this.props.errors || '';
//        var errorMessage = (typeof errors === 'string') ? errors : errors.join('\n');
//        return errorMessage;
//    },
//
//    render: function () {
//        var classes = cx({
//            'has-error': this.props.errors && this.state.lostFocus,
//            'has-success': this.state.changed && !this.props.errors,
//            'has-focus': this.state.hasFocus
//        });
//        var messageStyle = {
//            display:  this.state.isDirty ? 'block' : 'none'
//        };
//        return (
//            <div className={"form-group " + classes}>
//                <label className="col-sm-2 control-label">{this.props.label}</label>
//                <input type="text"
//                    ref='input'
//                    className="form-control"
//                    onChange={this.onChange}
//                    onFocus={this._onFocus}
//                    onBlur={this._onBlur}
//                    value={this.state.value}
//                />
//                <div className="col-sm-10" style={messageStyle}>
//                    <span>{this.getMessage()}</span>
//                </div>
//            </div>
//        )
//    },
//
//    onChange: function(e) {
//        this.setState({
//            value: e.target.value,
//            changed: true
//        });
//        this.props.onChange(e, this.props.name, e.target.value);
//    },
//
//    getValue: function () {
//        return this.state.value;
//    },
//
//    _onFocus: function () {
//        this.setState({
//            hasFocus: true,
//            isDirty: true,
//            lostFocus: false
//        });
//    },
//
//    _onBlur: function (e) {
//        this.setState({
//            labelUp: false,
//            lostFocus: true,
//            hasFocus: false
//        });
//        this.props.onChange(e, this.props.name, e.target.value);
//    }
//});
//
//FormHorizontal.Submit = React.createClass({
//    render: function () {
//        return (
//            <div className="form-group">
//                <div className="col-sm-10">
//                    <button disabled={this.props.disabled} type="submit" className="btn btn-default" onClick={this.props.onClick} >{this.props.label}</button>
//                </div>
//            </div>
//        );
//    }
//});
