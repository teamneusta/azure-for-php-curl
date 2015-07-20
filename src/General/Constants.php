<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>
 ***************************************************************/
namespace Bennsel\WindowsAzureCurl\General;

class Constants {
    const OAUTH_GRANT_TYPE = 'grant_type';
    const OAUTH_CLIENT_ID = 'client_id';
    const OAUTH_CLIENT_SECRET = 'client_secret';
    const OAUTH_SCOPE = 'scope';

    const HTTP_POST = 'POST';

    const MEDIA_SERVICES_URL = 'https://media.windows.net/API/';
    const MEDIA_SERVICES_OAUTH_URL = 'https://wamsprodglobal001acs.accesscontrol.windows.net/v2/OAuth2-13';
    const MEDIA_SERVICES_OAUTH_SCOPE = 'urn:WindowsAzureMediaServices';
    const MEDIA_SERVICES_INPUT_ASSETS_REL  = 'http://schemas.microsoft.com/ado/2007/08/dataservices/related/InputMediaAssets';
    const MEDIA_SERVICES_ASSET_REL  = 'http://schemas.microsoft.com/ado/2007/08/dataservices/related/Asset';
}