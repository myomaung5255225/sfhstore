import React from "react";

export const Logo = ({ className }) => {
    return (
        <div className='flex justify-center items-center content-center flex-row space-x-3'>
            <img src="/images/logo.png" className={`${className} w-12 h-12`} alt="logo" />
            <h5 className='uppercase font-bold text-lg'>SFH store </h5>
        </div>
    )
}
