import './globals.css'
import type { Metadata } from 'next'
import { Inter } from 'next/font/google'

const inter = Inter({ subsets: ['latin'] })

export const metadata: Metadata = {
  title: 'Laravel',
  description: 'Next.js v13.x with Laravel',
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="en">
      <head>
        <link
          href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap"
          rel="stylesheet"
        />
      </head>

      <body className={inter.className}>
        <div className="font-sans text-gray-900 antialiased">{children}</div>
      </body>
    </html>
  )
}
