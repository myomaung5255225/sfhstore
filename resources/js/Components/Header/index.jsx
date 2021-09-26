import React from "react";
import { Logo } from "../Logo";
import { NavItems } from "../NavLink";


export const Header = ({ className, auth, errors, canLogin, canRegister }) => {
    return (
        <nav className={`${className} w-full flex bg-gray-800 text-white shadow-lg fixed px-2 py-2 justify-center items-center content-center`}>
            <div className='flex w-full max-w-7xl justify-between items-center content-center'>
                <Logo />
                <NavItems auth={auth} />
            </div>
        </nav>
    )
}
