import React from 'react'

function AuthWrapper({ children }) {
    return (
        <div className='w-full flex justify-center items-center content-center min-h-screen bg-gray-100'>
            <div className='w-full flex max-w-md px-2 py-2 bg-white shadow-sm'>
                {children}
            </div>
        </div>
    )
}

export default AuthWrapper
