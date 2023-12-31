/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./dist/*.{html,js,php}"],
  theme: {animation: {
    'bounce-horizontal': 'bounce-horizontal 1.5s infinite',
    'bounce-horizontal-reverse': 'bounce-horizontal-reverse 1.5s infinite', // Nome animazione: durata animazione e iterazioni
    'appari':'appari  1s linear',
    'scompari':'scompari  .2s linear',
    'dasopra':'dasopra  .4s linear',
    'dasopra2':'dasopra2  .3s ease-in',
    'ritira':'ritira .3s ease-in',
    'ritira2':'ritira2 .5s linear',
    'dasinistra':'dasinistra  1s linear',
    'bounce':'bounce 1s infinite',
    'pulse':'pulse 1s infinite',
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

    'scompari' :{
      '0%': {
        opacity:'1',
      },
      '100%': {
        opacity:'0',
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

    'ritira' :{
      '0%': {
        transform: 'translateY(20px)',
        opacity:'0',
      },
      '100%': {
        transform: 'translateY(0px)',
        opacity:'1',
      },
    },
    'ritira2' :{
      '0%': {
        transform: 'translateY(0px)',
        opacity:'1',
      },
      '100%': {
        transform: 'translateY(50px)',
        opacity:'0',
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

    'pulse': {
      '0%' : {
        transform: 'scale(100%)',
       
      },
      '50%': {
        transform: 'scale(105%)',
        
      },
      
      '100%': {
        transform: 'scale(100%)',
        
      },
    },
    
    'dasopra2' :{
      '0%': {
        transform: 'translateY(-60px)',
        
      },
      '100%': {
        transform: 'translateY(0px)',
        
      },
    },
    
  },
    extend: {backgroundImage: {
      'back': "url('/img/sfondo home.jpg')",
 
    },},
    fontFamily: {
        lora: ['Lora', 'serif'],
        Montserrat:['Montserrat','serif'],
        Unna:['Unna','serif'],
        Merriweather:['Merriweather','serif'],
        Ayer:['Ayer','serif'],
        Grotesk:['Familjen Grotesk', 'sans-serif'],
      },
  },
  plugins: [],
}

