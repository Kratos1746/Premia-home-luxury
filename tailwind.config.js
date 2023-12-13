/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./dist/*.{html,js}"],
  theme: {animation: {
    'bounce-horizontal': 'bounce-horizontal 1.5s infinite',
    'bounce-horizontal-reverse': 'bounce-horizontal-reverse 1.5s infinite', // Nome animazione: durata animazione e iterazioni
    'appari':'appari  1s linear',
    'dasopra':'dasopra  .5s linear',
    'dasinistra':'dasinistra  1s linear',
    'bounce':'bounce 1s infinite',
  },
  keyframes: {
    'bounce-horizontal': {
      '0%, 100%': {
        transform: 'translateX(0px)',
      },
      '50%': {
        transform: 'translateX(30px)',
      },
    },

    'bounce-horizontal-reverse': {
      '0%, 100%': {
        transform: 'translateX(0px)',
      },
      '50%': {
        transform: 'translateX(-30px)',
      },
    },

     'appari' :{
      '0%': {
        opacity:'0',
      },
      '100%': {
        opacity:'1',
      },
    },

    'appari' :{
      '0%': {
        opacity:'0',
      },
      '100%': {
        opacity:'1',
      },
    },

    'dasopra' :{
      '0%': {
        transform: 'translateY(-20px)',
        opacity:'0',
      },
      '100%': {
        transform: 'translateY(0px)',
        opacity:'1',
      },
    },

    'dasinistra' :{
      '0%': {
        transform: 'translateX(-20%)',
        opacity:'0',
      },
      '100%': {
        transform: 'translatX(0px)',
        opacity:'1',
      },
    },
    
    

   'bounce': {
      '0%' : {
        transform: 'translateY(25%)',
       
      },
      '50%': {
        transform: 'translateY(0)',
        
      },
      '100%': {
        transform: 'translateY(25%)',
        
      },
    },
    
    
  },
    extend: {backgroundImage: {
      'back': "url('/img/sfondo home.jpg')",
      
    },},
  },
  plugins: [],
}

