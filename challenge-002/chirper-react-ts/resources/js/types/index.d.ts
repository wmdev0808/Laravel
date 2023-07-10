export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
};

export interface ChirpType {
    id: number;
    message: string;
    user: User;
    created_at: string;
    updated_at: string;
}
