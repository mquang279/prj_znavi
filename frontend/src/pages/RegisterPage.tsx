import { useState } from "react";
import { NavLink } from "react-router-dom";
import useRegister, { type RegisterCredentials } from "../hooks/auth/useRegister";

const RegisterPage = () => {
    const { mutateAsync: registerMutation, isPending, error } = useRegister();
    const [formData, setFormData] = useState<RegisterCredentials>({
        email: '',
        username: '',
        password: '',
        address: '',
        phoneNumber: ''
    });

    const handleChange = (field: keyof RegisterCredentials) => (e: React.ChangeEvent<HTMLInputElement>) => {
        setFormData((prev) => ({ ...prev, [field]: e.target.value }))
    }

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault()

        await registerMutation({
            email: formData.email,
            username: formData.username,
            password: formData.password,
            address: formData.address,
            phoneNumber: formData.phoneNumber
        })
        console.log(formData);
    }

    return (
        <div>
            <div className="flex justify-center h-screen">
                <div className="flex gap-6 flex-col justify-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg" alt="" className="h-16" />
                    <form onSubmit={handleSubmit} className="flex flex-col gap-4 w-80" action="">
                        <div>
                            <p className="font-semibold">Email</p>
                            <input type="email" className="border px-3 py-2 rounded-lg w-full" placeholder="Email" onChange={handleChange("email")} />
                        </div>
                        <div>
                            <p className="font-semibold">Username</p>
                            <input type="text" className="border px-3 py-2 rounded-lg w-full" placeholder="Password" onChange={handleChange("username")} />
                        </div>
                        <div>
                            <p className="font-semibold">Password</p>
                            <input type="password" className="border px-3 py-2 rounded-lg w-full" placeholder="Password" onChange={handleChange("password")} />
                        </div>
                        <div>
                            <p className="font-semibold">Phone number</p>
                            <input type="text" className="border px-3 py-2 rounded-lg w-full" placeholder="Password" onChange={handleChange("phoneNumber")} />
                        </div>
                        <div>
                            <p className="font-semibold">Address</p>
                            <input type="text" className="border px-3 py-2 rounded-lg w-full" placeholder="Password" onChange={handleChange("address")} />
                        </div>
                        <p></p>
                        <button type="submit" className="bg-black text-white py-2 rounded-lg">Sign up</button>
                    </form>
                    <p className="text-sm text-center">Already have an account? {<NavLink to={'/login'} className="text-blue-500">Sign in</NavLink>}</p>
                </div>
            </div>
        </div>
    )
}

export default RegisterPage;