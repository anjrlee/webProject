<template>
  <div>
    <div class="body404">
    <div class="noise"></div>
    <div class="overlay"></div>
    <div class="relative h-2/5 w-[60%] left-[25%] top-[30%]">
      <h1 class="text-[2vw] text-white">Error <span class="errorcode">404</span></h1>
      <p class="output">The page you are looking for might have been removed, had its name changed or is temporarily unavailable.</p>
      <p class="output">Please try to <a href="/">[return to the homepage]</a>.</p>
      <p class="output">Good luck.</p>
    
    </div>
        
    </div>
  </div>
</template>

<style lang="scss">

.body404{
  background-image: radial-gradient(#11581E, #041607);
  height: 100%;
  width:100%;
  position: absolute;
}


.noise {
  pointer-events: none;
  position: absolute;
  width: 100%;
  height: 100%;
  background-image: url("https://media.giphy.com/media/oEI9uBYSzLpBK/giphy.gif");
  background-repeat: no-repeat;
  background-size: cover;
  z-index: -1;
  opacity: .02;
}

.overlay {
  pointer-events: none;
  position: absolute;
  width: 100%;
  height: 100%;
  background:
      repeating-linear-gradient(
      180deg,
      rgba(0, 0, 0, 0) 0,
      rgba(0, 0, 0, 0.3) 50%,
      rgba(0, 0, 0, 0) 100%);
  background-size: auto 4px;
  z-index: 1;
}

.overlay::before {
  content: "";
  pointer-events: none;
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
  background-image: linear-gradient(
      0deg,
      transparent 0%,
      rgba(32, 128, 32, 0.2) 2%,
      rgba(32, 128, 32, 0.8) 3%,
      rgba(32, 128, 32, 0.2) 3%,
      transparent 100%);
  background-repeat: no-repeat;
  animation: scan 4.5s linear 0s infinite;
}

@keyframes scan {
  0%        { background-position: 0 -100vh; }
  35%, 100% { background-position: 0 100vh; }
}

.output {
  font-size: 1.2vw;
  color: rgba(128, 255, 128, 0.8);
  text-shadow:
      0 0 1px rgba(51, 255, 51, 0.4),
      0 0 2px rgba(255, 255, 255, 0.8);
}

.output::before {
  content: "> ";
}

a {
  color: #fff;
  text-decoration: none;
}


.errorcode {
  color: white;
}
</style>
