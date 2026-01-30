/** @type {import('tailwindcss').Config} */
export default {
  content: ["./src/**/*.{html,js,jsx,ts,tsx}"],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Geist Mono', 'monospace'],
        mono: ['Geist Mono', 'monospace'],
      },
    },
  },
  plugins: [],
}

