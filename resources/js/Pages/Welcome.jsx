import { PageWrapper } from '@/Layouts/PageWrapper'
import React from 'react'

function Welcome(props) {
    return (
        <PageWrapper auth={props.auth}>
            <div>
                welcome
            </div>
        </PageWrapper>
    )
}

export default Welcome
