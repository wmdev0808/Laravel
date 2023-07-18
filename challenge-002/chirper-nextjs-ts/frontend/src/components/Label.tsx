import { LabelHTMLAttributes, PropsWithChildren } from 'react'

const Label = ({
  className,
  children,
  ...props
}: PropsWithChildren<LabelHTMLAttributes<HTMLLabelElement>>) => (
  <label
    className={`${className} block font-medium text-sm text-gray-700`}
    {...props}
  >
    {children}
  </label>
)

export default Label
