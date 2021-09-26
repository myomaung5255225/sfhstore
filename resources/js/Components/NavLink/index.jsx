import React from "react";
import { Link } from '@inertiajs/inertia-react'
export const NavItems = ({ className, auth }) => {
    return (
        <div className='flex justify-end items-center content-center space-x-3'>
            {
                auth.user ?
                    <Link title='Logout' href='/logout' as='a' method='post' className='bg-gray-700 text-white px-2 py-2 rounded-md uppercase'>
                        Logout
                    </Link> : <>
                        <Link title='Login' href='/login' as='a' method='get' className='bg-gray-700 text-white px-2 py-2 rounded-md uppercase'>
                            Login
                        </Link>
                        <Link title='Regiser' href='/register' as='a' method='get' className='bg-gray-700 text-white px-2 py-2 rounded-md uppercase'>
                            Register
                        </Link>
                    </>
            }


        </div>
    )
}
