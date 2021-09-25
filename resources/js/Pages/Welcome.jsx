import PageWrapper from '@/Layouts/PageWrapper'
import React from 'react'

function Welcome({ auth, canLogin, canRegister, errors }) {
    return (
        <PageWrapper auth={auth} canLogin={canLogin} canRegister={canRegister} errors={errors} >
            <div className='w-full flex'>
                welcome
            </div>
        </PageWrapper>
    )
}

export default Welcome
