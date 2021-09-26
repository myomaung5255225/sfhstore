import React from "react";

export const Button = ({ type = 'button', onNextFunction, buttonText }) => {
    return (
        <div className='w-full flex px-2 py-2'>
            <button className='w-full flex justify-center items-center content-center text-white bg-indigo-700 hover:bg-indigo-900 px-2 py-2 rounded-sm' onClick={onNextFunction}>{buttonText}</button>
        </div>
    )
}
