document.addEventListener('DOMContentLoaded', () => {
  gsap.registerPlugin(ScrollTrigger);
  gsap.registerPlugin(ScrollToPlugin);

  // Function to initialize Masonry with dynamic column width
  function initializeMasonry() {
    const gridElement = document.querySelector('.grid');
    const viewportWidth = window.innerWidth;

    let columnCount = 5;
    if (viewportWidth <= 500) {
      columnCount = 1;
    } else if (viewportWidth <= 768) {
      columnCount = 2;
    } else if (viewportWidth <= 1024) {
      columnCount = 3;
    } else if (viewportWidth <= 1500) {
      columnCount = 4;
    } else {
      columnCount = 5;
    }

    const columnWidth = `calc((100% - ${(columnCount - 1) * 40}px) / ${columnCount})`;
    document.querySelectorAll('.grid-sizer, .grid-item').forEach(item => {
      item.style.width = columnWidth;
    });

    const masonry = new Masonry(gridElement, {
      itemSelector: '.grid-item',
      columnWidth: '.grid-sizer',
      gutter: 40,
      percentPosition: true,
    });

    imagesLoaded('.grid', function () {
      masonry.layout();
    });

    masonry.on('layoutComplete', function () {
      // Show the grid after layout is complete
      gsap.to('.grid', { opacity: 1, visibility: 'visible', duration: 0.5 });
      gsap.to('.page-footer', { opacity: 1, visibility: 'visible', duration: 0.5 });

      // Animate items
      gsap.fromTo(
        '.grid-item',
        { opacity: 0, y: 50 },
        { opacity: 1, y: 0, stagger: 0.2, duration: 0.5 }
      );
    });

    return masonry;
  }

  let masonry = initializeMasonry();

  window.addEventListener('resize', function () {
    if (masonry) {
      masonry.destroy();
    }
    masonry = initializeMasonry();
  });

  document.addEventListener('mousemove', function (e) {
    var blob = document.querySelector('.blob');
    var x = e.clientX - blob.clientWidth / 2;
    var y = e.clientY - blob.clientHeight / 2;
    blob.style.transform = `translate3d(${x}px, ${y}px, 0)`;
  });
});
