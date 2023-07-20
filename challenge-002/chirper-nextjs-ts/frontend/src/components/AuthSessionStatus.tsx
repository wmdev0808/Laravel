import { HTMLAttributes } from 'react'

type AuthSessionStatusProps = {
  status: number | string | null
} & HTMLAttributes<HTMLDivElement>

const AuthSessionStatus = ({
  status,
  className,
  ...props
}: AuthSessionStatusProps) => (
  <>
    {status && (
      <div
        className={`${className} font-medium text-sm text-green-600`}
        {...props}
      >
        {status}
      </div>
    )}
  </>
)

export default AuthSessionStatus
