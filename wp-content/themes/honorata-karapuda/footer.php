      </main>
      <?php get_template_part( 'template-parts/site-footer' ); ?>
    </div>

    <?php 
      wp_footer();
      if ($footer_scripts = get_theme_mod('astudio_footer_scripts')) {
        echo $footer_scripts;
      }
    ?>

  </body>
</html>