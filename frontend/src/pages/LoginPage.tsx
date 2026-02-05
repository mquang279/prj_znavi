import { useState } from "react";
import { NavLink, useNavigate } from "react-router";
import useLogin, { type LoginCredentials } from "../hooks/auth/useLogin";

const LoginPage = () => {
    const { mutateAsync: loginMutation, isPending, error } = useLogin();
    const navigate = useNavigate();
    const [formData, setFormData] = useState<LoginCredentials>({
        email: "",
        password: ""
    });

    if (error) {
        console.log(error);
    }

    const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault()

        if (!formData.email || !formData.password) {
            return
        }
        await loginMutation(formData);
        console.log('Login success')
        navigate('/');
    }

    const handleChange = (field: keyof LoginCredentials) => (e: React.ChangeEvent<HTMLInputElement>) => {
        setFormData((prev) => ({ ...prev, [field]: e.target.value }))
    }

    return (
        <div className="flex justify-center h-screen">
            <div className="flex gap-6 flex-col justify-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg" alt="" className="h-16" />
                <form onSubmit={handleSubmit} className="flex flex-col gap-4" action="">
                    <div>
                        <p className="font-semibold">Email</p>
                        <input type="email" className="border px-3 py-2 rounded-lg w-full" placeholder="Email" onChange={handleChange("email")} />
                    </div>
                    <div>
                        <p className="font-semibold">Password</p>
                        <input type="password" className="border px-3 py-2 rounded-lg w-full" placeholder="Password" onChange={handleChange("password")} />
                    </div>
                    <button type="submit" className="bg-black text-white py-2 rounded-lg">Sign in</button>
                </form>
                <p className="text-sm text-center">Do not have an account? {<NavLink className="text-blue-500" to={'/register'}>Sign up now!</NavLink>}</p>
            </div>
        </div>
    )
}

export default LoginPage;