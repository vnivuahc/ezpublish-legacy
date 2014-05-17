<?php
/**
 * This file is part of the eZ Publish Legacy package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version //autogentag//
 */

/**
 * Interface for a DFS FS handler, that offers CRUD support for binary files.
 *
 * Implementations of this interface can be used by DFS database backends, such as eZDFSFileHandlerMySQLiBackend,
 * to read/write to a binary file storage medium.
 */
interface eZDFSFileHandlerDFSBackendInterface
{
    /**
     * Checks if $path is supported by this handler
     * @param string $path
     * @return bool
     */
    public function supports( $path );

    /**
     * Creates a copy of $srcFilePath from DFS to $dstFilePath on DFS
     *
     * @param string $srcFilePath Local source file path
     * @param string $dstFilePath Local destination file path
     *
     * @return bool
     */
    public function copyFromDFSToDFS( $srcFilePath, $dstFilePath );

    /**
     * Copies the DFS file $srcFilePath to FS
     *
     * @param string $srcFilePath Source file path (on DFS)
     * @param string $dstFilePath Destination file path (on FS). If not specified, $srcFilePath is used
     *
     * @return bool
     */
    public function copyFromDFS( $srcFilePath, $dstFilePath = false );

    /**
     * Copies the local file $filePath to DFS under the same name, or a new name
     * if specified
     *
     * @param string $srcFilePath Local file path to copy from
     * @param bool|string $dstFilePath Optional path to copy to. If not specified, $srcFilePath is used on DFS as well.
     *
     * @return bool
     */
    public function copyToDFS( $srcFilePath, $dstFilePath = false );

    /**
     * Deletes one or more files from DFS
     *
     * @param string|array $filePath Single local filename, or array of local filenames
     *
     * @return bool true if deletion was successful, false otherwise
     * @todo Improve error handling using exceptions
     */
    public function delete( $filePath );

    /**
     * Sends the contents of $filePath to default output
     *
     * @param string $filePath File path
     * @param int $startOffset Starting offset
     * @param bool|int $length Length to transmit, false means everything
     *
     * @return bool true, or false if operation failed
     */
    public function passthrough( $filePath, $startOffset = 0, $length = false );

    /**
     * Returns the binary content of $filePath from DFS
     *
     * @param string $filePath local file path
     *
     * @return binary|bool file's content, or false
     * @todo Handle errors using exceptions
     */
    public function getContents( $filePath );

    /**
     * Creates the file $filePath on DFS with content $contents
     *
     * @param string $filePath
     * @param binary $contents
     *
     * @return bool
     */
    public function createFileOnDFS( $filePath, $contents );

    /**
     * Renamed DFS file $oldPath to DFS file $newPath
     *
     * @param string $oldPath
     * @param string $newPath
     *
     * @return bool
     */
    public function renameOnDFS( $oldPath, $newPath );

    /**
     * Checks if a file exists on the DFS
     *
     * @param string $filePath
     *
     * @return bool
     */
    public function existsOnDFS( $filePath );

    /**
     * Returns the mount point
     *
     * @return string
     */
    public function getMountPoint();

    /**
     * Returns size of a file in the DFS backend, from a relative path.
     *
     * @param string $filePath The relative file path we want to get size of
     *
     * @return int
     */
    public function getDfsFileSize( $filePath );
}
