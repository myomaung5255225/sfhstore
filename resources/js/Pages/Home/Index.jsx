import { PageContainer } from '@/Layouts/PageContainer'
import { PageWrapper } from '@/Layouts/PageWrapper'
import React from 'react'
import './home.css'
function HomePage({ products, errors }) {
    console.log(products)
    return (
        <PageWrapper>
            <PageContainer>
                <div>
                    {JSON.stringify(products, null, 2)}
                </div>
            </PageContainer>
        </PageWrapper>
    )
}

export default HomePage
