document.addEventListener('DOMContentLoaded', () => {

  gsap.registerPlugin(ScrollTrigger);
  gsap.registerPlugin(ScrollToPlugin);

  // ASTUDIO: Floating Header [START] -----------------------------------------------------------------------

    const header = document.querySelector('.page-header');

    let lastScrollY = window.scrollY;

    function handleScroll() {
      const currentScrollY = window.scrollY;

      if (currentScrollY > lastScrollY && currentScrollY > 32) {
        header.style.top = '-130px';
        header.style.opacity = '0';
        header.classList.remove('afloat');
      } else {
        header.style.top = '0px';
        header.style.opacity = '1';
        header.classList.add('afloat');
      }

      if (currentScrollY < 1) {
        header.classList.remove('afloat');
      }

      lastScrollY = currentScrollY;
    }

    window.addEventListener('scroll', handleScroll);

  // ASTUDIO: Floating Header [ END ] -----------------------------------------------------------------------


  // ASTUDIO: Scroll Bottom <-> Top [START] -----------------------------------------------------------------------

    const goBottom = document.querySelector('.go-bottom');
    const footer = document.querySelector('footer.page-footer');
    const footerOffset = 150;
    const sections = document.querySelectorAll('.section');
    let currentSectionIndex = 0;

    const scrollToSection = (index) => {
      if (sections[index]) {
        gsap.to(window, {
          duration: 1,
          scrollTo: sections[index],
          ease: 'power2.inOut',
        });
      }
    };

    const scrollToTop = () => {
      gsap.to(window, {
        duration: 1,
        scrollTo: 0,
        ease: 'power2.inOut',
      });
    };

    goBottom.addEventListener('click', () => {
      const footerRect = footer.getBoundingClientRect();

      if (goBottom.classList.contains('go-bottom--back')) {
        scrollToTop();
        goBottom.classList.remove('go-bottom--back');
        currentSectionIndex = 0;
      } else {
        if (footerRect.top > window.innerHeight - footerOffset) {
          currentSectionIndex = Math.min(currentSectionIndex + 1, sections.length - 1);
          scrollToSection(currentSectionIndex);
        } else {
          goBottom.classList.add('go-bottom--back');
        }
      }
    });

    const updateCurrentSectionIndex = () => {
      const scrollPosition = window.scrollY + window.innerHeight / 2;

      sections.forEach((section, index) => {
        const sectionTop = section.offsetTop;
        const sectionBottom = sectionTop + section.offsetHeight;

        if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
          currentSectionIndex = index;
        }
      });
    };

    const updateButtonState = () => {
      const footerRect = footer.getBoundingClientRect();

      if (footerRect.top <= window.innerHeight - footerOffset && !goBottom.classList.contains('go-bottom--back')) {
        goBottom.classList.add('go-bottom--back');
      } else if (footerRect.top > window.innerHeight - footerOffset && goBottom.classList.contains('go-bottom--back')) {
        goBottom.classList.remove('go-bottom--back');
      }
    };


    window.addEventListener('scroll', () => {
      updateCurrentSectionIndex();
      updateButtonState();
    });

  // ASTUDIO: Scroll Bottom <-> Top [ END ] -----------------------------------------------------------------------


  // ASTUDIO: Animated section appearance in viewport [START] -----------------------------------------------------

    document.querySelectorAll('.section:not(.page-footer)').forEach(section => {
      gsap.from(section, {
        duration: 1.5,
        y: 100,
        opacity: 0,
        ease: 'power2.out',
        immediateRender: false,
        scrollTrigger: {
          trigger: section,
          start: 'top bottom',
          end: 'bottom top',
          toggleActions: 'play none none none',
          markers: false,
          once: true
        }
      });
    });

    document.querySelectorAll('.animated-image').forEach(image => {
      gsap.fromTo(image, 
        { scale: 0.8, autoAlpha: 0 },
        {
          scale: 1,
          autoAlpha: 1,
          duration: 1.5,
          ease: 'power2.out',
          scrollTrigger: {
            trigger: image,
            start: 'top bottom',
            end: 'bottom top',
            toggleActions: 'play none none none',
            markers: false,
            once: true
          }
        }
      );
    });

    document.querySelectorAll('.animated-text-scale').forEach(image => {
      gsap.fromTo(image, 
        { scale: 0.5, autoAlpha: 0 },
        {
          scale: 1,
          autoAlpha: 1,
          duration: 1.5,
          ease: 'power2.out',
          scrollTrigger: {
            trigger: image,
            start: 'top bottom',
            end: 'bottom top',
            toggleActions: 'play none none none',
            markers: false,
            once: true
          }
        }
      );
    });

    const fadeInAnimations = {
      'fadeInUp': { x: 0, y: 50 },
      'fadeInLeft': { x: 0, y: 50 },
      'fadeInRight': { x: 0, y: 50 },
    };
    
    Object.keys(fadeInAnimations).forEach(animation => {
      document.querySelectorAll(`.animated-el-${animation}`).forEach(element => {
        gsap.fromTo(element, 
          { x: fadeInAnimations[animation].x, y: fadeInAnimations[animation].y, autoAlpha: 0 },
          {
            x: 0,
            y: 0,
            autoAlpha: 1,
            duration: 1.5,
            ease: 'power2.out',
            scrollTrigger: {
              trigger: element,
              start: 'top bottom',
              end: 'bottom top',
              toggleActions: 'play none none none',
              markers: false,
              once: true
            }
          }
        );
      });
    });

  // ASTUDIO: Animated section appearance in viewport [ END ] -----------------------------------------------------

});