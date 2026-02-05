import { useMutation } from "@tanstack/react-query";
import { useNavigate } from "react-router";
import { register } from "../../apis/Auth";
import type { User } from "../../types/User";

export interface RegisterCredentials {
    email: string
    username: string
    password: string
    address: string
    phoneNumber: string
}

const useRegister = () => {
    const navigate = useNavigate()

    return useMutation({
        mutationFn: async (credentials: RegisterCredentials): Promise<User> => {
            return await register(credentials);
        },
        onSuccess: () => {
            navigate('/login')
        }
    });
};

export default useRegister;