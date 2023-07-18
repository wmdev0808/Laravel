'use client'

import React, { ReactNode, useState } from 'react'
import { Menu, Transition } from '@headlessui/react'

enum Direction {
  left = 'left',
  right = 'right',
  top = 'top',
  bottom = 'bottom',
}

export interface DropdownProps {
  align?: keyof typeof Direction
  width?: string
  contentClasses?: string
  trigger: ReactNode
  children?: ReactNode
}

const Dropdown = ({
  align = Direction.right,
  width = '48',
  contentClasses = 'py-1 bg-white',
  trigger,
  children,
}: DropdownProps) => {
  let alignmentClasses = 'origin-top'

  if (align === 'left') {
    alignmentClasses = 'origin-top-left left-0'
  } else if (align === 'right') {
    alignmentClasses = 'origin-top-right right-0'
  }

  let widthClasses = ''

  if (width === '48') {
    widthClasses = 'w-48'
  }

  const [open, setOpen] = useState(false)

  return (
    <Menu as="div" className="relative">
      {({ open }) => (
        <>
          <Menu.Button as={React.Fragment}>{trigger}</Menu.Button>

          <Transition
            show={open}
            enter="transition ease-out duration-200"
            enterFrom="transform opacity-0 scale-95"
            enterTo="transform opacity-100 scale-100"
            leave="transition ease-in duration-75"
            leaveFrom="transform opacity-100 scale-100"
            leaveTo="transform opacity-0 scale-95"
          >
            <div
              className={`absolute z-50 mt-2 ${width} rounded-md shadow-lg ${alignmentClasses}`}
            >
              <Menu.Items
                className={`rounded-md focus:outline-none ring-1 ring-black ring-opacity-5 ${contentClasses}`}
                static
              >
                {children}
              </Menu.Items>
            </div>
          </Transition>
        </>
      )}
    </Menu>
  )
}

export default Dropdown
