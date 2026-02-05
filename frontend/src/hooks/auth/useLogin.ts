import { useMutation } from "@tanstack/react-query";
import { useAuth } from "./useAuth";
import type { User } from "../../types/User";
import { login } from "../../apis/Auth";

export interface LoginCredentials {
    email: string;
    password: string;
}

export interface LoginResponse {
    accessToken: string;
    user: User;
}

const useLogin = () => {
    const { login: authLogin } = useAuth();

    return useMutation({
        mutationFn: async (credentials: LoginCredentials): Promise<LoginResponse> => {
            return await login(credentials.email, credentials.password);
        },
        onSuccess: (data: LoginResponse) => {
            authLogin(data.accessToken, data.user);
            console.log(data);
        },
        onError: (error: Error) => {
            localStorage.removeItem("accessToken");
            console.error("Login failed:", error);
        },
    });
};

export default useLogin;