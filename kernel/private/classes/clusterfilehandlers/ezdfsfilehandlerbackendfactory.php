<?php
/**
 * This file is part of the eZ Publish Legacy package
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributd with this source code.
 * @version //autogentag//
 */

/**
 * Instantiates the DFSBackend based on INI settings
 */
class eZDFSFileHandlerBackendFactory
{

    /**
     * @return eZDFSFileHandlerDFSBackendInterface
     */
    public static function build()
    {
        $dfsBackend = eZINI::instance( 'file.ini' )->variable( 'eZDFSClusteringSettings', 'DFSBackend' );
        if ( !class_exists( $dfsBackend ) )
        {
            throw new InvalidArgumentException( "Invalid DFSBackend class $dfsBackend. Were autoloads generated ?" );
        }

        if ( !is_a( $dfsBackend, 'eZDFSFileHandlerDFSBackendInterface', true ) )
        {
            throw new InvalidArgumentException( "$dfsBackend must implement eZDFSFileHandlerDFSBackendInterface" );
        }

        if ( is_a( $dfsBackend, 'eZDFSFileHandlerFactoryDFSBackendInterface', true ) )
        {
            return $dfsBackend::factory();
        }
        else
        {
            return new $dfsBackend();
        }
    }
}
