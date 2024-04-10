<?php
declare(strict_types=1);
namespace Chupaprecios\NewSection\Model;

use Chupaprecios\NewSection\Api\OrderByIncrementIdInterface;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Driver\File as DriveFile;
use Psr\Log\LoggerInterface;

class OrderByIncrementId implements OrderByIncrementIdInterface
{

    /**
     * @var DirectoryList
     */
    protected DirectoryList $directoryList;

    /**
     * @var DriveFile
     */
    protected DriveFile $file;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    public function __construct(
        DirectoryList $directoryList,
        DriveFile $file,
        LoggerInterface $logger,
    )
    {
        $this->directoryList = $directoryList;
        $this->file = $file;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderByIncrementId($orderId)
    {
        $pathDirectoryFile = $this->directoryList->getPath('var'). '/log/logDataOrder.log';
        if ($this->file->isExists($pathDirectoryFile) ){
            $dateResponse = '';
            $file = fopen($pathDirectoryFile, 'r');
            while (!feof($file)) {
                $fileLine = fgets($file);
                $arrayLine = explode(" ", (string)$fileLine);
                if (isset($arrayLine[2]) && $arrayLine[2] == $orderId){
                    $dateResponse = $arrayLine[3];
                    break;
                }
            }
            fclose($file);
            if ($dateResponse === '') {
                return 'No match was found';
            }
            return $dateResponse;
        } else {
            return  'The file was not found';
        }
    }


}
