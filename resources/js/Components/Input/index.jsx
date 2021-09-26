import React from "react";

export const Input = ({ setData, name, type = 'text', autoComplete, placeHolder, labelText }) => {

    return (
        <div className='w-full flex px-2 py-2 flex-col'>
            <label className='text-xs py-2 uppercase font-light' htmlFor={name}>{labelText}</label>
            <input type={type} onChange={(e) => {
                setData(data => ({
                    ...data,
                    [e.target.name]: e.target.value
                }))
            }} name={name} className={type === 'checkbox' ? 'block rounded-sm' : 'w-full flex rounded-sm'} autoComplete={autoComplete} placeholder={placeHolder} />
        </div>
    )
}
