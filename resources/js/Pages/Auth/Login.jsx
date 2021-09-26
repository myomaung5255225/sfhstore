import { FormContainer } from '@/Components/FormContainer'
import { Input } from '@/Components/Input'
import AuthWrapper from '@/Layouts/AuthWrapper'
import React, { useState } from 'react'
import { Inertia } from '@inertiajs/inertia'
import { InertiaProgress } from '@inertiajs/progress'
import { Button } from '@/Components/Button'

function Login(props) {
    const [data, setData] = useState({
        email: '',
        password: '',

    })
    const onNextFunction = () => {
        InertiaProgress.init({
        })
        Inertia.post(route('login'), data)

    }

    return (
        <AuthWrapper>
            <FormContainer>
                <Input setData={setData} name='email' id="email" type='email' autoComplete='email' placeHolder='email address' labelText='Email address' />
                <Input setData={setData} name='password' id="password" type='password' placeHolder='Password' labelText='Password' />
                <Button onNextFunction={() => { onNextFunction() }} buttonText="Login" />
            </FormContainer>
        </AuthWrapper>
    )
}

export default Login
