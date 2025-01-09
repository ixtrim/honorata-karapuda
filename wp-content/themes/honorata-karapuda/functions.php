<?php 

// Loading all functions from /incl folder
foreach ( glob( get_template_directory() . '/inc/*.php' ) as $file ) {
  include $file;
}