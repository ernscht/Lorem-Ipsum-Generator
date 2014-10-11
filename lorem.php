<?php

/**
 * Lorem Ipsum, Dummy Text Generator.
 *
 * {@link https://github.com/akkara/Lorem-Ipsum-Generator}
 *
 * @author Kadir 'Akkara' Yardımcı {@link http://kadiryardimci.com}
 */
class lorem {

	public static function words() {
		$text = file_get_contents( __DIR__ . '/text/lorem.txt' );

		return explode( ' ', str_repeat( $text, 10 ) );
	}

	public static function get( $lenght = 100, $start = '', $end = '.' ) {
		$words = self::words();
		$total = count( $words );
		global $ipsum_offset;
		if ( !isset( $ipsum_offset ) ) {
			$ipsum_offset = 0;
		}
		$ipsum_offset_keep = $ipsum_offset;
		$ipsum_offset += $lenght;
		if ( $ipsum_offset > $total ) {
			$words = array_merge( $words, $words );
			if ( $ipsum_offset > count( $words ) ) {
				$ipsum_offset = count( $words );
				$end          = ' expected lorem is too big' . $end;
			}
			$ipsum_offset -= $total;
		}

		return ucfirst( $start . implode( ' ', array_slice( $words, $ipsum_offset_keep, $lenght ) ) ) . $end;
	}

	public static function text( $total = 5, $lenght = 10, $sep = "\n\n" ) {
		$text = array();
		for ( $i = 0; $i < $total; $i ++ ) {
			$text[] = self::get( $lenght );
		}
		self::reset();

		return implode( $sep, $text );
	}

	public static function html( $lenght = 100, $tags = 'strong/em/a' ) {
		$tags = explode( '/', $tags );
		$text = self::get( $lenght, '', '' );

		return self::html_rec( $text, $tags );
	}

	public static function html_rec( $text, $tags ) {
		if ( is_array( $tags ) && $tags !== array( '' ) ) {
			$text  = explode( ' ', $text );
			$count = count( $text );
			$index = 0;
			$parts = array();
			while ( $index < $count ) {
				$range   = rand( 1, floor( $count / 2 ) );
				$parts[] = implode( ' ', array_slice( $text, $index, $range ) );
				$index += $range;
			}
			foreach ( $parts as $key => $part ) {
				if ( !self::rand( 0, 2, 0, 3, 0, 1 ) ) {
					shuffle( $tags );
					$tag = array_pop( $tags );
					if ( $tags ) {
						$part = self::html_rec( $part, $tags );
					}
					$part          = self::html_tag( $part, $tag );
					$parts[ $key ] = $part;
					array_push( $tags, $tag );
				}
			}

			return implode( ' ', $parts );
		}

		return $text;
	}

	public static function html_tag( $text, $tag ) {
		switch ( $tag ) {
			case 'a' :
				return '<a href="#">' . $text . '</a>';
			default :
				return '<' . $tag . '>' . $text . '</' . $tag . '>';
		}
	}

	public static function p( $lenght = 100, $tags = 'strong/em/a' ) {
		return '<p>' . self::html( $lenght, $tags ) . '</p>';
	}

	public static function h( $size = 3, $lenght = 10, $tags = 'strong/em/a' ) {
		return '<h' . $size . '>' . self::html( $lenght, $tags ) . '</h' . $size . '>';
	}

	public static function lists( $type = 'ol', $total = 5, $lenght = 10, $tags = 'strong/em/a' ) {
		$items = array();
		for ( $i = 0; $i < $total; $i ++ ) {
			$items[] = '<li>' . self::html( $lenght, $tags ) . '</li>';
		}

		return '<' . $type . '>' . implode( "\n", $items ) . '</' . $type . '>';
	}

	public static function ol( $total = 5, $lenght = 10, $tags = 'strong/em/a' ) {
		return self::lists( 'ol', $total, $lenght, $tags );
	}

	public static function ul( $total = 5, $lenght = 10, $tags = 'strong/em/a' ) {
		return self::lists( 'ul', $total, $lenght, $tags );
	}

	public static function rand( $c1, $c2, $t1, $t2, $f1, $f2 ) {
		return ( rand( $c1, $c2 ) ? rand( $t1, $t2 ) : rand( $f1, $f2 ) );
	}

	public static function reset() {
		global $ipsum_offset;
		$ipsum_offset = 0;
	}

}
