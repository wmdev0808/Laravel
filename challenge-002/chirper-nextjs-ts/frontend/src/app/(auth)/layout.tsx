import { Metadata } from 'next'
import { PropsWithChildren } from 'react'

export const metadata: Metadata = {
  title: 'Next.js v13 + Laravel - Auth',
}

const GuestLayout = ({ children }: PropsWithChildren) => {
  return <div className="font-sans text-gray-900 antialiased">{children}</div>
}

export default GuestLayout
