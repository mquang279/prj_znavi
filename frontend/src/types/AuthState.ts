import type { User } from "./User"

export interface AuthState {
    isAuthenticated?: boolean
    token?: string
    user: User | null
}