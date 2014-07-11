anothercolors
=============

Another Colors Library for PHP cli


This project started out as an exercise where I tried to reverse engineer the [kevinlebrun/colors.php](https://github.com/kevinlebrun/colors.php) project without looking at the source code.  

Usage:


    use AnotherColor\Color;

    $c = new Color();
    echo $c('pop pop!')->color('yellow')->bold()->underline()->background('green');

To run the example script navigate to the example folder in your terminal and type:

    $ php example.php

More to come soon!