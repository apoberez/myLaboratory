import React from 'react';
import Parser from '../components/Parser'

class Test extends React.Component {
    render () {
        return <div>test</div>
    }
}


React.render(<Parser/>, document.getElementById('registration-form'));
