module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    colors: {
      'primary': '#F23030',
      'white': '#FBFBFB',
      'black': '#0F0F0F',
      'grey': '#716969',
      'dark-grey': '#2D2E2E',
      'opacity': 'rgba(255, 255, 255, .45)',
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ]
}
