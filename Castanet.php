<?php

/**
 * This file contains package-level constants for the Castanet package
 *
 * PHP version 5, 7
 *
 * LICENSE:
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2011-2017 silverorange
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * @category  XML
 * @package   Castanet
 * @author    Michael Gauthier <mike@silverorange.com>
 * @author    Charles Waddell <charles@silverorange.com>
 * @copyright 2011-2017 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @link      https://github.com/silverorange/castanet
 */

/**
 * Package-level constants
 *
 * @category  XML
 * @package   Castanet
 * @author    Michael Gauthier <mike@silverorange.com>
 * @author    Charles Waddell <charles@silverorange.com>
 * @copyright 2011-2016 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @link      https://github.com/silverorange/castanet
 */
abstract class Castanet
{
    // {{{ constants

    /**
     * Constant for RSS version to use in XML document
     */
    const RSS_VERSION = '2.0';

    /**
     * Base XML namespace
     */
    const XMLNS_NAMESPACE = 'http://www.w3.org/2000/xmlns/';

    /**
     * The iTunes namespace
     */
    const ITUNES_NAMESPACE = 'http://www.itunes.com/dtds/podcast-1.0.dtd';

    /**
     * Atom namespace
     */
    const ATOM_NAMESPACE = 'http://www.w3.org/2005/Atom';

    // }}}
}
