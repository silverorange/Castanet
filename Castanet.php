<?php

/**
 * This file contains package-level constants for the Castanet package.
 *
 * @category  XML
 *
 * @author    Michael Gauthier <mike@silverorange.com>
 * @author    Charles Waddell <charles@silverorange.com>
 * @copyright 2011-2017 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 *
 * @see      https://github.com/silverorange/castanet
 */
abstract class Castanet
{
    /**
     * Constant for RSS version to use in XML document.
     */
    public const RSS_VERSION = '2.0';

    /**
     * Base XML namespace.
     */
    public const XMLNS_NAMESPACE = 'http://www.w3.org/2000/xmlns/';

    /**
     * The iTunes namespace.
     */
    public const ITUNES_NAMESPACE = 'http://www.itunes.com/dtds/podcast-1.0.dtd';

    /**
     * Atom namespace.
     */
    public const ATOM_NAMESPACE = 'http://www.w3.org/2005/Atom';
}
