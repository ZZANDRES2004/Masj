
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ichiban Scroll</title>
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: sans-serif;
    }

    img {
      width: 100vw;
      height: 100dvh;
      object-fit: cover;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 0;
    }

   main {
  height: 2000dvh;
}

    @keyframes slideInDown {
      from {
        transform: translate3d(-50%, -100%, 0);
        opacity: 0;
      }

      to {
        transform: translate3d(-50%, 0, 0);
        opacity: 1;
      }
    }


    #btnContainer {
      display: none;
      position: fixed;
      top: 35em;
      left: 50%;
      transform: translateX(-50%);
      z-index: 10;
      display: flex;
      gap: 20px;
      opacity: 0;
      animation-fill-mode: forwards;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      font-weight: 600;
    }

   
    @keyframes fadeSlideIn {
      from {
        opacity: 0;
        transform: translateX(-50%) translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
      }
    }

 
    #btnContainer button {
      padding: 15px 30px;
      font-size: 18px;
      font-weight: 600;
      background-color: #ffffff;
      color: rgb(0, 0, 0);
      border: 1px solid grey;
      border-radius: 8px;
      cursor: pointer;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
      transition: all 0.5s ease;
    }

    #btnContainer button:hover {
      background-color: #ffffff77;
      backdrop-filter: blur(5px);
      color: rgb(255, 255, 255);
        transform: scale(1.05);
        box-shadow: 5px 0px 20px rgba(0, 0, 0, 0.2);
    }

    a {
      text-decoration: none;
      color: inherit;
    }
  </style>

  <script type="module">
   import { images } from './javaScript/images.js';


    const main = document.querySelector('main');
    const MAX_FRAMES = 553;
    const START_FRAME = 10;
    const SHOW_BUTTON_FRAME = 552;

    let currentFrame = 0;

    const img = document.createElement('img');
    main.appendChild(img);

    function updateImage(frame = 0) {
      if (frame < images.length) {
        img.src = images[frame].p;
      }
    }

    const btnContainer = document.getElementById('btnContainer');


    if (window.location.hash === '#buttons') {
  
      updateImage(SHOW_BUTTON_FRAME);
      currentFrame = SHOW_BUTTON_FRAME;
    
      btnContainer.style.display = 'flex';
      btnContainer.style.animation = 'fadeSlideIn 0.5s ease forwards';
    
      setTimeout(() => {
        const targetPosition = maxScroll * (SHOW_BUTTON_FRAME - START_FRAME) / (MAX_FRAMES - START_FRAME);
        window.scrollTo(0, targetPosition);
      }, 100);
    } else {
      
      updateImage(START_FRAME);
      currentFrame = START_FRAME;
    }

    let maxScroll = document.documentElement.scrollHeight - window.innerHeight;

    window.addEventListener('resize', () => {
      maxScroll = document.documentElement.scrollHeight - window.innerHeight;
    });

    const btnLogin = document.getElementById('btnLogin');
    const btnRegister = document.getElementById('btnRegister');
  
    let lastFrameUpdate = 0;


    window.addEventListener('scroll', () => {
      if (Date.now() - lastFrameUpdate < 1) return true;
      lastFrameUpdate = Date.now();

      const scrollPosition = window.scrollY;
      const scrollFraction = scrollPosition / maxScroll;
      const frame = Math.floor(scrollFraction * (MAX_FRAMES - START_FRAME)) + START_FRAME;

      if (currentFrame !== frame && frame < MAX_FRAMES) {
        updateImage(frame);
        currentFrame = frame;
      }


      if (frame >= SHOW_BUTTON_FRAME) {
        if (btnContainer.style.display !== 'flex') {
          btnContainer.style.display = 'flex';
          btnContainer.style.animation = 'fadeSlideIn 0.5s ease forwards';
        }
      } else {
        if (btnContainer.style.display !== 'none') {
          btnContainer.style.animation = '';
          btnContainer.style.opacity = '0';
          setTimeout(() => {
            btnContainer.style.display = 'none';
          }, 300);
        }
      }
    });
  </script>
</head>

<body>
  <main>
    <header>
    </header>

    <div id="btnContainer">
      <button id="btnLogin"><a href="login.jsp">Iniciar Sesión</a></button>
      <button id="btnRegister"><a href="registro.jsp">Registrar</a></button>
    </div>
  </main>
</body>

</html>