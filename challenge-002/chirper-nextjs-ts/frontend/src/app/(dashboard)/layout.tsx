'use client'

import { ReactNode } from 'react'
import DashboardNav from './nav'
import { useAuth } from '@/hooks/auth'

export default function AppLayout(props: {
  header: ReactNode
  children: ReactNode
}) {
  const { logout, user } = useAuth({ middleware: 'auth' })

  if (user) {
    return (
      <div className="min-h-screen bg-gray-100">
        <DashboardNav user={user} logout={logout} />

        {/* Page Heading */}
        <header className="bg-white shadow">
          <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {props.header}
          </div>
        </header>

        {/* Page Content */}
        <main>{props.children}</main>
      </div>
    )
  }

  return null
}
