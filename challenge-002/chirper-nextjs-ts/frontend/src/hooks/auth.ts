import useSWR from 'swr'
import axios from '@/lib/axios'
import { Dispatch, SetStateAction, useEffect } from 'react'
import { useRouter, useSearchParams } from 'next/navigation'

export interface User {
  id: number
  name: string
  email: string
  email_verified_at: string
}

export enum AuthMiddleware {
  guest = 'guest',
  auth = 'auth',
}
export interface UseAuthProps {
  middleware?: keyof typeof AuthMiddleware
  redirectIfAuthenticated?: string
}

export interface RegisterInputProps {
  name: string
  email: string
  password: string
  password_confirmation: string
  setErrors: Dispatch<
    SetStateAction<
      Partial<
        Record<
          'name' | 'email' | 'password' | 'password_confirmation',
          string[]
        >
      >
    >
  >
}

export interface LoginInputProps {
  email: string
  password: string
  remember: boolean
  setErrors: Dispatch<
    SetStateAction<Partial<Record<'email' | 'password', string[]>>>
  >
  setStatus: Dispatch<SetStateAction<number | string | null>>
}

export type ForgotPasswordInputProps = Pick<
  LoginInputProps,
  'email' | 'setErrors' | 'setStatus'
>

export interface ResetPasswordInputProps {
  email: string
  password: string
  password_confirmation: string
  setErrors: Dispatch<
    SetStateAction<
      Partial<Record<'email' | 'password' | 'password_confirmation', string[]>>
    >
  >
  setStatus: Dispatch<SetStateAction<number | string | null>>
}

export type ResendEmailVerificationProps = {
  setStatus: Dispatch<SetStateAction<number | string | null>>
}

export const useAuth = ({
  middleware,
  redirectIfAuthenticated,
}: UseAuthProps = {}) => {
  const router = useRouter()
  const searchParams = useSearchParams()

  const {
    data: user,
    error,
    mutate,
  } = useSWR<User>('/api/user', () =>
    axios
      .get('/api/user')
      .then((res) => res.data)
      .catch((error) => {
        if (error.response.status !== 409) throw error

        router.push('/verify-email')
      }),
  )

  const csrf = () => axios.get('/sanctum/csrf-cookie')

  const register = async ({ setErrors, ...props }: RegisterInputProps) => {
    await csrf()

    setErrors({})

    axios
      .post('/register', props)
      .then(() => mutate())
      .catch((error) => {
        if (error.response.status !== 422) throw error

        setErrors(error.response.data.errors)
      })
  }

  const login = async ({ setErrors, setStatus, ...props }: LoginInputProps) => {
    await csrf()

    setErrors({})
    setStatus(null)

    axios
      .post('/login', props)
      .then(() => mutate())
      .catch((error) => {
        if (error.response.status !== 422) throw error

        setErrors(error.response.data.errors)
      })
  }

  const forgotPassword = async ({
    setErrors,
    setStatus,
    email,
  }: ForgotPasswordInputProps) => {
    await csrf()

    setErrors({})
    setStatus(null)

    axios
      .post('/forgot-password', { email })
      .then((response) => setStatus(response.data.status))
      .catch((error) => {
        if (error.response.status !== 422) throw error

        setErrors(error.response.data.errors)
      })
  }

  const resetPassword = async ({
    setErrors,
    setStatus,
    ...props
  }: ResetPasswordInputProps) => {
    await csrf()

    setErrors({})
    setStatus(null)

    axios
      .post('/reset-password', { token: searchParams.get('token'), ...props })
      .then((response) =>
        router.push('/login?reset=' + btoa(response.data.status)),
      )
      .catch((error) => {
        if (error.response.status !== 422) throw error

        setErrors(error.response.data.errors)
      })
  }

  const resendEmailVerification = ({
    setStatus,
  }: ResendEmailVerificationProps) => {
    axios
      .post('/email/verification-notification')
      .then((response) => setStatus(response.data.status))
  }

  const logout = async () => {
    if (!error) {
      await axios.post('/logout').then(() => mutate())
    }

    window.location.pathname = '/login'
  }

  useEffect(() => {
    if (middleware === AuthMiddleware.guest && redirectIfAuthenticated && user)
      router.push(redirectIfAuthenticated)
    if (window.location.pathname === '/verify-email' && user?.email_verified_at)
      router.push(redirectIfAuthenticated || '/')
    if (middleware === AuthMiddleware.auth && error) logout()
  }, [user, error])

  return {
    user,
    register,
    login,
    forgotPassword,
    resetPassword,
    resendEmailVerification,
    logout,
  }
}
