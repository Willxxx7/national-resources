// Fire Animation
(() => {
  const canvas = document.querySelector('#fire-canvas');
  const ctx = canvas.getContext('2d');

  // Set canvas dimensions
  const resizeCanvas = () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight * 0.8; // 80% of viewport height
  };

  resizeCanvas();
  window.addEventListener('resize', resizeCanvas);

  // Fire particle class
  class Particle {
    constructor(x, y) {
      this.x = x;
      this.y = y;
      this.radius = Math.random() * 3 + 2;
      this.color = `hsl(${Math.random() * 30 + 15}, 100%, ${Math.random() * 30 + 50}%)`;
      this.velocity = {
        x: Math.random() * 2 - 1,
        y: Math.random() * -3 - 1,
      };
      this.life = Math.random() * 100 + 100;
      this.opacity = 1;
    }

    draw() {
      ctx.save();
      ctx.globalAlpha = this.opacity;
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
      ctx.fillStyle = this.color;
      ctx.fill();
      ctx.restore();
    }

    update() {
      this.x += this.velocity.x;
      this.y += this.velocity.y;
      this.life -= 1;
      this.opacity = Math.max(0, this.life / 100);

      if (this.life <= 20) {
        this.radius = Math.max(0.1, this.radius - 0.1);
      }
    }
  }

  // Array to store particles
  const particles = [];

  // Animation loop
  const animate = () => {
    requestAnimationFrame(animate);

    // Add semi-transparent overlay to create trail effect
    ctx.fillStyle = 'rgba(5, 21, 37, 0.2)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Create new particles
    if (particles.length < 200) {
      Array.from({ length: 5 }).forEach(() => {
        const x = Math.random() * canvas.width;
        const y = canvas.height + 10;
        particles.push(new Particle(x, y));
      });
    }

    // Update and draw particles
    particles.forEach((particle, index) => {
      particle.update();
      particle.draw();

      // Remove dead particles or those that are too small
      if (particle.life <= 0 || particle.radius <= 0.2) {
        particles.splice(index, 1);
      }
    });
  };

  animate();
})();
