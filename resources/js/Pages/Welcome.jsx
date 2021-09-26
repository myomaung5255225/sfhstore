import React from 'react'

function Welcome(props) {
    return (
        <div>
            <pre>{JSON.stringify(props, null, 2)}</pre>
        </div>
    )
}

export default Welcome
