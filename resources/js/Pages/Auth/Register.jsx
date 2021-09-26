import { FormContainer } from '@/Components/FormContainer'
import AuthWrapper from '@/Layouts/AuthWrapper'
import { useForm } from '@inertiajs/inertia-react'
import React, { useState } from 'react'

function Register() {
    const { post, processing, data, setData, errors, reset } = useForm({
        email: '',
        name: '',
        password: ''
    })
    const onHandleChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();

        post(route('register'));
    };
    return (
        <AuthWrapper>

            <FormContainer>
                <div>
                    register
                </div>
            </FormContainer>
        </AuthWrapper>
    )
}

export default Register
