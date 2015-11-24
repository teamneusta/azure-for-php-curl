# azure-for-php-curl
Azure Framework with curl or guzzle

## Configuration Blob Service

    $blobSettings = new BlobServiceSettings('NAME', 'KEY==');
    $blobService = new BlobService($blobSettings);
    
### Set RestClient to Guzzle
    $blobSettings = new BlobServiceSettings('NAME', 'KEY==');
    $blobSettings->setHttpClient('GuzzleClient');
    $blobService = new BlobService($blobSettings);
    
## Configuration Media Service

    $mediaServiceSettings = new MediaServiceSettings('NAME', 'KEY=');
    $mediaService = new MediaService($mediaServiceSettings);

### Set RestClient to Guzzle
    $mediaServiceSettings = new MediaServiceSettings('NAME', 'KEY=');
    $mediaServiceSettings->setHttpClient('GuzzleClient');
    $mediaService = new MediaService($mediaServiceSettings);
    
## Available Clients
    - CurlClient
    - GuzzleClient
    
# Available Services
    - BlobService
    - MediaService
    
# Available Service Functions BlobService
    - listContainers()
    - listBlobs($containerName)
    - copyBlob($destinationContainer, $destinationBlob, $sourceContainer, $sourceBlob)
    
# Available Service Functions MediaService
    - getAssetList()
    - getAssetByName($name)
    - getFilesByFilter($filter)
    - deleteAsset($assetId)
    - createAsset(Asset $asset)
    - createFileInfos(Asset $asset)
    - getLatestMediaProcessor($name)
    - getJob(Job $job | jobId)
    - getJobList()
    - getJobOutputMediaAssets(Job $job)
    - getJobListByState($state, $filter = null)
    - getJobListByFilter($filter)