import React from 'react'
import { Logo } from '../Logo'

export const FormContainer = ({ children }) => {
    return (
        <div className='w-full flex flex-col justify-center items-center content-center space-y-2'>
            <Logo />
            <hr />
            {children}
        </div>
    )
}
