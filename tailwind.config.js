/** @type {import('tailwindcss').Config} */
module.exports = {
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
    require('@tailwindcss/typography'),
  ],
  safelist: [
    'opacity-0',
    'group-hover:opacity-100',
    'transition-opacity',
    'duration-150',
    'ease-in-out'
  ],
}

