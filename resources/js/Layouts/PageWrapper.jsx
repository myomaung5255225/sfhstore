<<<<<<< HEAD
import React from "react";

export const PageWrapper = ({ children }) => {
    return (
        <div>
            <div>
                {children}
            </div>
        </div>
    )
}
=======
import { Footer } from '@/Components/Footer'
import { Header } from '@/Components/Header'
import React from 'react'

function PageWrapper({ children, auth, canLogin, canRegister, errors }) {
    return (
        <div className='m-0 p-0'>
            <Header auth={auth} canLogin={canLogin} canRegister={canRegister} errors={errors} />
            <div className='w-full flex justify-center items-center content-center bg-gray-100'>
                <div className='flex max-w-7xl w-full bg-white min-h-screen shadow-sm mt-16'>
                    {children}
                </div>
            </div>
            <Footer />
        </div>
    )
}

export default PageWrapper
>>>>>>> 27eb23b141c3c077334dbce978242e9392092435
