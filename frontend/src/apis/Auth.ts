import type { User } from "../types/User";
import axiosClient from "./AxiosClient";


interface RefreshTokenResponse {
    access_token: string;
    token_type: string;
    expires_in: number;
}

export interface LoginResponse {
    accessToken: string;
    user: User;
}

export interface RegisterCredentials {
    username: string;
    password: string;
    email: string;
}

export const getCurrentUser = async (): Promise<User> => {
    const response = await axiosClient.get('/auth/me');
    return response.data;
}

export const logout = async (): Promise<void> => {
    await axiosClient.post(`/auth/logout`);
};

export const refreshToken = async (): Promise<string> => {
    const response = await axiosClient.post<RefreshTokenResponse>(
        `/auth/refresh`
    );
    return response.data.access_token;
};

export const register = async (data: RegisterCredentials): Promise<User> => {
    const response = await axiosClient.post('/auth/register', data);
    return response.data;
};

export const login = async (email: string, password: string): Promise<LoginResponse> => {
    const response = await axiosClient.post('/auth/login',
        { email, password }
    );
    return response.data;
};