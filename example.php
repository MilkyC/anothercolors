<?php

  require_once('AnotherColor.php');
  use AnotherColor\Color;

  $c = new Color();
  echo $c('pop pop!')->color('yellow')->bold()->underline()->background('green');