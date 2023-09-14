/** @type {import('tailwindcss').Config} */

const defaultTheme = require('tailwindcss/defaultTheme')
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      screens: {
        'sm': '640px',  // Small screens, like phones
        'md': '768px',  // Medium screens, like tablets
        'lg': '1024px', // Large screens, like laptops
        'xl': '1280px', // Extra large screens, like desktops
        // You can define additional breakpoints here if needed.
      },
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
      animation: {
        moveRightAndBack: 'moveRightAndBack 0.5s ease-in-out',
      },
      keyframes: {
        moveRightAndBack: {
          '0%': { transform: 'translateX(0)' },
          '50%': { transform: 'translateX(0.4em)' },
          '100%': { transform: 'translateX(0)' },
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

