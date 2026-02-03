export interface Role {
    id: number;
    name: string;
    description: string;
    createdAt?: string;
    updatedAt?: string;
}

export interface User {
    id: number,
    username: string,
    email: string,
    role?: Role
}