// Particles.js setup
particlesJS("particles-js", {
  particles: {
    number: { value: 70 },
    color: { value: "#FFD700" },
    shape: { type: "circle" },
    opacity: { value: 0.5 },
    size: { value: 3, random: true },
    line_linked: {
      enable: true,
      distance: 150,
      color: "#FFD700",
      opacity: 0.4,
      width: 1
    },
    move: {
      enable: true,
      speed: 2
    }
  },
  interactivity: {
    events: {
      onhover: { enable: true, mode: "repulse" }
    },
    modes: {
      repulse: { distance: 100, duration: 0.4 }
    }
  },
  retina_detect: true
});

// Sounds
const bgMusic = new Audio("sounds/bg-music.mp3");
bgMusic.loop = true;
bgMusic.volume = 0.3;

const clickSound = new Audio("sounds/click.mp3");
const joinSound = new Audio("sounds/join.mp3");

window.addEventListener("DOMContentLoaded", () => {
  joinSound.play().catch(() => {});
  bgMusic.play().catch(() => {});

  document.querySelectorAll("a, button").forEach(el => {
    el.addEventListener("click", () => clickSound.play());
  });

  const toggleBtn = document.getElementById("toggleMusic");
  if (toggleBtn) {
    toggleBtn.addEventListener("click", () => {
      if (bgMusic.paused) {
        bgMusic.play();
        toggleBtn.textContent = "🔊 Mute Music";
      } else {
        bgMusic.pause();
        toggleBtn.textContent = "🔇 Play Music";
      }
    });
  }
});
