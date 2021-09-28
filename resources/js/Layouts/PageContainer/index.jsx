import React from "react";

export const PageContainer = ({ children }) => {
    return (
        <div className='w-full flex max-w-7xl bg-white min-h-screen mt-2 mb-2 rounded-sm shadow-md'>
            {children}
        </div>
    )
}
