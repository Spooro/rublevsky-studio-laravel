/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",

      ],
      darkMode: 'class',
  theme: {
    extend: {},
  },
  plugins: [
  ],
  safelist: [
    'opacity-0',
    'group-hover:opacity-100',
    'transition-opacity',
    'duration-150',
    'ease-in-out'
  ],
}

