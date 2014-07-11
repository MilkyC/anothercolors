anothercolors
=============

Another Colors Library for PHP cli


This project started out as an exercise where I tryed to reverse engineer the [kevinlebrun/colors.php](https://github.com/kevinlebrun/colors.php) project without looking at the source code.  

The usage is slightly different:


    use AnotherColor\Color;

    $c = new Color();
    echo $c('pop pop!')->color('yellow')->bold()->underline()->background('green');

To run the example navigate to its containing folder in your terminal and type:

    $ php example.php

More to come soon!