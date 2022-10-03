<?php
/**
 * String manipulation and plain-text analysis
 *
 * @package wpmu-dev-seo
 */

/**
 * String manipulation class
 */
class Smartcrawl_String_Utils {
	/**
	 * Converts string to uppercase version
	 *
	 * @param string $str String to process.
	 *
	 * @return string Uppercased string
	 */
	public static function uppercase( $str = '' ) {
		if ( empty( $str ) ) {
			return '';
		}

		return function_exists( 'mb_strtoupper' )
			? mb_strtoupper( $str )
			: strtoupper( $str );
	}

	/**
	 * Unicode-safe substr() port.
	 * Works just like substr(), except that it handles Unicode strings better.
	 *
	 * @param string $str String to extract from.
	 * @param int $start Where to start substring extraction (optional).
	 * @param int $length Substring length (optional).
	 *
	 * @return string Extracted substring
	 */
	public static function substr( $str, $start = 0, $length = null ) {
		if ( empty( $str ) ) {
			return '';
		}

		return function_exists( 'mb_substr' )
			? mb_substr( $str, $start, $length )
			: substr( $str, $start, $length );
	}

	/**
	 * Counts letters in a string
	 *
	 * @param string $str String to count.
	 *
	 * @return int Letter count
	 */
	public static function len( $str = '' ) {
		if ( empty( $str ) ) {
			return 0;
		}

		return function_exists( 'mb_strlen' )
			? mb_strlen( $str )
			: strlen( $str );
	}

	public static function split( $pattern, $string, $limit = - 1 ) {
		return function_exists( 'mb_split' )
			? mb_split( $pattern, $string, $limit )
			: preg_split( $pattern, $string, $limit );
	}

	public static function pos( $haystack, $needle, $offset = 0 ) {
		return function_exists( 'mb_strpos' )
			? mb_strpos( $haystack, $needle, $offset )
			: strpos( $haystack, $needle, $offset );
	}

	/**
	 * Extracts sentences from text
	 *
	 * @param string $text Text to process.
	 * @param bool $preserve_punctuation Whether to preserve sentence delimiters (defaults to no).
	 *
	 * @return array List of recognized sentences
	 */
	public static function sentences( $text, $preserve_punctuation = false ) {
		if ( empty( $text ) ) {
			return array();
		}
		$raw = preg_split( '/([?.!]+)/', $text, null, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY );
		$len = count( $raw );
		$sentences = array();

		for ( $i = 1; $i <= $len; $i += 2 ) {
			$current = $i - 1;
			$snt = isset( $raw[ $current ] ) ? $raw[ $current ] : false;
			if ( ! $snt ) {
				continue;
			}

			$snt = preg_replace( '/(^\s+|\s+$)/', '', $snt );
			if ( $preserve_punctuation ) {
				$snt .= $raw[ $i ];
			}

			$sentences[] = $snt;
		}

		return $sentences;
	}

	/**
	 * Extracts words from text
	 *
	 * @param string $text Text to process.
	 *
	 * @return array Recognized normalized words
	 */
	public static function words( $text = '' ) {
		$words = array();

		if ( empty( $text ) ) {
			return $words;
		}
		$text = join( ' ', self::paragraphs( $text ) );

		$text = preg_replace( '/[^ [:alnum:]]/iu', '', self::lowercase( $text ) );
		$words = array_filter( explode( ' ', $text ) );

		return $words;
	}

	public static function word_count( $text = '' ) {
		return count( self::words( $text ) );
	}

	/**
	 * Extracts paragrapsh from text
	 *
	 * @param string $text Text to process.
	 *
	 * @return array List of recognized paragraphs
	 */
	public static function paragraphs( $text = '' ) {
		if ( empty( $text ) ) {
			return array();
		}
		$paragraphs = array();

		$raw = preg_split( '/\n/', self::normalize_newlines( $text ), null, PREG_SPLIT_NO_EMPTY );
		foreach ( $raw as $para ) {
			$para = preg_replace( '/(^\s+|\s+$)/', '', $para );
			if ( ! preg_match( '/[[:punct:]]$/', $para ) ) {
				$para .= '.';
			}
			$paragraphs[] = $para;
		}

		return $paragraphs;
	}

	/**
	 * Normalizes newlines in text
	 *
	 * @param string $str Text to process.
	 *
	 * @return string Normalized text
	 */
	public static function normalize_newlines( $str ) {
		return preg_replace( '/(\r\n|\r|\n)/', "\n", $str );
	}

	/**
	 * Converts string to lowercase version
	 *
	 * @param string $str String to process.
	 *
	 * @return string Lowercased string
	 */
	public static function lowercase( $str = '' ) {
		if ( empty( $str ) ) {
			return '';
		}

		return function_exists( 'mb_strtolower' )
			? mb_strtolower( $str )
			: strtolower( $str );
	}

	public static function starts_with( $haystack, $needle ) {
		if ( '' === $needle ) {
			return true;
		}
		return 0 === self::pos( $haystack, $needle );
	}

	public static function ends_with( $haystack, $needle ) {
		$length = self::len( $needle );
		if ( 0 === $length ) {
			return true;
		}

		return ( self::substr( $haystack, - $length ) === $needle );
	}
}
