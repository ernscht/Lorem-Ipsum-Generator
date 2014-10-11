# Lorem Ipsum Generator

This class is written by Kadir 'Akkara' Yardımcı {@link http://kadiryardimci.com}
Original source on GitHub: https://github.com/akkara/Lorem-Ipsum-Generator
This source on GitHub: https://github.com/ernscht/Lorem-Ipsum-Generator

This is ...

* a simple lorem text & markup generator
* the configured text is written continuously
* may write random inline markup with configurable tags

## Table of contents

* [Requirements](#requirements)
* [Usage](#usage)
* [Configuration](#configuration)

## Requirements

* PHP 5.3+

## Usage

include the lorem class into your project

    require_once( __DIR__ . '/path/to/lorem.php' );

and use with the following echoes
(all parameters are optional, there always is a default)

### Simple Examples

    echo lorem::get(10);                      // 10 words building a sentence
    echo lorem::text(3);                      // 3 lines of unformatted text
    echo lorem::html(10);                     // 10 words, random inline markup

    echo lorem::h(1);                         // h1 tag with random inline markup
    echo lorem::h(3);                         // h2 tag with random inline markup
    echo lorem::p(10);                        // p tag - 10 words with random inline markup
    echo lorem::ul(3);                        // ul tag - 3 list items with random inline markup
    echo lorem::ol(5);                        // ol tag - 5 list items with random inline markup

    echo lorem::p(rand(100,200));             // p tag - 100-200 words with random inline markup


### Advanced Examples

    echo lorem::get(4, '--- ', '.');          // 4 words, start with, end with
    echo lorem::text(3, 4, '. ');             // 3 times, 4 words, separator '. '
    echo lorem::html(10, 'a/strong/mark');    // 10 words, random inline markup built out of this 'tags'
    echo lorem::html(10, false);              // 10 words, no inline markup

    echo lorem::p(10, 'em/strong');           // p with 10 words, random inline markup built out of this 'tags'
    echo lorem::h(2, 4, 'a');                 // heading 2, 4 words, random inline markup built out of this 'tags'
    echo lorem::ul(3, 4, 'a/strong');         // 3 list elements, 4 words, random inline markup built out of this 'tags'
    echo lorem::ol(5, 7, false);              // 5 ordered list elements, 7 words, with no inline markup


## Configuration

### Change Text

You may use other texts than the default lorem.
For doing so, link your favored textfile in the function `words` of the `lorem` class
