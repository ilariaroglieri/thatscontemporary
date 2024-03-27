document.addEventListener("DOMContentLoaded", (event) => {
  gsap.registerPlugin(ScrollTrigger)
  
  const lenis = new Lenis();

  lenis.on('scroll', (e) => {
    console.log(e)
  })

  lenis.on('scroll', ScrollTrigger.update);

  const timeline = gsap.timeline({
    defaults: { ease: 'none' },
    scrollTrigger: {
      trigger: $('#filler'),
      start: 'top bottom+=5%',
      end: 'bottom top-=5%',
      scrub: true
    }
  });

});