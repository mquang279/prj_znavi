import { NavLink } from "react-router";

const LoginPage = () => {
    return (
        <div className="flex justify-center h-screen">
            <div className="flex gap-6 flex-col justify-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg" alt="" className="h-16" />
                <form className="flex flex-col gap-4" action="">
                    <div>
                        <p className="font-semibold">Email</p>
                        <input type="text" className="border px-3 py-2 rounded-lg w-full" placeholder="Email" />
                    </div>
                    <div>
                        <p className="font-semibold">Password</p>
                        <input type="text" className="border px-3 py-2 rounded-lg w-full" placeholder="Password" />
                    </div>
                    <button className="bg-black text-white py-2 rounded-lg">Sign in</button>
                </form>
                <p>Do not have an account? {<NavLink className="text-blue-500" to={'/register'}>Sign up now!</NavLink>}</p>
            </div>
        </div>
    )
}

export default LoginPage;