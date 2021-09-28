import ApplicationLogo from "@/Components/ApplicationLogo";
import { Link } from "@inertiajs/inertia-react";
import React from "react";
import './PageWrapper.css'
export const PageWrapper = ({ children, auth }) => {
    return (
        <div className='w-full bg-gray-100 min-h-screen m-0 p-0'>
            <nav className='flex w-full relative bg-white px-2 py-2 shadow-md justify-center items-center content-center text-gray-900'>
                <div className='w-full max-w-6xl flex justify-between items-center content-center'>
                    <ApplicationLogo className='w-12 h-12 text-white' />
                    <div className='flex justify-end items-center content-center space-x-3'>
                        {
                            auth && auth.user ? <Link href='/logout' method='post' as='a' className='border border-gray-900 rounded-lg-md px-2 py-2 hover:border-red-600 hover:text-red-600' >Logout</Link>
                                : <>
                                    <Link href='/login' as='a' className='border border-gray-900 rounded-lg px-2 py-2 hover:border-red-600 hover:text-red-600' >Login</Link>
                                    <Link href='/register' as='a' className='border border-gray-900 rounded-lg px-2 py-2 hover:border-red-600 hover:text-red-600' >Register</Link>
                                </>
                        }

                    </div>
                </div>
            </nav>
            <div className='w-full flex justify-center items-center content-center' >
                {children}
            </div>
        </div>
    )
}
